<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/imageupload', [App\Http\Controllers\Admin\UploadController::class, 'uploadImage'])->name('api.imageupload');
