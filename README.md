# 🛒 E-Commerce Web App

A simple full-stack e-commerce system built using:

- **Laravel** (API backend)
- **React.js** (frontend)
- **Bootstrap** (for UI)
- **Laravel Sanctum** (for authentication)

---

## 🚀 Features

- Product listing with filtering (by name and price)
- Shopping cart and order placement
- Login authentication
- Order history view

---

## ⚙️ Requirements

### Backend (Laravel)
- PHP >= 8.1
- Composer
- MySQL

### Frontend (React)
- Node.js >= 18
- npm or yarn

---

## 📦 Installation Steps

### 1. Clone the project

git clone https://github.com/mohamed-elshahat-95/e-commerce-system-laravel-react.git
cd ecommerce-project

2. Backend Setup (Laravel)
cd e-commerce-system-laravel-react

# Install dependencies
composer install

# Copy .env file and set your database credentials
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
before run migration, you need to create a database with name (e-commerce-system) then run migration

php artisan migrate

# Serve the app
php artisan serve 

By default, Laravel will run on: http://127.0.0.1:8000

---

3. Frontend Setup (React)
cd e-commerce-system-laravel-react/resources/js

# Install dependencies
npm install

# Start the frontend development server
npm run dev

By default, React will run on: http://localhost:5173

---

# Authentication

- Login API: POST /api/login

- After successful login, a token is stored in localStorage and used in API headers.

- Protected API requests must include:

- Authorization: Bearer YOUR_TOKEN

# Also, you can download the Postman collection where i attached it into project root 

