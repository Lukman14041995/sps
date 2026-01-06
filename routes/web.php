<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| FRONTEND / PUBLIC ROUTES
|--------------------------------------------------------------------------
| Tidak perlu login
*/
Route::controller(PageController::class)
    ->name('frontend.')
    ->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/about', 'about')->name('about');
        Route::get('/business-units', 'business')->name('business.units');
        Route::get('/news', 'news')->name('news.index');
        Route::get('/csr', 'csr')->name('csr.index');
        Route::get('/career', 'career')->name('career.index');
        Route::get('/contact', 'contact')->name('contact');
    });

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN / LOGOUT)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES (NON ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Change Password (SEMUA USER)
    Route::get('/change-password', [PasswordController::class, 'form'])
        ->name('password.change.form');

    Route::post('/change-password', [PasswordController::class, 'update'])
        ->name('password.change.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (MASTER ONLY)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\{
    DashboardController,
    UserController,
    AboutController,
    BusinessUnitController,
    CareerController,
    ContactController,
    CsrController,
    NewsController,
    NewsCategoryController
};

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:master'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // User Management
        Route::resource('users', UserController::class);

        // About
        Route::resource('about', AboutController::class)
            ->except('show');

        // Business Units
        Route::resource('business-units', BusinessUnitController::class);

        // CSR
        Route::resource('csr', CsrController::class);
          Route::get('/csr/{csr}/edit-json', [CsrController::class, 'editJson'])
         ->name('csr.edit.json');
        Route::post('/csr/bulk-action', [CsrController::class, 'bulkAction'])
            ->name('csr.bulk-action');

        // Career
        // Career - Resource dengan nama singular
Route::resource('career', CareerController::class)->names([
    'index' => 'career.index',
    'create' => 'career.create',
    'store' => 'career.store',
    'show' => 'career.show',
    'edit' => 'career.edit',
    'update' => 'career.update',
    'destroy' => 'career.destroy',
]);
        Route::resource('contact', ContactController::class)
            ->except(['create', 'store']);

        /*
        |--------------------------------------------------------------------------
        | NEWS
        |--------------------------------------------------------------------------
        */
        Route::prefix('news')->name('news.')->group(function () {
           Route::get('/', [NewsController::class, 'index'])->name('index');
Route::get('/create', [NewsController::class, 'create'])->name('create');
Route::post('/', [NewsController::class, 'store'])->name('store');

Route::get('/{news}', [NewsController::class, 'show'])->name('show'); // ← WAJIB DI SINI
Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('edit');
Route::put('/{news}', [NewsController::class, 'update'])->name('update');
Route::delete('/{news}', [NewsController::class, 'destroy'])->name('destroy');
            Route::post('/bulk-action', [NewsController::class, 'bulkAction'])->name('bulk-action');
            Route::post('/{news}/update-status', [NewsController::class, 'updateStatus'])->name('update-status');
            Route::post('/preview', [NewsController::class, 'preview'])->name('preview');
        });

        /*
        |--------------------------------------------------------------------------
        | NEWS CATEGORIES
        |--------------------------------------------------------------------------
        */
        Route::prefix('news-categories')->name('news-categories.')->group(function () {
            Route::get('/', [NewsCategoryController::class, 'index'])->name('index');
            Route::post('/', [NewsCategoryController::class, 'store'])->name('store');
            Route::post('/update-order', [NewsCategoryController::class, 'updateOrder'])->name('update-order');
            Route::post('/update-inline', [NewsCategoryController::class, 'updateInline'])->name('update-inline');
            Route::post('/toggle-status', [NewsCategoryController::class, 'toggleStatus'])->name('toggle-status');
            Route::get('/stats', [NewsCategoryController::class, 'stats'])->name('stats');
            Route::delete('/{id}', [NewsCategoryController::class, 'destroy'])->name('destroy');
        });
    });

require __DIR__ . '/auth.php';
