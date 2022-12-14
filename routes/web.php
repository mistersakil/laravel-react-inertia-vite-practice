<?php

use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Test\FirebaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "home page";
});

## Firebase routes

Route::get('/save-token', [FirebaseController::class, 'saveToken'])->name('saveToken');
// Route::post('/save-token', [FirebaseController::class, 'saveToken'])->name('saveToken');
Route::get('/send-notification', [FirebaseController::class, 'sendNotification'])->name('sendNotificationForm');
Route::post('/send-notification', [FirebaseController::class, 'sendNotification'])->name('sendNotification');

## Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $data['metaTitle'] = "Dashboard";
        return inertia('Backend/Dashboard', $data)->withViewData(['metaTitle' => $data['metaTitle']]);
    });

    ### User routes
    Route::controller(UsersController::class)->prefix('users')->name('users.')->group(function () {
        Route::resource('/', UsersController::class);
    });
});
