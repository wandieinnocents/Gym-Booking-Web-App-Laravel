<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduledClassController;
use App\Http\Controllers\BookingController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');


//instructor routes
Route::middleware(['auth','checkUserRole:instructor'])->group(function(){
    Route::get('/instructor/dashboard',  function () {
        return view('instructor.dashboard');
    })->name('instructor.dashboard');

    Route::resource('/instructor/schedule', ScheduledClassController::class);
});

//admin routes
Route::middleware(['auth','checkUserRole:admin'])->group(function(){
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

});


// member routes 
Route::middleware(['auth','checkUserRole:member'])->group(function(){
    Route::get('/member/dashboard', function () {
        return view('member.dashboard');
    })->name('member.dashboard');


    Route::get('/member/book',[ BookingController::class,'create'])->name('booking.create');
    Route::post('/member/book',[ BookingController::class,'store'])->name('booking.store');
    Route::get('/member/bookings',[ BookingController::class,'index'])->name('booking.index');
    Route::delete('/member/bookings/{id}',[ BookingController::class,'destroy'])->name('booking.destroy');


});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
