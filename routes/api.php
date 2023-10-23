<?php

use App\Http\Controllers\Api\V1\Admin\AdApiController;
use App\Http\Controllers\Api\V1\Admin\AdcategoryApiController;
use App\Http\Controllers\Api\V1\Admin\ApplicationApiController;
use App\Http\Controllers\Api\V1\Admin\DesignApiController;
use App\Http\Controllers\Api\V1\Admin\MarketResearchApiController;
use App\Http\Controllers\Api\V1\Admin\MotionApiController;
use App\Http\Controllers\Api\V1\Admin\PackageApiController;
use App\Http\Controllers\Api\V1\Admin\PostApiController;
use App\Http\Controllers\Api\V1\Admin\PostcategoryApiController;
use App\Http\Controllers\Api\V1\Admin\ProjectApiController;
use App\Http\Controllers\Api\V1\Admin\QuotationApiController;
use App\Http\Controllers\Api\V1\Admin\StudioApiController;
use App\Http\Controllers\Api\V1\Admin\SystemApiController;
use App\Http\Controllers\Api\V1\Admin\VideoApiController;
use App\Http\Controllers\Api\V1\Admin\VideocategoryApiController;
use App\Http\Controllers\Api\V1\Admin\WebsiteApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Project
    Route::apiResource('projects', ProjectApiController::class);

    // Post
    Route::apiResource('posts', PostApiController::class);

    // Design
    Route::post('designs/media', [DesignApiController::class, 'storeMedia'])->name('designs.store_media');
    Route::apiResource('designs', DesignApiController::class);

    // Video
    Route::post('videos/media', [VideoApiController::class, 'storeMedia'])->name('videos.store_media');
    Route::apiResource('videos', VideoApiController::class);

    // Ad
    Route::post('ads/media', [AdApiController::class, 'storeMedia'])->name('ads.store_media');
    Route::apiResource('ads', AdApiController::class);

    // Postcategory
    Route::apiResource('postcategories', PostcategoryApiController::class);

    // Videocategory
    Route::apiResource('videocategories', VideocategoryApiController::class);

    // Adcategory
    Route::apiResource('adcategories', AdcategoryApiController::class);

    // Package
    Route::apiResource('packages', PackageApiController::class);

    // Studio
    Route::apiResource('studios', StudioApiController::class);

    // Motion
    Route::apiResource('motions', MotionApiController::class);

    // Website
    Route::apiResource('websites', WebsiteApiController::class);

    // Market Research
    Route::apiResource('market-researchs', MarketResearchApiController::class);

    // Quotation
    Route::apiResource('quotations', QuotationApiController::class);

    // Application
    Route::apiResource('applications', ApplicationApiController::class);

    // System
    Route::apiResource('systems', SystemApiController::class);
});
