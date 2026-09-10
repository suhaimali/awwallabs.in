    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Moment -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script>
        // ── Hide loader on page load
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('aw-loader').classList.add('hidden');
            }, 100); // 1 second loading delay
        });

        // ── Sidebar toggle (desktop collapse)
        function toggleSidebar() {
            if (window.innerWidth <= 991) {
                document.body.classList.toggle('sidebar-open');
            } else {
                document.body.classList.toggle('sidebar-collapsed');
                $.ajax({
                    url: '/sidebar-toggle',
                    type: 'POST',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });
            }
        }
        function closeSidebar() {
            document.body.classList.remove('sidebar-open');
        }

        // ── Live clock
        function updateClock() {
            const now = new Date();
            const t = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
            const d = now.toLocaleDateString('en-US', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
            const te = document.getElementById('header-live-time');
            const de = document.getElementById('header-live-date');
            if (te) { te.textContent = t; de.textContent = d; }
        }
        setInterval(updateClock, 1000);
        updateClock();

        // ── PWA Service Worker (production only — skip in local dev to avoid SSL probe errors)
        @if(app()->isProduction())
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register("{{ asset('sw.js') }}").catch(() => {});
            });
        }
        @endif

        // ── CSRF setup for AJAX
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        // ── Bootstrap 5 jQuery modal compatibility shim
        // Bootstrap 5 dropped jQuery support, so .modal('show'/'hide') doesn't exist natively.
        // This restores the familiar jQuery syntax by delegating to the Bootstrap 5 native API.
        $.fn.modal = function(action) {
            return this.each(function() {
                let instance = bootstrap.Modal.getOrCreateInstance(this);
                if (action === 'show') instance.show();
                else if (action === 'hide') instance.hide();
                else if (action === 'toggle') instance.toggle();
                else if (action === 'dispose') instance.dispose();
            });
        };

        // ── Global Toast Function (Enhanced, supports HTML, object errors, and modals)
        window.showToast = function(message, type = 'success') {
            if (type === 'danger') type = 'error';
            if (type === 'warn') type = 'warning';

            let content = message;
            if (typeof content === 'object' && content !== null) {
                if (content.responseJSON) {
                    if (content.responseJSON.errors) {
                        content = Object.values(content.responseJSON.errors).flat().join('<br>');
                    } else if (content.responseJSON.message) {
                        content = content.responseJSON.message;
                    } else {
                        content = JSON.stringify(content.responseJSON);
                    }
                } else if (content.message) {
                    content = content.message;
                } else if (content.error) {
                    content = content.error;
                } else {
                    content = JSON.stringify(content);
                }
            }

            if (!content) content = type === 'error' ? 'An unexpected error occurred.' : 'Action completed successfully.';

            const hasHtml = typeof content === 'string' && /<[a-z][\s\S]*>/i.test(content);

            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                icon: type,
                [hasHtml ? 'html' : 'title']: content,
                customClass: {
                    popup: 'swal2-app-toast'
                }
            });
        };
        function showToast(message, type = 'success') {
            window.showToast(message, type);
        }

        // ── Global Simple Delete Confirmation Popup (Modern Minimal UI)
        function confirmDelete(options = {}, onConfirm) {
            let title = typeof options === 'string' ? options : (options.title || 'Delete Confirmation');
            let text = typeof options === 'object' && options.text ? options.text : 'Are you sure you want to delete this? This action cannot be undone.';
            let confirmBtnText = typeof options === 'object' && options.confirmButtonText ? options.confirmButtonText : 'Delete';

            return Swal.fire({
                html: `
                    <div style="padding: 6px 0 2px; text-align: center;">
                        <div style="width: 52px; height: 52px; border-radius: 50%; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; font-size: 22px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.18);">
                            <i class="fa fa-trash-alt"></i>
                        </div>
                        <h4 style="font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 6px; letter-spacing: -0.01em;">${title}</h4>
                        <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin: 0 auto; max-width: 290px;">${text}</p>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: `<i class="fa fa-trash-alt"></i> ${confirmBtnText}`,
                cancelButtonText: 'Cancel',
                customClass: {
                    popup: 'swal2-simple-delete-popup',
                    confirmButton: 'btn-swal-delete-confirm',
                    cancelButton: 'btn-swal-delete-cancel',
                    actions: 'swal2-simple-delete-actions'
                },
                buttonsStyling: false,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed && typeof onConfirm === 'function') {
                    onConfirm();
                }
                return result;
            });
        }
        window.confirmDelete = confirmDelete;

        // ── Session Timeout Warning
        // Session lifetime = 120 minutes. Warn at 118 min, expire at 120 min.
        (function() {
            const SESSION_MINUTES = {{ config('session.lifetime', 120) }};
            const WARN_BEFORE_MS  = 2 * 60 * 1000;  // warn 2 minutes before expiry
            const SESSION_MS      = SESSION_MINUTES * 60 * 1000;
            let warningShown = false;
            let sessionTimer, expireTimer;

            function resetTimers() {
                clearTimeout(sessionTimer);
                clearTimeout(expireTimer);
                warningShown = false;

                // Show warning 2 minutes before session expires
                sessionTimer = setTimeout(function() {
                    if (warningShown) return;
                    warningShown = true;
                    Swal.fire({
                        title: '<i class="fa fa-clock" style="color:#f59e0b;"></i> Session Expiring Soon',
                        html: 'Your session will expire in <strong>2 minutes</strong>.<br>Do you want to stay logged in?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '<i class="fa fa-refresh"></i> Stay Logged In',
                        cancelButtonText: 'Logout Now',
                        confirmButtonColor: '#0284c7',
                        cancelButtonColor: '#dc2626',
                        timer: 120000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            // Ping server to keep session alive
                            $.get('/dashboard-stats').done(function() {
                                resetTimers();
                                Swal.fire({
                                    title: 'Session Extended',
                                    text: 'You are still logged in.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            }).fail(function() {
                                window.location.href = '/login';
                            });
                        } else {
                            document.getElementById('logout-form').submit();
                        }
                    });
                }, SESSION_MS - WARN_BEFORE_MS);

                // Hard redirect when session expires
                expireTimer = setTimeout(function() {
                    window.location.href = '/login';
                }, SESSION_MS);
            }

            // Start timers on page load
            resetTimers();

            // Reset timers on any user activity (clicks, key presses)
            $(document).on('click keydown', function() {
                if (!warningShown) resetTimers();
            });
        })();
    </script>

    @stack('scripts')
