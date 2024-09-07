# Iranian University

Iranian University is a comprehensive university management system built with Laravel. It provides features to manage students, courses, faculties, and more.

## Features

- Student registration and management
- Course creation and enrollment
- Faculty and staff management
- Timetable and scheduling
- Grade and transcript management
- Multi-language support

## Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL or PostgreSQL
- Node.js and npm (for frontend assets)

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/iranian-university.git
    cd iranian-university
    ```

2. Install PHP dependencies:
    ```bash
    composer install
    ```

3. Install JavaScript dependencies:
    ```bash
    npm install
    npm run dev
    ```

4. Copy the `.env.example` file to `.env` and configure your environment variables:
    ```bash
    cp .env.example .env
    ```

5. Generate an application key:
    ```bash
    php artisan key:generate
    ```

6. Run the database migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```

7. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

1. Access the application in your web browser at `http://localhost:8000`.

2. Register a new user or log in with the default admin credentials:
    - Email: `admin@example.com`
    - Password: `password`

3. Navigate through the dashboard to manage students, courses, faculties, and other university-related data.

## Project Structur

iranian-university/
│
├── app/ # Application core files
├── bootstrap/ # Bootstrap files
├── config/ # Configuration files
├── database/ # Migrations, seeders, and factories
├── public/ # Public assets
├── resources/ # Views, language files, and assets
├── routes/ # Route definitions
├── storage/ # Storage for logs, cache, and other files
├── tests/ # Automated tests
├── .env.example # Example environment configuration
├── artisan # Artisan command-line tool
├── composer.json # Composer dependencies
├── package.json # NPM dependencies
├── README.md # Project documentation
└── webpack.mix.js # Laravel Mix configuratione



## Extending the System

To add new modules or features, you can create new controllers, models, and views within the `app` and `resources` directories. Follow the Laravel documentation for best practices.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## 📞 Contact Me
<div align="center">
    <a href="https://www.linkedin.com/in/hesam-ahmadpour" style="color: red; font-size: 20px; text-decoration: none;">LinkedIn</a> |
    <a href="https://t.me/morpheusadam" style="color: red; font-size: 20px; text-decoration: none;">Telegram</a>
</div>

