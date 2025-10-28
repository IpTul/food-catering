# Food Catering

A modern web-based food catering management system built with Laravel framework. This application provides a comprehensive platform for managing catering services, orders, and customer interactions.

## 🚀 Features

- **User Management**: Complete authentication and authorization system
- **Menu Management**: Create, update, and manage food menu items
- **Order Processing**: Handle customer orders from placement to delivery
- **Admin Dashboard**: Comprehensive admin panel for managing operations
- **Responsive Design**: Mobile-friendly interface for accessing from any device
- **Database Management**: Efficient data handling with Laravel's Eloquent ORM

## 📋 Requirements

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM (for frontend assets)
- Apache/Nginx web server

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/IpTul/food-catering.git
   cd food-catering
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=food_catering
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Build assets**
   ```bash
   npm run dev
   # or for production
   npm run build
   ```

9. **Start development server**
   ```bash
   php artisan serve
   ```

   Access the application at `http://localhost:8000`

## 📁 Project Structure

```
food-catering/
├── app/                    # Application core files
│   ├── Http/              # Controllers, Middleware
│   ├── Models/            # Eloquent models
│   └── ...
├── config/                # Configuration files
├── database/              # Migrations, seeders, factories
├── public/                # Public assets
├── resources/             # Views, CSS, JS
│   ├── views/            # Blade templates
│   └── js/               # JavaScript files
├── routes/                # Route definitions
├── storage/               # Logs, cache, uploads
└── tests/                 # Test files
```

## 🎯 Usage

### For Administrators
1. Log in to the admin panel
2. Manage menu items, categories, and pricing
3. View and process customer orders
4. Generate reports and analytics

### For Customers
1. Browse available menu items
2. Add items to cart
3. Place orders with delivery details
4. Track order status

## 🔐 Default Credentials

After seeding the database, you can use these credentials (if applicable):

```
Admin:
Email: admin@foodcatering.com
Password: password

User:
Email: user@foodcatering.com
Password: password
```

**Note**: Change these credentials in production!

## 🛠️ Development

### Running Tests
```bash
php artisan test
```

### Code Formatting
```bash
./vendor/bin/pint
```

### Clearing Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 🌐 Deployment

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Configure web server (Apache/Nginx)
4. Run `composer install --optimize-autoloader --no-dev`
5. Run `php artisan config:cache`
6. Run `php artisan route:cache`
7. Run `php artisan view:cache`
8. Set proper file permissions

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).

## 👤 Author

**IpTul**
- GitHub: [@IpTul](https://github.com/IpTul)

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap/Tailwind CSS (for styling)
- All contributors and supporters

## 📞 Support

For support, please open an issue in the GitHub repository or contact the maintainer.

---

**Note**: This README is a template. Please customize it according to your specific implementation, features, and requirements.
