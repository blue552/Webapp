# Image PHP 8.2 có đủ extension cho Laravel
FROM php:8.2-cli

# Cài đặt gói hệ thống + extension PHP cần thiết
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl gnupg \
    && docker-php-ext-install pdo_mysql mbstring zip bcmath

# Cài composer (từ image composer chính thức)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Cài Node.js 20 để build Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Thư mục làm việc
WORKDIR /app

# Copy toàn bộ source vào container
COPY . .

# Phân quyền storage và cache
RUN chmod -R 777 storage bootstrap/cache

# Tạo thư mục cho images
RUN mkdir -p storage/app/public/images/products && chmod -R 777 storage/app/public

# Cài PHP dependencies và build frontend
RUN composer install --no-dev --optimize-autoloader \
 && npm install \
 && npm run build

# Khi container start: migrate + seed + storage link rồi mới serve
CMD php artisan migrate --force \
 && php artisan db:seed --force \
 && php artisan storage:link || true \
 && php artisan serve --host 0.0.0.0 --port ${PORT:-8000}