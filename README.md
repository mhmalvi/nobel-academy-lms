# Nobel Academy LMS

A feature-rich Learning Management System developed for **Nobel Training Academy (NTA)**, delivering a complete online education platform with course management, virtual classrooms, and integrated video conferencing.

## Overview

Nobel Academy LMS is a server-rendered web application built on Laravel 8, providing administrators, tutors, and students with tools for managing courses, tracking progress, conducting assessments, and hosting live sessions via Zoom integration.

## Tech Stack

| Layer       | Technology                                       |
|-------------|--------------------------------------------------|
| Backend     | PHP 7.3+ / 8.0, Laravel 8                       |
| Frontend    | Blade Templates, Vue.js (select components), Tailwind CSS |
| Auth        | Laravel Breeze                                   |
| Database    | MySQL                                            |
| Rich Text   | Quill Editor (PHP Quill Renderer)                |
| Media       | Intervention Image                               |
| Build Tools | Laravel Mix, Webpack                             |
| Testing     | PHPUnit, Mockery                                 |

## Key Features

### Course Management
- Structured courses with units and step-by-step content
- Course categories and enrollment management
- Unit-level file attachments and resources
- Course progress tracking per student

### Virtual Classrooms
- Classroom creation and management
- Announcement posting system
- Activity tracking and engagement monitoring

### Assessments
- Built-in assessment system for student evaluation
- Tutor-managed assessment workflows

### Zoom Integration
- Create and manage Zoom meetings directly from the platform
- Dedicated Zoom meeting component for scheduling live sessions

### User Management
- Multi-role system: Admin, Tutor, Student
- Profile management with photo uploads
- Student and tutor administration panels
- Password management and account activation

### Admin Dashboard
- Complete admin panel for platform oversight
- User management (students, tutors, admins)
- Course and category administration
- Resource management interface

### Security
- Custom encryption helpers
- Request validation layers
- Role-based middleware (Admin, User)

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/              # Admin panel (courses, classrooms, users, assessments)
│   ├── Auth/               # Authentication controllers
│   └── ...                 # Calendar, classrooms, courses, file, zoom
├── Models/                 # Eloquent models (Course, CourseUnit, Classroom, etc.)
├── Http/Helpers/           # Encryption & time utilities
└── Http/Requests/          # Form request validation
resources/
├── views/admin/            # Admin Blade templates
├── js/components/          # Vue components (profile, Zoom meetings)
└── css/                    # Stylesheets
routes/
├── admin.php               # Admin routes
├── auth.php                # Auth routes
├── api.php                 # API routes
└── web.php                 # Web routes
```

## Prerequisites

- PHP >= 7.3
- Composer
- Node.js & npm
- MySQL

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mhmalvi/nobel-academy-lms.git
   cd nobel-academy-lms
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set up the database**

   Configure your MySQL connection in `.env` and run:
   ```bash
   php artisan migrate
   ```

5. **Build frontend assets**
   ```bash
   npm run dev
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

## License

This project is proprietary software developed for Nobel Training Academy.