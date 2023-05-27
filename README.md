# Contacts Application

This is a Laravel 8.7 application utilizing Breeze for authentication and Tailwind for frontend, implementing a simple CRUD (Create, Read, Update, Delete) system for contacts.

## Requirements

- PHP 7.4.33
- Laravel 8.7
- MySQL or similar SQL database

## Features

- Breeze authentication, with secured routes (all except the index)
- CRUD for contacts
- Validations for contact data
- Unit tests

## Installation

1. Clone this repository

```bash
git clone https://github.com/yourusername/contacts-application.git
```

2. Navigate into the project directory and install dependencies

```bash
cd contacts-application
composer install
npm install
```

3. Copy `.env.example` to `.env` and modify the database credentials to match your environment

```bash
cp .env.example .env
```

4. Generate an application key

```bash
php artisan key:generate
```

5. Run the migrations

```bash
php artisan migrate
```

6. Start the local development server

```bash
php artisan serve
```

The application should now be available at `http://localhost:8000`

## Testing

The application comes with feature tests. To run the tests, use the artisan command:

```bash
php artisan test
```

You can specify a test database in your `.env.testing` file for the test stop deleting your database.

## Validation Rules

Once logged in, a user can create, view, update, and delete contacts. All inputs are validated according to the following rules:

- Name: required, minimum of 5 characters, maximum of 255 characters
- Contact: required, must be exactly 9 digits, must be unique
- Email: required, must be valid email format, maximum of 255 characters, must be unique

