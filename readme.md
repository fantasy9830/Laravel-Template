# Laravel範例，包含登入、權限控制功能實作及子系統模組化架構

# Installation

## Composer
```bash
composer install
```

## Recovery .env
```bash
cp .env.example .env
php artisan key:generate
```

## Migrate
```bash
php artisan migrate
```

## User Model
* 至少需要 `id` 和 `name` 欄位。

## Seeder
* 假資料(已先刪除)
```bash
php artisan db:seed --class=PermissionTableSeeder
```

## 子系統
* 可於 `app/Providers/RouteServiceProvider.php` 內使用 `mapRoutes('系統名稱')` 加入。
