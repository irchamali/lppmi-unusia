# LPPMI UNUSIA

LPPMI UNUSIA is the web application for the Internal Quality Assurance and Monitoring Institution of Universitas Nahdlatul Ulama Indonesia (UNUSIA). It provides a public information portal, content publishing tools, and a role-based quality-document workflow.

## Patch 2 and Framework Upgrade

This repository contains **Patch 2**. The application has been upgraded to the current CodeIgniter 4 release line, using **CodeIgniter 4.7+** and **PHP 8.2+**. The upgrade modernizes project dependencies while preserving the public site, dashboard, and document-management workflows.

## Features

### Public Portal

- Home page, institutional profile, strategy map, milestones, work descriptions, organization structure, team, workflow, and routine monitoring information.
- News posts with search, categories, tags, author archives, comments, and newsletter subscriptions.
- Accreditation information and programme study data.
- Document and report catalogues with detail pages and categories.
- Quality-assurance forms, including AMI, non-academic audit, strategic plan, operational plan, performance report, and SPMI forms.
- Gallery, contact form, and complaint page.

### Role-Based Dashboards

| Role | Main responsibilities |
| --- | --- |
| Administrator | Manages posts, programmes, partners, services, categories, tags, inbox, comments, subscribers, documents, reports, accreditation, study programmes, homepage content, users, and site settings. |
| Author | Creates and manages posts, post categories, tags, comments, and the author profile. |
| Manager | Creates, updates, and manages the documents assigned to the signed-in manager. |
| Validator | Reviews documents within the validator's assigned scope and approves, requests revision of, or rejects submitted documents. Revision and rejection require validation notes. |

Document access is protected by authentication and role filters. Validator decisions are recorded with the validator, timestamp, status, and notes.

## Architecture

### Backend

- PHP 8.2+
- CodeIgniter 4.7+
- MariaDB or MySQL
- CodeIgniter routing, filters, sessions, validation, migrations, and seeders
- Composer dependency management
- PHPUnit 9 for automated tests
- Kint for development debugging

### Frontend

- Server-rendered CodeIgniter views for the public portal and dashboards
- Bootstrap-based public and administrative interfaces
- jQuery and jQuery UI
- DataTables, Summernote, Chart.js, Toastr, Moment.js, and Dropify
- Public-site assets include AOS, GLightbox, Swiper, Isotope, PureCounter, Waypoints, Boxicons, and Bootstrap Icons

The public template assets are located in `public/assets/elixir`; dashboard assets are located in `public/assets/backend`.

## Installation

1. Install PHP 8.2+, Composer, and MariaDB or MySQL.
2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Copy the environment template and configure the database connection:

   ```bash
   cp env .env
   ```

4. Set `database.default.*` values and `app.baseURL` in `.env`.
5. Run database migrations when required by your environment:

   ```bash
   php spark migrate
   ```

6. Start the local development server:

   ```bash
   php spark serve
   ```

The application will be available at `http://localhost:8080` by default.

## Useful Commands

```bash
# Run the test suite
composer test

# List registered routes
php spark routes

# Clear application caches
php spark cache:clear
```

## Project Structure

```text
app/
  Config/        Application, route, filter, database, and security configuration
  Controllers/   Public controllers plus Admin, Author, Manager, and Validator areas
  Models/        Database access and workflow logic
  Views/         Public portal, dashboard, and authentication views
  Database/      Migrations and seeders
public/          Web root and frontend assets
tests/           PHPUnit tests and test support files
writable/        Logs, cache, sessions, and uploaded files
```

## License

See [LICENSE](LICENSE).

<hr>
