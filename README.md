# Election Management Platform

A **self-hosted** platform for conducting **secure online elections** efficiently. Built with Laravel 12 and Tailwind CSS v4.

## 🏢 Deployment Model

This is a **self-hosted election management system** designed for organizations to deploy on their own infrastructure.

**One installation = One organization**

### Perfect For:

-   🎓 **Universities** - Student government elections, faculty senate voting
-   🏛️ **Professional Associations** - Board member elections, committee selections
-   👥 **Trade Unions** - Leadership elections, member referendums
-   🎯 **Clubs & Societies** - Officer elections, policy votes
-   🏢 **Non-Profits** - Board elections, governance decisions
-   🏘️ **Community Organizations** - HOA boards, cooperative governance

### What This Means:

-   ✅ **Full data ownership** - All election data stays on your infrastructure
-   ✅ **Complete control** - Customize, modify, and extend as needed
-   ✅ **Privacy-first** - No third-party access to voter information
-   ✅ **Open source** - Transparent, auditable election process

## ✨ Features

### 🗳️ Election Management

-   **Multiple Vote Types:**
    -   **Single Choice** – Select one candidate from all candidates (e.g., President)
    -   **Multiple Choice** – Select up to a maximum number of candidates (e.g., "Select up to 2 Senators")
    -   **Yes/No Voting** – Vote yes or no for each candidate in a position (e.g., Executive Board approval)
-   **Category-Based Restrictions** – Restrict certain positions to specific voter categories (e.g., A user in "A" category can only vote for "A" category Reps)
-   **Position Management** – Admin can create, edit, and delete positions with custom vote types
-   **Candidate Management** – Add, edit, and remove candidates with photos and profile information
-   **Live Results Monitoring** – Real-time vote counting with auto-refresh for admins during active elections
-   **Election Control** – Toggle election periods on/off from settings
-   **Custom Branding** – Customize logo, colors (primary, secondary, accent), election banner, and custom CSS per election
-   **Flexible Authentication** – Users can log in with either User ID or Email
-   **Voting Progress Tracker** – Visual progress indicator showing completion status

### 👥 Voter Management

-   **Voter CRUD Operations** – Admins can create, view, edit, and delete voters
-   **Bulk Import** – Import multiple voters at once via CSV/Excel upload with validation
-   **Self-Registration** – Voters can register themselves with admin approval workflow
-   **Approval System** – Pending, approved, and rejected status for voter accounts
-   **Category-Based Organization** – Voters organized by categories (e.g., Board Members, Staff, Texans, Alumni)
-   **Automated Email Notifications** – Vote confirmations, election start/end announcements

### 🔒 Security & Performance

-   **Admin Middleware** – Dedicated middleware protecting all admin routes
-   **Rate Limiting** – Login throttling (5 attempts per minute) to prevent brute force attacks
-   **Policy-Based Authorization** – Laravel policies for User, Position, Candidate, and Vote resources
-   **Background Job Processing** – Queue support for reliable email delivery

### 📊 Analytics & Reporting

-   **Analytics Dashboard** – Real-time metrics including:
    -   Total voters and participation rate
    -   Turnout percentage
    -   Votes by position with visual progress bars
    -   Participation by category breakdown
    -   Recent voting activity
    -   Voting timeline
    -   Top positions by participation
-   **Export Capabilities:**
    -   **Excel Export** – Download complete results or individual position results
    -   **PDF Export** – Generate professional PDF reports with organization branding
-   **Live Monitoring** – Auto-refreshing dashboards during active elections

### ⚙️ Settings & Configuration

-   **Dynamic Settings** – Configure organization name, address, contact info from database
-   **Tenure Management** – Set current tenure
-   **Election Toggle** – Enable/disable election periods with start/end dates
-   **Registration Control** – Open/close new member registration

## 🛠️ Tech Stack

### Backend

-   **Laravel 12** – Modern PHP framework
-   **PHP 8.2+** – Latest PHP features
-   **MySQL** – Relational database

### Frontend

-   **Tailwind CSS v4** – Utility-first CSS framework
-   **Alpine.js** – Lightweight JavaScript framework
-   **Livewire 3.6** – Reactive components without JavaScript complexity

### Packages

-   **Maatwebsite/Excel** – Excel export functionality
-   **Barryvdh/laravel-dompdf** – PDF generation
-   **Laravel Notifications** – Email notification system

## 📋 Requirements

-   PHP 8.2 or higher
-   Composer
-   Node.js 20+ and pnpm (or npm)
-   MySQL 5.7+ or MariaDB 10.3+

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/danolu/elections-manager.git
cd elections-manager
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
# Using pnpm (recommended)
pnpm install

# Or using npm
npm install
```

### 4. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Environment Variables

Edit `.env` and set your configuration:

```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Application
APP_NAME="Your Organization Name"
APP_URL=http://localhost

# Mail Configuration (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Queue Configuration (for background jobs)
QUEUE_CONNECTION=database
```

### 6. Database Setup

```bash
# Run migrations and seed database
php artisan migrate --seed

# Link storage for candidate photos
php artisan storage:link

# Create jobs table for queue processing
php artisan queue:table
php artisan migrate
```

This will create:

-   Users table with role-based access control
-   Positions table for dynamic voting positions
-   Candidates table linked to positions
-   Votes table for storing election results
-   Settings table with default values
-   Jobs table for background processing

### 7. Build Assets

```bash
# Development build
pnpm run dev

# Production build
pnpm run build
```

### 8. Start Development Server

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Queue worker (for email notifications)
php artisan queue:work

# Terminal 3: Vite dev server (optional, for hot reload)
pnpm run dev
```

Visit `http://localhost:8000` in your browser.

## 🔑 Default Credentials

Check `database/seeders/UserSeeder.php` for admin credentials. **Change the password immediately after first login.**


## ⚙️ Configuration

### Settings Management

Access `/settings` to configure organization details, tenure, and election periods. All settings are database-driven—no code changes needed.

## 📧 Email Notifications

Automated emails are sent for:

-   **Vote confirmations** - After each vote is cast
-   **Election started** - When voting opens
-   **Election ended** - When voting closes

Configure SMTP settings in `.env` and run `php artisan queue:work` to process emails in the background.

## 🚀 Production Deployment

This section covers deploying your own instance of the election platform.

### Hosting Options

Choose a hosting solution based on your organization's needs:

#### **Option 1: Managed Laravel Hosting (Easiest)**

-   **[Laravel Forge](https://forge.laravel.com)** ($12/month) - One-click deployment, automatic SSL, queue management
-   **[Ploi](https://ploi.io)** ($10/month) - Similar to Forge, user-friendly interface
-   **[RunCloud](https://runcloud.io)** ($8/month) - Server management made simple

**Best for:** Organizations without technical staff. Everything is automated.

#### **Option 2: VPS/Cloud Hosting (Flexible)**

-   **[DigitalOcean](https://digitalocean.com)** ($6-12/month) - Reliable, good documentation
-   **[Linode](https://linode.com)** ($5-10/month) - Similar to DigitalOcean
-   **[Vultr](https://vultr.com)** ($6-12/month) - Fast deployment
-   **[AWS Lightsail](https://aws.amazon.com/lightsail/)** ($5-10/month) - AWS simplified

**Best for:** Organizations with technical staff or IT department.

#### **Option 3: Shared Hosting (Budget)**

-   **[Namecheap](https://namecheap.com)** - Shared hosting with PHP support
-   **[SiteGround](https://siteground.com)** - Good Laravel support
-   **[A2 Hosting](https://a2hosting.com)** - Fast shared hosting

**Best for:** Small organizations, limited budget. Note: Queue workers may be limited.

#### **Option 4: On-Premises (Maximum Control)**

-   Deploy on your organization's own servers
-   Full control over infrastructure and data
-   Requires IT staff for maintenance

**Best for:** Large organizations, government agencies, strict data residency requirements.

### Prerequisites

-   PHP 8.2+ with required extensions (mbstring, openssl, pdo, tokenizer, xml, ctype, json, bcmath)
-   MySQL 5.7+ or MariaDB 10.3+
-   Composer
-   Node.js 20+ and pnpm
-   Web server (Apache/Nginx)
-   SSL certificate (required for production)

### Deployment Steps

1. **Clone and install dependencies**:

```bash
git clone https://github.com/danolu/elections-manager.git
cd elections-manager
composer install --optimize-autoloader --no-dev
pnpm install
```

2. **Configure environment**:

```bash
cp .env.example .env
php artisan key:generate
# Edit .env with your organization's settings
```

**Important `.env` settings for production:**

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_DATABASE=your_elections_db
DB_USERNAME=your_db_user
DB_PASSWORD=strong_password_here

# Email settings (required for notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.yourprovider.com
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=elections@yourdomain.com
MAIL_FROM_NAME="Your Organization"

# Queue (optional but recommended)
QUEUE_CONNECTION=database
```

3. **Set up database**:

```bash
php artisan migrate --seed --force
php artisan storage:link
php artisan queue:table
php artisan migrate --force
```

4. **Build assets**:

```bash
pnpm run build
```

5. **Optimize for production**:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

6. **Set up queue worker** (optional but recommended):

**Option A: Using Supervisor (Recommended for VPS/Dedicated Servers)**

Create `/etc/supervisor/conf.d/elections-queue.conf`:

```ini
[program:elections-queue-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/elections-manager/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/elections-manager/storage/logs/worker.log
stopwaitsecs=3600
```

Then start Supervisor:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start elections-queue-worker:*
```

**Option B: Using Cron (For Shared Hosting)**

Add to your crontab:

```bash
* * * * * cd /path/to/elections-manager && php artisan schedule:run >> /dev/null 2>&1
```

Then update `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('queue:work --stop-when-empty')->everyMinute();
}
```

**Option C: Skip Queue (Not Recommended)**

Remove `implements ShouldQueue` from notification classes in `app/Notifications/`. Emails will be sent synchronously (slower but simpler).

7. **Configure web server**:

**Nginx Configuration:**

```nginx
server {
    listen 80;
    server_name elections.yourdomain.com;
    root /path/to/elections-manager/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

**Apache Configuration (.htaccess is included):**

Ensure `mod_rewrite` is enabled:

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Point your VirtualHost to the `public` directory:

```apache
<VirtualHost *:80>
    ServerName elections.yourdomain.com
    DocumentRoot /path/to/elections-manager/public

    <Directory /path/to/elections-manager/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

8. **Set permissions**:

```bash
chown -R www-data:www-data /path/to/elections-manager
chmod -R 755 /path/to/elections-manager
chmod -R 775 /path/to/elections-manager/storage
chmod -R 775 /path/to/elections-manager/bootstrap/cache
```

9. **Set up SSL certificate** (using Let's Encrypt):

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d elections.yourdomain.com
```

### Post-Deployment Checklist

-   ✅ **Change default admin password** (see `database/seeders/UserSeeder.php`)
-   ✅ **Test email notifications** - Verify SMTP settings work
-   ✅ **Configure organization settings** - Update name, logo, contact in `/settings`
-   ✅ **Set up database backups** - Schedule regular automated backups
-   ✅ **Test voting flow** - Run through complete election process

### Security Checklist

-   ✅ Set `APP_DEBUG=false` in production
-   ✅ Use strong `APP_KEY` (generated automatically)
-   ✅ Enable HTTPS with SSL certificate (required for production)
-   ✅ Configure firewall rules (allow only 80, 443, 22)
-   ✅ Set up regular database backups (daily recommended)
-   ✅ Use strong database passwords
-   ✅ Keep dependencies updated (`composer update`, `pnpm update`)
-   ✅ Monitor application logs for suspicious activity
-   ✅ Restrict `/admin` routes to trusted IP addresses (optional)
-   ✅ Enable two-factor authentication for admin accounts (future enhancement)

## 🎯 Getting Started (After Deployment)

Once your platform is deployed, follow these steps to set up your first election:

### 1. **Initial Login & Setup**

-   Navigate to `https://yourdomain.com/login`
-   Use default admin credentials from `database/seeders/UserSeeder.php`
-   **Change your password immediately**

### 2. **Configure Organization & Branding**

-   Go to `/settings` and update:
    -   Organization name, logo, favicon
    -   **Custom Branding:** Primary color, secondary color, accent color, election banner
    -   **Custom CSS:** Add your own CSS for advanced customization
    -   Contact information
    -   Email settings (send test email to verify)

### 3. **Create Voter Categories**

-   Go to `/categories`
-   Create categories (e.g., "Students", "Faculty", "Staff")
-   Used to organize voters and restrict position eligibility

### 4. **Add Voters**

**Option A: Add Individual Voters**

-   Go to `/users` → "Add Voter"
-   Required: Name, Email, User ID, Category, Password

**Option B: Bulk Import (Recommended for many voters)**

-   Go to `/users` → "Import Voters"
-   Download the CSV template
-   Fill in voter details (name, email, user_id, category_id, password, is_admin)
-   Upload the CSV file
-   System validates and imports all voters at once

**Option C: Voter Self-Registration**

-   Enable registration in `/settings` → "Is Registration Open"
-   Share registration link: `https://yourdomain.com/register`
-   Voters fill out registration form with their details
-   Admins approve/reject pending registrations at `/users/pending`
-   Approved voters can log in immediately

### 5. **Create Positions**

-   Go to `/positions` and create positions (e.g., "President", "Secretary")
-   Set: Type (single/multiple/yes-no), Max votes, Category restrictions

### 6. **Add Candidates**

-   Go to `/candidates` and add candidates with photos
-   Assign to appropriate positions

### 7. **Test Voting**

-   Log in as test voter and complete voting process
-   Verify emails are sent and votes recorded

### 8. **Start Election**

-   Go to `/settings` → Set dates → Check "Is Election Time"
-   Voters receive "Election Started" email

### 9. **Monitor Results**

-   `/results` - Real-time vote counts (auto-refresh)
-   `/analytics` - Detailed metrics dashboard

### 10. **End Election**

-   Go to `/settings` → Uncheck "Is Election Time"
-   Voters receive "Election Ended" email
-   Export results to Excel/PDF

---

## 🧪 Development

### Running Development Server

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Queue worker (for email notifications)
php artisan queue:work

# Terminal 3: Vite dev server (hot reload)
pnpm run dev
```

### Building for Production

```bash
pnpm run build
```

## � Troubleshooting

**Emails not sending?** Check `.env` mail config and ensure queue worker is running.

**Results not auto-refreshing?** Verify `is_election_time` is enabled in Settings.

**Permission errors?** Run `chmod -R 775 storage bootstrap/cache`

**Queue jobs stuck?** Restart with `php artisan queue:restart`

For more help, check [GitHub Issues](https://github.com/danolu/elections-manager/issues).

## �📝 License

This project is open-source and available under the [MIT License](LICENSE).

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

Feel free to check the [issues page](https://github.com/danolu/elections-manager/issues) or submit a pull request.

## 👨‍💻 Author

**Daniel Oluborode**

-   GitHub: [@danolu](https://github.com/danolu)
-   Website: [danoluborode.space](https://danoluborode.space)

## 🙏 Acknowledgments

-   Built with [Laravel 12](https://laravel.com) - The PHP Framework for Web Artisans
-   Styled with [Tailwind CSS v4](https://tailwindcss.com) - A utility-first CSS framework
-   Reactive components with [Livewire 3.6](https://livewire.laravel.com) - A full-stack framework for Laravel
-   Excel exports powered by [Maatwebsite/Laravel-Excel](https://laravel-excel.com)
-   PDF generation by [Barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
-   Icons from [Heroicons](https://heroicons.com)

## ❓ Frequently Asked Questions

### **Is this free to use?**

Yes! This is open-source software under the MIT License. You only pay for your hosting costs.

### **Can I customize the platform?**

Absolutely! You have full access to the source code. Modify, extend, and customize as needed.

### **Do voters need to create accounts?**

Currently yes. Admins create voter accounts. A "guest voting" feature (vote via email link) is on the roadmap.

### **Can I run multiple elections simultaneously?**

The current version supports one active election at a time. Multi-election support is planned for future releases.

### **Is this suitable for government elections?**

This platform is designed for organizational elections (schools, associations, clubs). For government elections, additional security audits and compliance certifications would be required.

### **Can I migrate from another election platform?**

Yes, but you'll need to manually import your data or create custom import scripts. Contact us if you need help.

### **What about vote anonymity?**

Votes are linked to user accounts for audit purposes. True anonymous voting (where even admins can't trace votes) would require architectural changes.

---

## 🌟 Features Roadmap

Future enhancements being considered:

### **Medium Priority**

-   [ ] **Multi-election support** - Run multiple elections simultaneously
-   [ ] **Custom branding per election** - Different logos/colors for each election
-   [ ] **Advanced analytics** - Demographic breakdowns, participation trends
-   [ ] **Email templates customization** - Visual editor for notification emails
-   [ ] **Voter self-registration** - Allow voters to sign up (with admin approval)

## 📊 Project Stats

-   **Type**: Self-Hosted Election Management System
-   **Laravel Version**: 12.x
-   **PHP Version**: 8.2+
-   **Database**: MySQL/MariaDB
-   **Frontend**: Tailwind CSS v4 + Livewire 3.6
-   **License**: MIT (Free & Open Source)
-   **Status**: Production Ready ✅
-   **Deployment Model**: One installation per organization

---

## 🤝 Support & Community

-   **Issues & Bug Reports**: [GitHub Issues](https://github.com/danolu/elections-manager/issues)
-   **Feature Requests**: [GitHub Discussions](https://github.com/danolu/elections-manager/discussions)
-   **Documentation**: This README + inline code comments
-   **Community**: Open to contributions via pull requests

### **Need Help?**

1. Check the [Troubleshooting](#-troubleshooting) section
2. Search [existing issues](https://github.com/danolu/elections-manager/issues)
3. Create a new issue with detailed information
4. For security vulnerabilities, email the author directly

---

## ⭐ Show Your Support

If this project helped your organization run successful elections, please:

-   ⭐ **Star this repository** on GitHub
-   🐛 **Report bugs** to help improve the platform
-   💡 **Suggest features** you'd like to see
-   🔀 **Contribute code** via pull requests
-   📢 **Share** with other organizations that might benefit

Every star and contribution helps make this platform better for everyone!
