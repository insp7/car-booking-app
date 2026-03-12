<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.cars.index')
            : redirect()->route('car.selection');
    }

    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('cars', AdminController::class);
    });

Route::middleware('auth')->group(function () {
    Route::get('/car-selection', [BookingController::class, 'showCarSelection'])->name('car.selection');

    Route::post('/confirmation', [BookingController::class, 'showConfirmation'])->name('confirmation');
    Route::post('/confirmation-final', [BookingController::class, 'showFinalConfirmation'])->name('confirmation.final');
    Route::post('/confirmation-final/pay', [PaymentController::class, 'mockPay'])->name('confirmation.final.pay');

    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.index');
});
