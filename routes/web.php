<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::group(['middleware' => ['auth']], function () {

    // Deslogar
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Parametros
    Route::get('/parametros', [App\Http\Controllers\ParameterController::class, 'index']);
    Route::get('/parametro/listar', [App\Http\Controllers\ParameterController::class, 'list']);
    Route::post('/parametro/cadastrar', [App\Http\Controllers\ParameterController::class, 'store']);
    Route::put('/parametro/editar', [App\Http\Controllers\ParameterController::class, 'update']);
    Route::delete('/parametro/deletar', [App\Http\Controllers\ParameterController::class, 'destroy']);

    // Tipos de parametros
    Route::get('/tipo-parametros', [App\Http\Controllers\ParameterTypeController::class, 'index']);
    Route::get('/tipo-parametro/listar', [App\Http\Controllers\ParameterTypeController::class, 'list']);
    Route::post('/tipo-parametro/cadastrar', [App\Http\Controllers\ParameterTypeController::class, 'store']);
    Route::put('/tipo-parametro/editar', [App\Http\Controllers\ParameterTypeController::class, 'update']);
    Route::delete('/tipo-parametro/deletar', [App\Http\Controllers\ParameterTypeController::class, 'destroy']);

    // Usuários
    Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/usuario/listar', [App\Http\Controllers\UserController::class, 'list']);
    Route::post('/usuario/cadastrar', [App\Http\Controllers\UserController::class, 'store']);
    Route::put('/usuario/editar', [App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/usuario/deletar', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::group(['middleware' => ['admin']], function () {

        // Unidades
        Route::get('/unidades', [App\Http\Controllers\UnitController::class, 'index']);
        Route::get('/unidade/listar', [App\Http\Controllers\UnitController::class, 'list']);
        Route::post('/unidade/cadastrar', [App\Http\Controllers\UnitController::class, 'store']);
        Route::put('/unidade/editar', [App\Http\Controllers\UnitController::class, 'update']);
        Route::delete('/unidade/deletar', [App\Http\Controllers\UnitController::class, 'destroy']);

    });

});

// Autentication
// Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
// Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
// Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
// Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
// Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
// Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('register', [RegisteredUserController::class, 'store']);
// Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
// Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
// Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
// Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
