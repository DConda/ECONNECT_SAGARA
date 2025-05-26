# Econnect - E-commerce Platform for Recyclable Materials

Econnect is a web-based e-commerce platform designed to facilitate the buying and selling of recyclable materials. The platform connects sellers who have recyclable materials with buyers who can repurpose these materials, promoting sustainability and waste reduction.

## Features

- User authentication (Buyer and Seller roles)
- Product catalog with categories and search functionality
- Advanced filtering and sorting options
- Product management for sellers
- Shopping cart functionality
- Order management system
- Product reviews and ratings
- Favorite products system
- Responsive design for all devices

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- PHP 8.2 or higher
- Composer (latest version)
- Node.js (LTS version recommended) and NPM
- MySQL 5.7 or higher
- Git

## Installation Guide

Follow these steps to set up the project locally:

1. **Create New Laravel Project**
   ```bash
   composer create-project laravel/laravel econnect
   cd econnect
   ```

2. **Install Required PHP Packages**
   ```bash
   # Install Laravel Sanctum for authentication
   composer require laravel/sanctum
   
   # Install Laravel UI for authentication scaffolding
   composer require laravel/ui
   
   # Install Laravel Tinker for database interaction
   composer require laravel/tinker
   ```

3. **Install Development PHP Packages**
   ```bash
   # Install testing and development tools
   composer require --dev fakerphp/faker
   composer require --dev laravel/pail
   composer require --dev laravel/pint
   composer require --dev laravel/sail
   composer require --dev mockery/mockery
   composer require --dev nunomaduro/collision
   composer require --dev phpunit/phpunit
   ```

4. **Install Node.js Dependencies**
   ```bash
   # Install all required Node.js packages
   npm install @tailwindcss/vite@4.0.0
   npm install axios@1.8.2
   npm install concurrently@9.0.1
   npm install laravel-vite-plugin@1.2.0
   npm install tailwindcss@4.0.0
   npm install vite@6.2.4
   ```

5. **Set Up Environment File**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

6. **Configure Database**
   - Open `.env` file and update the following settings:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=econnect
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```
   - Create a new MySQL database named `econnect`

7. **Configure Sanctum**
   ```bash
   # Publish Sanctum configuration
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   
   # Generate Sanctum security key
   php artisan sanctum:install
   ```
   
   Add these lines to your `.env` file:
   ```
   SANCTUM_STATEFUL_DOMAINS=localhost:8000,localhost:3000
   SESSION_DOMAIN=localhost
   ```
   
   Update your `app/Http/Kernel.php` file to add Sanctum middleware in the 'api' middleware group:
   ```php
   'api' => [
       \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
       'throttle:api',
       \Illuminate\Routing\Middleware\SubstituteBindings::class,
   ],
   ```

8. **Set Up Authentication UI**
   ```bash
   # Generate authentication scaffolding
   php artisan ui bootstrap --auth
   
   # Compile the fresh scaffolding
   npm install && npm run dev
   ```

9. **Run Migrations and Seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

10. **Set Up Storage Link**
    ```bash
    php artisan storage:link
    ```

11. **Build Assets**
    ```bash
    npm run build
    ```

12. **Start the Development Server**
    For development with hot reload:
    ```bash
    # Terminal 1: Start Laravel server
    php artisan serve

    # Terminal 2: Start Vite development server
    npm run dev
    ```

    For production:
    ```bash
    npm run build
    php artisan serve
    ```

## Dependencies List

### PHP Dependencies (via Composer)
- Laravel Framework v12.0
- Laravel Sanctum v4.1
- Laravel Tinker v2.10.1
- Laravel UI v4.6

### Development Dependencies (PHP)
- FakerPHP/Faker v1.23
- Laravel Pail v1.2.2
- Laravel Pint v1.13
- Laravel Sail v1.41
- Mockery v1.6
- Nunomaduro Collision v8.6
- PHPUnit v11.5.3

### Node.js Dependencies
- @tailwindcss/vite v4.0.0
- axios v1.8.2
- concurrently v9.0.1
- laravel-vite-plugin v1.2.0
- tailwindcss v4.0.0
- vite v6.2.4

## Testing the Application

1. **Access the Application**
   - Open your browser and go to `http://localhost:8000`

2. **Test Buyer Account**
   - Login using these credentials:
     ```
     Email: buyer@econnect.com
     Password: password123
     ```
   - You can:
     - Browse the catalog
     - Add items to cart
     - Place orders
     - Leave reviews
     - Add products to favorites

3. **Test Seller Account**
   - Login using these credentials:
     ```
     Email: seller@econnect.com
     Password: password123
     ```
   - You can:
     - Add new products
     - Manage existing products
     - View orders
     - Respond to reviews

## Common Issues and Solutions

1. **Storage Link Issues**
   - If images are not displaying, try:
     ```bash
     rm public/storage
     php artisan storage:link
     ```

2. **Database Issues**
   - If you encounter database errors, try:
     ```bash
     php artisan config:clear
     php artisan migrate:fresh --seed
     ```

3. **Composer Issues**
   - If you have dependency issues:
     ```bash
     composer clear-cache
     composer update
     ```

## Project Structure

- `app/` - Contains the core code of the application
- `database/` - Contains database migrations and seeders
- `public/` - Contains publicly accessible files
- `resources/` - Contains views and frontend assets
- `routes/` - Contains route definitions
- `storage/` - Contains uploaded files and logs

## Contributing

If you'd like to contribute to this project:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/improvement`)
3. Make your changes
4. Commit your changes (`git commit -am 'Add new feature'`)
5. Push to the branch (`git push origin feature/improvement`)
6. Create a Pull Request

## Support

If you encounter any issues or need assistance:

1. Check the Common Issues section above
2. Review the Laravel documentation: https://laravel.com/docs
3. Contact the project maintainer
4. Create an issue in the GitHub repository

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

- Built with Laravel Framework
- Uses Bootstrap for styling
- Icons from FontAwesome
- Product images sourced from project contributors
