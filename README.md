# Multi-Vendor E-Commerce Store

A modern multi-vendor e-commerce platform built with Laravel 12, featuring real-time notifications, multi-language support, and a comprehensive admin panel.

## Features

- **Multi-Vendor System**: Support for multiple stores/vendors
- **Product Management**: Categories, products, tags, and inventory management
- **Order Management**: Complete order processing system with order tracking
- **Shopping Cart**: User-friendly shopping cart functionality
- **User Authentication**: Secure authentication using Laravel Fortify
- **Admin Panel**: Comprehensive admin dashboard for managing stores, products, and orders
- **Real-time Notifications**: Pusher integration for real-time updates
- **Multi-Language Support**: Built-in localization support
- **Responsive Design**: Modern UI with TailwindCSS and Alpine.js

## Tech Stack

### Backend
- **Laravel 12** - PHP Framework
- **Laravel Fortify** - Authentication
- **Laravel Sanctum** - API Authentication
- **Pusher** - Real-time Broadcasting

### Frontend
- **TailwindCSS** - CSS Framework
- **Alpine.js** - JavaScript Framework
- **Vite** - Build Tool

### Development Tools
- **Laravel Breeze** - Authentication Scaffolding
- **Laravel Debugbar** - Debugging Tool
- **Laravel IDE Helper** - IDE Autocompletion
- **Pest PHP** - Testing Framework

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/SQLite Database

## Installation

### 1. Clone the repository
```bash
git clone <repository-url>
cd STORE
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Update your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations and Seeders
```bash
php artisan migrate:fresh --seed
```

### 6. Create Storage Link
```bash
php artisan storage:link
```

### 7. Build Assets
```bash
npm run build
# or for development
npm run dev
```

## Quick Setup (Alternative)

Use the automated setup script:
```bash
composer setup
```

This will:
- Install all dependencies
- Copy `.env.example` to `.env`
- Generate application key
- Run migrations
- Install and build frontend assets

## Running the Application

### Development Mode
Run all services concurrently (recommended):
```bash
composer dev
```

This starts:
- Laravel development server (port 8000)
- Queue worker
- Log viewer (Pail)
- Vite development server

### Manual Mode
Alternatively, run services separately:

```bash
# Start Laravel server
php artisan serve

# Start queue worker (in new terminal)
php artisan queue:listen

# Start Vite dev server (in new terminal)
npm run dev
```

## Testing

Run the test suite:
```bash
composer test
# or
php artisan test
```

## Common Artisan Commands

```bash
# Clear configuration cache
php artisan config:clear

# Cache configuration
php artisan config:cache

# View all routes
php artisan route:list

# Create a new controller
php artisan make:controller ControllerName

# Create a new model with migration
php artisan make:model ModelName -m

# Create seeder
php artisan make:seeder SeederName

# Run seeders
php artisan db:seed
```

## Project Structure

```
app/
├── Models/
│   ├── Admin.php
│   ├── Card.php
│   ├── Category.php
│   ├── Order.php
│   ├── OrderAddress.php
│   ├── OrderItem.php
│   ├── Product.php
│   ├── Profile.php
│   ├── Store.php
│   ├── Tag.php
│   └── User.php
└── ...
```

## Configuration

### Pusher Setup (Real-time Features)
Add your Pusher credentials to `.env`:
```env
BROADCAST_CONNECTION=pusher
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster
```

### Queue Configuration
Configure your queue connection in `.env`:
```env
QUEUE_CONNECTION=database
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
