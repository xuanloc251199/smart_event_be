<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RecommendationController;


Route::post('register', [AuthController::class, 'register']); // Đăng ký
Route::post('login', [AuthController::class, 'login']);       // Đăng nhập

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserDetailController::class, 'show']); // Lấy thông tin người dùng
    Route::post('logout', [AuthController::class, 'logout']);   // Đăng xuất
    Route::post('add-user-detail', [UserDetailController::class, 'store']); // API thêm thông tin chi tiết
    Route::post('update-user-detail', [UserDetailController::class, 'updateUserDetail']);
    Route::post('update-avatar', [UserDetailController::class, 'updateAvatar']);
    // Route::post('save-face-data', [UserDetailController::class, 'saveFaceData']);

    // Route::post('save-face-data', [UserDetailController::class, 'saveFaceData']);
    // Route::post('verify-face-data', [UserDetailController::class, 'verifyFaceData']);

    Route::post('save-face-data', [UserDetailController::class, 'saveFaceData']);
    Route::post('verify-face-data', [UserDetailController::class, 'verifyFaceData']);
});

Route::get('/classes', [ClassController::class, 'index']);

Route::get('/faculties?unit_id={unit_id}', [FacultyController::class, 'index']);

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/add', [CategoryController::class, 'store'])->middleware('auth:sanctum');
});

Route::get('/units', [ProfileController::class, 'getUnits']);
Route::get('/faculties', [ProfileController::class, 'getFaculties']);
Route::get('/classes', [ProfileController::class, 'getClasses']);


Route::get('/export-user-event-matrix', [RecommendationController::class, 'exportUserEventMatrix'])
    ->middleware('auth:sanctum');

Route::get('/train-recommendation', [RecommendationController::class, 'trainModel']);

Route::prefix('events')->group(function () {
    // Hiển thị danh sách sự kiện (tất cả user đều có quyền truy cập)
    Route::get('/', [EventController::class, 'index']);

    Route::get('/recommend', [EventController::class, 'recommendEvents'])->middleware('auth:sanctum');

    Route::get('/recommend-from-matrix', [EventController::class, 'recommendEventsFromMatrix'])->middleware('auth:sanctum');

    // Hiển thị chi tiết sự kiện (tất cả user đều có quyền truy cập)
    Route::get('/{id}', [EventController::class, 'show']);

    // Cập nhật sự kiện (chỉ dành cho admin, yêu cầu đăng nhập)
    Route::put('/{id}', [EventController::class, 'update'])->middleware(['auth:sanctum', 'admin']);

    // Thêm sự kiện (chỉ dành cho admin, yêu cầu đăng nhập)
    Route::post('/add', [EventController::class, 'store'])->middleware(['auth:sanctum', 'admin']);

    // Xóa sự kiện (chỉ dành cho admin, yêu cầu đăng nhập)
    Route::delete('/{id}', [EventController::class, 'destroy'])->middleware(['auth:sanctum', 'admin']);

    // Đăng ký tham gia sự kiện (tất cả user đã đăng nhập đều có quyền)
    Route::post('/{id}/register', [EventController::class, 'register'])->middleware('auth:sanctum');

    Route::post('/{id}/check-in', [EventController::class, 'checkIn'])->middleware('auth:sanctum');
});
