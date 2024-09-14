<?php

use App\Http\Controllers\Api\PostInteractionController;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function () {
    Route::post('/{id}/view', [PostInteractionController::class, 'increaseView']);
    Route::post('/{id}/like', [PostInteractionController::class, 'like']);
    Route::post('/{id}/dislike', [PostInteractionController::class, 'dislike']);
});

