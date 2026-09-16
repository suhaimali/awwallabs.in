@extends('layouts.app')
@section('title', ' | Report Templates')
@section('page-title', 'Report Templates')
@section('content')

<div class="page-header-aw">
    <div class="page-title-aw">
        <div class="title-icon">
            <i class="fa fa-copy"></i>
        </div>
        <div>
            <div>Report Templates</div>
            <div style="font-size:13px;font-weight:400;color:var(--text-muted);margin-top:2px;">Manage test profiles and load pre-configured parameters instantly</div>
        </div>
    </div>
    <button type="button" class="btn-aw-primary" data-bs-toggle="modal" data-bs-target="#modal-add-template">
        <i class="fa fa-plus-circle"></i> Add New Template
    </button>
</div>

<style>
    .template-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        color: #0284c7;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.15);
    }

    .action-btn-group {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .btn-icon-circle {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        transition: all 0.2s ease;
        cursor: pointer;
        outline: none;
    }

    .btn-icon-circle:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .btn-icon-circle.view:hover {
        color: #0284c7;
        border-color: #bae6fd;
        background: #f0f9ff;
    }

    .btn-icon-circle.edit:hover {
        color: #0284c7;
        border-color: #bae6fd;
        background: #f0f9ff;
    }

    .btn-icon-circle.delete:hover {
        color: #ef4444;
        border-color: #fecaca;
        background: #fef2f2;
    }

    .template-name-cell {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 600;
        color: #1e293b;
        font-size: 15px;
    }

    .template-row-item {
        border-radius: 10px;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 16px;
        position: relative;
        margin-bottom: 12px;
        transition: all 0.2s;
    }

    .template-row-item:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.02);
    }

    .btn-remove-row {
        position: absolute;
        top: 10px;
        right: 15px;
        color: #ef4444;
        background: transparent;
        border: none;
        padding: 0;
        font-size: 18px;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s, transform 0.2s;
    }

    .btn-remove-row:hover {
        opacity: 1;
        transform: scale(1.15);
    }

    .form-group label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #64748b;
        margin-bottom: 6px;
        display: block;
    }

    .form-group-parameter label {
        color: #2563eb !important;
    }

    #templates-table thead {
        display: none !important;
    }
</style>

<!-- Global Datalists for flexible suggestions without forcing rigid select -->
<datalist id="common-units-list">
    @foreach($units as $u)
        @if($u->name)
            <option value="{{ $u->name }}"></option>
        @endif
    @endforeach
    <option value="g/dL"></option>
    <option value="mg/dL"></option>
    <option value="mil/ul"></option>
    <option value="cells/cu.mm"></option>
    <option value="%"></option>
    <option value="fl"></option>
    <option value="pg"></option>
    <option value="mm/hr"></option>
    <option value="mIU/mL"></option>
    <option value="U/L"></option>
    <option value="µg/dL"></option>
</datalist>

<datalist id="common-refs-list">
    @foreach($referenceTemplates as $r)
        @if($r->name && $r->name !== 'null')
            <option value="{{ $r->name }}"></option>
        @endif
    @endforeach
    <option value="Negative"></option>
    <option value="Positive"></option>
    <option value="Normal"></option>
    <option value="Non-Reactive"></option>
    <option value="Reactive"></option>
    <option value="< 1.000"></option>
</datalist>

<div class="aw-card mb-4">
    <div class="aw-card-header">
        <div class="aw-card-title"><i class="fa fa-copy" style="color:#2563eb;"></i> Saved Templates</div>
        <div style="position:relative;">
            <i class="fa fa-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:13px;"></i>
            <input type="text" id="template-search" style="border:1.5px solid var(--border-color);border-radius:9px;padding:8px 12px 8px 32px;font-size:13px;outline:none;width:220px;" placeholder="Search templates..." autocomplete="off">
        </div>
    </div>
    <div class="aw-card-body" style="padding:0;">
        <div class="table-responsive-modern">
            <table class="table table-modern" id="templates-table">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Template Name</th>
                        <th>Description</th>
                        <th>No of Parameters</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($templates as $i => $template)
                    <tr>
                        <td data-label="SL No">
                            <span class="badge-aw" style="background:#f1f5f9;color:#475569;font-family:monospace;font-size:12px;padding:6px 10px;border-radius:6px;border:1px solid #e2e8f0;">#{{ str_pad($i + 1, 3, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td data-label="Template Name">
                            <div class="template-name-cell">
                                <div class="template-card-icon">
                                    <i class="fa fa-paste"></i>
                                </div>
                                <span>{{ $template->name ?: 'Unnamed Template' }}</span>
                            </div>
                        </td>
                        <td data-label="Description" style="color:#64748b;font-size:13px;line-height:1.5;">
                            {{ ($template->description && strtolower($template->description) !== 'null') ? $template->description : '-' }}
                        </td>
                        <td data-label="No of Parameters">
                            <span class="badge-aw badge-blue">{{ $template->items ? $template->items->count() : 0 }} parameters</span>
                        </td>
                        <td data-label="Action" class="text-end">
                            <div class="action-btn-group">
                                <button class="btn-icon-circle view btn-view-details"
                                    data-id="{{ $template->id }}"
                                    data-bs-toggle="modal" data-bs-target="#modal-view-template"
                                    title="View Template Details"><i class="fa fa-eye"></i></button>
                                <button class="btn-icon-circle edit btn-edit-template"
                                    data-id="{{ $template->id }}"
                                    data-bs-toggle="modal" data-bs-target="#modal-edit-template"
                                    title="Edit"><i class="fa fa-pen"></i></button>
                                <button class="btn-icon-circle delete btn-delete-template"
                                    data-id="{{ $template->id }}"
                                    data-name="{{ $template->name }}"
                                    title="Delete"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Template Modal -->
<div class="modal fade modal-aw" id="modal-add-template" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #0369a1 0%, #0284c7 100%); color: white;">
                <h5 class="modal-title text-white"><i class="fa fa-copy me-2"></i>Create New Report Template</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-template">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="add-template-name" class="form-label-aw">Template Name *</label>
                                <input type="text" class="form-control-aw" id="add-template-name" name="name" placeholder="e.g. Complete Blood Count (CBC)" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="add-template-desc" class="form-label-aw">Description</label>
                                <input type="text" class="form-control-aw" id="add-template-desc" name="description" placeholder="e.g. Standard 12-parameter hemogram profile" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <h5 class="text-primary mb-0"><i class="fa fa-list-check me-2"></i>Configure Parameters</h5>
                        <button type="button" class="btn btn-sm btn-success" id="btn-add-param-row"><i class="fa fa-plus me-1"></i> Add Parameter Row</button>
                    </div>

                    <div id="add-params-container">
                        <!-- Dynamic Parameter Rows Go Here -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-aw-primary" id="btn-save-template"><i class="fa fa-check"></i> Save Template</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Template Modal -->
<div class="modal fade modal-aw" id="modal-edit-template" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #0369a1 0%, #0284c7 100%); color: white;">
                <h5 class="modal-title text-white"><i class="fa fa-edit me-2"></i>Edit Report Template</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-template">
                    @csrf
                    <input type="hidden" name="id" id="edit-template-id">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-template-name" class="form-label-aw">Template Name *</label>
                                <input type="text" class="form-control-aw" id="edit-template-name" name="name" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="edit-template-desc" class="form-label-aw">Description</label>
                                <input type="text" class="form-control-aw" id="edit-template-desc" name="description" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <h5 class="text-primary mb-0"><i class="fa fa-list-check me-2"></i>Configure Parameters</h5>
                        <button type="button" class="btn btn-sm btn-success" id="btn-edit-add-param-row"><i class="fa fa-plus me-1"></i> Add Parameter Row</button>
                    </div>

                    <div id="edit-params-container">
                        <!-- Dynamic Parameter Rows Go Here -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-aw-primary" id="btn-update-template"><i class="fa fa-check"></i> Update Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- View Template Details Modal -->
<div class="modal fade modal-aw" id="modal-view-template" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-paste text-primary me-2"></i>Template Structure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background: #f8fafc;">
                <div class="d-flex align-items-center gap-3 mb-4 p-3 bg-white border border-slate-100 rounded-xl" style="border: 1px solid #f1f5f9;">
                    <div class="template-card-icon" style="flex-shrink:0;">
                        <i class="fa fa-paste"></i>
                    </div>
                    <div>
                        <h4 id="view-template-name" class="mb-1" style="font-weight:700; color:#1e293b; font-size:18px;"></h4>
                        <p id="view-template-desc" class="mb-0 text-muted" style="font-size:13px;"></p>
                    </div>
                </div>

                <div class="table-responsive bg-white rounded-xl border border-slate-100" style="border: 1px solid #f1f5f9; overflow:hidden;">
                    <table class="table table-borderless align-middle mb-0" style="font-size:13px;">
                        <thead style="background:#f1f5f9; font-weight:700; color:#475569;">
                            <tr>
                                <th style="padding:12px 16px;">Test Parameter</th>
                                <th style="padding:12px 16px;">Category / Subcategory</th>
                                <th style="padding:12px 16px;">Default Unit</th>
                                <th style="padding:12px 16px;">Reference Range</th>
                                <th style="padding:12px 16px;">Biological Normal Range</th>
                            </tr>
                        </thead>
                        <tbody id="view-template-items-body">
                            <!-- Items populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal" style="border-radius:10px; font-weight:600; padding:10px;">Close Preview</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Lab tests library
    const labTests = @json($labTests);

    // Initial DataTable setup
    const templatesTable = $('#templates-table').DataTable({
        dom: "<'row mb-3'<'col-sm-12 col-md-6'l>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        ordering: false,
        language: {
            lengthMenu: "Show _MENU_ records",
            info: "Showing _START_ to _END_ of _TOTAL_ templates",
            infoEmpty: "Showing 0 to 0 of 0 templates",
            infoFiltered: "(filtered from _MAX_ total templates)",
            emptyTable: "No templates found.",
            paginate: {
                previous: "<i class='fa fa-angle-left'></i>",
                next: "<i class='fa fa-angle-right'></i>"
            }
        },
        headerCallback: function(thead) { /* header hidden via CSS */ }
    });

    $('#template-search').on('keyup', function() {
        templatesTable.search($(this).val()).draw();
    });

    // Helper to sanitize strings from literal "null" or undefined
    function cleanStr(val, fallback = '') {
        if (val === null || val === undefined) return fallback;
        let str = String(val).trim();
        if (str.toLowerCase() === 'null' || str.toLowerCase() === 'undefined') return fallback;
        return str;
    }

    // Escape HTML for safe insertion
    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // HTML Generator for dynamic rows
    function getParameterRowHtml(index, testItem = null) {
        let optionsHtml = '<option value="">-- Select Lab Test or type custom below --</option>';
        labTests.forEach(test => {
            let selected = (testItem && testItem.lab_test_id && testItem.lab_test_id == test.id) ? 'selected' : '';
            let maleRef = test.parameter ? cleanStr(test.parameter.male_reference) : '';
            let femaleRef = test.parameter ? cleanStr(test.parameter.female_reference) : '';
            let unit = test.parameter ? cleanStr(test.parameter.unit) : '';
            let normalRange = test.parameter ? cleanStr(test.parameter.biological_reference) : '';

            optionsHtml += `<option value="${escapeHtml(test.name)}" data-id="${test.id}" data-unit="${escapeHtml(unit)}" data-male-ref="${escapeHtml(maleRef)}" data-female-ref="${escapeHtml(femaleRef)}" data-normal="${escapeHtml(normalRange)}" ${selected}>${escapeHtml(test.name)}</option>`;
        });

        let testNameVal = escapeHtml(cleanStr(testItem ? testItem.name : ''));
        let categoryVal = escapeHtml(cleanStr(testItem ? testItem.category : 'General', 'General'));
        let subcategoryVal = escapeHtml(cleanStr(testItem ? testItem.subcategory : ''));
        let unitVal = escapeHtml(cleanStr(testItem ? testItem.unit : ''));
        let refValueVal = escapeHtml(cleanStr(testItem ? testItem.normal_value : ''));
        let normalRangeVal = escapeHtml(cleanStr(testItem ? testItem.biological_reference : ''));
        let labTestIdVal = escapeHtml(cleanStr(testItem ? testItem.lab_test_id : ''));

        return `
        <div class="template-row-item shadow-sm" data-row-idx="${index}">
            <button type="button" class="btn-remove-row remove-param-row" title="Remove Parameter"><i class="fa fa-times-circle"></i></button>
            <input type="hidden" name="lab_test_id[]" class="row-lab-test-id" value="${labTestIdVal}">
            <div class="row g-3">
                <div class="col-md-4 form-group form-group-parameter">
                    <label>Auto-Fill From Lab Test</label>
                    <select class="form-select param-lookup-select" autocomplete="off">
                        ${optionsHtml}
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label>Display Parameter Name *</label>
                    <input type="text" name="test_name[]" class="form-control-aw row-test-name" value="${testNameVal}" placeholder="e.g. Hemoglobin" required autocomplete="off">
                </div>
                <div class="col-md-4 form-group">
                    <label>Category *</label>
                    <input type="text" name="test_category[]" class="form-control-aw row-category" value="${categoryVal}" placeholder="e.g. Hematology" required autocomplete="off">
                </div>
                <div class="col-md-4 form-group">
                    <label>Sub-Category</label>
                    <input type="text" name="test_subcategory[]" class="form-control-aw row-subcategory" value="${subcategoryVal}" placeholder="e.g. CBC Particulars" autocomplete="off">
                </div>
                <div class="col-md-4 form-group">
                    <label>Default Unit</label>
                    <input type="text" name="test_unit[]" list="common-units-list" class="form-control-aw row-unit" value="${unitVal}" placeholder="e.g. g/dL, %, fl" autocomplete="off">
                </div>
                <div class="col-md-4 form-group">
                    <label>Default Referral Range</label>
                    <input type="text" name="normal_value[]" list="common-refs-list" class="form-control-aw row-ref-value" value="${refValueVal}" placeholder="e.g. 13.5-18.0, Negative" autocomplete="off">
                </div>
                <div class="col-md-12 form-group">
                    <label>Default Biological Normal Range Description</label>
                    <input type="text" name="biological_reference[]" list="common-refs-list" class="form-control-aw row-biological" value="${normalRangeVal}" placeholder="e.g. Normal biological interval or reference range" autocomplete="off">
                </div>
            </div>
        </div>`;
    }

    // Auto-fill logic when selecting a lab test
    $(document).on('change', '.param-lookup-select', function() {
        let row = $(this).closest('.template-row-item');
        let selectedOption = $(this).find(':selected');
        
        let testName = selectedOption.val();
        if (!testName) return;

        let testId = selectedOption.data('id') || '';
        let unit = cleanStr(selectedOption.data('unit'));
        let normal = cleanStr(selectedOption.data('normal'));
        let maleRef = cleanStr(selectedOption.data('male-ref'));
        let femaleRef = cleanStr(selectedOption.data('female-ref'));
        
        // Find best reference range text
        let refRange = maleRef;
        if (femaleRef && maleRef && maleRef !== femaleRef) {
            refRange = `M: ${maleRef}, F: ${femaleRef}`;
        } else if (femaleRef) {
            refRange = femaleRef;
        }

        row.find('.row-lab-test-id').val(testId);
        row.find('.row-test-name').val(testName);
        if (unit) row.find('.row-unit').val(unit);
        if (refRange) row.find('.row-ref-value').val(refRange);
        if (normal || refRange) row.find('.row-biological').val(normal || refRange);
    });

    // Add row in create template
    let addIndex = 0;
    $('#btn-add-param-row').click(function() {
        $('#add-params-container').append(getParameterRowHtml(addIndex++));
    });

    // Auto-add initial row on modal open if empty
    $('#modal-add-template').on('show.bs.modal', function() {
        if ($('#add-params-container .template-row-item').length === 0) {
            $('#add-params-container').append(getParameterRowHtml(addIndex++));
        }
    });

    // Remove row
    $(document).on('click', '.remove-param-row', function() {
        $(this).closest('.template-row-item').remove();
    });

    // Save Template
    $('#btn-save-template').click(function() {
        let btn = $(this);
        if (btn.prop('disabled')) return;

        let name = cleanStr($('#add-template-name').val());
        if (!name) {
            showToast('Template Name is required.', 'error');
            $('#add-template-name').focus();
            return;
        }

        if ($('#add-params-container .template-row-item').length === 0) {
            showToast('Please add at least one parameter row to the template.', 'error');
            return;
        }

        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-2"></i> Saving Template...');
        let formData = $('#form-add-template').serialize();

        $.post("{{ route('templates.store') }}", formData, function(response) {
            showToast(response.success || 'Template saved successfully!', 'success');
            setTimeout(() => location.reload(), 600);
        }).fail(function(xhr) {
            let msg = 'Error saving template.';
            if (xhr.responseJSON) {
                if (xhr.responseJSON.errors) {
                    msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                } else if (xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
            }
            showToast(msg, 'error');
            btn.prop('disabled', false).html('<i class="fa fa-check"></i> Save Template');
        });
    });

    // View Template Details Preview
    $(document).on('click', '.btn-view-details', function() {
        let id = $(this).data('id');
        $('#view-template-name').text('Loading...');
        $('#view-template-desc').text('');
        $('#view-template-items-body').html('<tr><td colspan="5" class="text-center py-4"><i class="fa fa-spinner fa-spin me-2"></i>Loading details...</td></tr>');

        $.get("/templates/" + id, function(template) {
            $('#view-template-name').text(cleanStr(template.name, 'Unnamed Template'));
            $('#view-template-desc').text(cleanStr(template.description, 'No description provided'));
            
            let tbodyHtml = '';
            if (template.items && template.items.length > 0) {
                template.items.forEach(item => {
                    let itemName = cleanStr(item.name, '-');
                    let itemCat = cleanStr(item.category, 'General');
                    let itemSub = cleanStr(item.subcategory);
                    let itemUnit = cleanStr(item.unit, '-');
                    let itemNormal = cleanStr(item.normal_value, '-');
                    let itemBio = cleanStr(item.biological_reference, '-');

                    tbodyHtml += `
                    <tr>
                        <td style="padding:12px 16px; font-weight:600; color:#1e293b;">${escapeHtml(itemName)}</td>
                        <td style="padding:12px 16px;"><span class="badge bg-light text-dark border">${escapeHtml(itemCat)}</span> ${itemSub ? `<span class="badge bg-light text-muted border">${escapeHtml(itemSub)}</span>` : ''}</td>
                        <td style="padding:12px 16px; color:#475569;">${escapeHtml(itemUnit)}</td>
                        <td style="padding:12px 16px; color:#475569;">${escapeHtml(itemNormal)}</td>
                        <td style="padding:12px 16px; color:#64748b;">${escapeHtml(itemBio)}</td>
                    </tr>`;
                });
            } else {
                tbodyHtml = '<tr><td colspan="5" class="text-center text-muted py-4">No parameters configured in this template.</td></tr>';
            }
            $('#view-template-items-body').html(tbodyHtml);
        }).fail(function() {
            $('#view-template-items-body').html('<tr><td colspan="5" class="text-center text-danger py-4">Failed to load template details.</td></tr>');
        });
    });

    // Edit Template (Load)
    let editIndex = 0;
    $(document).on('click', '.btn-edit-template', function() {
        let id = $(this).data('id');
        $('#edit-params-container').html('<div class="text-center py-4"><i class="fa fa-spinner fa-spin me-2"></i>Loading template items...</div>');
        
        $.get("/templates/" + id, function(template) {
            $('#edit-template-id').val(template.id);
            $('#edit-template-name').val(cleanStr(template.name));
            $('#edit-template-desc').val(cleanStr(template.description));
            
            $('#edit-params-container').empty();
            editIndex = 0;
            if (template.items && template.items.length > 0) {
                template.items.forEach(item => {
                    $('#edit-params-container').append(getParameterRowHtml(editIndex++, item));
                });
            } else {
                $('#edit-params-container').append(getParameterRowHtml(editIndex++));
            }
        }).fail(function() {
            showToast('Failed to load template data.', 'error');
        });
    });

    // Add row in edit template
    $('#btn-edit-add-param-row').click(function() {
        $('#edit-params-container').append(getParameterRowHtml(editIndex++));
    });

    // Update Template Changes
    $('#btn-update-template').click(function() {
        let btn = $(this);
        if (btn.prop('disabled')) return;

        let id = $('#edit-template-id').val();
        let name = cleanStr($('#edit-template-name').val());
        if (!name) {
            showToast('Template Name is required.', 'error');
            $('#edit-template-name').focus();
            return;
        }

        if ($('#edit-params-container .template-row-item').length === 0) {
            showToast('Please add at least one parameter row to the template.', 'error');
            return;
        }

        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-2"></i> Updating Template...');
        let formData = $('#form-edit-template').serialize();

        $.ajax({
            url: "/templates/" + id,
            type: 'PUT',
            data: formData,
            success: function(response) {
                showToast(response.success || 'Template updated successfully!', 'success');
                setTimeout(() => location.reload(), 600);
            },
            error: function(xhr) {
                let msg = 'Failed to update template.';
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    } else if (xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                }
                showToast(msg, 'error');
                btn.prop('disabled', false).html('<i class="fa fa-check"></i> Update Changes');
            }
        });
    });

    // Delete Template
    $(document).on('click', '.btn-delete-template', function() {
        let id = $(this).data('id');
        let name = $(this).data('name') || 'this template';

        confirmDelete({
            title: 'Delete Template?',
            text: `Are you sure you want to delete template "${name}"? This action cannot be undone.`
        }, function() {
            $.ajax({
                url: "/templates/" + id,
                type: 'DELETE',
                success: function(response) {
                    showToast(response.success || 'Template deleted successfully', 'success');
                    setTimeout(() => location.reload(), 600);
                },
                error: function(xhr) {
                    showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Failed to delete template.", 'error');
                }
            });
        });
    });
});
</script>
@endpush

@endsection
