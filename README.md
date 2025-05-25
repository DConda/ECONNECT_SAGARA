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

- PHP 8.1 or higher
- Composer
- Node.js and NPM
- MySQL 5.7 or higher
- Git

## Installation Guide

Follow these steps to set up the project locally:

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/econnect.git
   cd econnect
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Set Up Environment File**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database**
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

5. **Run Migrations and Seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Set Up Storage**
   ```bash
   php artisan storage:link
   ```

7. **Start the Development Server**
   ```bash
   php artisan serve
   ```

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
