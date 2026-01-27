<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CategoryCsrController;
use App\Http\Controllers\CategoryLokerController;
use App\Http\Controllers\Admin\BisnisKategoriController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\RoleController;
// Hapus import duplicate atau perbaiki dengan alias
use App\Http\Controllers\Admin\{
    DashboardController,
    UserController,
    AboutController,
    BusinessUnitController,
    CareerController,
    ContactController,
    CsrController,
    NewsController as AdminNewsController, // Beri alias
    NewsCategoryController
};

/*
|--------------------------------------------------------------------------
| FRONTEND / PUBLIC ROUTES
|--------------------------------------------------------------------------
| Tidak perlu login
*/
// routes/web.php
Route::controller(PageController::class)
    ->name('frontend.')
    ->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/about', 'about')->name('about');
        Route::get('/business-units', 'business')->name('business.units');
        Route::get('/news', 'news')->name('news.index');
        Route::get('/news/{slug}', 'showNews')->name('news.show');
        Route::get('/csr', 'csr')->name('csr.index');
        Route::get('/csr/{slug}', 'csrShow')->name('csr.show');
        Route::get('/career', 'career')->name('career.index');
        Route::get('/career/{id}', 'careerDetail')->name('career.show'); // Tambahkan route detail
        Route::get('/contact', 'contact')->name('contact');
    });
/*
|--------------------------------------------------------------------------
| UPLOAD ROUTES (Untuk semua yang memerlukan upload)
|--------------------------------------------------------------------------
*/
Route::prefix('upload')->name('upload.')->middleware('auth')->group(function () {
    Route::post('/image', [UploadController::class, 'storeImage'])->name('image.store');
    Route::post('/file', [UploadController::class, 'storeFile'])->name('file.store');
    Route::post('/summernote', [UploadController::class, 'storeSummernote'])->name('summernote.store');
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

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'menu.access']) // 🔥 DINAMIS BERDASARKAN menu_role
    ->group(function () {

        /* ================= DASHBOARD ================= */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        /* ================= USERS ================= */
        Route::resource('users', UserController::class);


        /* ================= ABOUT ================= */
        Route::resource('about', AboutController::class)
            ->except('show');


        /* ================= BUSINESS UNIT ================= */
        Route::resource('business-units', BusinessUnitController::class);


        /* ================= CSR ================= */
        Route::resource('csr', CsrController::class);

        Route::get('/csr/{csr}/edit-json', [CsrController::class, 'editJson'])
            ->name('csr.edit.json');

        Route::post('/csr/bulk-action', [CsrController::class, 'bulkAction'])
            ->name('csr.bulk-action');


        /* ================= CAREER ================= */
        Route::resource('career', CareerController::class);


        /* ================= CONTACT ================= */
        Route::resource('contact', ContactController::class)
            ->except(['create', 'store']);


        /* ================= NEWS ================= */
        Route::prefix('news')->name('news.')->group(function () {

            Route::get('/', [AdminNewsController::class, 'index'])->name('index');
            Route::get('/create', [AdminNewsController::class, 'create'])->name('create');
            Route::post('/', [AdminNewsController::class, 'store'])->name('store');
            Route::get('/{news}', [AdminNewsController::class, 'show'])->name('show');
            Route::get('/{news}/edit', [AdminNewsController::class, 'edit'])->name('edit');
            Route::match(['put', 'patch'], '/{news}', [AdminNewsController::class, 'update'])->name('update');
            Route::delete('/{news}', [AdminNewsController::class, 'destroy'])->name('destroy');

            Route::post('/bulk-action', [AdminNewsController::class, 'bulkAction'])->name('bulk-action');
            Route::post('/{news}/update-status', [AdminNewsController::class, 'updateStatus'])->name('update-status');
            Route::post('/preview', [AdminNewsController::class, 'preview'])->name('preview');
            Route::post('/generate-slug', [AdminNewsController::class, 'generateSlug'])->name('generate-slug');
        });


        /* ================= NEWS CATEGORIES ================= */
        Route::prefix('news-categories')->name('news-categories.')->group(function () {

            Route::get('/', [NewsCategoryController::class, 'index'])->name('index');
            Route::post('/', [NewsCategoryController::class, 'store'])->name('store');
            Route::post('/update-order', [NewsCategoryController::class, 'updateOrder'])->name('update-order');
            Route::post('/update-inline', [NewsCategoryController::class, 'updateInline'])->name('update-inline');
            Route::post('/toggle-status', [NewsCategoryController::class, 'toggleStatus'])->name('toggle-status');
            Route::get('/stats', [NewsCategoryController::class, 'stats'])->name('stats');
            Route::delete('/{id}', [NewsCategoryController::class, 'destroy'])->name('destroy');
        });


        /* ================= MASTER DATA ================= */
        Route::resource('category-csr', CategoryCsrController::class);
        Route::resource('category-loker', CategoryLokerController::class);
        Route::resource('bisnis-kategori', BisnisKategoriController::class);
        Route::resource('bisnis-unit', BusinessUnitController::class);


        /* ================= RBAC ================= */
        Route::resource('menus', MenuController::class);
        Route::resource('roles', RoleController::class);

    });




require __DIR__ . '/auth.php';