## Laravel E‑Commerce (Laravel 12)

Ứng dụng quản lý sản phẩm & danh mục bánh ngọt (web + API), dùng Laravel 12, Vite, Tailwind và MySQL (Aiven) hoặc SQLite.

Ứng dụng mô phỏng một **cửa hàng bánh online** với khu vực quản trị đơn giản nhưng hiện đại:
- Người dùng đăng ký / đăng nhập bằng Laravel Breeze, sau đó truy cập dashboard với banner, thống kê nhanh và các sản phẩm nổi bật.
- Quản trị viên có thể **tạo sản phẩm** với tên, mô tả, giá, tồn kho, hình ảnh và gán vào một loại bánh phù hợp.
- Danh mục (loại bánh) được seed sẵn (Gato, Tiramisu, Mochi, Cupcake, Cookie, Donut, Tart, Cheesecake) để bạn dùng ngay.
- Mỗi sản phẩm hiển thị đẹp ở trang danh sách: ảnh, tên, giá, tồn kho, tag danh mục và các nút Xem / Sửa / Xóa.
- Trang chi tiết danh mục cho phép xem nhanh tất cả sản phẩm thuộc loại bánh đó.

Phần API cung cấp các endpoint `/api/products` để:
- Lấy danh sách sản phẩm (JSON) phục vụ frontend khác hoặc mobile app.
- Xem chi tiết, tạo mới, cập nhật, xóa sản phẩm (RESTful, có validation).

Ứng dụng được thiết kế để chạy **local với Aiven MySQL** (dùng service MySQL trên Aiven làm database chính) và vẫn có thể chuyển sang SQLite khi cần.

### 1. Cài đặt nhanh (local + Aiven MySQL)

```bash
git clone <repository-url>
cd laravel-projects

composer install
npm install
```

Tạo file `.env` (có thể copy từ `.env.example`) và cấu hình **MySQL của Aiven**:

```env
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=<host từ Aiven>
DB_PORT=<port>
DB_DATABASE=defaultdb
DB_USERNAME=avnadmin
DB_PASSWORD=<password>

MYSQL_ATTR_SSL_CA=storage/app/ca-certificate.crt
MYSQL_ATTR_SSL_VERIFY_SERVER_CERT=false
```

- Tải CA certificate từ Aiven Console và lưu vào `storage/app/ca-certificate.crt`.

Chạy migrations + seeder tạo loại sản phẩm:

```bash
php artisan migrate
php artisan db:seed --class=CategorySeeder
```

Build/frontend:

```bash
npm run dev     # dev
# hoặc
npm run build   # production
```

Chạy ứng dụng:

```bash
php artisan serve
```

Truy cập `http://localhost:8000`.

### 2. Tính năng chính

- Quản lý sản phẩm (CRUD, upload ảnh, tồn kho, giá).
- Quản lý danh mục; mỗi sản phẩm gắn 1 hoặc nhiều danh mục.
- Auth bằng Laravel Breeze (đăng ký / đăng nhập / profile).
- API `products` (GET/POST/PUT/DELETE) trả về JSON.

### 3. Lệnh hữu ích

```bash
php artisan migrate:fresh --seed   # reset DB + seed lại
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 4. Ghi chú

- Nhớ chạy `CategorySeeder` trước khi thêm sản phẩm.
- Với production, luôn dùng `APP_DEBUG=false` và `php artisan config:cache`.
