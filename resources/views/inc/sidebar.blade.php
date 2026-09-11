<aside id="awlab-sidebar">
    <!-- Brand -->
    <div class="sidebar-brand d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center gap-2">
            <div class="brand-icon">
                <i class="fa fa-flask"></i>
            </div>
            <span class="brand-name">{{ config('app.name', 'SUHAIM SOFT LAB') }}</span>
        </div>
        <button class="btn btn-sm btn-light d-lg-none" onclick="closeSidebar()" style="padding: 2px 8px; border-radius: 6px;">
            <i class="fa fa-times"></i>
        </button>
    </div>

    <!-- Nav -->
    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Main Menu</div>

        <a href="{{ route('dashboard') }}"
           class="nav-item-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
           data-tooltip="Dashboard">
            <span class="nav-icon"><i class="fa fa-th-large"></i></span>
            <span class="nav-label">Dashboard</span>
        </a>

        <a href="{{ route('patients') }}"
           class="nav-item-link {{ request()->routeIs('patients*') ? 'active' : '' }}"
           data-tooltip="Patients">
            <span class="nav-icon"><i class="fa fa-user-group"></i></span>
            <span class="nav-label">Patients</span>
        </a>

        <a href="{{ route('vital-signs.index') }}"
           class="nav-item-link {{ request()->routeIs('vital-signs*') ? 'active' : '' }}"
           data-tooltip="Vital Signs">
            <span class="nav-icon"><i class="fa fa-heartbeat"></i></span>
            <span class="nav-label">Vital Signs</span>
        </a>

        <a href="{{ route('appointments') }}"
           class="nav-item-link {{ request()->routeIs('appointments*') ? 'active' : '' }}"
           data-tooltip="Book Appointment">
            <span class="nav-icon"><i class="fa fa-calendar-plus"></i></span>
            <span class="nav-label">Book Appointment</span>
        </a>

        <div class="sidebar-section-label" style="margin-top:8px;">Lab Management</div>

        <a href="{{ route('lab-tests.index') }}"
           class="nav-item-link {{ request()->routeIs('lab-tests*') ? 'active' : '' }}"
           data-tooltip="Lab Tests">
            <span class="nav-icon"><i class="fa fa-flask"></i></span>
            <span class="nav-label">Lab Tests (Billing)</span>
        </a>

        <a href="{{ route('test-parameters.index') }}"
           class="nav-item-link {{ request()->routeIs('test-parameters*') ? 'active' : '' }}"
           data-tooltip="Test Parameters">
            <span class="nav-icon"><i class="fa fa-sliders"></i></span>
            <span class="nav-label">Test Parameters</span>
        </a>

        <a href="{{ route('categories.index') }}"
           class="nav-item-link {{ request()->routeIs('categories*') ? 'active' : '' }}"
           data-tooltip="Master Categories">
            <span class="nav-icon"><i class="fa fa-tags"></i></span>
            <span class="nav-label">Master Categories</span>
        </a>

        <a href="{{ route('sub-categories.index') }}"
           class="nav-item-link {{ request()->routeIs('sub-categories*') ? 'active' : '' }}"
           data-tooltip="Sub-Categories">
            <span class="nav-icon"><i class="fa fa-list-ul"></i></span>
            <span class="nav-label">Sub-Categories</span>
        </a>

        <a href="{{ route('master-data.index') }}"
           class="nav-item-link {{ request()->routeIs('master-data*') ? 'active' : '' }}"
           data-tooltip="Master Data">
            <span class="nav-icon"><i class="fa fa-database"></i></span>
            <span class="nav-label">Master Data</span>
        </a>

        <a href="{{ route('templates.index') }}"
           class="nav-item-link {{ request()->routeIs('templates*') ? 'active' : '' }}"
           data-tooltip="Report Templates">
            <span class="nav-icon"><i class="fa fa-copy"></i></span>
            <span class="nav-label">Report Templates</span>
        </a>

        <div class="sidebar-section-label" style="margin-top:8px;">Reports</div>

        <a href="{{ route('reports') }}"
           class="nav-item-link {{ request()->routeIs('reports') ? 'active' : '' }}"
           data-tooltip="Test Reports">
            <span class="nav-icon"><i class="fa fa-file-medical"></i></span>
            <span class="nav-label">Test Reports</span>
        </a>

        <a href="{{ route('report-signatures.index') }}"
           class="nav-item-link {{ request()->routeIs('report-signatures*') ? 'active' : '' }}"
           data-tooltip="Report Signatures">
            <span class="nav-icon"><i class="fa fa-signature"></i></span>
            <span class="nav-label">Report Signatures</span>
        </a>

        <div class="sidebar-section-label" style="margin-top:8px;">Finance</div>

        <a href="{{ route('payments') }}"
           class="nav-item-link {{ request()->routeIs('payments*') ? 'active' : '' }}"
           data-tooltip="Payments & Billing">
            <span class="nav-icon"><i class="fa fa-credit-card"></i></span>
            <span class="nav-label">Payments &amp; Billing</span>
        </a>

        <a href="{{ route('income-report') }}"
           class="nav-item-link {{ request()->routeIs('income-report*') ? 'active' : '' }}"
           data-tooltip="Income Report">
            <span class="nav-icon"><i class="fa fa-chart-line"></i></span>
            <span class="nav-label">Income Report</span>
        </a>

        <a href="{{ route('daily-collection') }}"
           class="nav-item-link {{ request()->routeIs('daily-collection*') ? 'active' : '' }}"
           data-tooltip="Daily Collection">
            <span class="nav-icon"><i class="fa fa-cash-register"></i></span>
            <span class="nav-label">Daily Collection</span>
        </a>

        <div class="sidebar-section-label" style="margin-top:8px;">Inventory & Accounts</div>

        <a href="{{ route('products.index') }}"
           class="nav-item-link {{ request()->routeIs('products*') ? 'active' : '' }}"
           data-tooltip="Products">
            <span class="nav-icon"><i class="fa fa-boxes"></i></span>
            <span class="nav-label">Products</span>
        </a>

        <a href="{{ route('purchases.index') }}"
           class="nav-item-link {{ request()->routeIs('purchases*') ? 'active' : '' }}"
           data-tooltip="Purchase Receipts">
            <span class="nav-icon"><i class="fa fa-file-invoice-dollar"></i></span>
            <span class="nav-label">Purchase Receipts</span>
        </a>

        <div class="sidebar-section-label" style="margin-top:8px;">System</div>

        <a href="{{ route('backups.index') }}"
           class="nav-item-link {{ request()->routeIs('backups*') ? 'active' : '' }}"
           data-tooltip="System Backups">
            <span class="nav-icon"><i class="fa fa-hdd"></i></span>
            <span class="nav-label">System Backups</span>
        </a>
    </nav>

    <div class="sidebar-footer" style="display: none;">
        <strong></strong><br>
    </div>
</aside>
