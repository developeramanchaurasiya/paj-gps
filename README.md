# Laravel API Project

This is a RESTful API built using Laravel 10 for managing users, authentication, and device access. It includes various endpoints for user registration, login, device management, and token-based authentication using Laravel's built-in features.

## Table of Contents
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [API Endpoints](#api-endpoints)
  - [POST /register](#post-register)
  - [POST /login](#post-login)
  - [POST /token/refresh](#post-token-refresh)
  - [GET /user](#get-user)
  - [GET /devices](#get-devices)
  - [GET /devices/{id}](#get-device)
  - [POST /logout](#post-logout)
- [Example Requests](#example-requests)
- [License](#license)

## Technologies Used

- **PHP 8.0+**
- **Laravel 10**
- **MySQL**
- **Postman (for API testing)**

## Installation

### Prerequisites
- Make sure you have PHP 8.0+ installed.
- Install Composer (PHP package manager).
- Install MySQL or use a MySQL-compatible database.

### Setup Steps

1. Clone the repository:

   ```bash
   git clone https://github.com/developeramanchaurasiya/paj-gps.git
   cd your-repository
