@extends('layouts.app')
@section('title', ' | Master Categories')
@section('page-title', 'Master Categories')
@section('content')
<div class="page-header-aw">
    <div class="page-title-aw">
        <div class="title-icon"><i class="fa fa-tags"></i></div>
        <div>
            <div>Master Categories</div>
            <div style="font-size:13px;font-weight:400;color:var(--text-muted);margin-top:2px;">Manage top-level test categories</div>
        </div>
    </div>
    <button type="button" class="btn-aw-primary" data-bs-toggle="modal" data-bs-target="#modal-add-category">
        <i class="fa fa-plus"></i> Add New Category
    </button>
</div>
<style>


    .cat-icon-box {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        color: #0284c7;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        box-shadow: 0 4px 10px rgba(2, 132, 199, 0.15);
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
        display: flex;
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

    .cat-name-cell {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 600;
        color: #1e293b;
        font-size: 15px;
    }


</style>

<div class="aw-card mb-4">
    <div class="aw-card-header">
        <div class="aw-card-title"><i class="fa fa-list" style="color:var(--primary);"></i> All Categories</div>
        <div style="position:relative;">
            <i class="fa fa-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:13px;"></i>
            <input type="text" id="category-search" style="border:1.5px solid var(--border-color);border-radius:9px;padding:8px 12px 8px 32px;font-size:13px;outline:none;width:220px;" placeholder="Search categories..." autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" name="name_1016">
        </div>
    </div>
    <div class="aw-card-body" style="padding:0;">
        <div class="table-responsive-modern">
            
                <table class="table-modern" id="categories-table">
                    <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Created Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td data-label="SL No">
                                <span class="badge-aw" style="background:#f1f5f9;color:#475569;font-family:monospace;font-size:12px;padding:6px 10px;border-radius:6px;border:1px solid #e2e8f0;">#{{ str_pad($category->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td data-label="Category Name">
                                <div class="cat-name-cell">
                                    <div class="cat-icon-box">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                    <span>{{ $category->name }}</span>
                                </div>
                            </td>
                            <td data-label="Description" style="color:#64748b;font-size:13px;line-height:1.5;">{{ Str::limit($category->description, 50, '...') ?? '-' }}</td>
                            <td data-label="Created Date" style="color:#64748b;font-size:13px;"><i class="fa fa-calendar-alt me-2" style="opacity:0.5;"></i>{{ $category->created_at->format('d M, Y') }}</td>
                            <td data-label="Action" class="text-end">
                                <div class="action-btn-group">
                                    <button class="btn-icon-circle edit btn-edit"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-description="{{ $category->description }}"
                                        data-bs-toggle="modal" data-bs-target="#modal-edit-category"
                                        title="Edit"><i class="fa fa-pen"></i></button>
                                    <button class="btn-icon-circle delete btn-delete"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
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
</div>

<!-- Add Category Modal -->
<div class="modal fade modal-aw" id="modal-add-category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-tags me-2"></i>Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-category">
                    @csrf
                    <div class="mb-3">
                        <label for="field_1017" class="form-label-aw">Category Name</label>
                        <input type="text" class="form-control-aw" name="name" placeholder="e.g. Hematology" required autocomplete="off" id="field_1017">
                    </div>
                    <div class="mb-3">
                        <label for="field_1018" class="form-label-aw">Description (Optional)</label>
                        <textarea rows="3" class="form-control-aw" name="description" placeholder="Details about this category..." autocomplete="off" id="field_1018"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-aw-primary" id="btn-save-category"><i class="fa fa-check"></i> Save Category</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade modal-aw" id="modal-edit-category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-pen me-2"></i>Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-category">
                    @csrf
                    <input type="hidden" id="edit-id" name="name_1019">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label-aw">Category Name</label>
                        <input type="text" class="form-control-aw" id="edit-name" name="name" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label-aw">Description</label>
                        <textarea rows="3" class="form-control-aw" id="edit-description" name="description" autocomplete="off"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-aw-outline" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-aw-primary" id="btn-update-category"><i class="fa fa-check"></i> Update Changes</button>
            </div>
        </div>
    </div>
</div>



<!-- JavaScript -->
@push('scripts')
  <script>
	  $(document).ready(function() {
		  $.ajaxSetup({
			  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		  });

		  // Initialize DataTables for Categories
		  var categoriesTable = $('#categories-table').DataTable({
			  dom: "<'row mb-3'<'col-sm-12 col-md-6'l>>" +
				   "<'row'<'col-sm-12'tr>>" +
				   "<'row mt-3'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			  pageLength: 10,
			  lengthMenu: [5, 10, 25, 50, 100],
			  ordering: false,
			  language: {
				  lengthMenu: "Show _MENU_ records",
				  info: "Showing _START_ to _END_ of _TOTAL_ categories",
				  infoEmpty: "Showing 0 to 0 of 0 categories",
				  infoFiltered: "(filtered from _MAX_ total categories)",
				  emptyTable: "No categories found.",
				  paginate: {
					  previous: "<i class='fa fa-angle-left'></i>",
					  next: "<i class='fa fa-angle-right'></i>"
				  }
			  }
		  });
		  $("#category-search").on("keyup", function() {
			  categoriesTable.search($(this).val()).draw();
		  });

		  // Save Category
		  $('#btn-save-category').click(function() {
			  let btn = $(this);
			  if (btn.prop('disabled')) return;
			  
			  btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-2"></i> Saving...');
			  let formData = $('#form-add-category').serialize();
			  
			  $.post("{{ route('categories.store') }}", formData, function(response) {
				  showToast(response.success || 'Done!', 'success');
				  location.reload();
			  }).fail(function(xhr) {
				  showToast(xhr.responseJSON?.message || 'Error saving category.', 'error');
				  btn.prop('disabled', false).html('<i class="fa fa-check"></i> Save Category');
			  });
		  });

		  // Edit Category (Populate)
		  $(document).on('click', '.btn-edit', function() {
			  $('#edit-id').val($(this).data('id'));
			  $('#edit-name').val($(this).data('name'));
			  $('#edit-description').val($(this).data('description'));
		  });

		  // Update Category
		  $('#btn-update-category').click(function() {
			  let btn = $(this);
			  if (btn.prop('disabled')) return;
			  
			  let id = $('#edit-id').val();
			  btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-2"></i> Updating...');
			  
			  $.ajax({
				  url: "/categories/" + id,
				  type: 'PUT',
				  data: $('#form-edit-category').serialize(),
				  success: function(response) {
					  showToast(response.success || 'Done!', 'success');
					  location.reload();
				  },
				  error: function(xhr) {
					  showToast(xhr.responseJSON?.message || 'Failed to update category.', 'error');
					  btn.prop('disabled', false).html('<i class="fa fa-check"></i> Update Changes');
				  }
			  });
		  });

		  // Delete Category
		  $(document).on('click', '.btn-delete', function(e) {
			  e.preventDefault();
			  let id = $(this).data('id');
			  let name = $(this).data('name') || 'this category';
			  confirmDelete({
				  title: 'Delete Category?',
				  text: `Are you sure you want to delete "${name}"? This action cannot be undone.`
			  }, function() {
				  $.ajax({
					  url: "/categories/" + id,
					  type: 'DELETE',
					  success: function(response) {
						  showToast(response.success || 'Category deleted successfully.', 'success');
						  setTimeout(() => location.reload(), 600);
					  },
					  error: function(xhr) {
						  showToast(xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Failed to delete category.", 'error');
					  }
				  });
			  });
		  });
	  });
  </script>
@endpush

@endsection



