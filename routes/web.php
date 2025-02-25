<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\CategoryController as PublicCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Admin\SubcategoryController as AdminSubcategoryController;


// 🔹 Группа маршрутов для авторизованных пользователей
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [ShopController::class, 'account'])->name('account');
    Route::get('/account/orders', [OrderController::class, 'index'])->name('orders');
    Route::post('/checkout/process', [OrderController::class, 'store'])->name('checkout.process');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// 🔹 Основные маршруты магазина
Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/category/{slug}', [PublicCategoryController::class, 'show'])->name('category');
Route::get('/category/{categorySlug}/{subcategorySlug}', [SubcategoryController::class, 'show'])->name('subcategory.show');
Route::get('/product/{slug}', [ShopController::class, 'product'])->name('product');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// 🔹 Каталог
Route::get('/catalog', [PublicCategoryController::class, 'catalog'])->name('catalog');

// 🔹 Корзина (общедоступная часть)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// 🔹 Авторизация
Route::middleware('guest')->group(function () { 
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 🔹 Админка
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('products', ProductController::class);
    Route::resource('categories', AdminCategoryController::class);
    
    // Ограничиваем ресурс subcategories, чтобы не было метода show
    Route::resource('subcategories', AdminSubcategoryController::class)->except(['show']);
    
    // Переименовываем маршрут для получения подкатегорий
    Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories'])->name('subcategories.get');
    
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.index');
    Route::patch('/orders/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});