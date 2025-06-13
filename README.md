# A complete Laravel-based project authentication featuring:

- 👥 User Roles & Permissions (via Spatie)
- 📰 Articles Module with CRUD
- 🔐 Authentication (Laravel Breeze)
- 🎨 Tailwind CSS UI + animated welcome screen
- ⚙️ Admin Dashboard for user, role, and permission management

---

## 🚀 Features

- Laravel Breeze authentication (Login/Register)
- Spatie Role & Permission integration
- Assign roles and permissions to users
- Role-based access to articles and admin areas
- Beautiful animated welcome page
- Responsive layout with Tailwind CSS

---

## 📦 Installation

```bash
git clone https://github.com/yourusername/ecommerce-laravel.git
cd ecommerce-laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve
