@extends('layouts.app')
@section('title', ' | Master Data Management')
@section('page-title', 'Master Data Management')

@section('content')

<style>
/* ── Premium UI Styles for Master Data ── */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
    background-color: #f8fafc;
}

.md-page-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 30px;
}
.md-page-header .md-icon {
    width: 54px; height: 54px;
    border-radius: 16px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-accent) 100%);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 24px;
    flex-shrink: 0;
    box-shadow: 0 10px 15px -3px rgba(2, 132, 199, 0.3);
}
.md-page-header h1 {
    font-size: 24px; font-weight: 700;
    margin: 0 0 4px;
    color: #0f172a;
    letter-spacing: -0.5px;
}
.md-page-header p {
    font-size: 14px; color: #64748b;
    margin: 0;
}

/* Premium Cards */
.aw-card-premium {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #f1f5f9;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 10px 15px -3px rgba(0, 0, 0, 0.04);
    overflow: hidden;
    height: 100%;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.aw-card-premium:hover {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
}

.card-header-premium {
    padding: 20px 24px;
    border-bottom: 1px solid #f1f5f9;
    background: #ffffff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title-premium {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
}

.card-icon-wrap {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
}

/* Specific Colors */
.theme-blue .card-icon-wrap { background: #f0f9ff; color: #0284c7; }
.theme-blue .md-badge { background: #f0f9ff; color: #0284c7; }
.theme-blue .btn-add { background: #0284c7; color: white; }
.theme-blue .btn-add:hover { background: #0369a1; }
.theme-blue .table-header { background: #f8fafc; color: #475569; }

.theme-green .card-icon-wrap { background: #f0fdf4; color: #10b981; }
.theme-green .md-badge { background: #f0fdf4; color: #10b981; }
.theme-green .btn-add { background: #10b981; color: white; }
.theme-green .btn-add:hover { background: #059669; }
.theme-green .table-header { background: #f8fafc; color: #475569; }

.theme-purple .card-icon-wrap { background: #faf5ff; color: #a855f7; }
.theme-purple .md-badge { background: #faf5ff; color: #a855f7; }
.theme-purple .btn-add { background: #a855f7; color: white; }
.theme-purple .btn-add:hover { background: #9333ea; }
.theme-purple .table-header { background: #f8fafc; color: #475569; }

.theme-orange .card-icon-wrap { background: #fff7ed; color: #f97316; }
.theme-orange .md-badge { background: #fff7ed; color: #f97316; }
.theme-orange .btn-add { background: #f97316; color: white; }
.theme-orange .btn-add:hover { background: #ea580c; }
.theme-orange .table-header { background: #f8fafc; color: #475569; }

.md-badge {
    font-size: 12px; font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
}

/* Search Input */
.search-input-wrap {
    position: relative;
}
.search-input-wrap i {
    position: absolute;
    left: 14px; top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 13px;
}
.search-input-wrap input {
    width: 180px;
    padding: 8px 16px 8px 36px;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    font-size: 13px;
    color: #334155;
    transition: all 0.2s;
}
.search-input-wrap input:focus {
    outline: none;
    border-color: #cbd5e1;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(226, 232, 240, 0.5);
    width: 220px;
}

/* Add Form area */
.add-form-area {
    padding: 16px 24px;
    background: #ffffff;
    border-bottom: 1px solid #f1f5f9;
}
.input-group-premium {
    display: flex;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    transition: all 0.2s;
    box-shadow: 0 1px 2px rgba(0,0,0,0.01);
}
.input-group-premium:focus-within {
    border-color: #94a3b8;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
}
.input-group-premium input {
    border: none;
    padding: 12px 16px;
    flex-grow: 1;
    font-size: 14px;
    color: #334155;
    background: #ffffff;
    outline: none;
}
.input-group-premium input::placeholder {
    color: #94a3b8;
}
.input-group-premium button {
    border: none;
    padding: 0 20px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Tables */
.table-wrapper {
    max-height: 400px;
    overflow-y: auto;
    overflow-x: auto;
}
/* Custom Scrollbar */
.table-wrapper::-webkit-scrollbar { width: 6px; }
.table-wrapper::-webkit-scrollbar-track { background: #f8fafc; }
.table-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
.table-wrapper::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

.table-premium {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 0;
}
.table-premium th {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 14px 24px;
    position: sticky;
    top: 0;
    z-index: 10;
    background-color: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}
.table-premium td {
    padding: 12px 24px;
    font-size: 14px;
    color: #1e293b;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    white-space: nowrap;
}
.table-premium tr:last-child td {
    border-bottom: none;
}
.table-premium tbody tr {
    transition: background-color 0.2s;
}
.table-premium tbody tr:hover {
    background-color: #f8fafc;
}
.td-number {
    font-weight: 600;
    color: #94a3b8;
    font-size: 12px;
}

/* Soft Action Buttons */
.action-btns {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
}
.btn-icon-soft {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 13px;
}
.btn-edit-soft {
    background-color: #f1f5f9;
    color: #64748b;
}
.btn-edit-soft:hover {
    background-color: #e0e7ff;
    color: #4f46e5;
    transform: translateY(-2px);
}
.btn-delete-soft {
    background-color: #f1f5f9;
    color: #64748b;
}
.btn-delete-soft:hover {
    background-color: #fee2e2;
    color: #dc2626;
    transform: translateY(-2px);
}

.empty-state-row td {
    padding: 40px 20px !important;
}
.empty-state-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
}
.empty-state-box i {
    font-size: 32px;
    margin-bottom: 12px;
    color: #cbd5e1;
}
.empty-state-box span {
    font-size: 14px;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-header-premium {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }
    .search-input-wrap, .search-input-wrap input {
        width: 100%;
    }
    .search-input-wrap input:focus {
        width: 100%;
    }
    .add-form-area {
        padding: 12px 16px;
    }
    .input-group-premium button {
        padding: 0 12px;
    }
    .table-premium th, .table-premium td {
        padding: 10px 14px;
    }
}
@media (max-width: 480px) {
    .md-page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    .table-premium th, .table-premium td {
        padding: 8px 10px;
    }
}

/* DataTables UI Fixes & Neatness */
.dataTables_wrapper .dataTables_info {
    float: none !important;
    padding: 0 !important;
    margin: 0 !important;
    color: #64748b !important;
    font-size: 13px;
}
.dataTables_wrapper .dataTables_paginate {
    float: none !important;
    padding: 0 !important;
    margin: 0 !important;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
/* For default DataTables wrapper */
.dataTables_wrapper .dataTables_paginate span {
    display: flex;
    gap: 4px;
    margin: 0 4px;
}
/* The pagination buttons (handles both default DataTables and Bootstrap's page-item/page-link) */
.dataTables_wrapper .dataTables_paginate .paginate_button,
.dataTables_wrapper .dataTables_paginate .page-item .page-link {
    box-sizing: border-box;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    padding: 0 10px;
    margin: 0 !important;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    color: #475569 !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 8px !important;
    background: #ffffff !important;
    font-size: 13px;
    transition: all 0.2s;
    box-shadow: none !important;
}
/* Add gap for Bootstrap pagination ul */
.dataTables_wrapper .dataTables_paginate ul.pagination {
    display: flex;
    gap: 4px;
    margin: 0;
    padding: 0;
}
/* Remove background/border from Bootstrap's li to prevent double styling */
.dataTables_wrapper .dataTables_paginate .page-item {
    background: transparent !important;
    border: none !important;
    padding: 0 !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
    background: #0284c7 !important;
    color: #ffffff !important;
    border-color: #0284c7 !important;
    font-weight: 600;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled):not(.current),
.dataTables_wrapper .dataTables_paginate .page-item:not(.disabled):not(.active) .page-link:hover {
    background: #f1f5f9 !important;
    border-color: #cbd5e1 !important;
    color: #1e293b !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.dataTables_wrapper .dataTables_paginate .page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
    background: #f8fafc !important;
    color: #94a3b8 !important;
}
.dataTables_wrapper .dataTables_length label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #64748b;
    margin: 0;
}
.dataTables_wrapper .dataTables_length select {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 4px 8px;
    background-color: #ffffff;
    outline: none;
    cursor: pointer;
    font-size: 13px;
    color: #334155;
}
.dataTables_wrapper .dataTables_length select:focus {
    border-color: #94a3b8;
}

</style>

{{-- Page Header --}}
<div class="md-page-header">
    <div class="md-icon"><i class="fa fa-database"></i></div>
    <div>
        <h1>Master Data Management</h1>
        <p>Manage units, result templates, reference ranges &amp; flag templates</p>
    </div>
</div>

<div class="row g-4 mb-4">

    {{-- ① Laboratory Units --}}
    <div class="col-lg-6">
        <div class="aw-card-premium theme-blue">
            <div class="card-header-premium">
                <h3 class="card-title-premium">
                    <div class="card-icon-wrap"><i class="fa fa-flask"></i></div>
                    Laboratory Units 
                    <span class="md-badge">{{ count($units) }}</span>
                </h3>
                <div class="search-input-wrap">
                    <i class="fa fa-search"></i>
                    <input type="text" id="unit-search" placeholder="Search units..." autocomplete="off">
                </div>
            </div>
            
            <div class="add-form-area">
                <form id="form-add-unit">
                    @csrf
                    <div class="input-group-premium">
                        <input type="text" name="name" placeholder="New unit (e.g. mg/dl, %)" required autocomplete="off">
                        <button type="submit" class="btn-add"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </form>
            </div>
            
                <table class="table-premium" id="units-table">
                    <thead class="table-header">
                        <tr>
                            <th width="10%">SL No</th>
                            <th>Unit Name</th>
                            <th width="20%" style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="units-list">
                        @foreach($units as $i => $unit)
                        <tr class="md-list-item" data-name="{{ strtolower($unit->name) }}">
                            <td class="td-number">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td style="font-weight: 600;">{{ $unit->name }}</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-icon-soft btn-edit-soft btn-edit-unit" data-id="{{ $unit->id }}" data-name="{{ $unit->name }}" data-bs-toggle="modal" data-bs-target="#modal-edit-master" title="Edit">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <button class="btn-icon-soft btn-delete-soft btn-delete-unit" data-id="{{ $unit->id }}" data-name="{{ $unit->name }}" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    {{-- ② Result Templates --}}
    <div class="col-lg-6">
        <div class="aw-card-premium theme-green">
            <div class="card-header-premium">
                <h3 class="card-title-premium">
                    <div class="card-icon-wrap"><i class="fa fa-list-check"></i></div>
                    Result Templates 
                    <span class="md-badge">{{ count($templates) }}</span>
                </h3>
                <div class="search-input-wrap">
                    <i class="fa fa-search"></i>
                    <input type="text" id="template-search" placeholder="Search templates..." autocomplete="off">
                </div>
            </div>
            
            <div class="add-form-area">
                <form id="form-add-template">
                    @csrf
                    <div class="input-group-premium">
                        <input type="text" name="name" placeholder="New result (e.g. Positive, Negative)" required autocomplete="off">
                        <button type="submit" class="btn-add"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </form>
            </div>
            
                <table class="table-premium" id="templates-table">
                    <thead class="table-header">
                        <tr>
                            <th width="10%">SL No</th>
                            <th>Result Name</th>
                            <th width="20%" style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="templates-list">
                        @foreach($templates as $i => $template)
                        <tr class="md-list-item" data-name="{{ strtolower($template->name) }}">
                            <td class="td-number">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td style="font-weight: 600;">{{ $template->name }}</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-icon-soft btn-edit-soft btn-edit-template" data-id="{{ $template->id }}" data-name="{{ $template->name }}" data-bs-toggle="modal" data-bs-target="#modal-edit-master" title="Edit">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <button class="btn-icon-soft btn-delete-soft btn-delete-template" data-id="{{ $template->id }}" data-name="{{ $template->name }}" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

</div>

<div class="row g-4 mb-4">

    {{-- ③ Reference Range Templates --}}
    <div class="col-lg-6">
        <div class="aw-card-premium theme-purple">
            <div class="card-header-premium">
                <h3 class="card-title-premium">
                    <div class="card-icon-wrap"><i class="fa fa-arrows-left-right"></i></div>
                    Reference Ranges 
                    <span class="md-badge">{{ count($referenceTemplates) }}</span>
                </h3>
                <div class="search-input-wrap">
                    <i class="fa fa-search"></i>
                    <input type="text" id="reference-search" placeholder="Search ranges..." autocomplete="off">
                </div>
            </div>
            
            <div class="add-form-area">
                <form id="form-add-reference">
                    @csrf
                    <div class="input-group-premium">
                        <input type="text" name="name" placeholder="New range (e.g. 70 - 110, < 1.0)" required autocomplete="off">
                        <button type="submit" class="btn-add"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </form>
            </div>
            
                <table class="table-premium" id="references-table">
                    <thead class="table-header">
                        <tr>
                            <th width="10%">SL No</th>
                            <th>Range Value</th>
                            <th width="20%" style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="references-list">
                        @foreach($referenceTemplates as $i => $ref)
                        <tr class="md-list-item" data-name="{{ strtolower($ref->name) }}">
                            <td class="td-number">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td style="font-weight: 600;">{{ $ref->name }}</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-icon-soft btn-edit-soft btn-edit-reference" data-id="{{ $ref->id }}" data-name="{{ $ref->name }}" data-bs-toggle="modal" data-bs-target="#modal-edit-master" title="Edit">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <button class="btn-icon-soft btn-delete-soft btn-delete-reference" data-id="{{ $ref->id }}" data-name="{{ $ref->name }}" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    {{-- ④ Flag Templates --}}
    <div class="col-lg-6">
        <div class="aw-card-premium theme-orange">
            <div class="card-header-premium">
                <h3 class="card-title-premium">
                    <div class="card-icon-wrap"><i class="fa fa-flag"></i></div>
                    Flag Templates 
                    <span class="md-badge">{{ count($flagTemplates) }}</span>
                </h3>
                <div class="search-input-wrap">
                    <i class="fa fa-search"></i>
                    <input type="text" id="flag-search" placeholder="Search flags..." autocomplete="off">
                </div>
            </div>
            
            <div class="add-form-area">
                <form id="form-add-flag">
                    @csrf
                    <div class="input-group-premium">
                        <input type="text" name="name" placeholder="New flag (e.g. High, Low, Critical)" required autocomplete="off">
                        <button type="submit" class="btn-add"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </form>
            </div>
            
                <table class="table-premium" id="flags-table">
                    <thead class="table-header">
                        <tr>
                            <th width="10%">SL No</th>
                            <th>Flag Symbol</th>
                            <th width="20%" style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="flags-list">
                        @foreach($flagTemplates as $i => $flg)
                        <tr class="md-list-item" data-name="{{ strtolower($flg->name) }}">
                            <td class="td-number">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td style="font-weight: 600;">
                                <span style="background: #fff7ed; color: #ea580c; padding: 4px 10px; border-radius: 6px;">{{ $flg->name }}</span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-icon-soft btn-edit-soft btn-edit-flag" data-id="{{ $flg->id }}" data-name="{{ $flg->name }}" data-bs-toggle="modal" data-bs-target="#modal-edit-master" title="Edit">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <button class="btn-icon-soft btn-delete-soft btn-delete-flag" data-id="{{ $flg->id }}" data-name="{{ $flg->name }}" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

</div>

{{-- Universal Edit Modal --}}
<div class="modal fade modal-aw" id="modal-edit-master" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
            <div class="modal-header border-0 pb-0" style="padding: 24px 24px 10px;">
                <h5 class="modal-title" style="font-weight: 700; color: #1e293b;"><i class="fa fa-pen text-primary me-2"></i>Edit Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 10px 24px 24px;">
                <form id="form-edit-master">
                    <input type="hidden" id="edit-id" name="name_1032">
                    <input type="hidden" id="edit-type" name="name_1033">
                    <div class="mb-2">
                        <label for="edit-name" class="form-label" style="font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 8px;">Name / Value</label>
                        <input type="text" id="edit-name" name="name" class="form-control" style="border-radius: 10px; padding: 12px 16px;" required autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 pt-0 d-flex gap-2 w-100" style="padding: 0 24px 24px;">
                <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal" style="border-radius: 10px; font-weight: 600; padding: 10px;">Cancel</button>
                <button type="button" class="btn btn-primary flex-fill" id="btn-update-master" style="border-radius: 10px; font-weight: 600; padding: 10px;">
                    Update Entry
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function () {

    /* ── DataTables Initialization (Row Limit & Search) ─────────────────── */
    function initDataTable(tableId, searchInputId) {
        var table = $('#' + tableId).DataTable({
            dom: "<'row px-4 pt-3 pb-2'<'col-sm-12'l>>" +
                 "<'table-wrapper'tr>" +
                 "<'row px-4 py-3'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start mb-2 mb-md-0'i><'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>",
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100],
            ordering: false,
            language: {
                lengthMenu: "Row Limit: _MENU_",
                info: "Showing _START_-_END_ of _TOTAL_",
                infoEmpty: "Showing 0 of 0",
                infoFiltered: "(filtered)",
                emptyTable: "<div class='empty-state-box py-4'><i class='fa fa-box-open mb-2 text-muted' style='font-size:24px'></i><span>No entries added yet</span></div>",
                zeroRecords: "<div class='empty-state-box py-4'><i class='fa fa-search-minus mb-2 text-muted' style='font-size:24px'></i><span>No results found</span></div>",
                paginate: {
                    previous: "<i class='fa fa-angle-left'></i>",
                    next: "<i class='fa fa-angle-right'></i>"
                }
            }
        });
        
        $('#' + searchInputId).on('keyup input', function () {
            table.search($(this).val()).draw();
        });
    }

    initDataTable('units-table', 'unit-search');
    initDataTable('templates-table', 'template-search');
    initDataTable('references-table', 'reference-search');
    initDataTable('flags-table', 'flag-search');

    /* ── ADD handlers ─────────────────────────────────────── */
    $('#form-add-unit').submit(function (e) {
        e.preventDefault();
        $.post("{{ route('units.store') }}", $(this).serialize(), function () { location.reload(); })
         .fail(function(xhr) { showToast(xhr.responseJSON?.message || 'Failed to add unit.', 'error'); });
    });
    $('#form-add-template').submit(function (e) {
        e.preventDefault();
        $.post("{{ route('result-templates.store') }}", $(this).serialize(), function () { location.reload(); })
         .fail(function(xhr) { showToast(xhr.responseJSON?.message || 'Failed to add template.', 'error'); });
    });
    $('#form-add-reference').submit(function (e) {
        e.preventDefault();
        $.post("{{ route('reference-templates.store') }}", $(this).serialize(), function () { location.reload(); })
         .fail(function(xhr) { showToast(xhr.responseJSON?.message || 'Failed to add reference template.', 'error'); });
    });
    $('#form-add-flag').submit(function (e) {
        e.preventDefault();
        $.post("{{ route('flag-templates.store') }}", $(this).serialize(), function () { location.reload(); })
         .fail(function(xhr) { showToast(xhr.responseJSON?.message || 'Failed to add flag template.', 'error'); });
    });

    /* ── DELETE handlers ──────────────────────────────────── */
    $(document).on('click', '.btn-delete-unit', function () {
        let id = $(this).data('id');
        let name = $(this).data('name') || $(this).closest('tr').find('td:nth-child(2)').text().trim();
        confirmDelete({
            title: name ? `Remove Unit "${name}"?` : 'Remove Unit?',
            text: name ? `Are you sure you want to remove unit "${name}"? This action cannot be undone.` : 'Are you sure you want to remove this unit?'
        }, function () {
            $.ajax({
                url: '/units/' + id,
                type: 'DELETE',
                success: function () {
                    showToast('Unit removed successfully', 'success');
                    setTimeout(() => location.reload(), 600);
                },
                error: function(xhr) {
                    showToast(xhr.responseJSON?.message || 'Failed to remove unit', 'error');
                }
            });
        });
    });

    $(document).on('click', '.btn-delete-template', function () {
        let id = $(this).data('id');
        let name = $(this).data('name') || $(this).closest('tr').find('td:nth-child(2)').text().trim();
        confirmDelete({
            title: name ? `Remove Template "${name}"?` : 'Remove Template?',
            text: name ? `Are you sure you want to remove result template "${name}"? This action cannot be undone.` : 'Are you sure you want to remove this result template?'
        }, function () {
            $.ajax({
                url: '/result-templates/' + id,
                type: 'DELETE',
                success: function () {
                    showToast('Template removed successfully', 'success');
                    setTimeout(() => location.reload(), 600);
                },
                error: function(xhr) {
                    showToast(xhr.responseJSON?.message || 'Failed to remove template', 'error');
                }
            });
        });
    });

    $(document).on('click', '.btn-delete-reference', function () {
        let id = $(this).data('id');
        let name = $(this).data('name') || $(this).closest('tr').find('td:nth-child(2)').text().trim();
        confirmDelete({
            title: name ? `Remove Reference Range "${name}"?` : 'Remove Reference Template?',
            text: name ? `Are you sure you want to remove reference range "${name}"? This action cannot be undone.` : 'Are you sure you want to remove this reference template?'
        }, function () {
            $.ajax({
                url: '/reference-templates/' + id,
                type: 'DELETE',
                success: function () {
                    showToast('Reference template removed successfully', 'success');
                    setTimeout(() => location.reload(), 600);
                },
                error: function(xhr) {
                    showToast(xhr.responseJSON?.message || 'Failed to remove reference template', 'error');
                }
            });
        });
    });

    $(document).on('click', '.btn-delete-flag', function () {
        let id = $(this).data('id');
        let name = $(this).data('name') || $(this).closest('tr').find('td:nth-child(2)').text().trim();
        confirmDelete({
            title: name ? `Remove Flag "${name}"?` : 'Remove Flag Template?',
            text: name ? `Are you sure you want to remove flag "${name}"? This action cannot be undone.` : 'Are you sure you want to remove this flag template?'
        }, function () {
            $.ajax({
                url: '/flag-templates/' + id,
                type: 'DELETE',
                success: function () {
                    showToast('Flag template removed successfully', 'success');
                    setTimeout(() => location.reload(), 600);
                },
                error: function(xhr) {
                    showToast(xhr.responseJSON?.message || 'Failed to remove flag template', 'error');
                }
            });
        });
    });

    /* ── POPULATE edit modal ──────────────────────────────── */
    $(document).on('click', '.btn-edit-unit', function () {
        $('#edit-id').val($(this).data('id'));
        $('#edit-name').val($(this).data('name'));
        $('#edit-type').val('unit');
        $('.modal-title').html('<i class="fa fa-pen text-primary me-2"></i>Edit Laboratory Unit');
    });
    $(document).on('click', '.btn-edit-template', function () {
        $('#edit-id').val($(this).data('id'));
        $('#edit-name').val($(this).data('name'));
        $('#edit-type').val('template');
        $('.modal-title').html('<i class="fa fa-pen text-success me-2"></i>Edit Result Template');
    });
    $(document).on('click', '.btn-edit-reference', function () {
        $('#edit-id').val($(this).data('id'));
        $('#edit-name').val($(this).data('name'));
        $('#edit-type').val('reference-template');
        $('.modal-title').html('<i class="fa fa-pen text-info me-2"></i>Edit Reference Template');
    });
    $(document).on('click', '.btn-edit-flag', function () {
        $('#edit-id').val($(this).data('id'));
        $('#edit-name').val($(this).data('name'));
        $('#edit-type').val('flag-template');
        $('.modal-title').html('<i class="fa fa-pen text-warning me-2"></i>Edit Flag Template');
    });

    /* ── UPDATE ───────────────────────────────────────────── */
    $('#btn-update-master').click(function () {
        var id   = $('#edit-id').val();
        var type = $('#edit-type').val();
        var urls = {
            'unit':               '/units/'              + id,
            'template':           '/result-templates/'   + id,
            'reference-template': '/reference-templates/'+ id,
            'flag-template':      '/flag-templates/'     + id,
        };
        $.ajax({
            url:     urls[type],
            type:    'PUT',
            data:    $('#form-edit-master').serialize(),
            success: function ()  { location.reload(); },
            error:   function ()  { showToast('Error updating entry. Possibly a duplicate name.', 'error'); }
        });
    });

});
</script>
@endpush
@endsection

