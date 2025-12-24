<!-- Simple Navigation -->
<nav class="shadow" style="background: #e8dcc6;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-black">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-black hover:text-gray-700">
                        Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-black hover:text-gray-700">
                        Sản phẩm
                    </a>
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-black hover:text-gray-700">
                        Danh mục
                    </a>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-black hover:text-gray-700">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-black hover:text-red-600">
                        @csrf
                        <button type="submit">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
