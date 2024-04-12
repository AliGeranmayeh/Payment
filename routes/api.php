<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\UserSide\DemandsController;
use App\Http\Controllers\AdminSide\DemandController;
use App\Http\Controllers\AdminSide\ReplyController;


Route::post('register', [AuthenticationController::class , 'register'])->name('register');
Route::post('login', [AuthenticationController::class , 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthenticationController::class , 'logout'])->name('logout');

    Route::get('demands', [DemandsController::class , 'index'])->name('demands.index');
    Route::post('demands', [DemandsController::class , 'store'])->name('demands.store');
    Route::get('demands/{demand}', [DemandsController::class , 'show'])->name('demands.show');


    Route::prefix('admin/')->middleware(['admin'])->name('admin.')->group(function () {
        Route::get('demands', [DemandController::class , 'index'])->name('demands.index');
        Route::get('demands/{demand}', [DemandController::class , 'show'])->name('demands.show');
        Route::post('demands/{demand}', [DemandController::class , 'changeStatus'])->name('demands.change.status');
        Route::get('demands/{demand}/download', [DemandController::class , 'download'])->name('demands.file.download');

        Route::post('reply/{demand}', ReplyController::class)->name('reply.declined.demand');
    });
});