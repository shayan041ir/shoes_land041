سلام اول در 
phpMyAdmin
دیتا بیس مورد نظر را ایجاد میکنیم 
بعد در منوی بال 
SQL
را انتخاب کرده و این دو کد را وارد میکنیم


INSERT INTO `admins` (`name`, `email`, `password`, `remember_token`) 
VALUES ('admin', 'admin@gmail.com', '$2y$12$lZ65kCWu9vC7Sl9Zxz0x4uKIU8Gwy4bmqb/g3FmQBT8SCivDEiJuS', NULL);

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image`, `color`, `material`, `brand`, `created_at`, `updated_at`) VALUES
(2, 'test', 'test', 200.00, 2, NULL, 'red', 'katan', NULL, NULL, NULL);

بعد در ترمینال پروژه دستور 
composer install
را بزنید

بعد ترمینال خود را باز کرده و این دستور را بزنید

php artisan migrate
 
و در فایل 
0001_01_01_000000_create_users_table.php
که در 
D:\shoes_land041\database\migrations
قرار دارد این کد را از حالت کامنت در بیارید
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

و دوباره این دستور را بزنید

php artisan migrate

و در ترمینال خود این دستور را بزنید
php artisan storage:link


و در ترمینال خود این دستور را بزنید
php artisan serve
و در مرورگر خود به آدرس
http://127.0.0.1:8000
مراجعه کنید