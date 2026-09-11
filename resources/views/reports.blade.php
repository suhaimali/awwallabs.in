@extends('layouts.app')
@section('title', 'Test Reports')
@section('page-title', 'Test Reports')

@section('content')
<div class="page-header-aw">
    <div class="page-title-aw">
        <div class="title-icon"><i class="fa fa-file-medical"></i></div>
        <div>
            <div>Test Reports</div>
            <div style="font-size:13px; font-weight:400; color:var(--text-muted); margin-top:2px;">Generate, preview, print, and manage patient laboratory reports</div>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2">
        
        <button type="button" class="btn-aw-primary" data-bs-toggle="modal" data-bs-target="#modal-add-report">
            <i class="fa fa-plus-circle"></i> Add New Report
        </button>
    </div>
</div>
            <style>
                @media (max-width: 767px) {
                    .table th, .table td { padding: 10px 8px !important; font-size: 11px; }
                    .page-title { font-size: 18px; }
                    .page-header-aw .d-flex.gap-2 { flex-direction: column; gap: 5px !important; align-items: flex-end; }
                    
                    /* Responsive Add/Edit Modals */
                    .modal-body .input-group.flex-nowrap {
                        flex-wrap: wrap !important;
                        border: none !important;
                        box-shadow: none !important;
                    }
                    .modal-body .input-group.flex-nowrap > .form-select,
                    .modal-body .input-group.flex-nowrap > .form-control {
                        width: 100% !important;
                        flex: 1 1 100% !important;
                        border-radius: 8px !important;
                        margin-bottom: 8px;
                        border: 1px solid #ced4da !important;
                    }
                    .modal-body .input-group.flex-nowrap:focus-within > .form-select,
                    .modal-body .input-group.flex-nowrap:focus-within > .form-control {
                        border-color: #86b7fe !important;
                        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
                    }
                    .modal-body .input-group.flex-nowrap > .btn {
                        flex: 1;
                        border-radius: 8px !important;
                        margin: 0 4px !important;
                        padding: 8px 0 !important;
                        height: auto !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                    }
                    .modal-body .input-group.flex-nowrap > .btn:first-of-type {
                        margin-left: 0 !important;
                    }
                    .modal-body .input-group.flex-nowrap > .btn:last-of-type {
                        margin-right: 0 !important;
                    }
                }

/* ── Simple Modal UI for Generate/Edit Lab Report ── */
#modal-add-report .modal-header,
#modal-edit-report .modal-header {
    background: #fff;
    border-bottom: 2px solid #e2e8f0;
    padding: 16px 20px;
}
#modal-add-report .modal-title,
#modal-edit-report .modal-title {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
}
#modal-add-report .modal-content,
#modal-edit-report .modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}
#modal-add-report .modal-footer,
#modal-edit-report .modal-footer {
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    padding: 12px 20px;
}
#modal-add-report .modal-body,
#modal-edit-report .modal-body {
    background: #ffffff;
    padding: 20px;
}
/* Simple section divider headers */
#modal-add-report h4.text-primary,
#modal-edit-report h4.text-primary {
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: 0.8px !important;
    text-transform: uppercase !important;
    color: #64748b !important;
    border-bottom: 1px solid #e2e8f0 !important;
    padding-bottom: 8px !important;
    margin-bottom: 14px !important;
}
/* Simple form labels */
#modal-add-report .form-label,
#modal-edit-report .form-label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 4px;
}
/* Simple, clean form controls */
#modal-add-report .form-control,
#modal-add-report .form-select,
#modal-edit-report .form-control,
#modal-edit-report .form-select {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 13px;
    color: #1e293b;
    height: 38px;
    padding: 6px 10px;
    background: #fff;
    box-shadow: none;
}
#modal-add-report textarea.form-control,
#modal-edit-report textarea.form-control {
    height: auto;
}
#modal-add-report .form-control:focus,
#modal-add-report .form-select:focus,
#modal-edit-report .form-control:focus,
#modal-edit-report .form-select:focus {
    border-color: #0284c7;
    box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.12);
}
/* Test row — simple flat white card */
.test-item-row {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 10px !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
    margin-bottom: 10px !important;
}
.test-item-row .card-body {
    padding: 14px 16px !important;
}
/* Keep the SL badge simple */
.test-item-row .row-sl-no {
    background: #0284c7 !important;
    font-size: 10px !important;
    font-weight: 700 !important;
    top: 12px !important;
    left: 12px !important;
    padding: 2px 8px !important;
    border-radius: 4px !important;
}
/* Remove row button clean */
.test-item-row .remove-row {
    top: 8px !important;
    right: 10px !important;
    background: #fff !important;
    border: 1px solid #fca5a5 !important;
    color: #ef4444 !important;
    border-radius: 6px !important;
    padding: 2px 6px !important;
    font-size: 12px !important;
    opacity: 1 !important;
}
.test-item-row .remove-row:hover {
    background: #fef2f2 !important;
    transform: none !important;
}
/* Load template / add test row controls */
#modal-add-report .select-load-report-template,
#modal-edit-report .select-load-report-template {
    border: 1px solid #e2e8f0 !important;
    border-radius: 8px !important;
    font-size: 12px !important;
}
 
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

.pdf-viewer-wrapper {
    display: flex;
    flex-direction: column;
    height: 100vh;
    height: 100dvh;
    background-color: #f8fafc;
    overflow: hidden;
    font-family: 'Inter', sans-serif;
}

.pdf-toolbar {
    background-color: #ffffff;
    border-bottom: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    color: #334155;
    padding: 0 20px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 1000;
}

.toolbar-section {
    display: flex;
    align-items: center;
    gap: 8px;
}

.pdf-btn {
    background: transparent;
    border: 1px solid transparent;
    color: #64748b;
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.2s;
}

.pdf-btn:hover {
    background: #f1f5f9;
    color: #0f172a;
}

.pdf-btn.pdf-btn-action {
    color: #0284c7;
    background: #f0f9ff;
    border: 1px solid #bae6fd;
}

.pdf-btn.pdf-btn-action:hover {
    background: #e0f2fe;
    color: #0369a1;
}

.pdf-btn.pdf-btn-share {
    color: #10b981;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
}

.pdf-btn.pdf-btn-share:hover {
    background: #d1fae5;
    color: #047857;
}

#viewer-filename-link {
    font-size: 14px;
    font-weight: 600;
    color: #334155 !important;
    text-decoration: none;
}

.toolbar-divider {
    width: 1px;
    height: 24px;
    background: #e2e8f0;
    margin: 0 8px;
}

.pdf-toolbar-center {
    display: flex;
    align-items: center;
    gap: 4px;
    background: #f8fafc;
    padding: 4px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.zoom-level {
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    min-width: 45px;
    text-align: center;
}

.header-toggle-container {
    display: flex;
    align-items: center;
}

.pdf-viewport {
    flex: 1;
    overflow: auto;
    padding: 30px;
    background-color: #cbd5e1;
}

.pdf-page-container {
    margin: 0 auto;
    width: max-content;
    max-width: 100%;
}

#pdf-canvas-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: center;
}

.pdf-canvas-wrapper {
    background: #ffffff;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border-radius: 2px;
    max-width: 100%;
    overflow: hidden;
}

.pdf-canvas-wrapper canvas {
    max-width: 100%;
    height: auto !important;
    display: block;
}

@media (max-width: 768px) {
    .pdf-toolbar {
        height: auto;
        padding: 10px;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }
    .toolbar-section {
        gap: 6px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .pdf-toolbar-center {
        order: 3;
        width: 100%;
        justify-content: center;
        margin-top: 4px;
    }
    .pdf-viewport {
        padding: 10px;
    }
    .pdf-btn {
        padding: 6px 10px;
    }
    .pdf-btn span {
        display: inline-block;
        font-size: 11px;
    }
    #viewer-filename-link {
        max-width: 100%;
        white-space: normal;
        word-break: break-all;
        font-size: 12px;
        display: inline-block;
        vertical-align: middle;
    }
}

@media (max-width: 480px) {
    .pdf-btn {
        padding: 8px 10px;
    }
    .toolbar-divider {
        margin: 0 4px;
    }
}

@media print {
                    @page { 
                        size: A4 portrait;
                        margin: 0; 
                    }
                    body { margin: 0; padding: 0; background: white !important; -webkit-print-color-adjust: exact; }
                    body * { visibility: hidden; }
                    .pdf-viewer-wrapper, .pdf-viewport, #pdf-page-container, #pdf-canvas-container, #pdf-canvas-container *, canvas { visibility: visible !important; }
                    .pdf-viewer-wrapper { position: absolute; left: 0; top: 0; width: 100%; height: auto; background: white !important; overflow: visible !important; display: block !important; }
                    .pdf-viewport { padding: 0 !important; margin: 0 !important; overflow: visible !important; display: block !important; }
                    #pdf-page-container { transform: none !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
                    #pdf-canvas-container { width: 100% !important; gap: 0 !important; }
                    .pdf-canvas-wrapper { box-shadow: none !important; margin-bottom: 0 !important; page-break-after: always; width: 100% !important; height: auto !important; }
                    canvas { width: 100% !important; height: auto !important; display: block !important; }
                    .pdf-toolbar, .modal-header, .modal-footer, .btn { display: none !important; }
                }

                .report-header { border-bottom: 3px solid #0056b3; padding-bottom: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-start; }
                .report-table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
                .report-table th { border-bottom: 2px solid #333; padding: 12px; text-align: left; background: #f9f9f9; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #555; }
                .report-table td { border-bottom: 1px solid #eee; padding: 12px; text-align: left; font-size: 13px; }
                .report-section-title { font-weight: 800; color: #000000; padding: 15px 0 5px 0 !important; border-bottom: none !important; font-size: 14px; text-transform: uppercase; }
                .barcode-container { text-align: center; }
                .barcode-bars { font-family: 'Libre Barcode 39', cursive; font-size: 40px; line-height: 1; color: #000; }
                .patient-info-box { background: #fcfcfc; border: 1px solid #eee; border-radius: 8px; padding: 20px; margin-bottom: 30px; }
                .patient-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px 40px; }
                .info-item { font-size: 13px; line-height: 1.6; }
                .info-label { color: #777; font-weight: 500; min-width: 100px; display: inline-block; }
                .info-value { color: #000; font-weight: 600; }
                .report-title-main { font-size: 28px; font-weight: 900; color: #000; letter-spacing: -0.5px; }
                .signature-section { margin-top: 50px; display: flex; justify-content: space-between; }
                .signature-box { text-align: center; border-top: 1px solid #333; width: 200px; padding-top: 5px; font-size: 12px; font-weight: 600; }

                /* Custom responsive columns for Report generator popup */
                @media (min-width: 768px) {
                    .col-sub { flex: 1; min-width: 140px; padding-left: 8px; padding-right: 8px; }
                    .col-unit-dept { flex: 1; min-width: 140px; padding-left: 8px; padding-right: 8px; }
                    .col-param { flex: 1; min-width: 180px; padding-left: 8px; padding-right: 8px; }
                    .col-observed { flex: 1; min-width: 140px; padding-left: 8px; padding-right: 8px; }
                    .col-unit-meas { flex: 1; min-width: 140px; padding-left: 8px; padding-right: 8px; }
                    .col-ref { flex: 1; min-width: 160px; padding-left: 8px; padding-right: 8px; }
                    .col-flag { flex: 1; min-width: 120px; padding-left: 8px; padding-right: 8px; }
                    .col-action { flex: 0 0 80px; max-width: 80px; padding-left: 8px; padding-right: 8px; }
                    
                    #dynamic-tests-container .test-item-row,
                    #edit-dynamic-tests-container .test-item-row,
                    .d-none.d-md-flex.row {
                        flex-wrap: nowrap;
                    }
                }

                /* Unified premium input group styling matching mockup */
                .test-item-row .input-group.flex-nowrap {
                    border-radius: 8px !important;
                    overflow: hidden;
                    border: 1.5px solid #cbd5e1;
                    background-color: #fff;
                    transition: border-color 0.2s, box-shadow 0.2s;
                }

                .test-item-row .input-group.flex-nowrap:focus-within {
                    border-color: #0284c7 !important;
                    box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.14) !important;
                }

                .test-item-row .input-group.flex-nowrap .form-select {
                    border: none !important;
                    border-radius: 8px 0 0 8px !important;
                    height: 38px !important;
                    padding: 0.375rem 2.25rem 0.375rem 0.75rem !important;
                    font-size: 13px !important;
                    color: #1e293b !important;
                    outline: none !important;
                    box-shadow: none !important;
                    background-color: #ffffff !important;
                }

                .test-item-row .input-group.flex-nowrap .form-select:focus {
                    outline: none !important;
                    box-shadow: none !important;
                }

                /* Unified style for all buttons inside the input-group */
                .test-item-row .input-group.flex-nowrap .btn {
                    border: none !important;
                    border-left: 1px solid #cbd5e1 !important;
                    height: 38px !important;
                    width: 34px !important;
                    padding: 0 !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    font-size: 13px !important;
                    border-radius: 0 !important;
                    transition: all 0.2s ease !important;
                }

                /* Green '+' buttons */
                .test-item-row .input-group.flex-nowrap .btn-add-report-category,
                .test-item-row .input-group.flex-nowrap .btn-add-report-subcategory,
                .test-item-row .input-group.flex-nowrap .btn-add-report-test,
                .test-item-row .input-group.flex-nowrap .btn-add-report-unit,
                .test-item-row .input-group.flex-nowrap .btn-add-reference,
                .test-item-row .input-group.flex-nowrap .btn-add-observed,
                .test-item-row .input-group.flex-nowrap .btn-add-flag {
                    background-color: #e8f5e9 !important;
                    color: #2e7d32 !important;
                }

                .test-item-row .input-group.flex-nowrap .btn-add-report-category:hover,
                .test-item-row .input-group.flex-nowrap .btn-add-report-subcategory:hover,
                .test-item-row .input-group.flex-nowrap .btn-add-report-test:hover,
                .test-item-row .input-group.flex-nowrap .btn-add-report-unit:hover,
                .test-item-row .input-group.flex-nowrap .btn-add-reference:hover,
                .test-item-row .input-group.flex-nowrap .btn-add-observed:hover,
                .test-item-row .input-group.flex-nowrap .btn-add-flag:hover {
                    background-color: #2e7d32 !important;
                    color: #ffffff !important;
                }

                /* Indigo 'edit' buttons */
                .test-item-row .input-group.flex-nowrap .btn-edit-report-category,
                .test-item-row .input-group.flex-nowrap .btn-edit-report-subcategory,
                .test-item-row .input-group.flex-nowrap .btn-edit-report-test,
                .test-item-row .input-group.flex-nowrap .btn-edit-report-unit,
                .test-item-row .input-group.flex-nowrap .btn-edit-reference,
                .test-item-row .input-group.flex-nowrap .btn-edit-observed,
                .test-item-row .input-group.flex-nowrap .btn-edit-flag {
                    background-color: #e0e7ff !important;
                    color: #4f46e5 !important;
                }

                .test-item-row .input-group.flex-nowrap .btn-edit-report-category:hover,
                .test-item-row .input-group.flex-nowrap .btn-edit-report-subcategory:hover,
                .test-item-row .input-group.flex-nowrap .btn-edit-report-test:hover,
                .test-item-row .input-group.flex-nowrap .btn-edit-report-unit:hover,
                .test-item-row .input-group.flex-nowrap .btn-edit-reference:hover,
                .test-item-row .input-group.flex-nowrap .btn-edit-observed:hover,
                .test-item-row .input-group.flex-nowrap .btn-edit-flag:hover {
                    background-color: #4f46e5 !important;
                    color: #ffffff !important;
                }

                /* Blue 'eye' buttons */
                .test-item-row .input-group.flex-nowrap .btn-view-report-category,
                .test-item-row .input-group.flex-nowrap .btn-view-report-subcategory,
                .test-item-row .input-group.flex-nowrap .btn-view-report-test,
                .test-item-row .input-group.flex-nowrap .btn-view-report-unit,
                .test-item-row .input-group.flex-nowrap .btn-view-observed,
                .test-item-row .input-group.flex-nowrap .btn-view-reference,
                .test-item-row .input-group.flex-nowrap .btn-view-flag {
                    background-color: #e0f2fe !important;
                    color: #0369a1 !important;
                }

                .test-item-row .input-group.flex-nowrap .btn-view-report-category:hover,
                .test-item-row .input-group.flex-nowrap .btn-view-report-subcategory:hover,
                .test-item-row .input-group.flex-nowrap .btn-view-report-test:hover,
                .test-item-row .input-group.flex-nowrap .btn-view-report-unit:hover,
                .test-item-row .input-group.flex-nowrap .btn-view-observed:hover,
                .test-item-row .input-group.flex-nowrap .btn-view-reference:hover,
                .test-item-row .input-group.flex-nowrap .btn-view-flag:hover {
                    background-color: #0369a1 !important;
                    color: #ffffff !important;
                }

                /* Red 'delete' buttons */
                .test-item-row .input-group.flex-nowrap .btn-delete-report-category,
                .test-item-row .input-group.flex-nowrap .btn-delete-report-subcategory,
                .test-item-row .input-group.flex-nowrap .btn-delete-report-test,
                .test-item-row .input-group.flex-nowrap .btn-delete-report-unit,
                .test-item-row .input-group.flex-nowrap .btn-delete-reference,
                .test-item-row .input-group.flex-nowrap .btn-delete-observed,
                .test-item-row .input-group.flex-nowrap .btn-delete-flag {
                    background-color: #fee2e2 !important;
                    color: #dc2626 !important;
                }

                .test-item-row .input-group.flex-nowrap .btn-delete-report-category:hover,
                .test-item-row .input-group.flex-nowrap .btn-delete-report-subcategory:hover,
                .test-item-row .input-group.flex-nowrap .btn-delete-report-test:hover,
                .test-item-row .input-group.flex-nowrap .btn-delete-report-unit:hover,
                .test-item-row .input-group.flex-nowrap .btn-delete-reference:hover,
                .test-item-row .input-group.flex-nowrap .btn-delete-observed:hover,
                .test-item-row .input-group.flex-nowrap .btn-delete-flag:hover {
                    background-color: #dc2626 !important;
                    color: #ffffff !important;
                }

                /* Connect vertical focus borders when input-group is focused */
                .test-item-row .input-group.flex-nowrap:focus-within .btn {
                    border-left-color: #0284c7 !important;
                }

                /* Last button in the input group gets rounded right corners */
                .test-item-row .input-group.flex-nowrap .btn:last-child {
                    border-radius: 0 8px 8px 0 !important;
                }

                /* Red X close button styled like standard delete icon */
                .test-item-row .remove-row {
                    position: absolute !important;
                    top: 10px !important;
                    right: 15px !important;
                    z-index: 10 !important;
                    color: #ef4444 !important;
                    background: transparent !important;
                    border: none !important;
                    padding: 0 !important;
                    font-size: 16px !important;
                    opacity: 0.65 !important;
                    transition: opacity 0.2s, transform 0.2s !important;
                }

                .test-item-row .remove-row:hover {
                    opacity: 1 !important;
                    transform: scale(1.2) !important;
                    color: #dc2626 !important;
                }

                /* Custom premium styling for row labels */
                .test-item-row label {
                    font-size: 11px !important;
                    font-weight: 700 !important;
                    letter-spacing: 0.5px !important;
                    text-transform: uppercase !important;
                    margin-bottom: 6px !important;
                    display: block !important;
                }

                /* Slate gray labels for standard columns */
                .test-item-row .col-md-4 label,
                .test-item-row .col-md-8 label {
                    color: #64748b;
                }

                /* Bright blue label for Parameter */
                .test-item-row .col-md-4:nth-child(3) label {
                    color: #2563eb !important;
                }

                /* Responsive Table View Styling */
                .table-preview-card {
                    background: #ffffff;
                    border-radius: 16px;
                    padding: 35px;
                    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
                    width: 100%;
                    max-width: 850px;
                    margin: 0 auto;
                    border: 1px solid #e2e8f0;
                    font-family: 'Inter', sans-serif;
                }

                .table-preview-card .metadata-item {
                    padding: 10px 12px;
                    background: #f8fafc;
                    border-radius: 8px;
                    border: 1px solid #f1f5f9;
                }

                .table-preview-card .table {
                    margin-bottom: 0;
                }

                .table-preview-card .table th {
                    background-color: #4f46e5;
                    color: #ffffff;
                    font-weight: 600;
                    font-size: 12px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    padding: 12px 16px;
                    border: none;
                }

                .table-preview-card .table td {
                    padding: 14px 16px;
                    vertical-align: middle;
                    font-size: 13px;
                    color: #334155;
                    border-color: #f1f5f9;
                }

                .table-preview-card .category-row {
                    background-color: #f8fafc !important;
                    font-weight: 700;
                    color: #1e293b;
                    font-size: 12px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    border-top: 2px solid #e2e8f0;
                }

                .table-preview-card .flag-badge-h {
                    background-color: #fee2e2;
                    color: #dc2626;
                    font-weight: 600;
                    padding: 4px 8px;
                    border-radius: 4px;
                    font-size: 11px;
                }

                .table-preview-card .flag-badge-l {
                    background-color: #fef3c7;
                    color: #d97706;
                    font-weight: 600;
                    padding: 4px 8px;
                    border-radius: 4px;
                    font-size: 11px;
                }
            </style>
            <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">

<div class="aw-card">
    <div class="aw-card-header">
        <div class="aw-card-title"><i class="fa fa-list" style="color:var(--primary);"></i> Reports List</div>
        <div style="position:relative;">
            <i class="fa fa-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:13px;"></i>
            <input type="text" id="report-search" style="border:1.5px solid var(--border-color);border-radius:9px;padding:8px 12px 8px 32px;font-size:13px;outline:none;width:220px;" placeholder="Search reports..." autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" name="name_1104">
        </div>
    </div>
    <div class="aw-card-body p-0">
        <div class="table-responsive-modern">
            <table class="table table-modern" id="report-table">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Date Released</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($reports as $report)
                     <tr>
                         <td data-label="SL No"><span class="badge-aw badge-blue">#{{ $report->id }}</span></td>
                         <td style="font-weight:600;" data-label="Patient Name">{{ $report->patient->first_name }} {{ $report->patient->last_name }}</td>
                         <td style="color:var(--text-muted);" data-label="Doctor Name">{{ $report->doctor_name }}</td>
                         <td data-label="Date Released">{{ \Carbon\Carbon::parse($report->report_released_on)->format('d M Y') }}</td>
                         <td class="text-end" data-label="Action">
                             <div class="d-flex justify-content-end gap-2">
                                 <button class="btn-aw-outline btn-aw-sm btn-view" data-id="{{ $report->id }}" data-bs-toggle="modal" data-bs-target="#modal-view-report" title="View / PDF" style="width: 32px; height: 32px; padding: 0; justify-content: center;"><i class="fa fa-file-pdf"></i></button>
                                 <button class="btn-aw-primary btn-aw-sm btn-edit" data-id="{{ $report->id }}" title="Edit Report" style="width: 32px; height: 32px; padding: 0; justify-content: center;"><i class="fa fa-edit"></i></button>
                                 <button class="btn-aw-danger btn-aw-sm btn-delete" data-id="{{ $report->id }}" title="Delete" style="width: 32px; height: 32px; padding: 0; justify-content: center;"><i class="fa fa-trash"></i></button>
                             </div>
                         </td>
                     </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
				</div>
			</div>
		</section>
	  </div>
  </div>

  <!-- Add Report Modal -->
  <div class="modal fade modal-aw" id="modal-add-report" aria-hidden="true">
	  <div class="modal-dialog modal-xl">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-file-medical me-2"></i>Generate Lab Report</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-add-report">
                @csrf
				<h4 class="text-primary border-bottom pb-2 mb-3"><i class="fa fa-info-circle me-1"></i>General Information</h4>
				<div class="row mb-3">
					<div class="col-md-6">
						<div class="form-group">
							<label for="add-patient-id" class="form-label">Select Patient</label>
							<div class="input-group flex-nowrap">
								<select class="form-select" name="patient_id" id="add-patient-id" required autocomplete="off">
									<option value="">-- Select Patient --</option>
									@foreach($patients as $patient)
											<option value="{{ $patient->id }}" data-gender="{{ $patient->gender }}" data-age="{{ $patient->age }}">{{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->patient_id }})</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="add-report-doctor" class="form-label">Referring Doctor</label>
							<div class="input-group flex-nowrap">
								<select class="form-select report-doctor-select" name="doctor_name" id="add-report-doctor" required autocomplete="off">
									<option value="">-- Select Doctor --</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-md-6">
						<div class="form-group">
							<label for="field_1105"  class="form-label">Sample Received On</label>
							<input type="datetime-local" class="form-control" name="sample_received_on" required autocomplete="off" id="field_1105">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="field_1106"  class="form-label">Report Released On</label>
							<input type="datetime-local" class="form-control" name="report_released_on" required autocomplete="off" id="field_1106">
						</div>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="field_1107"  class="form-label">Authorized Signature</label>
							<div class="input-group flex-nowrap">
								<select class="form-select report-signature-select" name="report_signature_id" autocomplete="off" id="field_1107">
									<option value="">No signature</option>
									@foreach($signatures as $signature)
										<option value="{{ $signature->id }}" data-name="{{ $signature->name }}" data-image="{{ route('report-signatures.image', $signature->id) }}">{{ $signature->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="field_1108"  class="form-label">PIN</label>
							<input type="password" class="form-control signature-pin-input" name="signature_pin" autocomplete="new-password" placeholder="PIN" id="field_1108">
						</div>
					</div>
				</div>

				<div class="row mt-2">
					<div class="col-12">
						<div class="form-group">
							<label for="field_1109"  class="form-label">Report Notes</label>
							<textarea class="form-control" name="notes" rows="2" placeholder="Notes to show in the PDF" autocomplete="off" id="field_1109"></textarea>
						</div>
					</div>
				</div>

                <div class="row align-items-center mt-2 mb-3 border-bottom pb-2">
                    <div class="col-md-6 col-12 mb-2 mb-md-0">
                        <h4 class="text-primary mb-0">Dynamic Test Results</h4>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="d-flex gap-2 align-items-center justify-content-md-end">
                            <select class="form-select form-select-sm select-load-report-template" style="min-width: 150px; max-width: 220px;" autocomplete="off">
                                <option value="">-- Load Template --</option>
                                @foreach($reportTemplates as $rt)
                                    <option value="{{ $rt->id }}">{{ $rt->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-sm btn-success text-nowrap" id="btn-add-test-row"><i class="fa fa-plus me-1"></i> Add Test Item</button>
                        </div>
                    </div>
                </div>
				
                <div id="dynamic-tests-container">
                    <!-- Dynamic rows go here -->
                </div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-save-report">Generate Report</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Edit Report Modal -->
  <div class="modal fade modal-aw" id="modal-edit-report" aria-hidden="true">
	  <div class="modal-dialog modal-xl">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-edit me-2"></i>Edit Lab Report</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-edit-report">
                @csrf
                <input type="hidden" name="id" id="edit-report-id">
				<h4 class="text-primary border-bottom pb-2 mb-3"><i class="fa fa-info-circle me-1"></i>General Information</h4>
				<div class="row mb-3">
					<div class="col-md-6">
						<div class="form-group">
							<label for="edit-patient-id" class="form-label">Select Patient</label>
							<div class="input-group flex-nowrap">
								<select class="form-select" name="patient_id" id="edit-patient-id" required autocomplete="off">
									<option value="">-- Select Patient --</option>
									@foreach($patients as $patient)
											<option value="{{ $patient->id }}" data-gender="{{ $patient->gender }}" data-age="{{ $patient->age }}">{{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->patient_id }})</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="edit-report-doctor" class="form-label">Referring Doctor</label>
							<div class="input-group flex-nowrap">
								<select class="form-select report-doctor-select" name="doctor_name" id="edit-report-doctor" required autocomplete="off">
									<option value="">-- Select Doctor --</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-md-6">
						<div class="form-group">
							<label for="edit-sample-date" class="form-label">Sample Received On</label>
							<input type="datetime-local" class="form-control" name="sample_received_on" id="edit-sample-date" required autocomplete="off">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="edit-release-date" class="form-label">Report Released On</label>
							<input type="datetime-local" class="form-control" name="report_released_on" id="edit-release-date" required autocomplete="off">
						</div>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="edit-report-signature-id" class="form-label">Authorized Signature</label>
							<div class="input-group flex-nowrap">
								<select class="form-select report-signature-select" name="report_signature_id" id="edit-report-signature-id" autocomplete="off">
									<option value="">No signature</option>
									@foreach($signatures as $signature)
										<option value="{{ $signature->id }}" data-name="{{ $signature->name }}" data-image="{{ route('report-signatures.image', $signature->id) }}">{{ $signature->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="edit-signature-pin" class="form-label">PIN</label>
							<input type="password" class="form-control signature-pin-input" name="signature_pin" id="edit-signature-pin" autocomplete="new-password" placeholder="Required">
						</div>
					</div>
				</div>

				<div class="row mt-2">
					<div class="col-12">
						<div class="form-group">
							<label for="edit-report-notes" class="form-label">Report Notes</label>
							<textarea class="form-control" name="notes" id="edit-report-notes" rows="2" placeholder="Notes to show in the PDF" autocomplete="off"></textarea>
						</div>
					</div>
				</div>

                <div class="row align-items-center mt-2 mb-3 border-bottom pb-2">
                    <div class="col-md-6 col-12 mb-2 mb-md-0">
                        <h4 class="text-primary mb-0">Dynamic Test Results</h4>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="d-flex gap-2 align-items-center justify-content-md-end">
                            <select class="form-select form-select-sm select-load-report-template" style="min-width: 150px; max-width: 220px;" autocomplete="off">
                                <option value="">-- Load Template --</option>
                                @foreach($reportTemplates as $rt)
                                    <option value="{{ $rt->id }}">{{ $rt->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-sm btn-success text-nowrap" id="btn-add-edit-test-row"><i class="fa fa-plus me-1"></i> Add Test Item</button>
                        </div>
                    </div>
                </div>
				
                <div id="edit-dynamic-tests-container">
                    <!-- Populated via JS -->
                </div>

                <datalist id="list-observed">
                    @foreach($templates as $tmpl)
                        <option value="{{ $tmpl->name }}">
                    @endforeach
                </datalist>

                <datalist id="list-units">
                    @foreach($units as $u)
                        <option value="{{ $u->name }}">
                    @endforeach
                </datalist>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-update-report">Update Report</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Neat PDF Viewer Modal -->
  <div class="modal fade" id="modal-view-report" tabindex="-1" aria-hidden="true">
	  <div class="modal-dialog modal-fullscreen">
		<div class="modal-content border-0">
		  <div class="modal-body p-0">
              <div class="pdf-viewer-wrapper">

                  <!-- Neat Toolbar -->
                  <div class="pdf-toolbar d-print-none">

                      <!-- LEFT: Back + Filename -->
                      <div class="toolbar-section">
                          <button type="button" class="pdf-btn" data-bs-dismiss="modal" title="Close Viewer">
                              <i class="fa fa-arrow-left"></i>
                          </button>
                          <div class="toolbar-divider"></div>
                          <i class="fa fa-file-pdf-o text-danger"></i>
                          <a href="javascript:void(0)" id="viewer-filename-link">report_preview.pdf</a>
                      </div>

                      <!-- CENTER: Zoom Controls -->
                      <div class="pdf-toolbar-center">
                          <button type="button" class="pdf-btn" id="zoom-out" title="Zoom Out"><i class="fa fa-minus"></i></button>
                          <span class="zoom-level" id="zoom-text">100%</span>
                          <button type="button" class="pdf-btn" id="zoom-in" title="Zoom In"><i class="fa fa-plus"></i></button>
                          <div class="toolbar-divider" style="height: 16px; margin: 0 4px;"></div>
                          <button type="button" class="pdf-btn" id="fit-width" title="Fit Width"><i class="fa fa-arrows-h"></i></button>
                      </div>

                      <!-- RIGHT: Actions -->
                      <div class="toolbar-section">
                          <!-- Mode Selector Dropdown -->
                          <div class="dropdown">
                              <button type="button" class="pdf-btn dropdown-toggle" id="btn-mode-selector" data-bs-toggle="dropdown" aria-expanded="false" style="background:#f1f5f9; color:#334155; border:1px solid #e2e8f0;">
                                  <i class="fa fa-id-card-o" id="current-mode-icon"></i>
                                  <span class="ms-1" id="current-mode-text">With Header</span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:8px;">
                                  <li>
                                      <a class="dropdown-item py-2 px-3 pdf-header-toggle is-active" href="javascript:void(0)" id="btn-with-header">
                                          <i class="fa fa-id-card-o me-2 text-primary"></i> With Lab Header
                                      </a>
                                  </li>
                                  <li>
                                      <a class="dropdown-item py-2 px-3 pdf-header-toggle" href="javascript:void(0)" id="btn-without-header">
                                          <i class="fa fa-file-o me-2 text-secondary"></i> No Header (Plain)
                                      </a>
                                  </li>
                              </ul>
                          </div>
                          
                          <div class="toolbar-divider d-none d-md-block"></div>

                          <button type="button" class="pdf-btn pdf-btn-action" id="btn-viewer-print" title="Print">
                              <i class="fa fa-print"></i><span>Print</span>
                          </button>
                          <button type="button" class="pdf-btn pdf-btn-action" id="btn-viewer-download" title="Download">
                              <i class="fa fa-download"></i><span>Download</span>
                          </button>
                          <button type="button" class="pdf-btn pdf-btn-share" id="btn-viewer-share" title="Share">
                              <i class="fa fa-share-alt"></i><span>Share</span>
                          </button>
                      </div>
                  </div>

                  <!-- Viewport -->
                  <div class="pdf-viewport" id="pdf-viewport">
                      <div class="pdf-page-container" id="pdf-page-container">
                          <div id="pdf-canvas-container">
                              <div class="text-center py-50" style="color:#64748b;">
                                  <i class="fa fa-circle-o-notch fa-spin fa-2x mb-3 text-primary"></i>
                                  <p>Loading document...</p>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Scripts -->
  @push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <script>
      // Initialize PDF.js
      var pdfjsLib = window['pdfjs-dist/build/pdf'] || window.pdfjsLib;
      if (pdfjsLib) {
          pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
          window.pdfjsLib = pdfjsLib;
      }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script src="{{ asset('js/report-pdf.js') }}"></script>
  @endpush

  <!-- Datalist for Auto-complete -->
  <datalist id="standard-tests-list">
      <option value="Blood Glucose (Fasting)">
      <option value="Total Cholesterol">
      <option value="Triglycerides">
      <option value="HDL Cholesterol">
      <option value="LDL Cholesterol">
      <option value="VLDL">
      <option value="Cholesterol / HDL Ratio">
      <option value="LDL / HDL Ratio">
  </datalist>

  @push('scripts')
  <script>
	  $(document).ready(function() {
		  $.ajaxSetup({
			  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		  });

          // Function to refresh reports table and dropdowns without a full page reload
          window.refreshReportsPageData = function(modalToCloseId = null, btnToReset = null, defaultBtnText = '') {
              if (modalToCloseId) {
                  $(modalToCloseId).modal('hide');
              }
              if (btnToReset) {
                  btnToReset.html(defaultBtnText).prop('disabled', false);
              }
              
              let currentUrl = window.location.href;
              $.ajax({
                  url: currentUrl,
                  type: 'GET',
                  cache: false, // PREVENT AGGRESSIVE BROWSER CACHING
                  success: function(html) {
                      let newDoc = new DOMParser().parseFromString(html, 'text/html');
                      
                      // 1. Update the main reports table
                      let newTableWrapper = $(newDoc).find('#report-table').closest('.table-responsive-modern').html();
                      if (newTableWrapper) {
                          let dtState = { page: 0, length: 10, search: '' };
                          if($.fn.DataTable.isDataTable('#report-table')) {
                              let dt = $('#report-table').DataTable();
                              dtState.page = dt.page();
                              dtState.length = dt.page.len();
                              dtState.search = dt.search();
                              dt.destroy();
                          }
                          
                          // Specifically target the wrapper of report-table to avoid affecting modal tables
                          $('#report-table').closest('.table-responsive-modern').html(newTableWrapper);
                          
                          // Re-initialize reports table with preserved state
                          var reportsTable = $('#report-table').DataTable({
                              dom: "<'row mb-3'<'col-sm-12 col-md-6'l>>" +
                                   "<'row'<'col-sm-12'tr>>" +
                                   "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                              pageLength: dtState.length,
                              search: { search: dtState.search },
                              lengthMenu: [5, 10, 25, 50, 100],
                              ordering: false,
                              language: {
                                  lengthMenu: "Show _MENU_ records",
                                  info: "Showing _START_ to _END_ of _TOTAL_ reports",
                                  infoEmpty: "Showing 0 to 0 of 0 reports",
                                  infoFiltered: "(filtered from _MAX_ total reports)",
                                  emptyTable: "No test reports generated yet.",
                                  paginate: {
                                      previous: "<i class='fa fa-angle-left'></i>",
                                      next: "<i class='fa fa-angle-right'></i>"
                                  }
                              }
                          });
                          
                          reportsTable.page(dtState.page).draw('page');

                          $("#report-search").off("keyup").on("keyup", function() {
                              reportsTable.search($(this).val()).draw();
                          });
                      }

                      // 2. Update the "View Details" modal tables so "all pop" stay refreshed
                      let newModalDetail = $(newDoc).find('#modal-view-detail .modal-body').html();
                      if (newModalDetail) {
                          $('#modal-view-detail .modal-body').html(newModalDetail);
                      }
                      
                      // 3. Dynamically update ALL dropdown <select> contents without destroying bindings
                      const selectNamesToUpdate = [
                          'patient_id', 'doctor_name', 'report_signature_id', 'category_id', 'unit',
                          'test_category[]', 'test_subcategory[]', 'test_name[]', 'observed_value[]', 
                          'test_unit[]', 'normal_value[]', 'test_flag[]', 'biological_reference[]'
                      ];
                      
                      selectNamesToUpdate.forEach(name => {
                          let newOptions = $(newDoc).find(`select[name="${name}"]`).first().html();
                          if (newOptions) {
                              $(`select[name="${name}"]`).each(function() {
                                  let currentVal = $(this).val();
                                  $(this).html(newOptions);
                                  $(this).val(currentVal); // Restore user selection if still exists
                              });
                          }
                      });
                  }
              });
          };

          // Fix overlapping modal backdrops z-index
          $(document).on('show.bs.modal', '.modal', function () {
              const zIndex = 1060 + (10 * $('.modal:visible').length);
              $(this).css('z-index', zIndex);
              setTimeout(function() {
                  $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
              }, 0);
          });
          $(document).on('hidden.bs.modal', '.modal', function () {
              if ($('.modal:visible').length > 0) {
                  // Restore modal-open class to body if another modal is still open
                  setTimeout(function() {
                      $('body').addClass('modal-open');
                  }, 0);
              }
          });

		  // Initialize DataTables for Reports
		  var reportsTable = $('#report-table').DataTable({
			  dom: "<'row mb-3'<'col-sm-12 col-md-6'l>>" +
				   "<'row'<'col-sm-12'tr>>" +
				   "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			  pageLength: 10,
			  lengthMenu: [5, 10, 25, 50, 100],
			  ordering: false,
			  language: {
				  lengthMenu: "Show _MENU_ records",
				  info: "Showing _START_ to _END_ of _TOTAL_ reports",
				  infoEmpty: "Showing 0 to 0 of 0 reports",
				  infoFiltered: "(filtered from _MAX_ total reports)",
				  emptyTable: "No test reports generated yet.",
				  paginate: {
					  previous: "<i class='fa fa-angle-left'></i>",
					  next: "<i class='fa fa-angle-right'></i>"
				  }
			  }
		  });
		  $("#report-search").on("keyup", function() {
			  reportsTable.search($(this).val()).draw();
		  });

          // Standard Tests Dictionary for Auto-Fill
          const standardTests = {
              "Blood Glucose (Fasting)": { category: "BIOCHEMISTRY", normal: "60 - 110 mg/dl" },
              "Total Cholesterol": { category: "LIPID PROFILE (FASTING)", normal: "130 - 220 mg/dl" },
              "Triglycerides": { category: "LIPID PROFILE (FASTING)", normal: "40 - 170 mg/dl" },
              "HDL Cholesterol": { category: "LIPID PROFILE (FASTING)", normal: "30 - 70 mg/dl" },
              "LDL Cholesterol": { category: "LIPID PROFILE (FASTING)", normal: "60 - 160 mg/dl" },
              "VLDL": { category: "LIPID PROFILE (FASTING)", normal: "8 - 32 mg/dl" },
              "Cholesterol / HDL Ratio": { category: "LIPID PROFILE (FASTING)", normal: "< 4" },
              "LDL / HDL Ratio": { category: "LIPID PROFILE (FASTING)", normal: "< 3.5" }
          };

          window.REPORT_HEADER_IMAGE = "data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('images/Awwal Lab Report Sheet Top_page-0001.jpg'))) }}";
          window.REPORT_FOOTER_IMAGE = "data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('images/Awwal Lab Report Sheet Bottom_page-0001.jpg'))) }}";

          // Dynamic Rows Logic (Refined Alignment & Auto-fill)
          const trTemplate = `
            <div class="test-item-row card border-0 mb-3" style="position: relative; overflow: hidden;">
                <div class="card-body">
                    <span class="badge position-absolute row-sl-no" style="background:#0284c7;">SL 1</span>
                    <button type="button" class="btn btn-sm position-absolute remove-row" style="z-index:10;" title="Remove Test"><i class="fa fa-times"></i></button>
                    <div class="row g-3 align-items-end mt-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label text-muted fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Master Category</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select report-category-select" name="test_category[]" autocomplete="off">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->name }}" data-id="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success btn-sm btn-add-report-category" title="Add Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit-report-category" title="Edit Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-info btn-sm btn-view-report-category" title="View Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-report-category" title="Delete Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label text-muted fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Sub Category</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select report-subcategory-select" name="test_subcategory[]" autocomplete="off">
                                    <option value="">-- Select Sub Category --</option>
                                    @foreach($subCategories as $sub)
                                        <option value="{{ $sub->name }}" data-id="{{ $sub->id }}" data-category_id="{{ $sub->category_id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success btn-sm btn-add-report-subcategory" title="Add Sub-Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit-report-subcategory" title="Edit Sub-Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-info btn-sm btn-view-report-subcategory" title="View Sub-Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-report-subcategory" title="Delete Sub-Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label text-primary fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Parameter / Test Name</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select test-selector-dynamic border-primary shadow-none" name="test_name[]" autocomplete="off">
                                    <option value="">-- Select Test --</option>
                                    @foreach($tests as $test)
                                        <option value="{{ str_replace(['`', '${'], ['\`', '\${'], $test->name) }}" 
                                            data-id="{{ $test->id }}"
                                            data-price="{{ $test->price }}"
                                            data-unit="{{ $test->parameter->unit ?? '' }}"
                                            data-male-ref="{{ $test->parameter->male_reference ?? '' }}"
                                            data-female-ref="{{ $test->parameter->female_reference ?? '' }}"
                                            data-male-min="{{ $test->parameter->male_min ?? '' }}"
                                            data-male-max="{{ $test->parameter->male_max ?? '' }}"
                                            data-female-min="{{ $test->parameter->female_min ?? '' }}"
                                            data-female-max="{{ $test->parameter->female_max ?? '' }}"
                                            data-critical-low="{{ $test->parameter->critical_low ?? '' }}"
                                            data-critical-high="{{ $test->parameter->critical_high ?? '' }}"
                                            data-reference-intervals='{{ $test->referenceIntervals->map->only(['gender', 'age_min', 'age_max', 'reference_text', 'min_value', 'max_value'])->values()->toJson() }}'
                                            data-is-immunoassay="{{ $test->parameter->is_immunoassay ?? 0 }}"
                                            data-bio-ref="{{ $test->parameter->biological_reference ?? '' }}"
                                            data-normal="{{ str_replace(['`', '${'], ['\`', '\${'], $test->description) }}">{{ str_replace(['`', '${'], ['\`', '\${'], $test->name) }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success btn-sm btn-add-report-test" title="Add Parameter" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit-report-test" title="Edit Parameter" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-info btn-sm btn-view-report-test" title="View Parameter Details" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-report-test" title="Delete Parameter" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label text-success fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Observed Value</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select report-observed-select" name="observed_value[]" autocomplete="off">
                                    <option value="">-- Select Observed --</option>
                                    @foreach($templates as $tmpl)
                                        <option value="{{ $tmpl->name }}" data-id="{{ $tmpl->id }}">{{ $tmpl->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success btn-sm btn-add-observed" title="Add Observed" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit-observed" title="Edit Observed" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-info btn-sm btn-view-observed" title="View Observed Details" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-observed" title="Delete Observed" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label text-muted fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Unit</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select report-unit-select" name="test_unit[]" autocomplete="off">
                                    <option value="">-- Select Unit --</option>
                                    @foreach($units as $u)
                                        <option value="{{ $u->name }}" data-id="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success btn-sm btn-add-report-unit" title="Add Unit" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit-report-unit" title="Edit Unit" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-info btn-sm btn-view-report-unit" title="View Unit" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-report-unit" title="Delete Unit" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label text-info fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Referral Range</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select normal-val-dynamic" name="normal_value[]" autocomplete="off">
                                    <option value="">-- Select Reference --</option>
                                    @foreach($referenceTemplates as $ref)
                                        <option value="{{ $ref->name }}" data-id="{{ $ref->id }}">{{ $ref->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success btn-sm btn-add-reference" title="Add Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit-reference" title="Edit Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-info btn-sm btn-view-reference" title="View Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-reference" title="Delete Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label text-warning fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Flag</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select flag-selector" name="test_flag[]" autocomplete="off">
                                    <option value="">-- Select Flag --</option>
                                    @foreach($flagTemplates as $flg)
                                        <option value="{{ str_replace(['`', '${'], ['\`', '\${'], $flg->name) }}" data-id="{{ $flg->id }}">{{ str_replace(['`', '${'], ['\`', '\${'], $flg->name) }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success btn-sm btn-add-flag" title="Add Flag" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit-flag" title="Edit Flag" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-info btn-sm btn-view-flag" title="View Flag" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-flag" title="Delete Flag" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <label class="form-label text-dark fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Normal Range</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select bio-val-dynamic" name="biological_reference[]" autocomplete="off">
                                    <option value="">-- Select Range --</option>
                                    @foreach($referenceTemplates as $ref)
                                        <option value="{{ $ref->name }}" data-id="{{ $ref->id }}">{{ $ref->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success btn-sm btn-add-reference" title="Add Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-primary btn-sm btn-edit-reference" title="Edit Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-info btn-sm btn-view-reference" title="View Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btn-sm btn-delete-reference" title="Delete Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

          // Auto-fill Normal Value from Select & Handle Auto-calc Logic
          $(document).on('change', '.test-selector-dynamic', function() {
              let selected = $(this).find(':selected');
	              let row = $(this).closest('.test-item-row');
	              let modal = $(this).closest('.modal');
	              let gender = modal.find('select[name="patient_id"] :selected').attr('data-gender') || 'M/F';
	              let age = parseInt(modal.find('select[name="patient_id"] :selected').attr('data-age'), 10);
	              
	              // Set Unit
	              row.find('select[name="test_unit[]"]').val(selected.attr('data-unit') || '');
	              
	              // Set Reference Interval based on Gender
	              let ageInterval = getMatchingReferenceInterval(selected, gender, age);
	              let ref = ageInterval ? ageInterval.reference_text : '';
                  if (!ref) {
                      let mRef = selected.attr('data-male-ref');
                      let fRef = selected.attr('data-female-ref');
                      if (mRef && fRef && mRef !== fRef) {
                          ref = "Male: " + mRef + "\nFemale: " + fRef;
                      } else {
                          ref = mRef || fRef || selected.attr('data-normal') || '';
                      }
                  }
              
              setSelectValueWithDefault(row.find('.normal-val-dynamic'), ref);
              
              // Keep legacy JSON field filled for older reports while printing the normal value column.
              let masterBio = selected.attr('data-bio-ref');
              setSelectValueWithDefault(row.find('.bio-val-dynamic'), masterBio || ref);
              
               // Trigger calculation if value exists
               row.find('.report-observed-select').trigger('change');
          });

          $(document).on('change', '.normal-val-dynamic', function() {
              let val = $(this).val();
              setSelectValueWithDefault($(this).closest('.test-item-row').find('.bio-val-dynamic'), val);
          });

          // Keep hidden flag values compatible with older saved reports.
           $(document).on('change', '.report-observed-select', function() {
              let val = parseFloat($(this).val());
	              let row = $(this).closest('.test-item-row');
	              let selected = row.find('.test-selector-dynamic :selected');
	              let modal = $(this).closest('.modal');
	              let gender = modal.find('select[name="patient_id"] :selected').attr('data-gender') || 'Male';
	              let age = parseInt(modal.find('select[name="patient_id"] :selected').attr('data-age'), 10);
	              let flagSelector = row.find('.flag-selector');
              
              if (isNaN(val)) {
                  flagSelector.val('');
                  return;
              }

	              let isImmuno = selected.attr('data-is-immunoassay') == 1;
	              let criticalLow = parseFloat(selected.attr('data-critical-low'));
	              let criticalHigh = parseFloat(selected.attr('data-critical-high'));
	              let ageInterval = getMatchingReferenceInterval(selected, gender, age);
	              let min = ageInterval ? ageInterval.min_value : (gender === 'Male' ? selected.attr('data-male-min') : selected.attr('data-female-min'));
	              let max = ageInterval ? ageInterval.max_value : (gender === 'Male' ? selected.attr('data-male-max') : selected.attr('data-female-max'));

	              if (!isNaN(criticalLow) && val <= criticalLow) {
	                  setSelectValueWithDefault(flagSelector, 'C');
	                  return;
	              }

	              if (!isNaN(criticalHigh) && val >= criticalHigh) {
	                  setSelectValueWithDefault(flagSelector, 'C');
	                  return;
	              }

              if (isImmuno) {
                  // Immunoassay logic: <0.9 Neg, 0.9-1.1 Bord, >1.1 Pos
                  if (val < 0.9) setSelectValueWithDefault(flagSelector, '-');
                  else if (val >= 0.9 && val <= 1.1) setSelectValueWithDefault(flagSelector, '+/-');
                  else if (val > 1.1) setSelectValueWithDefault(flagSelector, '+');
              } else if (min !== undefined && max !== undefined) {
                  // Standard Min-Max logic
	                  if (val < min) setSelectValueWithDefault(flagSelector, '↓');
	                  else if (val > max) setSelectValueWithDefault(flagSelector, '↑');
	                  else setSelectValueWithDefault(flagSelector, '');
	              }
	          });

	          function getMatchingReferenceInterval(selected, gender, age) {
	              let intervals = JSON.parse(selected.attr('data-reference-intervals') || '[]');
	              if (!Array.isArray(intervals) || isNaN(age)) return null;
	              gender = (gender || '').toLowerCase();
	              return intervals
	                  .filter(interval => {
	                      let intervalGender = (interval.gender || '').toLowerCase();
	                      let min = interval.age_min === null ? 0 : parseInt(interval.age_min, 10);
	                      let max = interval.age_max === null ? 999 : parseInt(interval.age_max, 10);
	                      return (!intervalGender || intervalGender === gender) && age >= min && age <= max;
	                  })
	                  .sort((a, b) => parseInt(b.age_min || 0, 10) - parseInt(a.age_min || 0, 10))[0] || null;
	          }

          function calculateCBC(containerSelector) {
              let rbc = null;
              let hb = null;
              let hct = null;
              
              let rbcRow = null;
              let hbRow = null;
              let hctRow = null;
              
              let mcvRow = null;
              let mchRow = null;
              let mchcRow = null;
              
              // Iterate over all rows in this container
              $(containerSelector).find('.test-item-row').each(function() {
                  let testSelect = $(this).find('.test-selector-dynamic');
                  let testName = (testSelect.val() || '').toLowerCase().trim();
                  let observedVal = parseFloat($(this).find('.report-observed-select').val());
                  
                  // Check test names
                  if (testName === 'rbc' || testName === 'rbc count' || testName.indexOf('red blood cell') > -1) {
                      rbc = observedVal;
                      rbcRow = $(this);
                  } else if (testName === 'hemoglobin' || testName === 'hb' || testName === 'hgb') {
                      hb = observedVal;
                      hbRow = $(this);
                  } else if (testName === 'pcv' || testName === 'hct' || testName === 'hematocrit' || testName === 'packed cell volume') {
                      hct = observedVal;
                      hctRow = $(this);
                  } else if (testName === 'mcv' || testName.indexOf('mean corpuscular volume') > -1) {
                      mcvRow = $(this);
                  } else if (testName === 'mch' || testName.indexOf('mean corpuscular hemoglobin') > -1 && testName.indexOf('concentration') === -1) {
                      mchRow = $(this);
                  } else if (testName === 'mchc' || testName.indexOf('mchc') > -1 || testName.indexOf('mean corpuscular hemoglobin concentration') > -1) {
                      mchcRow = $(this);
                  }
              });
              
              if (window._isCalculatingCBC) return;
              window._isCalculatingCBC = true;
              
              try {
                  // MCV = (HCT / RBC) * 10
                  if (mcvRow && rbc !== null && hct !== null && !isNaN(rbc) && !isNaN(hct) && rbc > 0) {
                      let mcv = ((hct / rbc) * 10).toFixed(1);
                      let observedSelect = mcvRow.find('.report-observed-select');
                      setSelectValueWithDefault(observedSelect, mcv);
                      observedSelect.trigger('change');
                  }
                  
                  // MCH = (Hb / RBC) * 10
                  if (mchRow && rbc !== null && hb !== null && !isNaN(rbc) && !isNaN(hb) && rbc > 0) {
                      let mch = ((hb / rbc) * 10).toFixed(1);
                      let observedSelect = mchRow.find('.report-observed-select');
                      setSelectValueWithDefault(observedSelect, mch);
                      observedSelect.trigger('change');
                  }
                  
                  // MCHC = (Hb / HCT) * 100
                  if (mchcRow && hb !== null && hct !== null && !isNaN(hb) && !isNaN(hct) && hct > 0) {
                      let mchc = ((hb / hct) * 100).toFixed(1);
                      let observedSelect = mchcRow.find('.report-observed-select');
                      setSelectValueWithDefault(observedSelect, mchc);
                      observedSelect.trigger('change');
                  }
              } finally {
                  window._isCalculatingCBC = false;
              }
          }

          // Trigger CBC calculation when observed values change or test parameter is selected
          $(document).on('change', '.report-observed-select, .test-selector-dynamic', function() {
              let container = $(this).closest('#dynamic-tests-container').length ? '#dynamic-tests-container' : '#edit-dynamic-tests-container';
              calculateCBC(container);
          });

          // Re-trigger calculation when patient (gender) changes
          $(document).on('change', 'select[name="patient_id"]', function() {
              let modal = $(this).closest('.modal');
              modal.find('.test-selector-dynamic').trigger('change');
          });

          function updateSignaturePinRequirement(select) {
              const modal = $(select).closest('.modal');
              const pinInput = modal.find('.signature-pin-input');
              const hasSignature = !!$(select).val();
              pinInput.prop('required', hasSignature);
              pinInput.attr('placeholder', hasSignature ? 'Required' : 'PIN');
              if (!hasSignature) {
                  pinInput.val('');
              }
          }

          $(document).on('change', '.report-signature-select', function() {
              updateSignaturePinRequirement(this);
          });

          $('.report-signature-select').each(function() {
              updateSignaturePinRequirement(this);
          });

          function setSelectValueWithDefault(select, value) {
              if (value === undefined || value === null) {
                  select.val('');
                  return;
              }
              if (select.is('input')) {
                  select.val(value);
                  return;
              }
              let strVal = String(value);
              let found = false;
              select.find('option').each(function() {
                  if ($(this).val() === strVal) {
                      found = true;
                      return false;
                  }
              });
              if (!found) {
                  select.append($('<option>', {
                      value: strVal,
                      text: strVal
                  }));
              }
              select.val(strVal);
          }

          function initDynamicSelect2() {
              // Revert all select elements inside the reports modals to standard native HTML selects
              if ($.fn.select2) {
                  $('#modal-add-report select, #modal-edit-report select').each(function() {
                      if ($(this).hasClass('select2-hidden-accessible')) {
                          $(this).select2('destroy');
                      }
                  });
              }
          }

          // Modal clearing logic to fix 'titles not clearing'
          $('#modal-add-report').on('hidden.bs.modal', function() {
              $('#form-add-report')[0].reset();
              $('#dynamic-tests-container').empty().append(trTemplate);
              initDynamicSelect2();
          });

          $('#modal-add-report').on('shown.bs.modal', function() {
              initDynamicSelect2();
              let now = moment().format('YYYY-MM-DDTHH:mm');
              $('#field_1105').val(now);
              $('#field_1106').val(now);
          });

          $('#modal-edit-report').on('hidden.bs.modal', function() {
              $('#form-edit-report')[0].reset();
              $('#edit-dynamic-tests-container').empty();
          });

          $('#modal-edit-report').on('shown.bs.modal', function() {
              initDynamicSelect2();
          });
          
          initDynamicSelect2();

          function updateRowSlNo(target) {
              $(target).find('.test-item-row').each(function(index) {
                  $(this).find('.row-sl-no').text('SL ' + (index + 1));
              });
          }

          $('#btn-add-test-row, #btn-add-edit-test-row').click(function() {
              let target = $(this).attr('id') === 'btn-add-test-row' ? '#dynamic-tests-container' : '#edit-dynamic-tests-container';
              $(target).append(trTemplate);
              updateRowSlNo(target);
              initDynamicSelect2();
          });

          $(document).on('change', '.select-load-report-template', function() {
              let templateId = $(this).val();
              if (!templateId) return;

              let selectDropdown = $(this);
              let modal = $(this).closest('.modal');
              let container = modal.attr('id') === 'modal-add-report' ? '#dynamic-tests-container' : '#edit-dynamic-tests-container';

              selectDropdown.prop('disabled', true);

              $.get("/templates/" + templateId, function(template) {
                  if (template.items && template.items.length > 0) {
                      Swal.fire({
                          title: 'Load Template',
                          html: `Clear existing test items before loading <strong>${template.name}</strong>?`,
                          icon: 'question',
                          showCancelButton: true,
                          confirmButtonText: '<i class="fa fa-trash"></i> Clear & Load',
                          cancelButtonText: 'Keep & Append',
                          confirmButtonColor: '#0284c7',
                          cancelButtonColor: '#6c757d',
                      }).then((result) => {
                          if (result.isConfirmed) {
                              $(container).empty();
                          }
                          template.items.forEach(item => {
                              let newRow = $(trTemplate);
                              $(container).append(newRow);

                              // Set Category & Subcategory
                              setSelectValueWithDefault(newRow.find('.report-category-select'), item.category || 'General');
                              setSelectValueWithDefault(newRow.find('.report-subcategory-select'), item.subcategory || '');

                              // Set Test parameter & trigger change for patient details auto-calculation
                              let testSelect = newRow.find('.test-selector-dynamic');
                              setSelectValueWithDefault(testSelect, item.name || '');
                              testSelect.trigger('change');

                              // Override defaults if specified in the template
                              if (item.unit) {
                                  setSelectValueWithDefault(newRow.find('.report-unit-select'), item.unit);
                              }
                              if (item.normal_value) {
                                  setSelectValueWithDefault(newRow.find('.normal-val-dynamic'), item.normal_value);
                              }
                              if (item.biological_reference) {
                                  setSelectValueWithDefault(newRow.find('.bio-val-dynamic'), item.biological_reference);
                              }
                          });

                          updateRowSlNo(container);
                          initDynamicSelect2();
                      });
                  } else {
                      showToast('This template has no test items.', 'warning');
                  }
                  selectDropdown.val('').prop('disabled', false);
              }).fail(function() {
                  showToast('Failed to load template.', 'error');
                  selectDropdown.prop('disabled', false);
              });
          });

          $(document).on('click', '.remove-row', function() {
              let target = $(this).closest('.test-item-row').parent();
              $(this).closest('.test-item-row').remove();
              updateRowSlNo(target);
          });

          // =============================================
          // DOCTOR SELECT MANAGEMENT (for Reports)
          // =============================================
          function fetchReportDoctors(selectedValue = null) {
              $.get("{{ route('doctors.suggestions') }}", function(data) {
                  let options = '<option value="">-- Select Doctor --</option><option value="Self">Self</option>';
                  (Array.isArray(data) ? data : (data.data || [])).forEach(function(doctor) {
                      let qual = doctor.qualification ? doctor.qualification : '';
                      options += `<option value="${doctor.name}" data-id="${doctor.id}" data-phone="${doctor.phone || ''}" data-email="${doctor.email || ''}" data-qualification="${qual}">${doctor.name}${qual ? ' (' + qual + ')' : ''}</option>`;
                  });
                  $('.report-doctor-select').html(options);
                  if (selectedValue) {
                      $('.report-doctor-select').val(selectedValue).trigger('change');
                  } else {
                      $('.report-doctor-select').trigger('change');
                  }
              });
          }

          // Open Add Doctor modal from report
          $(document).on('click', '.btn-add-report-doctor', function() {
              $('#modal-add-report-doctor').modal('show');
          });

          // Open Edit Doctor modal from report
          $(document).on('click', '.btn-edit-report-doctor', function() {
              let select = $(this).siblings('.report-doctor-select');
              let selectedOption = select.find('option:selected');
              let docId = selectedOption.attr('data-id');
              if (!docId) { showToast('Please select a valid doctor to edit.', 'error'); return; }
              $('#edit-report-doc-id').val(docId);
              $('#edit-report-doc-name').val(selectedOption.val());
              $('#edit-report-doc-qualification').val(selectedOption.attr('data-qualification'));
              $('#edit-report-doc-phone').val(selectedOption.attr('data-phone'));
              $('#edit-report-doc-email').val(selectedOption.attr('data-email'));
              $('#modal-edit-report-doctor').modal('show');
          });

          $('#btn-save-report-doctor').click(function() {
              let formData = $('#form-add-report-doctor').serialize();
              $.post("{{ route('doctors.store') }}", formData, function(response) {
                  showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                  $('#modal-add-report-doctor').modal('hide');
                  $('#form-add-report-doctor')[0].reset();
                  fetchReportDoctors(response.doctor.name);
              }).fail(function(xhr) {
                  showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to save doctor.', 'error');
              });
          });

          $('#btn-update-report-doctor').click(function() {
              let docId = $('#edit-report-doc-id').val();
              $.ajax({
                  url: "/doctors/" + docId,
                  type: 'PUT',
                  data: $('#form-edit-report-doctor').serialize(),
                  success: function(response) {
                      showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                      $('#modal-edit-report-doctor').modal('hide');
                      fetchReportDoctors(response.doctor.name);
                  },
                  error: function(xhr) {
                      showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to update doctor.', 'error');
                  }
              });
          });

          fetchReportDoctors();
          // =============================================

          // =============================================
          // STARTUP: Load all dynamic dropdowns from DB
          // =============================================
          fetchReportCategories();
          fetchReportSubCategories();
          fetchReportTests();
          fetchReportUnits();
          fetchReportReferences();
          fetchReportObserved();
          fetchReportFlags();
          // =============================================

          // =============================================
          // CATEGORY SELECT MANAGEMENT
          // =============================================
          function fetchReportCategories(selectedValue = null) {
              $.get("{{ route('api.categories') }}", function(data) {
                  let options = '<option value="">-- Select Category --</option>';
                  let modalOptions = '<option value="">-- Select Category --</option>';
                  (Array.isArray(data) ? data : (data.data || [])).forEach(function(cat) {
                      options += `<option value="${cat.name}" data-id="${cat.id}">${cat.name}</option>`;
                      modalOptions += `<option value="${cat.id}">${cat.name}</option>`;
                  });
                  $('.report-category-select').each(function() {
                      let currentVal = $(this).val();
                      $(this).html(options);
                      if (selectedValue && $(this).hasClass('active-category-select')) {
                          $(this).val(selectedValue).removeClass('active-category-select').trigger('change');
                      } else {
                          $(this).val(currentVal).trigger('change');
                      }
                  });
                  
                  // Also update subcategory modals!
                  let addSubCatSelect = $('#add-report-sub-category-id');
                  let addSubCatVal = window._pendingAddSubCatId !== undefined ? window._pendingAddSubCatId : addSubCatSelect.val();
                  addSubCatSelect.html(modalOptions).val(addSubCatVal);
                  window._pendingAddSubCatId = undefined;
                  
                  let editSubCatSelect = $('#edit-report-sub-category-id');
                  let editSubCatVal = window._pendingEditSubCatId !== undefined ? window._pendingEditSubCatId : editSubCatSelect.val();
                  editSubCatSelect.html(modalOptions).val(editSubCatVal);
                  window._pendingEditSubCatId = undefined;
              });
          }

          $(document).on('click', '.btn-add-report-category', function() {
              $('.report-category-select').removeClass('active-category-select');
              $(this).siblings('.report-category-select').addClass('active-category-select');
              $('#modal-add-report-category').modal('show');
          });

          $(document).on('click', '.btn-edit-report-category', function() {
              let select = $(this).siblings('.report-category-select');
              let selectedOption = select.find('option:selected');
              let catId = selectedOption.attr('data-id');
              if (!catId) { showToast('Please select a valid category to edit.', 'error'); return; }
              $('.report-category-select').removeClass('active-category-select');
              select.addClass('active-category-select');
              
              $('#edit-report-cat-id').val(catId);
              $('#edit-report-cat-name').val(selectedOption.val());
              $('#modal-edit-report-category').modal('show');
          });

          $('#btn-save-report-category').click(function() {
              let formData = $('#form-add-report-category').serialize();
              $.post("{{ route('categories.store') }}", formData, function(response) {
                  showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                  $('#modal-add-report-category').modal('hide');
                  $('#form-add-report-category')[0].reset();
                  fetchReportCategories(response.category.name);
              }).fail(function(xhr) {
                  showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to save category.', 'error');
              });
          });

          $('#btn-update-report-category').click(function() {
              let catId = $('#edit-report-cat-id').val();
              $.ajax({
                  url: "/categories/" + catId,
                  type: 'PUT',
                  data: $('#form-edit-report-category').serialize(),
                  success: function(response) {
                      showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                      $('#modal-edit-report-category').modal('hide');
                      fetchReportCategories(response.category.name);
                  },
                  error: function(xhr) {
                      showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to update category.', 'error');
                  }
              });
          });
          // =============================================

          // =============================================
          // SUBCATEGORY SELECT MANAGEMENT
          // =============================================
          function fetchReportSubCategories(selectedValue = null) {
              $.get("{{ route('api.sub-categories') }}", function(data) {
                  let options = '<option value="">-- Select Sub Category --</option>';
                  (Array.isArray(data) ? data : (data.data || [])).forEach(function(sub) {
                      options += `<option value="${sub.name}" data-id="${sub.id}" data-category_id="${sub.category_id}">${sub.name}</option>`;
                  });
                  $('.report-subcategory-select').each(function() {
                      let currentVal = $(this).val();
                      $(this).html(options);
                      if (selectedValue && $(this).hasClass('active-subcategory-select')) {
                          $(this).val(selectedValue).removeClass('active-subcategory-select').trigger('change');
                      } else {
                          $(this).val(currentVal).trigger('change');
                      }
                  });
              });
          }

           $(document).on('click', '.btn-add-report-subcategory', function() {
              $('.report-subcategory-select').removeClass('active-subcategory-select');
              $(this).siblings('.report-subcategory-select').addClass('active-subcategory-select');
              
              let catId = $(this).closest('.test-item-row').find('.report-category-select option:selected').attr('data-id');
              window._pendingAddSubCatId = catId || '';
              $('#add-report-sub-category-id').val(catId || '');
              
              $('#modal-add-report-subcategory').modal('show');
          });

          $('#modal-add-report-subcategory').on('shown.bs.modal', function() {
              if (window._pendingAddSubCatId !== undefined && window._pendingAddSubCatId !== null) {
                  $('#add-report-sub-category-id').val(window._pendingAddSubCatId);
              }
          });

          $(document).on('click', '.btn-edit-report-subcategory', function() {
              let select = $(this).siblings('.report-subcategory-select');
              let selectedOption = select.find('option:selected');
              let subId = selectedOption.attr('data-id');
              if (!subId) { showToast('Please select a valid sub-category to edit.', 'error'); return; }
              $('.report-subcategory-select').removeClass('active-subcategory-select');
              select.addClass('active-subcategory-select');
              
              let catId = selectedOption.attr('data-category_id') || $(this).closest('.test-item-row').find('.report-category-select option:selected').attr('data-id');
              window._pendingEditSubCatId = catId || '';
              $('#edit-report-sub-category-id').val(catId || '');
              
              $('#edit-report-sub-id').val(subId);
              $('#edit-report-sub-name').val(selectedOption.val());
              $('#modal-edit-report-subcategory').modal('show');
          });

          $('#modal-edit-report-subcategory').on('shown.bs.modal', function() {
              if (window._pendingEditSubCatId !== undefined && window._pendingEditSubCatId !== null) {
                  $('#edit-report-sub-category-id').val(window._pendingEditSubCatId);
              }
          });

          $('#btn-save-report-subcategory').click(function() {
              let formData = $('#form-add-report-subcategory').serialize();
              $.post("{{ route('sub-categories.store') }}", formData, function(response) {
                  showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                  $('#modal-add-report-subcategory').modal('hide');
                  $('#form-add-report-subcategory')[0].reset();
                  fetchReportSubCategories(response.subCategory.name);
              }).fail(function(xhr) {
                  showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to save sub-category.', 'error');
              });
          });

          $('#btn-update-report-subcategory').click(function() {
              let subId = $('#edit-report-sub-id').val();
              $.ajax({
                  url: "/sub-categories/" + subId,
                  type: 'PUT',
                  data: $('#form-edit-report-subcategory').serialize(),
                  success: function(response) {
                      showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                      $('#modal-edit-report-subcategory').modal('hide');
                      fetchReportSubCategories(response.subCategory.name);
                  },
                  error: function(xhr) {
                      showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to update sub-category.', 'error');
                  }
              });
          });
          // =============================================

          // =============================================
          // TEST/PARAMETER SELECT MANAGEMENT
          // =============================================
          function fetchReportTests(selectedValue = null) {
              $.get("{{ route('api.tests') }}", function(data) {
                  let options = '<option value="">-- Select Test --</option>';
                  (Array.isArray(data) ? data : (data.data || [])).forEach(function(test) {
                      let param = test.parameter || {};
                      let refJson = '[]';
                      if(test.reference_intervals) {
                          let refs = test.reference_intervals.map(r => ({
                              gender: r.gender, age_min: r.age_min, age_max: r.age_max, reference_text: r.reference_text, min_value: r.min_value, max_value: r.max_value
                          }));
                          // sanitize quotes
                          refJson = JSON.stringify(refs).replace(/'/g, "&#39;");
                      }
                      options += `<option value="${test.name}" 
                          data-id="${test.id}"
                          data-price="${test.price || 0}"
                          data-unit="${param.unit || ''}"
                          data-male-ref="${param.male_reference || ''}"
                          data-female-ref="${param.female_reference || ''}"
                          data-male-min="${param.male_min || ''}"
                          data-male-max="${param.male_max || ''}"
                          data-female-min="${param.female_min || ''}"
                          data-female-max="${param.female_max || ''}"
                          data-critical-low="${param.critical_low || ''}"
                          data-critical-high="${param.critical_high || ''}"
                          data-reference-intervals='${refJson}'
                          data-is-immunoassay="${param.is_immunoassay || 0}"
                          data-bio-ref="${param.biological_reference || ''}"
                          data-normal="${test.description || ''}">${test.name}</option>`;
                  });
                  options += '<option value="Immunoassay Test">Immunoassay Test (Auto-calc)</option>';

                  $('.test-selector-dynamic').each(function() {
                      let currentVal = $(this).val();
                      $(this).html(options);
                      if (selectedValue && $(this).hasClass('active-test-select')) {
                          $(this).val(selectedValue).removeClass('active-test-select').trigger('change'); // trigger auto-fill
                      } else {
                          $(this).val(currentVal).trigger('change');
                      }
                  });
              });
          }

          $(document).on('click', '.btn-add-report-test', function() {
              $('.test-selector-dynamic').removeClass('active-test-select');
              $(this).siblings('.test-selector-dynamic').addClass('active-test-select');
              $('#modal-add-report-test').modal('show');
          });

          $(document).on('click', '.btn-edit-report-test', function() {
              let select = $(this).siblings('.test-selector-dynamic');
              let selectedOption = select.find('option:selected');
              let testId = selectedOption.attr('data-id');
              if (!testId) { showToast('Please select a valid parameter to edit.', 'error'); return; }
              $('.test-selector-dynamic').removeClass('active-test-select');
              select.addClass('active-test-select');
              
              $('#edit-report-test-id').val(testId);
              $('#edit-report-test-name').val(selectedOption.val());
              $('#edit-report-test-unit').val(selectedOption.attr('data-unit'));
              $('#edit-report-test-bio').val(selectedOption.attr('data-bio-ref'));
              $('#edit-report-test-immunoassay').val(selectedOption.attr('data-is-immunoassay') || '0');
              
              // Reference Ranges & Panic Values
              $('#edit-report-test-male-min').val(selectedOption.attr('data-male-min') || '');
              $('#edit-report-test-male-max').val(selectedOption.attr('data-male-max') || '');
              $('#edit-report-test-female-min').val(selectedOption.attr('data-female-min') || '');
              $('#edit-report-test-female-max').val(selectedOption.attr('data-female-max') || '');
              $('#edit-report-test-critical-low').val(selectedOption.attr('data-critical-low') || '');
              $('#edit-report-test-critical-high').val(selectedOption.attr('data-critical-high') || '');
              $('#edit-report-test-male-ref').val(selectedOption.attr('data-male-ref') || '');
              $('#edit-report-test-female-ref').val(selectedOption.attr('data-female-ref') || '');
              
              $('#modal-edit-report-test').modal('show');
          });

          $('#btn-save-report-test').click(function() {
              let formData = $('#form-add-report-test').serialize();
              $.post("{{ route('tests.quick-store') }}", formData, function(response) {
                  showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                  $('#modal-add-report-test').modal('hide');
                  $('#form-add-report-test')[0].reset();
                  fetchReportTests(response.test.name);
              }).fail(function(xhr) {
                  showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to save parameter.', 'error');
              });
          });

          $('#btn-update-report-test').click(function() {
              let testId = $('#edit-report-test-id').val();
              $.ajax({
                  url: "/tests/quick-update/" + testId,
                  type: 'PUT',
                  data: $('#form-edit-report-test').serialize(),
                  success: function(response) {
                      showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                      $('#modal-edit-report-test').modal('hide');
                      fetchReportTests(response.test.name);
                  },
                  error: function(xhr) {
                      showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to update parameter.', 'error');
                  }
              });
          });

          // =============================================
          // UNIT SELECT MANAGEMENT
          // =============================================
          function fetchReportUnits(selectedValue = null) {
              $.get("{{ route('units.index') }}", function(data) {
                  let options = '<option value="">-- Select Unit --</option>';
                  (Array.isArray(data) ? data : (data.data || [])).forEach(function(u) {
                      options += `<option value="${u.name}" data-id="${u.id}">${u.name}</option>`;
                  });
                  $('.report-unit-select').each(function() {
                      let currentVal = $(this).val();
                      $(this).html(options);
                      if (selectedValue && $(this).hasClass('active-unit-select')) {
                          $(this).val(selectedValue).removeClass('active-unit-select').trigger('change');
                      } else {
                          $(this).val(currentVal).trigger('change');
                      }
                  });
              });
          }

          $(document).on('click', '.btn-add-report-unit', function() {
              $('.report-unit-select').removeClass('active-unit-select');
              $(this).siblings('.report-unit-select').addClass('active-unit-select');
              $('#modal-add-report-unit').modal('show');
          });

          $(document).on('click', '.btn-edit-report-unit', function() {
              let select = $(this).siblings('.report-unit-select');
              let selectedOption = select.find('option:selected');
              let unitId = selectedOption.attr('data-id');
              if (!unitId) { showToast('Please select a valid unit to edit.', 'error'); return; }
              $('.report-unit-select').removeClass('active-unit-select');
              select.addClass('active-unit-select');
              
              $('#edit-report-unit-id').val(unitId);
              $('#edit-report-unit-name').val(selectedOption.val());
              $('#modal-edit-report-unit').modal('show');
          });

          $('#btn-save-report-unit').click(function() {
              let formData = $('#form-add-report-unit').serialize();
              $.post("{{ route('units.store') }}", formData, function(response) {
                  showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                  $('#modal-add-report-unit').modal('hide');
                  $('#form-add-report-unit')[0].reset();
                  fetchReportUnits(response.unit.name);
              }).fail(function(xhr) {
                  showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to save unit.', 'error');
              });
          });

          $('#btn-update-report-unit').click(function() {
              let unitId = $('#edit-report-unit-id').val();
              $.ajax({
                  url: "/units/" + unitId,
                  type: 'PUT',
                  data: $('#form-edit-report-unit').serialize(),
                  success: function(response) {
                      showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                      $('#modal-edit-report-unit').modal('hide');
                      fetchReportUnits(response.unit.name);
                  },
                  error: function(xhr) {
                      showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to update unit.', 'error');
                  }
              });
          });
          // =============================================
          function fetchReportReferences(selectedValue = null) {
              $.get("{{ route('reference-templates.index') }}", function(data) {
                  let options = '<option value="">-- Select Reference --</option>';
                  (Array.isArray(data) ? data : (data.data || [])).forEach(function(ref) {
                      options += `<option value="${ref.name}" data-id="${ref.id}">${ref.name}</option>`;
                  });
                  $('.normal-val-dynamic, .bio-val-dynamic').each(function() {
                      let currentVal = $(this).val();
                      let currentSelectedId = $(this).find('option:selected').attr('data-id');
                      $(this).html(options);
                      if (selectedValue && $(this).hasClass('active-reference-select')) {
                          $(this).val(selectedValue).removeClass('active-reference-select').trigger('change');
                      } else if (currentSelectedId) {
                          let opt = $(this).find(`option[data-id="${currentSelectedId}"]`);
                          if (opt.length) {
                              $(this).val(opt.val()).trigger('change');
                          }
                      } else {
                          $(this).val(currentVal).trigger('change');
                      }
                  });
              });
          }

          function fetchReportObserved(selectedValue = null) {
              $.get("{{ route('result-templates.index') }}", function(data) {
                  let options = '<option value="">-- Select Observed --</option>';
                  (Array.isArray(data) ? data : (data.data || [])).forEach(function(tmpl) {
                      options += `<option value="${tmpl.name}" data-id="${tmpl.id}">${tmpl.name}</option>`;
                  });
                  $('.report-observed-select').each(function() {
                      let currentVal = $(this).val();
                      let currentSelectedId = $(this).find('option:selected').attr('data-id');
                      $(this).html(options);
                      if (selectedValue && $(this).hasClass('active-observed-select')) {
                          $(this).val(selectedValue).removeClass('active-observed-select').trigger('change');
                      } else if (currentSelectedId) {
                          let opt = $(this).find(`option[data-id="${currentSelectedId}"]`);
                          if (opt.length) {
                              $(this).val(opt.val()).trigger('change');
                          }
                      } else {
                          $(this).val(currentVal).trigger('change');
                      }
                  });
              });
          }

          function fetchReportFlags(selectedValue = null) {
              $.get("{{ route('flag-templates.index') }}", function(data) {
                  let options = '<option value="">-- Select Reference --</option>';
                  (Array.isArray(data) ? data : (data.data || [])).forEach(function(flg) {
                      options += `<option value="${flg.name}" data-id="${flg.id}">${flg.name}</option>`;
                  });
                  $('.flag-selector').each(function() {
                      let currentVal = $(this).val();
                      let currentSelectedId = $(this).find('option:selected').attr('data-id');
                      $(this).html(options);
                      if (selectedValue && $(this).hasClass('active-flag-select')) {
                          $(this).val(selectedValue).removeClass('active-flag-select').trigger('change');
                      } else if (currentSelectedId) {
                          let opt = $(this).find(`option[data-id="${currentSelectedId}"]`);
                          if (opt.length) {
                              $(this).val(opt.val()).trigger('change');
                          }
                      } else {
                          $(this).val(currentVal).trigger('change');
                      }
                  });
              });
          }

          // =============================================
          // OBSERVED TEMPLATE MANAGEMENT
          // =============================================
          $(document).on('click', '.btn-add-observed', function() {
              $('.report-observed-select').removeClass('active-observed-select');
              let select = $(this).closest('.test-item-row').find('.report-observed-select');
              select.addClass('active-observed-select');
              $('#modal-add-report-observed').modal('show');
          });

          $(document).on('click', '.btn-edit-observed', function() {
              let select = $(this).closest('.test-item-row').find('.report-observed-select');
              let selectedOption = select.find('option:selected');
              let observedName = selectedOption.val();
              if (!observedName) { showToast('Please select a valid observed value to edit.', 'error'); return; }
              $('.report-observed-select').removeClass('active-observed-select');
              select.addClass('active-observed-select');
              
              let observedId = selectedOption.attr('data-id');
              $('#edit-report-observed-id').val(observedId);
              $('#edit-report-observed-name').val(observedName);
              $('#modal-edit-report-observed').modal('show');
          });

          $('#btn-save-report-observed').click(function() {
              let formData = $('#form-add-report-observed').serialize();
              let nameVal = $('#form-add-report-observed input[name="name"]').val().trim();
              $.post("{{ route('result-templates.store') }}", formData, function(response) {
                  showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                  $('#modal-add-report-observed').modal('hide');
                  $('#form-add-report-observed')[0].reset();
                  fetchReportObserved(nameVal);
              }).fail(function(xhr) {
                  showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to save observed template.', 'error');
              });
          });

          $('#btn-update-report-observed').click(function() {
              let observedId = $('#edit-report-observed-id').val();
              let nameVal = $('#edit-report-observed-name').val().trim();
              $.ajax({
                  url: "/result-templates/" + observedId,
                  type: 'PUT',
                  data: $('#form-edit-report-observed').serialize(),
                  success: function(response) {
                      showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                      $('#modal-edit-report-observed').modal('hide');
                      $('#form-edit-report-observed')[0].reset();
                      fetchReportObserved(nameVal);
                  },
                  error: function(xhr) {
                      showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to update observed template.', 'error');
                  }
              });
          });
          // =============================================

          // =============================================
          // REFERENCE TEMPLATE MANAGEMENT
          // =============================================
          $(document).on('click', '.btn-add-reference', function() {
              $('.normal-val-dynamic, .bio-val-dynamic').removeClass('active-reference-select');
              let select = $(this).closest('.input-group').find('select');
              select.addClass('active-reference-select');
              $('#modal-add-report-reference').modal('show');
          });

          $(document).on('click', '.btn-edit-reference', function() {
              let select = $(this).closest('.test-item-row').find('.normal-val-dynamic');
              let selectedOption = select.find('option:selected');
              let referenceName = selectedOption.val();
              if (!referenceName) { showToast('Please select a valid reference value to edit.', 'error'); return; }
              
              let referenceId = selectedOption.attr('data-id');
              if (!referenceId) { showToast('This is a custom/auto-filled reference value — not saved as a template. Click "+" to save it as a template first.', 'error'); return; }
              
              $('.normal-val-dynamic').removeClass('active-reference-select');
              select.addClass('active-reference-select');
              
              $('#edit-report-reference-id').val(referenceId);
              $('#edit-report-reference-name').val(referenceName);
              $('#modal-edit-report-reference').modal('show');
          });

          $('#btn-save-report-reference').click(function() {
              let formData = $('#form-add-report-reference').serialize();
              let nameVal = $('#form-add-report-reference input[name="name"]').val().trim();
              $.post("{{ route('reference-templates.store') }}", formData, function(response) {
                  showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                  $('#modal-add-report-reference').modal('hide');
                  $('#form-add-report-reference')[0].reset();
                  fetchReportReferences(nameVal);
              }).fail(function(xhr) {
                  showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to save reference template.', 'error');
              });
          });

          $('#btn-update-report-reference').click(function() {
              let referenceId = $('#edit-report-reference-id').val();
              let nameVal = $('#edit-report-reference-name').val().trim();
              $.ajax({
                  url: "/reference-templates/" + referenceId,
                  type: 'PUT',
                  data: $('#form-edit-report-reference').serialize(),
                  success: function(response) {
                      showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                      $('#modal-edit-report-reference').modal('hide');
                      $('#form-edit-report-reference')[0].reset();
                      fetchReportReferences(nameVal);
                  },
                  error: function(xhr) {
                      showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to update reference template.', 'error');
                  }
              });
          });

          $(document).on('click', '.btn-delete-reference', function() {
              let select = $(this).closest('.test-item-row').find('.normal-val-dynamic');
              let selectedOption = select.find('option:selected');
              let referenceId = selectedOption.attr('data-id');
              let referenceName = selectedOption.val();
              if (!referenceId) { showToast('Please select a valid reference template to delete.', 'error'); return; }
              
              confirmDelete({
                  title: 'Delete Reference Template?',
                  text: 'Are you sure you want to delete the reference template "' + referenceName + '"?'
              }, function() {
                  $.ajax({
                      url: "/reference-templates/" + referenceId,
                      type: 'DELETE',
                      success: function(response) {
                          showToast(response.success || 'Reference template deleted successfully!', 'success');
                          fetchReportReferences();
                      },
                      error: function(xhr) {
                          showToast('Error: ' + (xhr.responseJSON?.message || 'Failed to delete reference template.'), 'error');
                      }
                  });
              });
          });
          // =============================================

          // =============================================
          // FLAG TEMPLATE MANAGEMENT
          // =============================================
          $(document).on('click', '.btn-add-flag', function() {
              $('.flag-selector').removeClass('active-flag-select');
              let select = $(this).closest('.test-item-row').find('.flag-selector');
              select.addClass('active-flag-select');
              $('#modal-add-report-flag').modal('show');
          });

          $(document).on('click', '.btn-edit-flag', function() {
              let select = $(this).closest('.test-item-row').find('.flag-selector');
              let selectedOption = select.find('option:selected');
              let flagName = selectedOption.val();
              if (!flagName) { showToast('Please select a valid flag to edit.', 'error'); return; }
              $('.flag-selector').removeClass('active-flag-select');
              select.addClass('active-flag-select');
              
              let flagId = selectedOption.attr('data-id');
              $('#edit-report-flag-id').val(flagId);
              $('#edit-report-flag-name').val(flagName);
              $('#modal-edit-report-flag').modal('show');
          });

          $('#btn-save-report-flag').click(function() {
              let formData = $('#form-add-report-flag').serialize();
              let nameVal = $('#form-add-report-flag input[name="name"]').val().trim();
              $.post("{{ route('flag-templates.store') }}", formData, function(response) {
                  showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                  $('#modal-add-report-flag').modal('hide');
                  $('#form-add-report-flag')[0].reset();
                  fetchReportFlags(nameVal);
              }).fail(function(xhr) {
                  showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to save flag template.', 'error');
              });
          });

          $('#btn-update-report-flag').click(function() {
              let flagId = $('#edit-report-flag-id').val();
              let nameVal = $('#edit-report-flag-name').val().trim();
              $.ajax({
                  url: "/flag-templates/" + flagId,
                  type: 'PUT',
                  data: $('#form-edit-report-flag').serialize(),
                  success: function(response) {
                      showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                      $('#modal-edit-report-flag').modal('hide');
                      $('#form-edit-report-flag')[0].reset();
                      fetchReportFlags(nameVal);
                  },
                  error: function(xhr) {
                      showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to update flag template.', 'error');
                  }
              });
          });
          // =============================================

           // Save Report

		  $('#btn-save-report').click(function() {
              if(!$('#form-add-report')[0].checkValidity()) {
                  $('#form-add-report')[0].reportValidity();
                  return;
              }

			  let btn = $(this);
              btn.html('<i class="fa fa-spinner fa-spin"></i> Saving...').prop('disabled', true);
			  
			  $.post("{{ route('reports.store') }}", $('#form-add-report').serialize(), function(response) {
				  showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
				  refreshReportsPageData('#modal-add-report', btn, 'Generate Report');
                  $('#form-add-report')[0].reset();
                  $('#dynamic-tests-container').empty();
			  }).fail(function(xhr) {
                  let errorMsg = (xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Error saving report. Please check all fields.");
				  showToast(errorMsg, 'error');
                  btn.html('Generate Report').prop('disabled', false);
			  });
		  });

          let pendingAction = null;
          let pendingReportId = null;

          $(document).on('click', '.btn-edit', function(e) {
              e.preventDefault();
              let id = $(this).data('id');
              loadAndShowEditModal(id);
          });

          $(document).on('click', '.btn-delete', function(e) {
              e.preventDefault();
              let id = $(this).data('id');
              executeDeleteReport(id);
          });

          function executeDeleteReport(id) {
               confirmDelete({
                   title: 'Delete Report?',
                   text: 'Are you sure you want to delete this report? This action cannot be undone.'
               }, function() {
                   $.ajax({
                       url: "/reports/" + id,
                       type: 'DELETE',
                       success: function(response) {
                           showToast(response.success || 'Report deleted successfully', 'success');
                           refreshReportsPageData();
                       },
                       error: function(xhr) {
                           showToast(xhr.responseJSON?.message || 'Failed to delete report', 'error');
                       }
                   });
               });
           }

          // Edit Report Load Data
          function loadAndShowEditModal(id) {
              $.get("/reports/" + id, function(data) {
                  $('#edit-report-id').val(data.id);
                  $('#edit-patient-id').val(data.patient_id).trigger('change');
                  $('#edit-report-doctor').val(data.doctor_name).trigger('change');
                  $('#edit-sample-date').val(moment(data.sample_received_on).format('YYYY-MM-DDTHH:mm'));
                  $('#edit-release-date').val(moment(data.report_released_on).format('YYYY-MM-DDTHH:mm'));
                  $('#edit-report-notes').val(data.notes || '');
                  $('#edit-report-signature-id').val(data.report_signature_id || '').trigger('change');
                  $('#edit-signature-pin').val('');
                  updateSignaturePinRequirement($('#edit-report-signature-id')[0]);
                  
                  let container = $('#edit-dynamic-tests-container');
                  container.empty();
                  
                  if(data.results && data.results.length > 0) {
                      data.results.forEach(item => {
                          let catOptions = `<option value="">-- Select Category --</option>`;
                          @foreach($categories as $cat)
                            catOptions += `<option value="{{ str_replace(['`', '${'], ['\`', '\${'], $cat->name) }}" data-id="{{ $cat->id }}">{{ str_replace(['`', '${'], ['\`', '\${'], $cat->name) }}</option>`;
                          @endforeach

                          let subOptions = `<option value="">-- Select Sub Category --</option>`;
                          @foreach($subCategories as $sub)
                            subOptions += `<option value="{{ str_replace(['`', '${'], ['\`', '\${'], $sub->name) }}" data-id="{{ $sub->id }}" data-category_id="{{ $sub->category_id }}">{{ str_replace(['`', '${'], ['\`', '\${'], $sub->name) }}</option>`;
                          @endforeach

                           let testOptions = `<option value="">-- Select Test --</option>`;
                           @foreach($tests as $test)
                             testOptions += `<option value="{{ str_replace(['`', '${'], ['\`', '\${'], $test->name) }}" 
                                data-unit="{{ $test->parameter->unit ?? '' }}"
                                data-male-ref="{{ $test->parameter->male_reference ?? '' }}"
                                data-female-ref="{{ $test->parameter->female_reference ?? '' }}"
                                data-male-min="{{ $test->parameter->male_min ?? '' }}"
                                data-male-max="{{ $test->parameter->male_max ?? '' }}"
                                data-female-min="{{ $test->parameter->female_min ?? '' }}"
                                data-female-max="{{ $test->parameter->female_max ?? '' }}"
                                data-critical-low="{{ $test->parameter->critical_low ?? '' }}"
                                data-critical-high="{{ $test->parameter->critical_high ?? '' }}"
                                data-reference-intervals='{{ $test->referenceIntervals->map->only(['gender', 'age_min', 'age_max', 'reference_text', 'min_value', 'max_value'])->values()->toJson() }}'
                                data-is-immunoassay="{{ $test->parameter->is_immunoassay ?? 0 }}"
                                data-bio-ref="{{ $test->parameter->biological_reference ?? '' }}"
                                data-normal="{{ str_replace(['`', '${'], ['\`', '\${'], $test->description) }}">{{ str_replace(['`', '${'], ['\`', '\${'], $test->name) }}</option>`;
                           @endforeach

                           let flagOptions = `<option value="">-- Select --</option>`;
                           @foreach($flagTemplates as $flg)
                             flagOptions += `<option value="{{ str_replace(['`', '${'], ['\`', '\${'], $flg->name) }}" data-id="{{ $flg->id }}">{{ str_replace(['`', '${'], ['\`', '\${'], $flg->name) }}</option>`;
                           @endforeach

                           let newRow = $(`
             <div class="test-item-row card border-0 shadow-sm mb-3" style="background: linear-gradient(145deg, #ffffff, #f8fafc); border-radius: 12px; position: relative; overflow: hidden;">
                 <div style="position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: #6366f1;"></div>
                 <div class="card-body p-3">
                     <span class="badge bg-primary text-white position-absolute row-sl-no" style="top: 10px; left: 15px; z-index: 10; border-radius: 6px;">SL 1</span>
                     <button type="button" class="btn btn-sm btn-danger position-absolute remove-row" style="top: 10px; right: 10px; z-index: 10; border-radius: 8px;" title="Remove Test"><i class="fa fa-trash"></i></button>
                     <div class="row g-3 align-items-end mt-3">
                          <div class="col-md-4 col-sm-6">
                              <label class="form-label text-muted fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Master Category</label>
                              <div class="input-group flex-nowrap">
                                  <select class="form-select report-category-select" name="test_category[]" autocomplete="off">
                                      ${catOptions}
                                  </select>
                                  <button type="button" class="btn btn-success btn-sm btn-add-report-category" title="Add Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                  <button type="button" class="btn btn-primary btn-sm btn-edit-report-category" title="Edit Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-info btn-sm btn-view-report-category" title="View Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm btn-delete-report-category" title="Delete Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6">
                              <label class="form-label text-muted fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Sub Category</label>
                              <div class="input-group flex-nowrap">
                                  <select class="form-select report-subcategory-select" name="test_subcategory[]" autocomplete="off">
                                      ${subOptions}
                                  </select>
                                  <button type="button" class="btn btn-success btn-sm btn-add-report-subcategory" title="Add Sub-Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                  <button type="button" class="btn btn-primary btn-sm btn-edit-report-subcategory" title="Edit Sub-Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-info btn-sm btn-view-report-subcategory" title="View Sub-Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm btn-delete-report-subcategory" title="Delete Sub-Category" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6">
                              <label class="form-label text-primary fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Parameter / Test Name</label>
                              <div class="input-group flex-nowrap">
                                  <select class="form-select test-selector-dynamic border-primary shadow-none" name="test_name[]" autocomplete="off">
                                      ${testOptions}
                                  </select>
                                  <button type="button" class="btn btn-success btn-sm btn-add-report-test" title="Add Parameter" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                  <button type="button" class="btn btn-primary btn-sm btn-edit-report-test" title="Edit Parameter" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-info btn-sm btn-view-report-test" title="View Parameter Details" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm btn-delete-report-test" title="Delete Parameter" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6">
                              <label class="form-label text-success fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Observed Value</label>
                              <div class="input-group flex-nowrap">
                                  <select class="form-select report-observed-select" name="observed_value[]" autocomplete="off">
                                      <option value="">-- Select Observed --</option>
                                      @foreach($templates as $tmpl)
                                          <option value="{{ $tmpl->name }}" data-id="{{ $tmpl->id }}">{{ $tmpl->name }}</option>
                                      @endforeach
                                  </select>
                                  <button type="button" class="btn btn-success btn-sm btn-add-observed" title="Add Observed" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                  <button type="button" class="btn btn-primary btn-sm btn-edit-observed" title="Edit Observed" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-info btn-sm btn-view-observed" title="View Observed Details" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm btn-delete-observed" title="Delete Observed" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6">
                              <label class="form-label text-muted fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Unit</label>
                              <div class="input-group flex-nowrap">
                                  <select class="form-select report-unit-select" name="test_unit[]" autocomplete="off">
                                      <option value="">-- Select Unit --</option>
                                      @foreach($units as $u)
                                          <option value="{{ $u->name }}" data-id="{{ $u->id }}">{{ $u->name }}</option>
                                      @endforeach
                                  </select>
                                  <button type="button" class="btn btn-success btn-sm btn-add-report-unit" title="Add Unit" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                  <button type="button" class="btn btn-primary btn-sm btn-edit-report-unit" title="Edit Unit" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-info btn-sm btn-view-report-unit" title="View Unit" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm btn-delete-report-unit" title="Delete Unit" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6">
                              <label class="form-label text-info fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Referral Range</label>
                              <div class="input-group flex-nowrap">
                                  <select class="form-select normal-val-dynamic" name="normal_value[]" autocomplete="off">
                                      <option value="">-- Select Reference --</option>
                                      @foreach($referenceTemplates as $ref)
                                          <option value="{{ $ref->name }}" data-id="{{ $ref->id }}">{{ $ref->name }}</option>
                                      @endforeach
                                  </select>
                                  <button type="button" class="btn btn-success btn-sm btn-add-reference" title="Add Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                  <button type="button" class="btn btn-primary btn-sm btn-edit-reference" title="Edit Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-info btn-sm btn-view-reference" title="View Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm btn-delete-reference" title="Delete Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6">
                              <label class="form-label text-warning fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Flag</label>
                              <div class="input-group flex-nowrap">
                                  <select class="form-select flag-selector" name="test_flag[]" autocomplete="off">
                                      ${flagOptions}
                                  </select>
                                  <button type="button" class="btn btn-success btn-sm btn-add-flag" title="Add Flag" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                  <button type="button" class="btn btn-primary btn-sm btn-edit-flag" title="Edit Flag" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-info btn-sm btn-view-flag" title="View Flag" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm btn-delete-flag" title="Delete Flag" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                              </div>
                          </div>
                          <div class="col-md-8 col-sm-12">
                              <label class="form-label text-dark fs-11 fw-bold text-uppercase mb-1" style="font-size:11px;">Normal Range</label>
                              <div class="input-group flex-nowrap">
                                  <select class="form-select bio-val-dynamic" name="biological_reference[]" autocomplete="off">
                                      <option value="">-- Select Range --</option>
                                      @foreach($referenceTemplates as $ref)
                                          <option value="{{ $ref->name }}" data-id="{{ $ref->id }}">{{ $ref->name }}</option>
                                      @endforeach
                                  </select>
                                  <button type="button" class="btn btn-success btn-sm btn-add-reference" title="Add Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-plus"></i></button>
                                  <button type="button" class="btn btn-primary btn-sm btn-edit-reference" title="Edit Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-info btn-sm btn-view-reference" title="View Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-eye"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm btn-delete-reference" title="Delete Reference" style="padding: 0.25rem 0.5rem;"><i class="fa fa-trash"></i></button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                             `);
                           container.append(newRow);
                           setSelectValueWithDefault(newRow.find('.report-category-select'), item.category);
                           setSelectValueWithDefault(newRow.find('.report-subcategory-select'), item.subcategory);
                           setSelectValueWithDefault(newRow.find('.test-selector-dynamic'), item.name);
                           setSelectValueWithDefault(newRow.find('.report-observed-select'), item.observed_value);
                           setSelectValueWithDefault(newRow.find('.report-unit-select'), item.unit);
                           setSelectValueWithDefault(newRow.find('.flag-selector'), item.flag);
                           setSelectValueWithDefault(newRow.find('.normal-val-dynamic'), item.normal_value);
                           setSelectValueWithDefault(newRow.find('.bio-val-dynamic'), item.biological_reference);
                      });
                      updateRowSlNo(container);
                      initDynamicSelect2();
                  } else {
                      container.append(trTemplate);
                      updateRowSlNo(container);
                      initDynamicSelect2();
                  }

                  new bootstrap.Modal(document.getElementById('modal-edit-report')).show();
              });
          }

          // Update Report
          $('#btn-update-report').click(function() {
              if(!$('#form-edit-report')[0].checkValidity()) {
                  $('#form-edit-report')[0].reportValidity();
                  return;
              }

			  let btn = $(this);
              let id = $('#edit-report-id').val();
              btn.html('<i class="fa fa-spinner fa-spin"></i> Updating...').prop('disabled', true);

			  
			  $.ajax({
                  url: "/reports/" + id,
                  type: 'PUT',
                  data: $('#form-edit-report').serialize(),
                  success: function(response) {
                      showToast(response.success || 'Done!', 'success'); setTimeout(() => location.reload(), 600); return;
                      refreshReportsPageData('#modal-edit-report', btn, 'Update Report');
                  },
                  error: function(xhr) {
                      showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error updating report.', 'error');
                      btn.html('Update Report').prop('disabled', false);
                  }
              });
		  });

	  });
  </script>
  @endpush


  <div class="modal fade modal-aw" id="modal-add-report-doctor" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-user-md me-2"></i>Add New Doctor</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-add-report-doctor">
				@csrf
				<div class="form-group">
					<label for="field_1126"  class="form-label-aw">Doctor Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control-aw" name="name" required placeholder="e.g. Dr. John Doe" autocomplete="off" id="field_1126">
				</div>
				<div class="form-group mt-3">
					<label for="field_1127"  class="form-label-aw">Qualification</label>
					<input type="text" class="form-control-aw" name="qualification" placeholder="e.g. MBBS, MD" autocomplete="off" id="field_1127">
				</div>
				<div class="form-group mt-3">
					<label for="field_1128"  class="form-label-aw">Phone No</label>
					<input type="text" class="form-control-aw" name="phone" placeholder="Phone Number" autocomplete="off" id="field_1128">
				</div>
				<div class="form-group mt-3">
					<label for="field_1129"  class="form-label-aw">Email</label>
					<input type="email" class="form-control-aw" name="email" placeholder="Email Address" autocomplete="new-password" id="field_1129">
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-save-report-doctor">Save Doctor</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Edit Report Doctor Modal -->
  <div class="modal fade modal-aw" id="modal-edit-report-doctor" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-user-md me-2"></i>Edit Doctor</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-edit-report-doctor">
				@csrf
				<input type="hidden" name="doctor_id" id="edit-report-doc-id">
				<div class="form-group">
					<label for="edit-report-doc-name" class="form-label-aw">Doctor Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control-aw" name="name" id="edit-report-doc-name" required autocomplete="off">
				</div>
				<div class="form-group mt-3">
					<label for="edit-report-doc-qualification" class="form-label-aw">Qualification</label>
					<input type="text" class="form-control-aw" name="qualification" id="edit-report-doc-qualification" autocomplete="off">
				</div>
				<div class="form-group mt-3">
					<label for="edit-report-doc-phone" class="form-label-aw">Phone No</label>
					<input type="text" class="form-control-aw" name="phone" id="edit-report-doc-phone" autocomplete="off">
				</div>
				<div class="form-group mt-3">
					<label for="edit-report-doc-email" class="form-label-aw">Email</label>
					<input type="email" class="form-control-aw" name="email" id="edit-report-doc-email" autocomplete="new-password">
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-update-report-doctor">Update Doctor</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Add Category Modal -->
  <div class="modal fade modal-aw" id="modal-add-report-category" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-folder-plus me-2"></i>Add New Category</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-add-report-category">
				@csrf
				<div class="form-group">
					<label for="field_1130"  class="form-label-aw">Category Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control-aw" name="name" required placeholder="e.g. BIOCHEMISTRY" autocomplete="off" id="field_1130">
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-save-report-category">Save Category</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Edit Category Modal -->
  <div class="modal fade modal-aw" id="modal-edit-report-category" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-folder-open me-2"></i>Edit Category</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-edit-report-category">
				@csrf
				<div class="form-group">
					<label for="edit-report-cat-name" class="form-label-aw">Category Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control-aw" name="name" id="edit-report-cat-name" required autocomplete="off">
				</div>
                <input type="hidden" name="category_id" id="edit-report-cat-id">
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-update-report-category">Update Category</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Add SubCategory Modal -->
  <div class="modal fade modal-aw" id="modal-add-report-subcategory" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-folder-plus me-2"></i>Add New Sub-Category</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-add-report-subcategory">
				@csrf
				<div class="form-group">
					<label for="add-report-sub-category-id" class="form-label-aw">Category <span class="text-danger">*</span></label>
					<select class="form-select" name="category_id" id="add-report-sub-category-id" required autocomplete="off">
						<option value="">-- Select Category --</option>
						@foreach($categories as $cat)
							<option value="{{ $cat->id }}">{{ $cat->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group mt-3">
					<label for="field_1131"  class="form-label-aw">Sub-Category Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control-aw" name="name" required placeholder="e.g. SEROLOGY" autocomplete="off" id="field_1131">
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-save-report-subcategory">Save Sub-Category</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Edit SubCategory Modal -->
  <div class="modal fade modal-aw" id="modal-edit-report-subcategory" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-folder-open me-2"></i>Edit Sub-Category</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-edit-report-subcategory">
				@csrf
				<div class="form-group">
					<label for="edit-report-sub-category-id" class="form-label-aw">Category <span class="text-danger">*</span></label>
					<select class="form-select" name="category_id" id="edit-report-sub-category-id" required autocomplete="off">
						<option value="">-- Select Category --</option>
						@foreach($categories as $cat)
							<option value="{{ $cat->id }}">{{ $cat->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group mt-3">
					<label for="edit-report-sub-name" class="form-label-aw">Sub-Category Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control-aw" name="name" id="edit-report-sub-name" required autocomplete="off">
				</div>
                <input type="hidden" name="subcategory_id" id="edit-report-sub-id">
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-update-report-subcategory">Update Sub-Category</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Add Parameter Modal -->
   <!-- Add Reference Modal -->
   <div class="modal fade modal-aw" id="modal-add-report-reference" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title"><i class="fa fa-plus-circle me-2"></i>Add Reference Template</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="form-add-report-reference">
                       @csrf
                       <div class="form-group">
                           <label for="field_1132"  class="form-label">Template Name</label>
                           <input type="text" class="form-control" name="name" required placeholder="e.g. 70 - 110 mg/dl" autocomplete="off" id="field_1132">
                       </div>
                   </form>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
                   <button type="button" class="btn-aw-primary" id="btn-save-report-reference">Save Template</button>
               </div>
           </div>
       </div>
   </div>

   <!-- Edit Reference Modal -->
   <div class="modal fade modal-aw" id="modal-edit-report-reference" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title"><i class="fa fa-edit me-2"></i>Edit Reference Template</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="form-edit-report-reference">
                       @csrf
                       <input type="hidden" id="edit-report-reference-id" name="name_1133">
                       <div class="form-group">
                           <label for="edit-report-reference-name" class="form-label">Template Name</label>
                           <input type="text" class="form-control" name="name" id="edit-report-reference-name" required autocomplete="off">
                       </div>
                   </form>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
                   <button type="button" class="btn-aw-primary" id="btn-update-report-reference">Update Template</button>
               </div>
           </div>
       </div>
   </div>

   <!-- Add Flag Modal -->
   <div class="modal fade modal-aw" id="modal-add-report-flag" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title"><i class="fa fa-plus-circle me-2"></i>Add Flag Template</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="form-add-report-flag">
                       @csrf
                       <div class="form-group">
                           <label for="field_1134"  class="form-label">Flag Name</label>
                           <input type="text" class="form-control" name="name" required placeholder="e.g. H, L, N" autocomplete="off" id="field_1134">
                       </div>
                   </form>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
                   <button type="button" class="btn-aw-primary" id="btn-save-report-flag">Save Template</button>
               </div>
           </div>
       </div>
   </div>

   <!-- Edit Flag Modal -->
   <div class="modal fade modal-aw" id="modal-edit-report-flag" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title"><i class="fa fa-edit me-2"></i>Edit Flag Template</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="form-edit-report-flag">
                       @csrf
                       <input type="hidden" id="edit-report-flag-id" name="name_1135">
                       <div class="form-group">
                           <label for="edit-report-flag-name" class="form-label">Flag Name</label>
                           <input type="text" class="form-control" name="name" id="edit-report-flag-name" required autocomplete="off">
                       </div>
                   </form>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
                   <button type="button" class="btn-aw-primary" id="btn-update-report-flag">Update Template</button>
               </div>
           </div>
       </div>
   </div>
   <div class="modal fade modal-aw" id="modal-add-report-observed" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title"><i class="fa fa-plus-circle me-2"></i>Add Observed Template</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="form-add-report-observed">
                       @csrf
                       <div class="form-group">
                           <label for="field_1136"  class="form-label">Template Name</label>
                           <input type="text" class="form-control" name="name" required placeholder="e.g. Negative, Positive, Trace" autocomplete="off" id="field_1136">
                       </div>
                   </form>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
                   <button type="button" class="btn-aw-primary" id="btn-save-report-observed">Save Template</button>
               </div>
           </div>
       </div>
   </div>

   <!-- Edit Observed Modal -->
   <div class="modal fade modal-aw" id="modal-edit-report-observed" tabindex="-1" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title"><i class="fa fa-edit me-2"></i>Edit Observed Template</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="form-edit-report-observed">
                       @csrf
                       <input type="hidden" id="edit-report-observed-id" name="name_1137">
                       <div class="form-group">
                           <label for="edit-report-observed-name" class="form-label">Template Name</label>
                           <input type="text" class="form-control" name="name" id="edit-report-observed-name" required autocomplete="off">
                       </div>
                   </form>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
                   <button type="button" class="btn-aw-primary" id="btn-update-report-observed">Update Template</button>
               </div>
           </div>
       </div>
   </div>

   <div class="modal fade modal-aw" id="modal-add-report-test" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
 	  <div class="modal-dialog modal-dialog-centered modal-lg">
 		<div class="modal-content">
 		  <div class="modal-header">
 			<h5 class="modal-title"><i class="fa fa-flask me-2"></i>Add New Parameter</h5>
 			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 		  </div>
 		  <div class="modal-body">
 			<form id="form-add-report-test">
 				@csrf
 				<div class="row">
 					<div class="col-md-6 mb-3">
 						<label for="field_1138" class="form-label-aw">Parameter Name <span class="text-danger">*</span></label>
 						<input type="text" class="form-control-aw" name="name" required placeholder="e.g. Glucose Fasting" autocomplete="off" id="field_1138">
 					</div>
 					<div class="col-md-6 mb-3">
 						<label for="field_1139" class="form-label-aw">Unit</label>
 						<input type="text" class="form-control-aw" name="unit" placeholder="e.g. mg/dL, %, IU/L" autocomplete="off" id="field_1139">
 					</div>
 				</div>
 				<div class="row">
 					<div class="col-md-6 mb-3">
 						<label for="field_1140" class="form-label-aw">Biological Reference</label>
 						<input type="text" class="form-control-aw" name="biological_reference" placeholder="e.g. 70 - 110" autocomplete="off" id="field_1140">
 					</div>
 					<div class="col-md-6 mb-3">
 						<label class="form-label-aw">Is Immunoassay?</label>
 						<select class="form-select form-control-aw" name="is_immunoassay">
 							<option value="0">No</option>
 							<option value="1">Yes</option>
 						</select>
 					</div>
 				</div>
 				
 				<h6 class="mt-2 mb-3 text-primary fw-bold" style="font-size: 14px;"><i class="fa fa-sliders me-1"></i>Reference Intervals & Limits</h6>
 				
 				<div class="row">
 					<div class="col-md-3 mb-3">
 						<label class="form-label-aw">Male Min Value</label>
 						<input type="number" step="any" class="form-control-aw" name="male_min" placeholder="Min" autocomplete="off">
 					</div>
 					<div class="col-md-3 mb-3">
 						<label class="form-label-aw">Male Max Value</label>
 						<input type="number" step="any" class="form-control-aw" name="male_max" placeholder="Max" autocomplete="off">
 					</div>
 					<div class="col-md-3 mb-3">
 						<label class="form-label-aw">Female Min Value</label>
 						<input type="number" step="any" class="form-control-aw" name="female_min" placeholder="Min" autocomplete="off">
 					</div>
 					<div class="col-md-3 mb-3">
 						<label class="form-label-aw">Female Max Value</label>
 						<input type="number" step="any" class="form-control-aw" name="female_max" placeholder="Max" autocomplete="off">
 					</div>
 				</div>
 				
 				<div class="row">
 					<div class="col-md-3 mb-3">
 						<label class="form-label-aw">Critical Low (Panic)</label>
 						<input type="number" step="any" class="form-control-aw" name="critical_low" placeholder="e.g. 3.0" autocomplete="off">
 					</div>
 					<div class="col-md-3 mb-3">
 						<label class="form-label-aw">Critical High (Panic)</label>
 						<input type="number" step="any" class="form-control-aw" name="critical_high" placeholder="e.g. 8.0" autocomplete="off">
 					</div>
 					<div class="col-md-3 mb-3">
 						<label class="form-label-aw">Male Ref. Text</label>
 						<input type="text" class="form-control-aw" name="male_reference" placeholder="e.g. 4.5 - 6.0" autocomplete="off">
 					</div>
 					<div class="col-md-3 mb-3">
 						<label class="form-label-aw">Female Ref. Text</label>
 						<input type="text" class="form-control-aw" name="female_reference" placeholder="e.g. 4.5 - 6.0" autocomplete="off">
 					</div>
 				</div>
 			</form>
 		  </div>
 		  <div class="modal-footer">
 			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
 			<button type="button" class="btn-aw-primary" id="btn-save-report-test">Save Parameter</button>
 		  </div>
 		</div>
 	  </div>
   </div>

  <!-- Edit Parameter Modal -->
  <div class="modal fade modal-aw" id="modal-edit-report-test" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-flask me-2"></i>Edit Parameter</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-edit-report-test">
				@csrf
				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="edit-report-test-name" class="form-label-aw">Parameter Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control-aw" name="name" id="edit-report-test-name" required autocomplete="off">
					</div>
					<div class="col-md-6 mb-3">
						<label for="edit-report-test-unit" class="form-label-aw">Unit</label>
						<input type="text" class="form-control-aw" name="unit" id="edit-report-test-unit" autocomplete="off" placeholder="e.g. mg/dL, %, IU/L">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="edit-report-test-bio" class="form-label-aw">Biological Reference</label>
						<input type="text" class="form-control-aw" name="biological_reference" id="edit-report-test-bio" autocomplete="off">
					</div>
					<div class="col-md-6 mb-3">
						<label class="form-label-aw">Is Immunoassay?</label>
						<select class="form-select form-control-aw" name="is_immunoassay" id="edit-report-test-immunoassay">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
				</div>
				
				<h6 class="mt-2 mb-3 text-primary fw-bold" style="font-size: 14px;"><i class="fa fa-sliders me-1"></i>Reference Intervals & Limits</h6>
				
				<div class="row">
					<div class="col-md-3 mb-3">
						<label class="form-label-aw">Male Min Value</label>
						<input type="number" step="any" class="form-control-aw" name="male_min" id="edit-report-test-male-min" autocomplete="off">
					</div>
					<div class="col-md-3 mb-3">
						<label class="form-label-aw">Male Max Value</label>
						<input type="number" step="any" class="form-control-aw" name="male_max" id="edit-report-test-male-max" autocomplete="off">
					</div>
					<div class="col-md-3 mb-3">
						<label class="form-label-aw">Female Min Value</label>
						<input type="number" step="any" class="form-control-aw" name="female_min" id="edit-report-test-female-min" autocomplete="off">
					</div>
					<div class="col-md-3 mb-3">
						<label class="form-label-aw">Female Max Value</label>
						<input type="number" step="any" class="form-control-aw" name="female_max" id="edit-report-test-female-max" autocomplete="off">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3 mb-3">
						<label class="form-label-aw">Critical Low (Panic)</label>
						<input type="number" step="any" class="form-control-aw" name="critical_low" id="edit-report-test-critical-low" autocomplete="off">
					</div>
					<div class="col-md-3 mb-3">
						<label class="form-label-aw">Critical High (Panic)</label>
						<input type="number" step="any" class="form-control-aw" name="critical_high" id="edit-report-test-critical-high" autocomplete="off">
					</div>
					<div class="col-md-3 mb-3">
						<label class="form-label-aw">Male Ref. Text</label>
						<input type="text" class="form-control-aw" name="male_reference" id="edit-report-test-male-ref" autocomplete="off">
					</div>
					<div class="col-md-3 mb-3">
						<label class="form-label-aw">Female Ref. Text</label>
						<input type="text" class="form-control-aw" name="female_reference" id="edit-report-test-female-ref" autocomplete="off">
					</div>
				</div>
                <input type="hidden" name="test_id" id="edit-report-test-id">
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-update-report-test">Update Parameter</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Add Unit Modal -->
  <div class="modal fade modal-aw" id="modal-add-report-unit" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-balance-scale me-2"></i>Add New Unit</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-add-report-unit">
				@csrf
				<div class="form-group">
					<label for="field_1141"  class="form-label-aw">Unit Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control-aw" name="name" required placeholder="e.g. mg/dL" autocomplete="off" id="field_1141">
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-save-report-unit">Save Unit</button>
		  </div>
		</div>
	  </div>
  </div>

  </div>

  <!-- Edit Unit Modal -->
  <div class="modal fade modal-aw" id="modal-edit-report-unit" tabindex="-1" style="z-index: 1070;" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"><i class="fa fa-balance-scale me-2"></i>Edit Unit</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<form id="form-edit-report-unit">
				@csrf
				<input type="hidden" id="edit-report-unit-id" name="name_1142">
				<div class="form-group">
					<label for="edit-report-unit-name" class="form-label-aw">Unit Name <span class="text-danger">*</span></label>
					<input type="text" class="form-control-aw" name="name" id="edit-report-unit-name" required placeholder="e.g. mg/dL" autocomplete="off">
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn-aw-primary" id="btn-update-report-unit">Update Unit</button>
		  </div>
		</div>
	  </div>
  </div>

  <!-- Generic Detail View Modal -->
  <div class="modal fade modal-aw" id="modal-view-detail" tabindex="-1" style="z-index: 1080;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="view-detail-title"><i class="fa fa-info-circle me-2"></i>Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="view-detail-body">
                  <!-- Dynamically populated -->
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-sm" id="btn-detail-delete" style="display:none;"><i class="fa fa-trash me-1"></i>Delete</button>
                  <button type="button" class="btn btn-primary btn-sm" id="btn-detail-edit" style="display:none;"><i class="fa fa-edit me-1"></i>Edit</button>
                  <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>

  <!-- Action Password Verification Modal -->
  <div class="modal fade modal-aw" id="modal-action-password" tabindex="-1" aria-hidden="true" style="z-index: 1090;">
      <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title"><i class="fa fa-lock me-2"></i>Authorization Required</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <label for="action-password-input" class="form-label-aw">Enter Admin Password to Proceed</label>
                  <input type="password" id="action-password-input" class="form-control-aw" placeholder="Enter password..." autocomplete="off">
                  <div id="action-password-error" class="mt-2" style="display:none; color:#dc2626; font-size:13px;">
                      <i class="fa fa-circle-exclamation me-1"></i>Incorrect password. Please try again.
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn-aw-primary" id="btn-verify-action-password">
                      <i class="fa fa-unlock"></i> Verify
                  </button>
              </div>
          </div>
      </div>
  </div>

  @push('scripts')
  <script>
      $(document).ready(function() {
          function setupDetailModalButtons(id, type, name = '') {
              $('#btn-detail-edit').data('id', id).data('type', type).data('name', name).show();
              $('#btn-detail-delete').data('id', id).data('type', type).data('name', name).show();
          }

          $(document).on('click', '.btn-add-report-patient', function() {
              Swal.fire({
                  title: 'Navigate to Patients?',
                  html: 'Adding a new patient requires you to go to the Patients page.<br><strong>Make sure to save your work first.</strong>',
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonText: '<i class="fa fa-external-link-alt"></i> Open Patients Page',
                  cancelButtonText: 'Cancel',
                  confirmButtonColor: '#0284c7',
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.open("/patients", "_blank");
                  }
              });
          });

          $(document).on('click', '.btn-edit-report-patient', function() {
              let select = $(this).siblings('select');
              let patientId = select.val();
              if (!patientId) { showToast('Please select a patient first.', 'error'); return; }
              window.open("/patients?edit=" + patientId, "_blank");
          });

          $(document).on('click', '.btn-delete-report-patient', function() {
              let select = $(this).siblings('select');
              let id = select.val();
              if (!id) { showToast('Please select a patient first.', 'error'); return; }
              $('#btn-detail-delete').data('id', id).data('type', 'patient').click();
          });

          $(document).on('click', '.btn-view-report-patient', function() {
              let select = $(this).siblings('select');
              let patientId = select.val();
              if (!patientId) { showToast('Please select a patient first.', 'error'); return; }
              
              $('#btn-detail-edit').hide();
              $('#btn-detail-delete').hide();
              
              $('#view-detail-title').html('<i class="fa fa-user me-2"></i>Patient Details');
              $('#view-detail-body').html('<div class="text-center py-3"><i class="fa fa-spinner fa-spin fa-2x text-primary"></i></div>');
              $('#modal-view-detail').modal('show');
              
              $.get("/patients/" + patientId, function(data) {
                  let html = `
                      <div class="table-responsive-modern">
                          <table class="table table-bordered table-striped mb-0">
                              <tr><th width="35%">Patient ID</th><td><strong class="text-primary">${data.patient_id || ''}</strong></td></tr>
                              <tr><th>First Name</th><td>${data.first_name || ''}</td></tr>
                              <tr><th>Last Name</th><td>${data.last_name || ''}</td></tr>
                              <tr><th>Gender</th><td><span class="badge bg-secondary">${data.gender || ''}</span></td></tr>
                              <tr><th>Age</th><td>${data.age || ''} ${data.age_type || 'Years'}</td></tr>
                              <tr><th>Phone</th><td>${data.phone || 'N/A'}</td></tr>
                              <tr><th>Email</th><td>${data.email || 'N/A'}</td></tr>
                              <tr><th>Reference Doctor</th><td>${data.reference_dr || 'Self'}</td></tr>
                              <tr><th>Status</th><td><span class="badge bg-success">${data.status || 'Active'}</span></td></tr>
                              <tr><th>Address</th><td>${data.address || 'N/A'}</td></tr>
                          </table>
                      </div>
                  `;
                  $('#view-detail-body').html(html);
                  setupDetailModalButtons(patientId, 'patient');
              }).fail(function() {
                  $('#view-detail-body').html('<div class="alert alert-danger">Failed to load patient details.</div>');
              });
          });

          $(document).on('click', '.btn-view-report-doctor', function() {
              let select = $(this).siblings('select');
              let selectedOption = select.find('option:selected');
              let doctorName = selectedOption.val();
              if (!doctorName) { showToast('Please select a doctor first.', 'error'); return; }
              
              $('#btn-detail-edit').hide();
              $('#btn-detail-delete').hide();
              
              $('#view-detail-title').html('<i class="fa fa-user-md me-2"></i>Doctor Details');
              
              let qualification = selectedOption.attr('data-qualification') || 'N/A';
              let phone = selectedOption.attr('data-phone') || 'N/A';
              let email = selectedOption.attr('data-email') || 'N/A';
              let doctorId = selectedOption.attr('data-id');
              
              let html = `
                  <div class="table-responsive-modern">
                      <table class="table table-bordered table-striped mb-0">
                          <tr><th width="35%">Doctor Name</th><td><strong class="text-primary">${doctorName}</strong></td></tr>
                          <tr><th>Qualification</th><td>${qualification}</td></tr>
                          <tr><th>Phone</th><td>${phone}</td></tr>
                          <tr><th>Email</th><td>${email}</td></tr>
                      </table>
                  </div>
              `;
              $('#view-detail-body').html(html);
              if (doctorId && doctorName !== 'Self') {
                  setupDetailModalButtons(doctorId, 'doctor');
              }
              $('#modal-view-detail').modal('show');
          });

          $(document).on('click', '.btn-view-report-signature', function() {
              let select = $(this).siblings('select');
              let selectedOption = select.find('option:selected');
              let signatureId = selectedOption.val();
              if (!signatureId) { showToast('Please select a signature first.', 'error'); return; }
              
              $('#btn-detail-edit').hide();
              $('#btn-detail-delete').hide();
              
              $('#view-detail-title').html('<i class="fa fa-signature me-2"></i>Signature Details');
              
              let name = selectedOption.attr('data-name');
              let imageUrl = selectedOption.attr('data-image');
              
              let html = `
                  <div class="table-responsive-modern">
                      <table class="table table-bordered table-striped mb-0">
                          <tr><th width="35%">Name</th><td><strong class="text-primary">${name}</strong></td></tr>
                          <tr>
                              <th>Signature Image</th>
                              <td>
                                  <div class="text-center bg-light p-3 rounded border">
                                      <img src="${imageUrl}" alt="Signature Image" style="max-height: 100px; max-width: 100%; object-fit: contain;">
                                  </div>
                              </td>
                          </tr>
                      </table>
                  </div>
              `;
              $('#view-detail-body').html(html);
              if (signatureId) {
                  setupDetailModalButtons(signatureId, 'signature');
              }
              $('#modal-view-detail').modal('show');
          });





          // Handle Dynamic Row View/Delete Buttons
          $(document).on('click', '.btn-delete-report-category', function() { handleDeleteClick($(this), 'category', 'category'); });
          $(document).on('click', '.btn-delete-report-subcategory', function() { handleDeleteClick($(this), 'sub-category', 'subcategory'); });
          $(document).on('click', '.btn-delete-report-test', function() { handleDeleteClick($(this), 'parameter', 'test'); });
          $(document).on('click', '.btn-delete-observed', function() { handleDeleteClick($(this), 'observed value', 'observed'); });
          $(document).on('click', '.btn-delete-report-unit', function() { handleDeleteClick($(this), 'unit', 'unit'); });
          $(document).on('click', '.btn-delete-reference', function() { handleDeleteClick($(this), 'reference template', 'reference'); });
          $(document).on('click', '.btn-delete-flag', function() { handleDeleteClick($(this), 'flag', 'flag'); });

          function handleDeleteClick(btn, label, type) {
              let select = btn.siblings('select');
              let selectedOption = select.find('option:selected');
              let id = selectedOption.attr('data-id');
              let val = select.val();
              let name = selectedOption.text() || val || '';
              
              if (!val) { showToast('Please select a ' + label + ' first.', 'error'); return; }
              if (!id) { showToast('This is a custom/auto-filled ' + label + ' — not saved as a template. Select a saved template from the dropdown.', 'error'); return; }
              
              $('#btn-detail-delete').data('id', id).data('type', type).data('name', name).click();
          }

          $(document).on('click', '.btn-view-report-category', function() { handleViewClick($(this), 'category', 'Category', 'fa-folder'); });
          $(document).on('click', '.btn-view-report-subcategory', function() { handleViewClick($(this), 'subcategory', 'Sub-Category', 'fa-folder-open'); });
          $(document).on('click', '.btn-view-report-test', function() {
              let select = $(this).siblings('select');
              let selectedOption = select.find('option:selected');
              let id = selectedOption.attr('data-id');
              let name = selectedOption.val() || selectedOption.text();
              if (!id) { showToast('Please select a parameter first.', 'error'); return; }
              
              $('#btn-detail-edit').hide();
              $('#btn-detail-delete').hide();
              $('#view-detail-title').html('<i class="fa fa-flask me-2"></i>Parameter Details');
              
              let bioRef = selectedOption.attr('data-bio-ref') || '';
              let html = `
                  <div class="table-responsive-modern">
                      <table class="table table-bordered table-striped mb-0">
                          <tr><th width="35%">Test Name</th><td><strong class="text-primary">${name}</strong></td></tr>
                          <tr><th>Price</th><td>${selectedOption.attr('data-price') || '<span class="text-muted">—</span>'}</td></tr>
                          <tr><th>Unit</th><td>${selectedOption.attr('data-unit') || '<span class="text-muted">—</span>'}</td></tr>
                          <tr><th>Male Ref.</th><td>${selectedOption.attr('data-male-ref') || '<span class="text-muted">—</span>'}</td></tr>
                          <tr><th>Female Ref.</th><td>${selectedOption.attr('data-female-ref') || '<span class="text-muted">—</span>'}</td></tr>
                          <tr><th>Critical Low</th><td>${selectedOption.attr('data-critical-low') || '<span class="text-muted">—</span>'}</td></tr>
                          <tr><th>Critical High</th><td>${selectedOption.attr('data-critical-high') || '<span class="text-muted">—</span>'}</td></tr>
                          <tr><th>Biological Reference</th><td>${bioRef ? bioRef : '<span class="text-muted">—</span>'}</td></tr>
                      </table>
                  </div>
              `;
              $('#view-detail-body').html(html);
              setupDetailModalButtons(id, 'test', name);
              $('#modal-view-detail').modal('show');
          });
          $(document).on('click', '.btn-view-observed', function() { handleViewClick($(this), 'observed', 'Observed Value', 'fa-eye'); });
          $(document).on('click', '.btn-view-report-unit', function() { handleViewClick($(this), 'unit', 'Unit', 'fa-balance-scale'); });
          $(document).on('click', '.btn-view-reference', function() { handleViewClick($(this), 'reference', 'Reference Template', 'fa-book'); });
          $(document).on('click', '.btn-view-flag', function() { handleViewClick($(this), 'flag', 'Flag', 'fa-flag'); });

          function handleViewClick(btn, type, label, icon) {
              let select = btn.siblings('select');
              let selectedOption = select.find('option:selected');
              let id = selectedOption.attr('data-id');
              let name = select.val() || selectedOption.text();
              
              if (!select.val()) { showToast('Please select a ' + label + ' first.', 'error'); return; }
              if (!id) { showToast('This is a custom/auto-filled ' + label + ' — not saved as a template. Click "+" to save it first.', 'error'); return; }
              
              $('#btn-detail-edit').hide();
              $('#btn-detail-delete').hide();
              $('#view-detail-title').html('<i class="fa ' + icon + ' me-2"></i>' + label + ' Details');
              
              let html = `
                  <div class="table-responsive-modern">
                      <table class="table table-bordered table-striped mb-0">
                          <tr><th width="35%">${label} Name</th><td><strong class="text-primary">${name}</strong></td></tr>
              `;

              if (type === 'category') {
                  let desc = select.find('option:selected').attr('data-desc');
                  html += `<tr><th>Description</th><td>${desc ? desc : '<span class="text-muted">—</span>'}</td></tr>`;
              } else if (type === 'subcategory') {
                  let catId = select.find('option:selected').attr('data-category_id');
                  let catName = '<span class="text-muted">—</span>';
                  if (catId) {
                      let catOpt = $('.report-category-select option[data-id="' + catId + '"]').first();
                      if (catOpt.length) {
                          catName = catOpt.text();
                      } else {
                          catOpt = $('#add-report-sub-category-id option[value="' + catId + '"]').first();
                          if (catOpt.length) catName = catOpt.text();
                      }
                  }
                  let desc = select.find('option:selected').attr('data-desc');
                  html += `<tr><th>Parent Category</th><td><strong>${catName}</strong></td></tr>`;
                  html += `<tr><th>Description</th><td>${desc ? desc : '<span class="text-muted">—</span>'}</td></tr>`;
              }

              html += `
                      </table>
                  </div>
              `;
              $('#view-detail-body').html(html);
              setupDetailModalButtons(id, type, name);
              $('#modal-view-detail').modal('show');
          }


          // Handle dynamic edit inside detail view modal
          $(document).on('click', '#btn-detail-edit', function() {
              let id = $(this).data('id');
              let type = $(this).data('type');
              if (!id || !type) return;

              if (type === 'patient') {
                  window.location.href = "/patients?edit=" + id;
              } else if (type === 'signature') {
                  window.location.href = "/report-signatures";
              } else if (type === 'doctor') {
                  $('#modal-view-detail').modal('hide');
                  let select = $('.report-doctor-select');
                  let selectedOption = select.find(`option[data-id="${id}"]`);
                  $('#edit-report-doc-id').val(id);
                  $('#edit-report-doc-name').val(selectedOption.val() || selectedOption.text());
                  $('#edit-report-doc-qualification').val(selectedOption.attr('data-qualification'));
                  $('#edit-report-doc-phone').val(selectedOption.attr('data-phone'));
                  $('#edit-report-doc-email').val(selectedOption.attr('data-email'));
                  $('#modal-edit-report-doctor').modal('show');
              } else if (type === 'category') {
                  $('#modal-view-detail').modal('hide');
                  let select = $('.report-category-select');
                  let selectedOption = select.find(`option[data-id="${id}"]`);
                  $('#edit-report-cat-id').val(id);
                  $('#edit-report-cat-name').val(selectedOption.val() || selectedOption.text());
                  $('#modal-edit-report-category').modal('show');
              } else if (type === 'subcategory') {
                  $('#modal-view-detail').modal('hide');
                  let select = $('.report-subcategory-select');
                  let selectedOption = select.find(`option[data-id="${id}"]`);
                  let catId = selectedOption.attr('data-category_id') || '';
                  window._pendingEditSubCatId = catId;
                  $('#edit-report-sub-category-id').val(catId);
                  $('#edit-report-sub-id').val(id);
                  $('#edit-report-sub-name').val(selectedOption.val() || selectedOption.text());
                  $('#modal-edit-report-subcategory').modal('show');
              } else if (type === 'test') {
                  $('#modal-view-detail').modal('hide');
                  let select = $('.test-selector-dynamic');
                  let selectedOption = select.find(`option[data-id="${id}"]`);
                  $('#edit-report-test-id').val(id);
                  $('#edit-report-test-name').val(selectedOption.val() || selectedOption.text());
                  $('#edit-report-test-unit').val(selectedOption.attr('data-unit'));
                  $('#edit-report-test-bio').val(selectedOption.attr('data-bio-ref'));
                  $('#edit-report-test-immunoassay').val(selectedOption.attr('data-is-immunoassay') || '0');
                  
                  // Reference Ranges & Panic Values
                  $('#edit-report-test-male-min').val(selectedOption.attr('data-male-min') || '');
                  $('#edit-report-test-male-max').val(selectedOption.attr('data-male-max') || '');
                  $('#edit-report-test-female-min').val(selectedOption.attr('data-female-min') || '');
                  $('#edit-report-test-female-max').val(selectedOption.attr('data-female-max') || '');
                  $('#edit-report-test-critical-low').val(selectedOption.attr('data-critical-low') || '');
                  $('#edit-report-test-critical-high').val(selectedOption.attr('data-critical-high') || '');
                  $('#edit-report-test-male-ref').val(selectedOption.attr('data-male-ref') || '');
                  $('#edit-report-test-female-ref').val(selectedOption.attr('data-female-ref') || '');
                  
                  $('#modal-edit-report-test').modal('show');
              } else if (type === 'observed') {
                  $('#modal-view-detail').modal('hide');
                  let select = $('.report-observed-select');
                  let selectedOption = select.find(`option[data-id="${id}"]`);
                  $('#edit-report-observed-id').val(id);
                  $('#edit-report-observed-name').val(selectedOption.val() || selectedOption.text());
                  $('#modal-edit-report-observed').modal('show');
              } else if (type === 'unit') {
                  $('#modal-view-detail').modal('hide');
                  let select = $('.report-unit-select');
                  let selectedOption = select.find(`option[data-id="${id}"]`);
                  $('#edit-report-unit-id').val(id);
                  $('#edit-report-unit-name').val(selectedOption.val() || selectedOption.text());
                  $('#modal-edit-report-unit').modal('show');
              } else if (type === 'reference') {
                  $('#modal-view-detail').modal('hide');
                  let select = $('.normal-val-dynamic');
                  let selectedOption = select.find(`option[data-id="${id}"]`);
                  $('#edit-report-reference-id').val(id);
                  $('#edit-report-reference-name').val(selectedOption.val() || selectedOption.text());
                  $('#modal-edit-report-reference').modal('show');
              } else if (type === 'flag') {
                  $('#modal-view-detail').modal('hide');
                  let select = $('.flag-selector');
                  let selectedOption = select.find(`option[data-id="${id}"]`);
                  $('#edit-report-flag-id').val(id);
                  $('#edit-report-flag-name').val(selectedOption.val() || selectedOption.text());
                  $('#modal-edit-report-flag').modal('show');
              }
          });

           // Handle dynamic delete inside detail view modal
           $(document).on('click', '#btn-detail-delete', function() {
               let id = $(this).data('id');
               let type = $(this).data('type');
               let name = $(this).data('name') || '';
               if (!id || !type) return;

               let title = name ? `Delete ${type.charAt(0).toUpperCase() + type.slice(1)} "${name}"?` : `Delete ${type.charAt(0).toUpperCase() + type.slice(1)}?`;
               let text = name ? `Are you sure you want to delete ${type} "${name}"? This action cannot be undone.` : `Are you sure you want to delete this ${type}? This action cannot be undone.`;

               confirmDelete({
                   title: title,
                   text: text
               }, function() {
                   let deleteUrl = '';
                   if (type === 'patient') deleteUrl = "/patients/" + id;
                   else if (type === 'doctor') deleteUrl = "/doctors/" + id;
                   else if (type === 'signature') deleteUrl = "/report-signatures/" + id;
                   else if (type === 'category') deleteUrl = "/categories/" + id;
                   else if (type === 'subcategory') deleteUrl = "/sub-categories/" + id;
                   else if (type === 'test') deleteUrl = "/lab-tests/" + id;
                   else if (type === 'observed') deleteUrl = "/result-templates/" + id;
                   else if (type === 'unit') deleteUrl = "/units/" + id;
                   else if (type === 'reference') deleteUrl = "/reference-templates/" + id;
                   else if (type === 'flag') deleteUrl = "/flag-templates/" + id;

                   if (deleteUrl) {
                       $.ajax({
                           url: deleteUrl,
                           type: 'DELETE',
                           success: function(response) {
                               showToast(response.success || 'Item deleted successfully!', 'success');
                               $('#modal-view-detail').modal('hide');
                               if (type === 'reference') {
                                   fetchReportReferences();
                               } else if (type === 'observed') {
                                   fetchReportObserved();
                               } else if (type === 'flag') {
                                   fetchReportFlags();
                               } else {
                                   refreshReportsPageData();
                               }
                           },
                           error: function(xhr) {
                               showToast(xhr.responseJSON?.message || 'Failed to delete item', 'error');
                           }
                       });
                   }
               });
           });
      });
  </script>
  @endpush

@endsection





<!-- File Structure Optimized -->

