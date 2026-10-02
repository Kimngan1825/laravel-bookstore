# 📚 Bookstore E-Commerce Platform

A full-featured e-commerce bookstore platform built with Laravel 10.  
The project supports customer shopping, checkout with discount coupons, and administrative management of books, inventory, orders, users, and promotions.

## Features

### For Customers

- Browse and search books by category and price
- View book details and customer reviews
- Add and update items in the shopping cart
- Checkout with multiple payment methods: COD, Bank Transfer, and E-Wallet
- Apply discount coupons
- Manage favorite books
- View order history
- Update profile information and shipping addresses

### For Admins

- Dashboard with revenue statistics
- Manage books and inventory
- Manage categories
- Manage users and roles
- Manage orders and order status
- Manage coupons and promotions
- Moderate customer reviews

## Tech Stack

- **Backend:** Laravel 10, PHP 8.1+
- **Frontend:** Blade, Tailwind CSS, JavaScript
- **Database:** MySQL 8.4
- **Authentication:** Laravel Breeze, Google OAuth

## Installation & Setup

### 1. Clone the repository

```bash
git clone https://github.com/Kimngan1825/laravel-bookstore.git
cd laravel-bookstore
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Set up the environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure the database

Update the database configuration in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstore_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Import the database

```bash
mysql -u root -p < bookstore_db.sql
```

### 6. Run the application

```bash
npm run dev
```

In another terminal:

```bash
php artisan serve
```

Open the application at:

```text
http://localhost:8000
```

## Main User Flow

1. Browse books from the homepage
2. Search or filter books by category and price
3. View book details
4. Add books to the shopping cart
5. Review and update cart items
6. Apply a coupon if applicable
7. Enter checkout information
8. Select a payment method
9. Place the order
10. View the order in order history

## Admin Flow

1. Log in with an admin account
2. Open the admin dashboard
3. Manage books and inventory
4. Manage orders and update order status
5. Manage users and roles
6. Manage coupons and promotions
7. Moderate customer reviews

## Database

The repository includes a database dump:

```text
bookstore_db.sql
```

The database contains sample data for the application, including:

- 70+ sample books
- 50+ sample users
- Categories
- Coupons and discounts
- Sample orders
- Customer reviews

Importing the SQL file provides sample data for testing the application.

## Project Structure

```text
app/
└── Http/
    └── Controllers/
        ├── HomeController.php
        ├── Controller4.php
        ├── OrderController.php
        ├── ProfileController.php
        ├── FavoriteController.php
        └── Controller2.php

routes/
└── web.php

database/
└── bookstore_db.sql
```

## Key Implementation

### Stock Management

- Validates available inventory before processing an order
- Uses database transactions for order processing
- Includes inventory checks to prevent orders from exceeding available stock

### Coupon System

- Supports discount codes with configurable conditions
- Validates minimum order value
- Validates coupon expiration
- Supports usage limits

### Order Processing

- Processes order creation within a database transaction
- Saves order information and related order items as part of the checkout process

### Email Notification

- Sends order confirmation emails after checkout
- SMTP configuration is required for email functionality

## Team Contributions

This project was developed as a group assignment.

- **Ngân:** Product display and search functionality
- **Quang:** Shopping cart, checkout, and payment
- **Châu:** Email notifications and review moderation
- **Other members:** Additional project features

## Configuration Notes

### Email

Email notifications require SMTP configuration in `.env`.

### Google OAuth

Google authentication requires the corresponding client ID and client secret to be configured in `.env`.

### Environment Variables

Sensitive information such as database credentials, SMTP credentials, and OAuth secrets should be stored in `.env` and should not be committed to the repository.

## Future Improvements

- Add automated testing
- Refactor and improve code structure
- Integrate real payment gateways
- Improve admin analytics and reporting

## Project Status

🎓 Educational group project  
📦 Ready for local testing