$(document).ready(function () {
    // View Report (Chrome-like Viewer Logic)
    let currentZoom = 1;
    const ZOOM_STEP = 0.1;
    const MAX_ZOOM = 2.0;
    const MIN_ZOOM = 0.25;

    // ── Header Toggle ──────────────────────────────────────
    let showReportHeader = true;

    $(document).on('click', '.pdf-header-toggle', function () {
        showReportHeader = $(this).attr('id') === 'btn-with-header';
        $('.pdf-header-toggle').removeClass('is-active');
        $(this).addClass('is-active');

        // Update Dropdown UI
        if (showReportHeader) {
            $('#current-mode-text').text('With Header');
            $('#current-mode-icon').removeClass('fa-file-o').addClass('fa-id-card-o');
        } else {
            $('#current-mode-text').text('No Header');
            $('#current-mode-icon').removeClass('fa-id-card-o').addClass('fa-file-o');
        }

        let id = $('#btn-viewer-download').data('current-id');
        if (!id) return;
        $('#pdf-canvas-container').html(`<div class="text-center py-100" style="color:#64748b;"><div style="width:40px;height:40px;border:3px solid rgba(99,102,241,0.3);border-top-color:#6366f1;border-radius:50%;animation:spin 0.9s linear infinite;margin:0 auto 16px;"></div><p style="font-size:13px;">Re-generating...</p></div>`);
        $.get("/reports/" + id, function (data) {
            const doc = createPDFDocument(data, showReportHeader);
            const pdfBlob = doc.output('blob');
            renderPDF(URL.createObjectURL(pdfBlob));
        }).fail(function (xhr) {
            $('#pdf-canvas-container').html(`<div class="alert alert-danger m-20">Could not reload report preview. ${xhr.responseJSON?.message || 'Please try again.'}</div>`);
        });
    });
    // ──────────────────────────────────────────────────────

    $(document).on('click', '.btn-view', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        // Open modal
        $('#modal-view-report').modal('show');

        // Reset header toggle to 'With Header'
        showReportHeader = true;
        $('.pdf-header-toggle').removeClass('is-active');
        $('#btn-with-header').addClass('is-active');

        $('#btn-viewer-download').data('current-id', id);
        $('#btn-viewer-print').data('current-id', id);
        $('#btn-viewer-share').data('current-id', id);

        $('#pdf-canvas-container').html(`
          <div class="text-center py-100">
              <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                  <span class="visually-hidden">Loading...</span>
              </div>
              <p class="mt-20 text-muted fs-16">Generating real PDF preview...</p>
          </div>
        `);

        // Reset zoom
        currentZoom = 1;
        applyZoom();

        $.get("/reports/" + id, function (data) {
            let p = data.patient;
            let filename = `Report_${p.first_name}_${id}.pdf`;
            $('#viewer-filename-link').text(filename);
            $('#viewer-filename-link').attr('title', `Click to open ${filename} directly`);

            // Generate PDF Blob
            const doc = createPDFDocument(data, showReportHeader);
            const pdfBlob = doc.output('blob');
            const pdfUrl = URL.createObjectURL(pdfBlob);

            // Render PDF using PDF.js
            renderPDF(pdfUrl).then(() => {
                // On mobile, default to fit width
                if (window.innerWidth < 768) {
                    $('#fit-width').click();
                }
            });
        }).fail(function (xhr) {
            $('#pdf-canvas-container').html(`<div class="alert alert-danger m-20">Could not load report preview. ${xhr.responseJSON?.message || 'Please try again.'}</div>`);
        });
    });

    async function renderPDF(url) {
        try {
            if (!window.pdfjsLib) {
                throw new Error('PDF preview engine did not load.');
            }

            const loadingTask = pdfjsLib.getDocument(url);
            const pdf = await loadingTask.promise;
            const container = document.getElementById('pdf-canvas-container');
            container.innerHTML = ''; // Clear loader

            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                const page = await pdf.getPage(pageNum);
                const viewport = page.getViewport({ scale: 1.5 }); // High resolution render

                const wrapper = document.createElement('div');
                wrapper.className = 'pdf-canvas-wrapper mb-20';

                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                canvas.dataset.baseWidth = viewport.width;
                canvas.style.width = `${viewport.width * currentZoom}px`;

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };

                wrapper.appendChild(canvas);
                container.appendChild(wrapper);

                await page.render(renderContext).promise;
            }

            applyZoom();
        } catch (error) {
            console.error('PDF Rendering Error:', error);
            $('#pdf-canvas-container').html(`<div class="alert alert-danger m-20">Error rendering PDF: ${error.message}</div>`);
        }
    }

    // Zoom Functions
    function applyZoom() {
        $('#pdf-page-container').css('transform', 'none');
        $('#pdf-canvas-container canvas').each(function () {
            const baseWidth = parseFloat(this.dataset.baseWidth || this.width || 794);
            $(this).css('width', `${baseWidth * currentZoom}px`);
        });
        $('#zoom-text').text(`${Math.round(currentZoom * 100)}%`);
    }

    $('#zoom-in').click(function () {
        if (currentZoom < MAX_ZOOM) {
            currentZoom += ZOOM_STEP;
            applyZoom();
        }
    });

    $('#zoom-out').click(function () {
        if (currentZoom > MIN_ZOOM) {
            currentZoom -= ZOOM_STEP;
            applyZoom();
        }
    });

    $('#fit-width').click(function () {
        let containerWidth = $('#pdf-viewport').width() - (window.innerWidth < 768 ? 14 : 80);
        let firstCanvas = $('#pdf-canvas-container canvas').first()[0];
        let pageWidth = parseFloat(firstCanvas?.dataset.baseWidth || firstCanvas?.width || 794);
        currentZoom = containerWidth / pageWidth;
        if (currentZoom > MAX_ZOOM) currentZoom = MAX_ZOOM;
        if (currentZoom < MIN_ZOOM) currentZoom = MIN_ZOOM;
        applyZoom();
    });

    $('#fit-page').click(function () {
        let containerHeight = $('#pdf-viewport').height() - 80;
        let pageHeight = 1123; // A4 Height in px roughly
        currentZoom = containerHeight / pageHeight;
        if (currentZoom > MAX_ZOOM) currentZoom = MAX_ZOOM;
        if (currentZoom < MIN_ZOOM) currentZoom = MIN_ZOOM;
        applyZoom();
    });

    // Keyboard Navigation
    $(document).on('keydown', function (e) {
        // Only active when PDF viewer is open
        if (!$('#modal-view-report').hasClass('show')) return;

        const viewport = $('#pdf-viewport')[0];
        const scrollStep = 100;
        const pageStep = $('#pdf-viewport').height() * 0.85;

        switch (e.key) {
            case 'ArrowDown':
                viewport.scrollTop += scrollStep;
                e.preventDefault();
                break;
            case 'ArrowUp':
                viewport.scrollTop -= scrollStep;
                e.preventDefault();
                break;
            case 'PageDown':
            case ' ': // Space bar
                if (!$(e.target).is('input, textarea, select')) {
                    $('#pdf-viewport').stop().animate({ scrollTop: $('#pdf-viewport').scrollTop() + pageStep }, 200);
                    e.preventDefault();
                }
                break;
            case 'PageUp':
                $('#pdf-viewport').stop().animate({ scrollTop: $('#pdf-viewport').scrollTop() - pageStep }, 200);
                e.preventDefault();
                break;
            case 'Home':
                $('#pdf-viewport').stop().animate({ scrollTop: 0 }, 300);
                e.preventDefault();
                break;
            case 'End':
                $('#pdf-viewport').stop().animate({ scrollTop: viewport.scrollHeight }, 300);
                e.preventDefault();
                break;
            case '+':
            case '=':
                if (e.ctrlKey) { $('#zoom-in').click(); e.preventDefault(); }
                break;
            case '-':
            case '_':
                if (e.ctrlKey) { $('#zoom-out').click(); e.preventDefault(); }
                break;
            case '0':
                if (e.ctrlKey) { currentZoom = 1; applyZoom(); e.preventDefault(); }
                break;
        }
    });

    $('#btn-viewer-fullscreen').click(function () {
        const elem = document.querySelector('.pdf-viewer-wrapper');
        if (!document.fullscreenElement) {
            elem.requestFullscreen().catch(err => {
                alert(`Error attempting to enable full-screen mode: ${err.message}`);
            });
            $(this).find('i').removeClass('fa-expand').addClass('fa-compress');
        } else {
            document.exitFullscreen();
            $(this).find('i').removeClass('fa-compress').addClass('fa-expand');
        }
    });

    $('#btn-viewer-print').click(function () {
        let id = $(this).data('current-id');
        $.get("/reports/" + id, function (data) {
            const doc = createPDFDocument(data, showReportHeader);
            window.open(doc.output('bloburl'), '_blank');
        });
    });

    $(document).on('click', '#viewer-filename-link', function () {
        let id = $('#btn-viewer-download').data('current-id');
        generateAndOpenPDF(id);
    });

    function generateAndOpenPDF(reportId) {
        const { jsPDF } = window.jspdf;
        $.get("/reports/" + reportId, function (data) {
            const doc = createPDFDocument(data, showReportHeader);
            window.open(doc.output('bloburl'), '_blank');
        });
    }

    // Helper to create the Awwal-style lab report PDF.
    function createPDFDocument(data, showHeader = true) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        const p = data.patient;
        const referenceNo = (p.patient_id || '').replace('#P-', '').replace('#', '');
        const patientName = `${(p.first_name || '').toUpperCase()} ${(p.last_name || '').toUpperCase()}`.trim();
        const sex = (p.gender || '').toUpperCase();
        const reportDate = moment(data.sample_received_on).format('DD-MMM-YYYY - hh:mm:ss A');
        const printedDate = moment().format('DD-MMM-YYYY - hh:mm:ss A');
        const reportNotes = (data.notes || '').trim();
        const signature = data.signature || null;

        const pageW = doc.internal.pageSize.getWidth();
        const pageH = doc.internal.pageSize.getHeight();
        const left = 20;
        const tableW = 170;
        const col1 = 70; // Parameter
        const col2 = 25; // Result
        const col3 = 20; // Unit
        const col4 = 43; // Reference Interval
        const col5 = 12; // Flag
        const footerTop = 269;
        let pageNo = 1;
        let alternatingRowIdx = 0;

        function addShell(isFirstPage = true) {
            if (showHeader) {
                const hProps = doc.getImageProperties(window.REPORT_HEADER_IMAGE);
                const hHeight = (hProps.height * pageW) / hProps.width;
                doc.addImage(window.REPORT_HEADER_IMAGE, 'JPEG', 0, 0, pageW, hHeight, undefined, 'FAST');
            }

            const fProps = doc.getImageProperties(window.REPORT_FOOTER_IMAGE);
            const fHeight = (fProps.height * pageW) / fProps.width;
            const actualFooterTop = pageH - fHeight;
            doc.addImage(window.REPORT_FOOTER_IMAGE, 'PNG', 0, actualFooterTop, pageW, fHeight);

            doc.setTextColor(30, 41, 59);
            doc.setDrawColor(226, 232, 240);
            doc.setLineWidth(0.25);

            const infoY = 44;

            // Draw Patient Card Background
            doc.setFillColor(248, 250, 252);
            doc.roundedRect(left, infoY - 5, tableW, 26, 2, 2, 'FD');

            doc.setFont('helvetica', 'normal');
            doc.setFontSize(9);

            // Column 1 Labels & Values
            doc.setTextColor(100, 116, 139);
            doc.text('PATIENT NAME', left + 4, infoY + 1);
            doc.text('REFERENCE NO', left + 4, infoY + 7);
            doc.text('REFERRED BY', left + 4, infoY + 13);
            doc.text('PRINTED DATE', left + 4, infoY + 19);

            doc.text(':', left + 34, infoY + 1);
            doc.text(':', left + 34, infoY + 7);
            doc.text(':', left + 34, infoY + 13);
            doc.text(':', left + 34, infoY + 19);

            doc.setTextColor(15, 23, 42);
            doc.setFont('helvetica', 'bold');
            doc.text(patientName, left + 36, infoY + 1);
            doc.setFont('helvetica', 'normal');
            doc.text(referenceNo, left + 36, infoY + 7);
            doc.setFont('helvetica', 'bold');
            let docDisplayName = data.doctor_name || 'Self';
            if (data.doctor_qualification && data.doctor_qualification.trim() !== '') {
                docDisplayName += ' (' + data.doctor_qualification + ')';
            }
            doc.text(docDisplayName, left + 36, infoY + 13);
            doc.setFont('helvetica', 'normal');
            doc.text(printedDate, left + 36, infoY + 19);

            // Column 2 Labels & Values
            doc.setTextColor(100, 116, 139);
            doc.text('AGE / SEX', left + 105, infoY + 1);
            doc.text('SPECIMEN', left + 105, infoY + 7);
            doc.text('RECEIVED DATE', left + 105, infoY + 13);

            doc.text(':', left + 133, infoY + 1);
            doc.text(':', left + 133, infoY + 7);
            doc.text(':', left + 133, infoY + 13);

            doc.setTextColor(15, 23, 42);
            doc.setFont('helvetica', 'bold');
            doc.text(`${p.age || ''} ${p.age_type || 'Years'} / ${sex}`, left + 135, infoY + 1);
            doc.setFont('helvetica', 'normal');
            doc.text('Blood / Serum', left + 135, infoY + 7);
            doc.text(isFirstPage ? reportDate.split(' - ')[0] : moment(data.sample_received_on).format('DD-MMM-YYYY'), left + 135, infoY + 13);
        }

        function addNewPage() {
            doc.addPage();
            pageNo += 1;
            addShell(false);
            alternatingRowIdx = 0;
            return 72;
        }

        function drawCategoryTitle(title, y) {
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(11);
            doc.setTextColor(138, 39, 125);
            doc.text((title || 'GENERAL').toUpperCase(), left + 2, y);

            // Category Underline
            doc.setDrawColor(138, 39, 125);
            doc.setLineWidth(0.5);
            doc.line(left, y + 2, left + tableW, y + 2);

            return y + 7;
        }

        function drawTableHeader(y) {
            doc.setFont('helvetica', 'bold');
            doc.setFontSize(9);
            doc.setTextColor(71, 85, 105);

            // Header box background
            doc.setFillColor(241, 245, 249);
            doc.rect(left, y, tableW, 8, 'F');

            // Top/Bottom border lines
            doc.setDrawColor(203, 213, 225);
            doc.setLineWidth(0.3);
            doc.line(left, y, left + tableW, y);
            doc.line(left, y + 8, left + tableW, y + 8);

            doc.text('PARAMETER', left + 4, y + 5.5);
            doc.text('RESULT', left + col1 + 4, y + 5.5);
            doc.text('UNIT', left + col1 + col2 + 4, y + 5.5);
            doc.text('REFERENCE RANGE', left + col1 + col2 + col3 + 4, y + 5.5);
            doc.text('FLAG', left + col1 + col2 + col3 + col4 + col5 / 2, y + 5.5, { align: 'center' });
            return y + 8;
        }

        function drawCellRow(y, name, observedValue, unit, reference, flag = '', isSubheading = false) {
            doc.setFontSize(9.5);
            doc.setLineWidth(0.2);
            doc.setDrawColor(226, 232, 240);

            const nameLines = doc.splitTextToSize(name || '', col1 - 6);
            const observedLines = doc.splitTextToSize(observedValue || '', col2 - 4);
            const refLines = doc.splitTextToSize(reference || '', col4 - 4);
            const unitLines = doc.splitTextToSize(unit || '', col3 - 4);

            const lineCount = Math.max(nameLines.length, observedLines.length, refLines.length, unitLines.length, 1);
            const rowH = isSubheading ? 7 : Math.max(6.5, lineCount * 5);

            if (y + rowH > footerTop - 12) {
                y = addNewPage();
                y = drawTableHeader(y);
            }

            if (isSubheading) {
                // Subheading Background
                doc.setFillColor(248, 250, 252);
                doc.rect(left, y, tableW, rowH, 'F');

                // Left Accent Line
                doc.setFillColor(138, 39, 125);
                doc.rect(left, y, 1.5, rowH, 'F');

                doc.setFont('helvetica', 'bold');
                doc.setTextColor(71, 85, 105);
                doc.text((name || '').toUpperCase(), left + 5, y + 4.5);
            } else {
                // Alternating background
                if (alternatingRowIdx % 2 === 1) {
                    doc.setFillColor(248, 250, 252);
                    doc.rect(left, y, tableW, rowH, 'F');
                }
                alternatingRowIdx++;

                // Parameter Name
                doc.setTextColor(15, 23, 42);
                doc.setFont('helvetica', 'normal');
                doc.text(nameLines, left + 4, y + 4.5);

                // Observed Value (Result)
                doc.setFont('helvetica', 'bold');

                // Highlight observed value if flagged
                if (flag) {
                    const fUpper = String(flag).toUpperCase();
                    if (fUpper.includes('H') || fUpper.includes('↑')) doc.setTextColor(234, 88, 12);
                    else if (fUpper.includes('L') || fUpper.includes('↓')) doc.setTextColor(37, 99, 235);
                    else doc.setTextColor(220, 38, 38); // Critical / other
                } else {
                    doc.setTextColor(15, 23, 42);
                }

                doc.text(observedLines, left + col1 + 4, y + 4.5);

                // Unit
                doc.setFont('helvetica', 'normal');
                doc.setTextColor(100, 116, 139);
                doc.text(unitLines, left + col1 + col2 + 4, y + 4.5);

                // Reference Value
                doc.setTextColor(51, 65, 85);
                doc.text(refLines, left + col1 + col2 + col3 + 4, y + 4.5);

                // Flag (Centered in last column)
                if (flag) {
                    const flagStr = String(flag).trim().toUpperCase();
                    let flagX = left + col1 + col2 + col3 + col4 + col5 / 2;

                    const isHigh = flagStr.includes('H') || flagStr.includes('↑') || flagStr.includes('HIGH');
                    const isLow = flagStr.includes('L') || flagStr.includes('↓') || flagStr.includes('LOW');
                    const isDoubleHigh = flagStr.includes('HH') || flagStr.includes('↑↑') || flagStr.includes('CRITICAL HIGH');
                    const isDoubleLow = flagStr.includes('LL') || flagStr.includes('↓↓') || flagStr.includes('CRITICAL LOW');

                    if (isHigh) {
                        doc.setLineWidth(0.4);
                        doc.setDrawColor(220, 38, 38);

                        const bottomY = y + 4.5;
                        const topY = y + 1.5;

                        doc.line(flagX, bottomY, flagX, topY);
                        doc.line(flagX, topY, flagX - 1, topY + 1);
                        doc.line(flagX, topY, flagX + 1, topY + 1);

                        if (isDoubleHigh) {
                            doc.line(flagX + 2.5, bottomY, flagX + 2.5, topY);
                            doc.line(flagX + 2.5, topY, flagX + 1.5, topY + 1);
                            doc.line(flagX + 2.5, topY, flagX + 3.5, topY + 1);
                        }
                    } else if (isLow) {
                        doc.setLineWidth(0.4);
                        doc.setDrawColor(37, 99, 235);

                        const bottomY = y + 4.5;
                        const topY = y + 1.5;

                        doc.line(flagX, topY, flagX, bottomY);
                        doc.line(flagX, bottomY, flagX - 1, bottomY - 1);
                        doc.line(flagX, bottomY, flagX + 1, bottomY - 1);

                        if (isDoubleLow) {
                            doc.line(flagX + 2.5, topY, flagX + 2.5, bottomY);
                            doc.line(flagX + 2.5, bottomY, flagX + 1.5, bottomY - 1);
                            doc.line(flagX + 2.5, bottomY, flagX + 3.5, bottomY - 1);
                        }
                    } else {
                        doc.setFont('helvetica', 'bold');
                        doc.setTextColor(220, 38, 38);
                        doc.text(flagStr, flagX, y + 4.5, { align: 'center' });
                    }
                    doc.setDrawColor(226, 232, 240);
                } else {
                    doc.setTextColor(203, 213, 225);
                    doc.text('-', left + col1 + col2 + col3 + col4 + col5 / 2, y + 4.5, { align: 'center' });
                }
            }

            // Underline row
            doc.setDrawColor(226, 232, 240);
            doc.line(left, y + rowH, left + tableW, y + rowH);

            doc.setTextColor(15, 23, 42);
            return y + rowH;
        }

        function imageFormatFromDataUrl(dataUrl) {
            if (!dataUrl || dataUrl.indexOf('image/jpeg') !== -1 || dataUrl.indexOf('image/jpg') !== -1) {
                return 'JPEG';
            }
            return 'PNG';
        }

        addShell(true);

        let groupedResults = {};
        (data.results || []).forEach(r => {
            const cat = (r.category || 'GENERAL').toUpperCase();
            if (!groupedResults[cat]) groupedResults[cat] = [];
            groupedResults[cat].push(r);
        });

        let y = 77;
        const sortedCategories = Object.keys(groupedResults).sort((a, b) => {
            const isA = /H[AE]{1,2}M[AO]TOLOGY/i.test(a);
            const isB = /H[AE]{1,2}M[AO]TOLOGY/i.test(b);
            if (isA && !isB) return -1;
            if (!isA && isB) return 1;
            return a.localeCompare(b);
        });
        sortedCategories.forEach(cat => {
            if (y > footerTop - 35) y = addNewPage();
            y = drawCategoryTitle(cat, y);
            y = drawTableHeader(y);

            let lastSubheading = null;
            groupedResults[cat].forEach(r => {
                const subheading = (r.subcategory || '').trim();
                if (subheading && subheading !== lastSubheading) {
                    y = drawCellRow(y, subheading, '', '', '', '', true);
                    lastSubheading = subheading;
                }

                const refVal = r.normal_value !== null && r.normal_value !== undefined && r.normal_value !== '' ? r.normal_value : r.biological_reference;
                const reference = refVal !== null && refVal !== undefined ? refVal : '';
                const obsVal = r.observed_value !== null && r.observed_value !== undefined ? r.observed_value : '';
                const flgVal = r.flag !== null && r.flag !== undefined ? r.flag : '';
                y = drawCellRow(y, r.name || '', obsVal, r.unit || '', reference, flgVal);
            });

            y += 6;
        });

        // Notes & Signatures
        if (y > footerTop - 50) y = addNewPage();

        // Note Box
        doc.setFillColor(248, 250, 252);
        doc.setDrawColor(226, 232, 240);
        doc.setLineWidth(0.25);

        // Left Accent Line for note
        doc.setFillColor(138, 39, 125);

        const noteBoxW = 120; // Increased from 100 to allow wider notes
        const noteBoxH = Math.max(20, reportNotes ? (doc.splitTextToSize(reportNotes, noteBoxW - 8).length * 5 + 10) : 20);
        if (y + noteBoxH > footerTop - 15) {
            y = addNewPage();
        }

        doc.setFillColor(248, 250, 252);
        doc.rect(left, y + 2, noteBoxW, noteBoxH, 'FD');
        doc.setFillColor(138, 39, 125);
        doc.rect(left, y + 2, 1.5, noteBoxH, 'F');

        doc.setFont('helvetica', 'bold');
        doc.setFontSize(8.5);
        doc.setTextColor(15, 23, 42);
        doc.text('NOTES / INTERPRETATION', left + 4, y + 8);

        doc.setFont('helvetica', 'normal');
        doc.setFontSize(9);
        doc.setTextColor(71, 85, 105);

        if (reportNotes) {
            const noteLines = doc.splitTextToSize(reportNotes, noteBoxW - 8);
            doc.text(noteLines, left + 4, y + 14);
        } else {
            doc.setFont('helvetica', 'italic');
            doc.text('No notes provided.', left + 4, y + 14);
        }

        // Signature image and details
        if (signature && signature.image_data) {
            try {
                doc.addImage(signature.image_data, imageFormatFromDataUrl(signature.image_data), 148, footerTop - 34, 38, 18, undefined, 'FAST');
            } catch (error) {
                console.warn('Could not add signature image:', error);
            }
        }

        doc.setFont('helvetica', 'bold');
        doc.setFontSize(9.5);
        doc.setTextColor(15, 23, 42);
        doc.text(signature?.name || 'Medi Technician', left + 138, footerTop - 8, { align: 'center' });

        doc.setFont('helvetica', 'normal');
        doc.setFontSize(8);
        doc.setTextColor(100, 116, 139);
        doc.text(signature?.name ? 'Authorized Signatory' : 'Lab In-Charge', left + 138, footerTop - 4, { align: 'center' });

        if (pageNo > 1) {
            doc.setFontSize(8.5);
            doc.text(`Page No : ${pageNo}`, left + 4, 38);
        }

        return doc;
    }

    $('#btn-viewer-download').click(function () {
        let id = $(this).data('current-id');
        generateAndDownloadPDF(id, showReportHeader);
    });

    // Share Report PDF
    $('#btn-viewer-share').click(function () {
        let id = $(this).data('current-id');
        let btn = $(this);
        let originalHtml = btn.html();
        btn.html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);

        $.get("/reports/" + id, function (data) {
            const doc = createPDFDocument(data, showReportHeader);
            const p = data.patient;
            const filename = `Report_${p.first_name}_${p.last_name}_${id}.pdf`;

            // Generate PDF as Blob
            const pdfBlob = doc.output('blob');
            const pdfFile = new File([pdfBlob], filename, { type: 'application/pdf' });

            // Try Web Share API (supports file sharing on mobile)
            if (navigator.share && navigator.canShare && navigator.canShare({ files: [pdfFile] })) {
                navigator.share({
                    title: `Lab Report - ${p.first_name} ${p.last_name}`,
                    text: `Lab Report for ${p.first_name} ${p.last_name}. Please find the attached PDF report.`,
                    files: [pdfFile]
                }).then(() => {
                    console.log('Report shared successfully.');
                }).catch(err => {
                    if (err.name !== 'AbortError') {
                        console.warn('Share failed, falling back:', err);
                        shareViaWhatsApp(p, filename, pdfBlob);
                    }
                });
            } else if (navigator.share) {
                // Share API available but no file support — share link/text
                navigator.share({
                    title: `Lab Report - ${p.first_name} ${p.last_name}`,
                    text: `Lab Report for ${p.first_name} ${p.last_name} (ID: ${p.patient_id}). Generated from SUHAIM SOFT LAB Management System.`,
                }).catch(err => console.warn('Share failed:', err));
            } else {
                // Desktop fallback: WhatsApp + auto-download
                shareViaWhatsApp(p, filename, pdfBlob);
            }

            btn.html(originalHtml).prop('disabled', false);
        }).fail(function () {
            alert('Failed to generate report for sharing.');
            btn.html(originalHtml).prop('disabled', false);
        });
    });

    function shareViaWhatsApp(patient, filename, pdfBlob) {
        // Auto-download the PDF first
        const url = URL.createObjectURL(pdfBlob);
        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        a.click();
        URL.revokeObjectURL(url);

        // Open WhatsApp with a pre-filled message
        const phone = patient.phone ? patient.phone.replace(/\D/g, '') : '';
        const msg = encodeURIComponent(`Lab Report for ${patient.first_name} ${patient.last_name} (ID: ${patient.patient_id}).\n\nPlease find your report PDF that has been downloaded. You can attach it manually.`);
        const waUrl = phone
            ? `https://wa.me/${phone}?text=${msg}`
            : `https://wa.me/?text=${msg}`;

        setTimeout(() => window.open(waUrl, '_blank'), 500);
    }

    function generateAndDownloadPDF(reportId, withHeader = true, callback) {
        $.get("/reports/" + reportId, function (data) {
            const doc = createPDFDocument(data, withHeader);
            const p = data.patient;
            doc.save(`Report_${p.first_name}_${reportId}.pdf`);
            if (callback) callback();
        });
    }
});
