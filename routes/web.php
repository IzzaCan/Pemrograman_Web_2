<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;


Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products'])->name('products.index');
Route::get('product/{slug}', [HomepageController::class, 'product'])->name('product.show');
Route::get('categories', [HomepageController::class, 'categories'])->name('categories.index');
Route::get('category/{slug}', [HomepageController::class, 'category'])->name('category.show');
Route::get('cart', [HomepageController::class, 'cart'])->name('cart');
Route::get('checkout', [HomepageController::class, 'checkout'])->name('checkout');


Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';



    //------Pertemuan Ketiga - Blade Template------//

    // Route::get('/', function(){
    // $title = "Homepage";
    // return view('web.homepage',['title'=>$title]);
    // });
    // Route::get('products', function(){
    // $title = "Products";
    // return view('web.products',['title'=>$title]);
    // });
    // Route::get('product/{slug}', function($slug){
    // $title = "Single Product";
    // return view('web.single_product',['title'=>$title,'slug'=>$slug]);
    // });
    // Route::get('categories', function(){
    // $title = "Categories";
    // return view('web.categories',['title'=>$title]);
    // });
    // Route::get('category/{slug}', function($slug){
    // $title = "Single Category";
    // return view('web.single_category',['title'=>$title,'slug'=>$slug]);
    // });
    // Route::get('cart', function(){
    // $title = "Cart";
    // return view('web.cart',['title'=>$title]);
    // });
    // Route::get('checkout', function(){
    // $title = "Checkout";
    // return view('web.checkout',['title'=>$title]);
    // });

    //------Pertemuan Ketiga - Blade Template------//






// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/products', function () {
//     return view('products');
// });

// Route::get('/products/{id}', function ($id) {
//     return view('product-detail', ['id' => $id]);
// });

// Route::get('/cart', function () {
//     return view('cart');
// });

// Route::get('/checkout', function () {
//     return view('checkout');
// });
