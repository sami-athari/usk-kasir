<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Kopiku') }} - Cafe Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-amber-50 via-white to-red-50 min-h-screen">
    <!-- Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-amber-500 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-red-500 to-amber-500 bg-clip-text text-transparent">Kopiku</span>
                </div>

                <!-- Nav Links -->
                @if (Route::has('login'))
                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-medium rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 text-gray-600 hover:text-red-600 text-sm font-medium transition-colors duration-200">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-medium rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="pt-24">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 rounded-full">
                        <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                        <span class="text-sm font-medium text-amber-700">Cafe Management System</span>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Manage Your <span class="bg-gradient-to-r from-red-500 to-amber-500 bg-clip-text text-transparent">Coffee Shop</span> with Ease
                    </h1>

                    <p class="text-lg text-gray-600 leading-relaxed max-w-lg">
                        Streamline your cafe operations with our intuitive POS system. Track orders, manage inventory, and grow your business.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        @auth
                            <a href="{{ url('/order') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-2xl hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Start Ordering
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-2xl hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                Get Started
                            </a>
                        @endauth
                        <a href="#features" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-gray-700 font-semibold rounded-2xl border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300">
                            Learn More
                        </a>
                    </div>
                </div>

                <!-- Right Content - Illustration -->
                <div class="relative">
                    <div class="absolute -top-10 -right-10 w-72 h-72 bg-amber-200 rounded-full opacity-30 blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-red-200 rounded-full opacity-30 blur-3xl"></div>

                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
                        <!-- Mock POS Interface -->
                        <div class="space-y-6">
                            <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                                <span class="font-semibold text-gray-900">Today's Orders</span>
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">Active</span>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-amber-600 rounded-xl flex items-center justify-center">
                                        <span class="text-white text-lg">☕</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">Cappuccino</p>
                                        <p class="text-sm text-gray-500">x2</p>
                                    </div>
                                    <span class="font-semibold text-red-600">Rp 50K</span>
                                </div>

                                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-xl flex items-center justify-center">
                                        <span class="text-white text-lg">🍰</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">Red Velvet Cake</p>
                                        <p class="text-sm text-gray-500">x1</p>
                                    </div>
                                    <span class="font-semibold text-red-600">Rp 35K</span>
                                </div>

                                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-red-500 rounded-xl flex items-center justify-center">
                                        <span class="text-white text-lg">🥐</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">Croissant</p>
                                        <p class="text-sm text-gray-500">x3</p>
                                    </div>
                                    <span class="font-semibold text-red-600">Rp 45K</span>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Total</span>
                                    <span class="text-2xl font-bold text-gray-900">Rp 130K</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Everything You Need</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Powerful features to help you manage and grow your cafe business</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="group p-8 bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100 hover:border-red-200 hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-amber-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Order Management</h3>
                        <p class="text-gray-600">Efficiently process orders with our intuitive POS interface. Fast, simple, and reliable.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group p-8 bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100 hover:border-red-200 hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-amber-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Financial Reports</h3>
                        <p class="text-gray-600">Get detailed insights into your sales, expenses, and profit margins with comprehensive reports.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group p-8 bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100 hover:border-red-200 hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-amber-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Inventory Tracking</h3>
                        <p class="text-gray-600">Keep track of your ingredients and products. Get alerts when stock is running low.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-amber-500 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">Kopiku</span>
                </div>
                <p class="text-gray-400 text-sm">© {{ date('Y') }} Kopiku. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
