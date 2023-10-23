<?php

use App\Http\Controllers\Admin\AdcategoryController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\DesignController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MarketResearchController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\MotionController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostcategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StudioController;
use App\Http\Controllers\Admin\SystemCalendarController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\TaskCalendarController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TaskStatusController;
use App\Http\Controllers\Admin\TaskTagController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserAlertController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideocategoryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\Auth\UserTeamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Project
    Route::post('projects/csv', [ProjectController::class, 'csvStore'])->name('projects.csv.store');
    Route::put('projects/csv', [ProjectController::class, 'csvUpdate'])->name('projects.csv.update');
    Route::resource('projects', ProjectController::class, ['except' => ['store', 'update', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', AuditLogController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit']]);

    // Team
    Route::resource('teams', TeamController::class, ['except' => ['store', 'update', 'destroy']]);

    // User Alert
    Route::get('user-alerts/seen', [UserAlertController::class, 'seen'])->name('user-alerts.seen');
    Route::resource('user-alerts', UserAlertController::class, ['except' => ['store', 'update', 'destroy']]);

    // Post
    Route::post('posts/csv', [PostController::class, 'csvStore'])->name('posts.csv.store');
    Route::put('posts/csv', [PostController::class, 'csvUpdate'])->name('posts.csv.update');
    Route::resource('posts', PostController::class, ['except' => ['store', 'update', 'destroy']]);

    // Design
    Route::post('designs/media', [DesignController::class, 'storeMedia'])->name('designs.storeMedia');
    Route::post('designs/csv', [DesignController::class, 'csvStore'])->name('designs.csv.store');
    Route::put('designs/csv', [DesignController::class, 'csvUpdate'])->name('designs.csv.update');
    Route::resource('designs', DesignController::class, ['except' => ['store', 'update', 'destroy']]);

    // Video
    Route::post('videos/media', [VideoController::class, 'storeMedia'])->name('videos.storeMedia');
    Route::post('videos/csv', [VideoController::class, 'csvStore'])->name('videos.csv.store');
    Route::put('videos/csv', [VideoController::class, 'csvUpdate'])->name('videos.csv.update');
    Route::resource('videos', VideoController::class, ['except' => ['store', 'update', 'destroy']]);

    // Ad
    Route::post('ads/media', [AdController::class, 'storeMedia'])->name('ads.storeMedia');
    Route::post('ads/csv', [AdController::class, 'csvStore'])->name('ads.csv.store');
    Route::put('ads/csv', [AdController::class, 'csvUpdate'])->name('ads.csv.update');
    Route::resource('ads', AdController::class, ['except' => ['store', 'update', 'destroy']]);

    // Postcategory
    Route::post('postcategories/csv', [PostcategoryController::class, 'csvStore'])->name('postcategories.csv.store');
    Route::put('postcategories/csv', [PostcategoryController::class, 'csvUpdate'])->name('postcategories.csv.update');
    Route::resource('postcategories', PostcategoryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Videocategory
    Route::post('videocategories/csv', [VideocategoryController::class, 'csvStore'])->name('videocategories.csv.store');
    Route::put('videocategories/csv', [VideocategoryController::class, 'csvUpdate'])->name('videocategories.csv.update');
    Route::resource('videocategories', VideocategoryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Adcategory
    Route::post('adcategories/csv', [AdcategoryController::class, 'csvStore'])->name('adcategories.csv.store');
    Route::put('adcategories/csv', [AdcategoryController::class, 'csvUpdate'])->name('adcategories.csv.update');
    Route::resource('adcategories', AdcategoryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Package
    Route::post('packages/csv', [PackageController::class, 'csvStore'])->name('packages.csv.store');
    Route::put('packages/csv', [PackageController::class, 'csvUpdate'])->name('packages.csv.update');
    Route::resource('packages', PackageController::class, ['except' => ['store', 'update', 'destroy']]);

    // Studio
    Route::post('studios/csv', [StudioController::class, 'csvStore'])->name('studios.csv.store');
    Route::put('studios/csv', [StudioController::class, 'csvUpdate'])->name('studios.csv.update');
    Route::resource('studios', StudioController::class, ['except' => ['store', 'update', 'destroy']]);

    // Motion
    Route::post('motions/csv', [MotionController::class, 'csvStore'])->name('motions.csv.store');
    Route::put('motions/csv', [MotionController::class, 'csvUpdate'])->name('motions.csv.update');
    Route::resource('motions', MotionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Website
    Route::post('websites/csv', [WebsiteController::class, 'csvStore'])->name('websites.csv.store');
    Route::put('websites/csv', [WebsiteController::class, 'csvUpdate'])->name('websites.csv.update');
    Route::resource('websites', WebsiteController::class, ['except' => ['store', 'update', 'destroy']]);

    // Market Research
    Route::post('market-researchs/csv', [MarketResearchController::class, 'csvStore'])->name('market-researchs.csv.store');
    Route::put('market-researchs/csv', [MarketResearchController::class, 'csvUpdate'])->name('market-researchs.csv.update');
    Route::resource('market-researchs', MarketResearchController::class, ['except' => ['store', 'update', 'destroy']]);

    // Quotation
    Route::post('quotations/csv', [QuotationController::class, 'csvStore'])->name('quotations.csv.store');
    Route::put('quotations/csv', [QuotationController::class, 'csvUpdate'])->name('quotations.csv.update');
    Route::resource('quotations', QuotationController::class, ['except' => ['store', 'update', 'destroy']]);

    // Application
    Route::post('applications/csv', [ApplicationController::class, 'csvStore'])->name('applications.csv.store');
    Route::put('applications/csv', [ApplicationController::class, 'csvUpdate'])->name('applications.csv.update');
    Route::resource('applications', ApplicationController::class, ['except' => ['store', 'update', 'destroy']]);

    // System
    Route::post('systems/csv', [SystemController::class, 'csvStore'])->name('systems.csv.store');
    Route::put('systems/csv', [SystemController::class, 'csvUpdate'])->name('systems.csv.update');
    Route::resource('systems', SystemController::class, ['except' => ['store', 'update', 'destroy']]);

    // Task Status
    Route::resource('task-statuses', TaskStatusController::class, ['except' => ['store', 'update', 'destroy']]);

    // Task Tag
    Route::resource('task-tags', TaskTagController::class, ['except' => ['store', 'update', 'destroy']]);

    // Task
    Route::post('tasks/media', [TaskController::class, 'storeMedia'])->name('tasks.storeMedia');
    Route::resource('tasks', TaskController::class, ['except' => ['store', 'update', 'destroy']]);

    // Task Calendar
    Route::resource('task-calendars', TaskCalendarController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit', 'show']]);

    // System Calendar
    Route::resource('system-calendars', SystemCalendarController::class, ['except' => ['store', 'update', 'destroy', 'create', 'edit', 'show']]);

    // Messages
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('messages/outbox', [MessageController::class, 'outbox'])->name('messages.outbox');
    Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::get('messages/{conversation}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('messages/{conversation}', [MessageController::class, 'update'])->name('messages.update');
    Route::post('messages/{conversation}/destroy', [MessageController::class, 'destroy'])->name('messages.destroy');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});

Route::group(['prefix' => 'team', 'as' => 'team.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserTeamController.php'))) {
        Route::get('/', [UserTeamController::class, 'show'])->name('show');
        Route::get('{team}/accept', [UserTeamController::class, 'accept'])->middleware('signed')->name('accept');
    }
});
