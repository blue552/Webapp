<!-----------------------MODERN HEADER ----------------------------------------->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Top Bar -->
<div class="header-top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="header-top-left">
                    <div class="header-info-item">
                        <i class="fa fa-phone" style="color: #d4af37;"></i>
                        <span>Hotline: (+84) 1900 xxx xxx</span>
                    </div>
                    <div class="header-info-item">
                        <i class="fa fa-clock-o" style="color: #d4af37;"></i>
                        <span>T2-CN: 8:00 AM - 10:00 PM</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="header-top-right">
                    <div class="header-social">
                        <a href="#" class="social-link"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="social-link"><i class="fa fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fa fa-youtube"></i></a>
                    </div>
                    <div class="header-auth">
                        @auth
                            <div class="user-menu">
                                <a href="#" class="user-link">
                                    <i class="fa fa-user" style="color: #d4af37;"></i>
                                    <span>{{ auth()->user()->name ?? auth()->user()->tendangnhap }}</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="user-dropdown">
                                    @if(auth()->user()->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Admin Panel</a>
                                    @endif
                                    <a href="{{ route('profile') }}"><i class="fa fa-user"></i>Thông tin cá nhân</a>
                                    <a href="{{ route('change-password') }}"><i class="fa fa-key"></i>Đổi mật khẩu</a>
                                    <a href="{{ route('order.history') }}"><i class="fa fa-history"></i>Lịch sử đơn hàng</a>
                                    <a href="{{ route('mailbox') }}"><i class="fa fa-envelope"></i>Hộp thư</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout') }}" class="logout-link"><i class="fa fa-sign-out"></i>Đăng xuất</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="auth-link"><i class="fa fa-sign-in"></i>Đăng nhập</a>
                            <a href="{{ route('register') }}" class="auth-link"><i class="fa fa-user-plus"></i>Đăng ký</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="modern-header">
    <div class="container">
        <div class="header-main">
            <!-- Logo -->
            <div class="header-logo">
                <a href="{{ route('home') }}">
                    <h1 class="logo-text">LuxeAura</h1>
                    <span class="logo-tagline">Luxury Fashion</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="header-nav desktop-nav">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">Trang chủ</a>
                    </li>
                    <li class="nav-item has-dropdown">
                        <a href="#" class="nav-link">
                            Sản phẩm <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-content">
                                @foreach($categories ?? [] as $category)
                                    <a href="{{ route('shop', ['category' => $category->id]) }}" class="dropdown-link">
                                        <i class="fa fa-tag" style="color: #d4af37;"></i>{{ $category->name }}
                                    </a>
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('shop') }}" class="dropdown-link featured">
                                    <i class="fa fa-star" style="color: #d4af37;"></i>Tất cả sản phẩm
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item has-dropdown">
                        <a href="#" class="nav-link">
                            Bộ sưu tập <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-content">
                                @foreach($collections ?? [] as $collection)
                                    <a href="{{ route('collection', $collection->id) }}" class="dropdown-link">
                                        <i class="fa fa-diamond" style="color: #d4af37;"></i>{{ $collection->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li class="nav-item has-dropdown">
                        <a href="{{ route('blog') }}" class="nav-link">
                            Blog <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-content">
                                <a href="{{ route('blog') }}" class="dropdown-link">
                                    <i class="fa fa-newspaper-o" style="color: #d4af37;"></i>Tất cả bài viết
                                </a>
                                <a href="{{ route('blog', ['category' => 'fashion']) }}" class="dropdown-link">
                                    <i class="fa fa-tshirt" style="color: #d4af37;"></i>Thời trang
                                </a>
                                <a href="{{ route('blog', ['category' => 'style']) }}" class="dropdown-link">
                                    <i class="fa fa-star" style="color: #d4af37;"></i>Phong cách
                                </a>
                                <a href="{{ route('blog', ['category' => 'care']) }}" class="dropdown-link">
                                    <i class="fa fa-heart" style="color: #d4af37;"></i>Chăm sóc
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link">Về chúng tôi</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link">Liên hệ</a>
                    </li>
                </ul>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- Search -->
                <div class="header-search">
                    <button class="search-toggle"><i class="fa fa-search"></i></button>
                    <div class="search-form">
                        <form action="{{ route('shop') }}" method="GET">
                            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." class="search-input">
                            <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>

                <!-- Wishlist -->
                <div class="header-wishlist">
                    <a href="{{ route('wishlist') }}" class="wishlist-toggle">
                        <i class="fa fa-heart"></i>
                        <span class="wishlist-count">{{ $wishlistCount ?? 0 }}</span>
                    </a>
                    <div class="wishlist-dropdown">
                        <div class="wishlist-header">
                            <h3>Sản phẩm yêu thích</h3>
                        </div>
                        <div class="wishlist-content">
                            @if(isset($wishlistItems) && count($wishlistItems) > 0)
                                @foreach($wishlistItems as $item)
                                    <div class="wishlist-item">
                                        <div class="item-image">
                                            <img src="{{ asset('images/products/' . $item['thumbnail']) }}" alt="{{ $item['title'] }}">
                                        </div>
                                        <div class="item-details">
                                            <h4><a href="{{ route('product.show', $item['product_id']) }}">{{ $item['title'] }}</a></h4>
                                            <div class="item-price">
                                                <span class="price">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</span>
                                            </div>
                                        </div>
                                        <button class="remove-item" onclick="removeFromWishlist({{ $item['product_id'] }})">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                                <div class="wishlist-footer">
                                    <div class="wishlist-actions">
                                        <a href="{{ route('wishlist') }}" class="btn btn-primary">Xem tất cả</a>
                                    </div>
                                </div>
                            @else
                                @auth
                                    <div class="wishlist-empty">
                                        <i class="fa fa-heart"></i>
                                        <p>Chưa có sản phẩm yêu thích</p>
                                        <a href="{{ route('shop') }}" class="btn btn-primary">Khám phá ngay</a>
                                    </div>
                                @else
                                    <div class="wishlist-empty">
                                        <i class="fa fa-heart"></i>
                                        <p>Đăng nhập để xem sản phẩm yêu thích</p>
                                        <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                                    </div>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Shopping Cart -->
                <div class="header-cart">
                    <a href="{{ route('cart') }}" class="cart-toggle">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="cart-count">{{ $cartCount ?? 0 }}</span>
                    </a>
                    <div class="cart-dropdown">
                        <div class="cart-header">
                            <h3>Giỏ hàng của bạn</h3>
                        </div>
                        <div class="cart-content">
                            @if(isset($cartItems) && !empty($cartItems))
                                @foreach($cartItems as $item)
                                    <div class="cart-item">
                                        <div class="item-image">
                                            <img src="{{ asset('images/products/' . $item['thumbnail']) }}" alt="{{ $item['title'] }}">
                                        </div>
                                        <div class="item-details">
                                            <h4>{{ $item['title'] }}</h4>
                                            <div class="item-size">
                                                <span class="size-label">Size: <strong>{{ $item['size'] }}</strong></span>
                                            </div>
                                            <div class="item-price">
                                                <span class="quantity">{{ $item['quantity'] }} x </span>
                                                <span class="price">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</span>
                                            </div>
                                        </div>
                                        <button class="remove-item" onclick="deleteCart({{ $item['product_id'] }}, '{{ $item['size'] }}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                                <div class="cart-footer">
                                    <div class="cart-total">
                                        <span>Tổng cộng: <strong>{{ number_format($cartTotal ?? 0, 0, ',', '.') }} VNĐ</strong></span>
                                    </div>
                                    <div class="cart-actions">
                                        <a href="{{ route('cart') }}" class="btn btn-outline">Xem giỏ hàng</a>
                                        <a href="{{ route('checkout') }}" class="btn btn-primary">Thanh toán</a>
                                    </div>
                                </div>
                            @else
                                <div class="cart-empty">
                                    <i class="fa fa-shopping-cart"></i>
                                    @auth
                                        <p>Giỏ hàng trống</p>
                                        <a href="{{ route('shop') }}" class="btn btn-primary">Mua sắm ngay</a>
                                    @else
                                        <p>Đăng nhập để xem giỏ hàng</p>
                                        <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Navigation -->
<div class="mobile-nav">
    <div class="mobile-nav-content">
        <div class="mobile-nav-header">
            <h3>Menu</h3>
            <button class="mobile-nav-close">&times;</button>
        </div>
        <nav class="mobile-nav-menu">
            <ul>
                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="has-submenu">
                    <a href="#">Sản phẩm <i class="fa fa-angle-down"></i></a>
                    <ul class="submenu">
                        @foreach($categories ?? [] as $category)
                            <li><a href="{{ route('shop', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('shop') }}">Tất cả sản phẩm</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#">Bộ sưu tập <i class="fa fa-angle-down"></i></a>
                    <ul class="submenu">
                        @foreach($collections ?? [] as $collection)
                            <li><a href="{{ route('collection', $collection->id) }}">{{ $collection->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="{{ route('blog') }}">Blog <i class="fa fa-angle-down"></i></a>
                    <ul class="submenu">
                        <li><a href="{{ route('blog') }}">Tất cả bài viết</a></li>
                        <li><a href="{{ route('blog', ['category' => 'fashion']) }}">Thời trang</a></li>
                        <li><a href="{{ route('blog', ['category' => 'style']) }}">Phong cách</a></li>
                        <li><a href="{{ route('blog', ['category' => 'care']) }}">Chăm sóc</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                <li><a href="{{ route('contact') }}">Liên hệ</a></li>
            </ul>
        </nav>
    </div>
</div>

<!-- Search Overlay -->
<div class="search-overlay">
    <div class="search-overlay-content">
        <button class="search-overlay-close">&times;</button>
        <form action="{{ route('shop') }}" method="GET" class="search-form-overlay">
            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." class="search-input-overlay">
            <button type="submit" class="search-submit-overlay">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
</div>