<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for PostController
Route::get('/posts', [PostController::class, 'index']);       // List all posts
Route::post('websites/{website}/posts', [PostController::class, 'store']);     // Create a new post
Route::get('/posts/{id}', [PostController::class, 'show']);   // Get a specific post by ID


// Routes for SubscriptionController
Route::post('websites/{website}/subscriptions', [SubscriptionController::class, 'store']);   // Subscribe a user to a website
Route::delete('/unsubscribe', [SubscriptionController::class, 'unsubscribe']);

