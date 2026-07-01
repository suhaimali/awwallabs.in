@extends('layouts.app')
@section('title', ' | System Backups')
@section('page-title', 'System Backups')

@section('content')
<div class="page-header-aw">
    <div class="page-title-aw">
        <div class="title-icon"><i class="fa fa-hdd"></i></div>
        <div>
            <div>System Backups</div>
            <div style="font-size:13px; font-weight:400; color:var(--text-muted); margin-top:2px;">Manage and create database backups</div>
        </div>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <button id="btn-create-backup" class="btn-aw-primary">
            <i class="fa fa-plus-circle"></i> Create New Backup
        </button>
        <button id="btn-upload-restore-trigger" class="btn btn-outline-primary" style="padding: 10px 20px; border-radius: 6px; font-weight: 500; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fa fa-upload"></i> Restore from File
        </button>
        <input type="file" id="restore-file-input" style="display: none;" accept=".sql">
    </div>
</div>

<div class="aw-card">
    <div class="aw-card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="backups-table">
                <thead style="background:var(--bg-light);">
                    <tr>
                        <th style="padding:15px; font-weight:600; font-size:12px; color:var(--text-muted); text-transform:uppercase;">Filename</th>
                        <th style="padding:15px; font-weight:600; font-size:12px; color:var(--text-muted); text-transform:uppercase;">Size</th>
                        <th style="padding:15px; font-weight:600; font-size:12px; color:var(--text-muted); text-transform:uppercase;">Created Date</th>
                        <th style="padding:15px; font-weight:600; font-size:12px; color:var(--text-muted); text-transform:uppercase; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($backups as $backup)
                    <tr>
                        <td style="padding:15px; vertical-align:middle; font-weight:600; color:var(--text-dark);">
                            <i class="fa fa-database me-2 text-primary"></i> {{ $backup['name'] }}
                        </td>
                        <td style="padding:15px; vertical-align:middle; font-size:13px; color:var(--text-muted);">
                            {{ $backup['size'] }}
                        </td>
                        <td style="padding:15px; vertical-align:middle; font-size:13px; color:var(--text-muted);">
                            {{ $backup['date'] }}
                        </td>
                        <td style="padding:15px; vertical-align:middle; text-align:right;">
                            <a href="{{ route('backups.download', $backup['name']) }}" class="btn btn-sm btn-outline-primary shadow-sm rounded-3">
                                <i class="fa fa-download"></i> Download
                            </a>
                            <button class="btn btn-sm btn-outline-danger shadow-sm rounded-3 btn-delete-backup ms-1" data-file="{{ $backup['name'] }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#btn-upload-restore-trigger').click(function() {
        $('#restore-file-input').click();
    });

    $('#restore-file-input').change(function() {
        let file = this.files[0];
        if (!file) return;

        if (file.name.split('.').pop() !== 'sql') {
            showToast('Only .sql files are allowed.', 'error');
            $(this).val('');
            return;
        }

        Swal.fire({
            title: 'Restore Backup from File?',
            text: "WARNING: Restoring will overwrite the current database with this uploaded backup. This cannot be undone. Are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1a56db',
            cancelButtonColor: '#dc2626',
            confirmButtonText: 'Yes, Upload & Restore'
        }).then((result) => {
            if (result.isConfirmed) {
                let btn = $('#btn-upload-restore-trigger');
                let originalHtml = btn.html();
                btn.html('<i class="fa fa-spinner fa-spin"></i> Restoring...').prop('disabled', true);

                let formData = new FormData();
                formData.append('backup_file', file);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route("backups.upload-restore") }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Restored!', response.message, 'success');
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            showToast(response.message || 'Failed to restore.', 'error');
                            btn.html(originalHtml).prop('disabled', false);
                        }
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON?.message || 'An error occurred during restore.';
                        showToast(msg, 'error');
                        btn.html(originalHtml).prop('disabled', false);
                    },
                    complete: function() {
                        $('#restore-file-input').val(''); // Reset file input
                    }
                });
            } else {
                $('#restore-file-input').val(''); // Reset if cancelled
            }
        });
    });

    $('#btn-create-backup').click(function() {
        let btn = $(this);
        let originalHtml = btn.html();
        btn.html('<i class="fa fa-spinner fa-spin"></i> Creating...').prop('disabled', true);

        $.ajax({
            url: '{{ route("backups.create") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    showToast(response.message, 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast(response.message || 'Failed to create backup.', 'error');
                    btn.html(originalHtml).prop('disabled', false);
                }
            },
            error: function(xhr) {
                let msg = xhr.responseJSON?.message || 'An error occurred. Check console for details.';
                showToast(msg, 'error');
                console.error(xhr.responseText);
                btn.html(originalHtml).prop('disabled', false);
            }
        });
    });

    $('.btn-delete-backup').click(function() {
        let file = $(this).data('file');
        let btn = $(this);
        let originalHtml = btn.html();

        Swal.fire({
            title: 'Delete Backup?',
            text: "Are you sure you want to delete this backup?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                btn.html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);

                $.ajax({
                    url: '{{ url("backups/delete") }}/' + file,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.success) {
                            showToast('Backup deleted', 'success');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showToast(response.message || 'Failed to delete backup.', 'error');
                            btn.html(originalHtml).prop('disabled', false);
                        }
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON?.message || 'An error occurred.';
                        showToast(msg, 'error');
                        btn.html(originalHtml).prop('disabled', false);
                    }
                });
            }
        });
    });
    
    // Initialize DataTables for Row Limit System
    $('#backups-table').DataTable({
        "pageLength": 10,
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "ordering": false,
        "language": {
            "lengthMenu": "Show _MENU_ entries",
            "emptyTable": "No backups have been created yet. Click 'Create New Backup' to get started."
        }
    });
});
</script>
@endpush
@endsection
