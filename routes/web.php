<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::resource('products', ProductController::class);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile-picture.update');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/manageUsers', [AdminController::class, 'index'])->name('admin.manageUsers');
    Route::get('/admin/userInformation', [AdminController::class, 'userInformation'])->name('admin.userInformation');

    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.addNewUser');

    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::get('/suppliers/supplierInformation/{id}', [AdminController::class, 'supplierInformation'])->name('suppliers.supplierInformation');

    Route::get('products/{id}/edit', [ProductController::class, 'edit']);

    Route::resource('admin', AdminController::class);
    Route::get('/admin/userInformation/{id}', [AdminController::class, 'userInformation'])->name('admin.userInformation');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

    Route::get('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.create');
    Route::put('/admin/updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');

});