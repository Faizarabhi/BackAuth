<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel BackAuth API

This repository contains a Laravel API with authentication using Laravel Passport.

## Setup

1. Clone the repository and navigate to the project directory:

```bash
git clone https://github.com/Faizarabhi/BackAuth.git
cd BackAuth
```

Install the required packages using composer:

```
composer install
```

Set up the database:

Create a MySQL database and update the .env file with the database details:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

```

Run migrations and seed the database:

```
php artisan migrate --seed

```

Generate the encryption keys needed for Passport:

```
php artisan passport:install
```

The server will start at http://localhost:8000.


APIs
Register User
Endpoint: POST /api/register
Description: Register a new user.
Request Body:

```
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "yourpassword"
}
```

Login User
Endpoint: POST /api/login
Description: Login an existing user.
Request Body:

```
{
  "email": "john@example.com",
  "password": "yourpassword"
}

```

Protected Route
Endpoint: GET /api/members/{id}
Description: Get the authenticated user's details.
Headers:

```
Authorization: Bearer <access_token>

```
Replace <access_token> with the actual access token obtained after a successful login.


Get Member by ID
Endpoint: GET /api/members/{id}
Description: Get details of a member by their ID.


Update Member by ID
Endpoint: PUT /api/members/{id}
Description: Update a member's name and email by their ID.
Request Body:
```
{
  "name": "Updated Name",
  "email": "updated@example.com"
}
```

Delete Member by ID
Endpoint: DELETE /api/members/{id}
Description: Delete a member by their ID.


Authentication
This API uses Laravel Passport for authentication. It provides token-based authentication for protecting routes.

Make sure to handle authentication using the provided APIs and include the appropriate authorization headers in requests to protected routes.


GET /api/tasks - Retrieve all tasks
GET /api/tasks/{id} - Retrieve a specific task
POST /api/tasks - Create a new task
PUT /api/tasks/{id} - Update an existing task
DELETE /api/tasks/{id} - Delete a task



The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
