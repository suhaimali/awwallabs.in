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
        font-size: 16px;
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

    /* No table header */
    #templates-table thead {
        display: none !important;
    }
</style>

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
                                <span>{{ $template->name }}</span>
                            </div>
                        </td>
                        <td data-label="Description" style="color:#64748b;font-size:13px;line-height:1.5;">
                            {{ $template->description ?: '-' }}
                        </td>
                        <td data-label="No of Parameters">
                            <span class="badge-aw badge-blue">{{ $template->items->count() }} parameters</span>
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
                                <label for="add-template-name" class="form-label-aw">Template Name</label>
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
                                <label for="edit-template-name" class="form-label-aw">Template Name</label>
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
                                <th style="padding:12px 16px;">Normal Values</th>
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

    // ── EAGER TEST PARAMETERS JSON ──
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

    // HTML Generator for dynamic rows
    function getParameterRowHtml(index, testItem = null) {
        let optionsHtml = '<option value="">-- Custom Parameter --</option>';
        labTests.forEach(test => {
            let selected = (testItem && testItem.lab_test_id == test.id) ? 'selected' : '';
            // Auto fill data tags
            let maleRef = test.parameter ? (test.parameter.male_reference || '') : '';
            let femaleRef = test.parameter ? (test.parameter.female_reference || '') : '';
            let unit = test.parameter ? (test.parameter.unit || '') : '';
            let normalRange = test.parameter ? (test.parameter.biological_reference || '') : '';

            optionsHtml += `<option value="${test.name}" data-id="${test.id}" data-unit="${unit}" data-male-ref="${maleRef}" data-female-ref="${femaleRef}" data-normal="${normalRange}" ${selected}>${test.name}</option>`;
        });

        let testNameVal = testItem ? testItem.name : '';
        let categoryVal = testItem ? testItem.category : 'General';
        let subcategoryVal = testItem ? (testItem.subcategory || '') : '';
        let unitVal = testItem ? (testItem.unit || '') : '';
        let normalRangeVal = testItem ? (testItem.biological_reference || '') : '';
        let refValueVal = testItem ? (testItem.normal_value || '') : '';
        let labTestIdVal = testItem ? (testItem.lab_test_id || '') : '';

        return `
        <div class="template-row-item shadow-sm" data-row-idx="${index}">
            <button type="button" class="btn-remove-row remove-param-row" title="Remove Parameter"><i class="fa fa-times-circle"></i></button>
            <input type="hidden" name="lab_test_id[]" class="row-lab-test-id" value="${labTestIdVal}">
            <div class="row g-3">
                <div class="col-md-4 form-group form-group-parameter">
                    <label>Select Lab Test Parameter</label>
                    <select class="form-select param-lookup-select" autocomplete="off">
                        ${optionsHtml}
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label>Display Parameter Name</label>
                    <input type="text" name="test_name[]" class="form-control-aw row-test-name" value="${testNameVal}" placeholder="e.g. Hemoglobin" required autocomplete="off">
                </div>
                <div class="col-md-4 form-group">
                    <label>Category</label>
                    <input type="text" name="test_category[]" class="form-control-aw row-category" value="${categoryVal}" placeholder="e.g. Hematology" required autocomplete="off">
                </div>
                <div class="col-md-4 form-group">
                    <label>Sub-Category</label>
                    <input type="text" name="test_subcategory[]" class="form-control-aw row-subcategory" value="${subcategoryVal}" placeholder="e.g. CBC Particulars" autocomplete="off">
                </div>
                <div class="col-md-4 form-group">
                    <label>Default Unit</label>
                    <select name="test_unit[]" class="form-select row-unit" autocomplete="off">
                        <option value="">-- No Unit --</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->name }}" ${testItem && testItem.unit == "{{ $unit->name }}" ? 'selected' : ''}>{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label>Default Referral Range</label>
                    <select name="normal_value[]" class="form-select row-ref-value" autocomplete="off">
                        <option value="">-- No Range --</option>
                        @foreach($referenceTemplates as $ref)
                            <option value="{{ $ref->name }}" ${testItem && testItem.normal_value == "{{ $ref->name }}" ? 'selected' : ''}>{{ $ref->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 form-group">
                    <label>Default Biological Normal Range Description</label>
                    <select name="biological_reference[]" class="form-select row-biological" autocomplete="off">
                        <option value="">-- No Normal Range --</option>
                        @foreach($referenceTemplates as $ref)
                            <option value="{{ $ref->name }}" ${testItem && testItem.biological_reference == "{{ $ref->name }}" ? 'selected' : ''}>{{ $ref->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>`;
    }

    // Auto-fill logic when selecting a lab test
    $(document).on('change', '.param-lookup-select', function() {
        let row = $(this).closest('.template-row-item');
        let selectedOption = $(this).find(':selected');
        
        let testName = selectedOption.val();
        let testId = selectedOption.data('id') || '';
        let unit = selectedOption.data('unit') || '';
        let normal = selectedOption.data('normal') || '';
        let maleRef = selectedOption.data('male-ref') || '';
        let femaleRef = selectedOption.data('female-ref') || '';
        
        // Find best reference range text
        let refRange = maleRef;
        if (femaleRef && maleRef !== femaleRef) {
            refRange = `M: ${maleRef}, F: ${femaleRef}`;
        } else if (femaleRef) {
            refRange = femaleRef;
        }

        row.find('.row-lab-test-id').val(testId);
        row.find('.row-test-name').val(testName);
        row.find('.row-unit').val(unit);
        row.find('.row-ref-value').val(refRange);
        row.find('.row-biological').val(normal || refRange);
        
        // Dynamic category/subcategory auto-fill from parameters matching
        if (testId) {
            let matchedTest = labTests.find(t => t.id == testId);
            if (matchedTest) {
                // Determine category based on name or description or look up existing parameters
                // Let's keep it editable but helpful
            }
        }
    });

    // Add row in create template
    let addIndex = 0;
    $('#btn-add-param-row').click(function() {
        $('#add-params-container').append(getParameterRowHtml(addIndex++));
    });

    // Remove row
    $(document).on('click', '.remove-param-row', function() {
        $(this).closest('.template-row-item').remove();
    });

    // Save Template
    $('#btn-save-template').click(function() {
        let btn = $(this);
        if (btn.prop('disabled')) return;

        let name = $('#add-template-name').val().trim();
        if (!name) {
            showToast('Template Name is required.', 'error');
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
            showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error saving template.', 'error');
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
            $('#view-template-name').text(template.name);
            $('#view-template-desc').text(template.description || 'No description provided');
            
            let tbodyHtml = '';
            if (template.items && template.items.length > 0) {
                template.items.forEach(item => {
                    tbodyHtml += `
                    <tr>
                        <td style="padding:12px 16px; font-weight:600; color:#1e293b;">${item.name}</td>
                        <td style="padding:12px 16px;"><span class="badge bg-light text-dark border">${item.category}</span> ${item.subcategory ? `<span class="badge bg-light text-muted border">${item.subcategory}</span>` : ''}</td>
                        <td style="padding:12px 16px; color:#475569;">${item.unit || '-'}</td>
                        <td style="padding:12px 16px; color:#475569;">${item.normal_value || '-'}</td>
                        <td style="padding:12px 16px; color:#64748b;">${item.biological_reference || '-'}</td>
                    </tr>`;
                });
            } else {
                tbodyHtml = '<tr><td colspan="5" class="text-center text-muted py-4">No parameters configured in this template.</td></tr>';
            }
            $('#view-template-items-body').html(tbodyHtml);
        });
    });

    // Edit Template (Load)
    let editIndex = 0;
    $(document).on('click', '.btn-edit-template', function() {
        let id = $(this).data('id');
        $('#edit-params-container').html('<div class="text-center py-4"><i class="fa fa-spinner fa-spin me-2"></i>Loading template items...</div>');
        
        $.get("/templates/" + id, function(template) {
            $('#edit-template-id').val(template.id);
            $('#edit-template-name').val(template.name);
            $('#edit-template-desc').val(template.description);
            
            $('#edit-params-container').empty();
            editIndex = 0;
            if (template.items && template.items.length > 0) {
                template.items.forEach(item => {
                    $('#edit-params-container').append(getParameterRowHtml(editIndex++, item));
                });
            } else {
                $('#edit-params-container').append('<p class="text-muted text-center py-3">No parameters. Click "Add Parameter Row" to add.</p>');
            }
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
        let name = $('#edit-template-name').val().trim();
        if (!name) {
            showToast('Template Name is required.', 'error');
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
                showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Failed to update template.', 'error');
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
