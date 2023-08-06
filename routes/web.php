<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');

Route::group(['middleware' => ['auth']], function () {

    // Autentication
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Tipos de planilhas
    Route::get('/planilhas', [App\Http\Controllers\WorksheetController::class, 'index']);
    Route::get('/planilha/listar', [App\Http\Controllers\WorksheetController::class, 'list']);
    Route::post('/planilha/cadastrar', [App\Http\Controllers\WorksheetController::class, 'store']);
    Route::put('/planilha/editar', [App\Http\Controllers\WorksheetController::class, 'update']);
    Route::delete('/planilha/deletar', [App\Http\Controllers\WorksheetController::class, 'destroy']);

    Route::group(['middleware' => ['admin']], function () {

        // Unidades
        Route::get('/unidades', [App\Http\Controllers\UnitController::class, 'index']);
        Route::get('/unidade/listar', [App\Http\Controllers\UnitController::class, 'list']);
        Route::post('/unidade/cadastrar', [App\Http\Controllers\UnitController::class, 'store']);
        Route::put('/unidade/editar', [App\Http\Controllers\UnitController::class, 'update']);
        Route::delete('/unidade/deletar', [App\Http\Controllers\UnitController::class, 'destroy']);

        // Tipos de planilhas
        Route::get('/estrutura-planilhas', [App\Http\Controllers\WorksheetStructureController::class, 'index']);
        Route::get('/estrutura-planilha/listar', [App\Http\Controllers\WorksheetStructureController::class, 'list']);
        Route::post('/estrutura-planilha/cadastrar', [App\Http\Controllers\WorksheetStructureController::class, 'store']);
        Route::put('/estrutura-planilha/editar', [App\Http\Controllers\WorksheetStructureController::class, 'update']);
        Route::delete('/estrutura-planilha/deletar', [App\Http\Controllers\WorksheetStructureController::class, 'destroy']);

    });

});
