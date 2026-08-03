# Campus Core

Campus Core (project name `Iranian University`) is a Laravel 10 university management system for institutions and developers who need to manage students, staff, courses, schedules, and attendance in one application.

## Overview

The system covers the core academic entities: students, professors, colleges (faculties), educational groups, courses and lessons, classrooms, locations, academic terms, time periods, schedules, and attendance records.

Access is governed by role-based permissions built on Spatie Laravel Permission, with dedicated middleware for the Admin, Faculty Head, Educational Supervisor, and Professor roles. Dates use the Jalali (Persian) calendar through `morilog/jalali`, and documents can be generated as Word files via PHPWord or as PDFs.

## Features

- Student registration and management
- Professor and staff management
- College (faculty) and educational group management
- Course and lesson creation and management
- Classroom and location management
- Academic terms and time periods
- Scheduling and timetables
- Presence and absence (attendance) tracking
- Role-based access control for Admin, Faculty Head, Educational Supervisor, and Professor
- Entry and enrollment management
- Document and report generation via PHPWord and PDF
- Jalali (Persian) calendar support

## Requirements

- PHP 8.1 or later with Composer
- MySQL (or PostgreSQL)
- Node.js and npm for frontend assets

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/morpheusadam/CampusCore.git
cd iranian-univercity

# 2. Install dependencies
composer install
npm install
npm run dev

# 3. Configure environment
cp .env.example .env
php artisan key:generate

# 4. Set database credentials in .env, then migrate and seed
php artisan migrate --seed

# 5. Serve the application
php artisan serve
```

## Usage

1. Open `http://localhost:8000` in a browser.
2. Log in or register, then use the dashboard to manage students, professors, colleges, courses, schedules, and attendance.
3. What each account sees depends on its role: Admin, Faculty Head, Educational Supervisor, or Professor.

## Tech stack

| Layer | Technologies |
| --- | --- |
| Backend | Laravel 10, PHP 8.1+, Laravel Sanctum, Tinker |
| Authorization | Spatie Laravel Permission |
| Frontend | Blade, Bootstrap, Bootstrap Icons, Select2, jQuery, Sass, Vite |
| Documents | morilog/jalali, PHPWord, misterspelik/laravel-pdf |
| Forms | LaravelCollective HTML, Laravel UI |

## Project structure

```text
iranian-univercity/
├── app/
│   ├── Http/Controllers/   # ClassRoom, Collage, EducationalGroup,
│   │                       # Professor, Lesson, Schedule, Term,
│   │                       # PresenceAndAbsence, Entry, User...
│   ├── Http/Middleware/    # Admin, FacultyHead, EducationalSupervisor,
│   │                       # Professor, Role, TermExists...
│   ├── Models/             # Collage, Professor, Term, Classroom,
│   │                       # Lesson, Location, presenceAndAbsence...
│   └── Providers/
├── config/                 # configuration files
├── resources/              # Blade views & frontend assets
└── routes/                 # route definitions
```

## Contributing

Open an [issue](https://github.com/morpheusadam/CampusCore/issues) or submit a pull request with new features, fixes, or improvements.

## License

Built on the Laravel framework, which is MIT licensed. Add a `LICENSE` file to clarify the distribution terms of this project.

## Author

Morpheus Adam — [GitHub](https://github.com/morpheusadam) · [sam.zeonic.me](https://sam.zeonic.me) · morpheusadam95@gmail.com
