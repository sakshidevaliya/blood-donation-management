# LifeDrop - Blood Donation Management System (PHP + MySQL)

A web-based platform connecting blood donors with people in need. Built with PHP, MySQL (via PDO), HTML, CSS.

## Features
- Public donor search by blood group + city
- Donor registration form
- Blood request submission form (for recipients/hospitals)
- Admin panel: login, manage donors (edit/delete/toggle availability), manage requests, view matching donors for each request

## Setup Instructions (using XAMPP)

1. **Copy this whole `blood-donation-system` folder** into your XAMPP `htdocs` folder.
   - Windows: `C:\xampp\htdocs\blood-donation-system`
   - Mac: `/Applications/XAMPP/htdocs/blood-donation-system`

2. **Start Apache and MySQL** in the XAMPP Control Panel.

3. **Create the database:**
   - Go to `http://localhost/phpmyadmin`
   - Click "Import" tab
   - Choose the file `database.sql` from this folder, click "Go"
   - This creates the `blood_donation_db` database with 18 sample donors and 8 sample requests (all fake/demo data)

4. **Create your admin login:**
   - Visit `http://localhost/blood-donation-system/admin/create_admin.php`
   - Set a username and password
   - **Delete `admin/create_admin.php` afterward** for security

5. **View your site:**
   - Public site: `http://localhost/blood-donation-system/index.php`
   - Admin panel: `http://localhost/blood-donation-system/admin/login.php`

## Notes
- All donor/request data in `database.sql` is fictional, for demo purposes only.
- `config.php` assumes default XAMPP MySQL settings (`username: root`, `password: empty`). Edit if yours differs.
- The "Request Blood" flow doesn't auto-notify donors — the admin reviews requests and sees matching available donors on the request detail page. Real SMS/email notification would be a good "future scope" point for your report.

## Folder Structure
```
blood-donation-system/
├── admin/               # Admin panel (login, dashboard, donor & request management)
├── css/style.css         # Styling
├── includes/             # Shared header/footer
├── config.php             # Database connection
├── database.sql         # Import this into phpMyAdmin
├── index.php                # Homepage / donor search
├── register_donor.php  # Donor registration form + handler
└── request_blood.php    # Blood request form + handler
```
