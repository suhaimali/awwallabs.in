@extends('layouts.app')
@section('title', ' | Income Report Locked')
@section('page-title', 'Income Report')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card border-0 shadow-sm" style="max-width: 400px; width: 100%; border-radius: 16px; background: #ffffff;">
        <div class="card-body p-4 text-center">
            <div class="mb-4 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%; background: #fee2e2; color: #ef4444;">
                <i class="fa fa-lock fa-3x"></i>
            </div>
            
            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 800; color: var(--text-dark); margin-bottom: 8px;">Access Restricted</h4>
            <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 24px;">Please enter the administrator password to view the Income Report.</p>
            
            <form id="form-unlock-page">
                @csrf
                <div class="mb-3 text-start">
                    <label for="page-password-input" class="form-label-aw" style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Password</label>
                    <input type="password" id="page-password-input" class="form-control-aw w-100" placeholder="Enter password..." autocomplete="current-password" name="password" required style="padding: 10px 14px;">
                </div>
                
                <div id="page-password-error" class="mb-3 text-start" style="display:none; color:#dc2626; font-size:13px;">
                    <i class="fa fa-circle-exclamation me-1"></i>Incorrect password. Please try again.
                </div>
                
                <button type="submit" class="btn-aw-primary w-100 py-2" id="btn-unlock-page" style="font-weight: 600; border-radius: 10px;">
                    <i class="fa fa-unlock-alt me-2"></i> Unlock Page
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#form-unlock-page').on('submit', function(e) {
        e.preventDefault();
        const pass = $('#page-password-input').val();
        const btn = $('#btn-unlock-page');
        
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-2"></i> Unlocking...');
        $('#page-password-error').hide();
        
        fetch("{{ route('income-report.unlock') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ password: pass })
        }).then(r => {
            if (!r.ok) throw new Error();
            return r.json();
        }).then(data => {
            window.location.reload();
        }).catch(() => {
            btn.prop('disabled', false).html('<i class="fa fa-unlock-alt me-2"></i> Unlock Page');
            $('#page-password-error').show();
        });
    });
</script>
@endpush
@endsection
