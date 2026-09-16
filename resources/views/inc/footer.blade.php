<footer id="awlab-footer">
    <div class="footer-left">
        <span>&copy; {{ date('Y') }} <strong>{{ config('app.name', 'SUHAIM SOFT LAB') }}</strong>. All rights reserved.</span>
    </div>
    <div class="footer-right">
        <span>Designed by <a href="https://suhaimsoft.com" target="_blank" rel="noopener" class="footer-brand-link">Suhaim Soft</a></span>
        <span class="footer-version badge bg-light text-secondary border">v2.4.0</span>
    </div>
</footer>

<style>
    #awlab-footer {
        margin-left: var(--sidebar-w);
        padding: 16px 28px;
        border-top: 1px solid var(--border-color);
        background: #ffffff;
        font-size: 12.5px;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        transition: margin-left var(--transition);
        z-index: 10;
    }

    body.sidebar-collapsed #awlab-footer {
        margin-left: var(--sidebar-collapsed);
    }

    @media (max-width: 991px) {
        #awlab-footer {
            margin-left: 0 !important;
            padding: 14px 16px;
            justify-content: center;
            text-align: center;
        }
    }

    .footer-left {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .footer-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .footer-brand-link {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .footer-brand-link:hover {
        color: var(--primary-hover, #4338ca);
        text-decoration: underline;
    }

    .footer-version {
        font-size: 11px;
        padding: 3px 8px;
        border-radius: 6px;
    }
</style>
