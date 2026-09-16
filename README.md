# AWWAL LABS - Advanced Laboratory Information Management System (LIMS)

AWWAL LABS is an enterprise-grade, comprehensive Laboratory Information Management System built with **Laravel 11** and **MySQL**. It is engineered to streamline clinical patient registration, diagnostic test reporting, dynamic reference intervals, multi-tier billing, and automated PDF invoicing.

---

## 🚀 Key Features

* **Patient Management:** Rapid AJAX-based registry with live search and standard **`Q-XXXX`** patient ID auto-generation.
* **Diagnostic Test Reports:** Dynamic reporting templates, critical value flags, authorized doctor signatures, and multi-format export.
* **Automated Invoicing:** Instant client-side PDF generation powered by `jsPDF` and `AutoTable` with automatic breakdown of charges and discounts.
* **Reference Intervals:** Multi-demographic biological reference intervals segmented by age, gender, and clinical conditions.
* **Daily Collection & Finances:** Real-time collection tracking, categorized payment methods (Cash, Card, UPI), and date-based ledger reports.
* **Master Configurations:** Intuitive administration for doctors, categories, lab tests, report templates, units of measurement, and flag alerts.
* **Optimized HTTP/2 & PWA Architecture:** Zero protocol buffer conflicts, unbuffered chunk streams for large datasets, and seamless offline-tolerant caching.

---

## 💻 Tech Stack

* **Backend Framework:** Laravel 11 (PHP 8.2+)
* **Database:** MySQL 8.x / MariaDB
* **Architecture:** 100% MySQL Relational Schema (34 core tables)
* **Frontend:** Laravel Blade, Bootstrap 5, HTML5/CSS3, JavaScript (jQuery + AJAX)
* **Plugins & Libraries:** DataTables, Select2, SweetAlert2, jsPDF, AutoTable, Moment.js, FontAwesome 6

---

## 🚀 Server Deployment Guide (For Developers & DevOps)

### Option 1: Automated Deployment (Recommended)

The repository includes a ready-to-use deployment script `deploy.sh`.

```bash
# 1. SSH into the server and navigate to your application root:
cd /var/www/awwallabs.in

# 2. Pull the latest release:
git pull origin main

# 3. Execute the automated deploy script:
bash deploy.sh
```

---

### Option 2: Step-by-Step Manual Deployment

```bash
# 1. Navigate to application folder
cd /var/www/awwallabs.in

# 2. Pull latest codebase
git pull origin main

# 3. Install/update production Composer dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# 4. Clear and rebuild Laravel production caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Ensure safe storage and cache permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 6. Restart queue workers (if supervisor/queues are used)
php artisan queue:restart
```

---

## 🗄️ Database Recovery & Initialization

A complete, verified UTF-8 database backup is provided in the repository root: **`awwal_lab_full_backup_utf8.sql`**.

### Restore to MySQL:
```bash
mysql -u root -p awwal_lab < awwal_lab_full_backup_utf8.sql
```

*(On Windows PowerShell:)*
```powershell
Get-Content "awwal_lab_full_backup_utf8.sql" | mysql -u root awwal_lab
```

### Ensure Consistent Patient ID Format:
To format any legacy patient IDs to the standard `Q-XXXX` scheme:
```sql
UPDATE patients 
SET patient_id = CONCAT('Q-', LPAD(id, 4, '0'))
WHERE patient_id NOT LIKE 'Q-%';
```

---

## 🛠️ Local Development Setup

### 1. Clone Repository
```bash
git clone https://github.com/suhaimali/awwallabs.in.git
cd awwallabs.in
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```
Update `.env` with your local database connection:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=awwal_lab
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations or Import Database
```bash
# Either restore the backup:
mysql -u root awwal_lab < awwal_lab_full_backup_utf8.sql

# Or run fresh migrations:
php artisan migrate
```

### 5. Start Development Server
```bash
php artisan serve
```
Access the application at: `http://127.0.0.1:8000`

---

## 📂 Key Directory Layout

```text
awwallabs.in/
├── app/
│   ├── Http/Controllers/   # Application Controllers (HomeController, AdminController, etc.)
│   └── Models/             # Eloquent Models (Patient, LabTest, Payment, ReportTemplate, etc.)
├── database/
│   ├── migrations/         # Migration history
│   └── seeders/            # Database seeders
├── resources/
│   └── views/              # Blade templates (patients, reports, templates, daily_collection, etc.)
├── routes/
│   └── web.php             # Web route definitions
├── awwal_lab_full_backup_utf8.sql # Full SQL database backup
├── deploy.sh               # One-click server deployment script
└── .env.example            # Environment configuration template
```

---

## 📜 License

This project is proprietary software of **AWWAL LABS**. All rights reserved.