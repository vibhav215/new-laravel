<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamManageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route to view Binding
//Default Route
Route::get('/', function () {
    return view('pages.home');
});

Route::get('/index', [HomeController::class, 'index']);
Route::get('/gallery', [HomeController::class, 'gallery']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/license', [HomeController::class, 'license']);
Route::get('/about', [HomeController::class, 'about']);

//Type Hinting 
Route::get('/students', function (Student $student) {

    $StudentData = $student->getAll();
    return response()->json([
        'code' => 200,
        'message' => 'Student Record Found',
        'status' => true,
        'error' => false,
        'data' => $StudentData
    ]);
});

Route::get('/posts', function (Post $post) {

    $postData = $post->getAll();
    return response()->json([
        'code' => 200,
        'message' => 'Post Record Found',
        'status' => true,
        'error' => false,
        'data' => $postData
    ]);
});

// Register and Login Complete

Route::get('/register', [UserController::class, 'registerform']);
Route::post('/user/save', [UserController::class, 'save']);
Route::get('/login', [UserController::class, 'loginform']);
Route::post('/user/login', [UserController::class, 'login']);
Route::get('/user/logout', [UserController::class, 'logout']);
Route::post('/user/contact', [UserController::class, 'contactForm']);

//Dashboard
Route::get('/dashboard/user', [DashboardController::class, 'index']);
Route::get('/dashboard/admin', [DashboardController::class, 'admin']);

//Admin Route
Route::prefix('/admin')->group(function () {
    // Project Management Routes 
    Route::get('/manage-project', [ProjectController::class, 'index']);
    Route::get('/manage-project/add', [ProjectController::class, 'create']);
    Route::post('/manage-project/add', [ProjectController::class, 'store']);
    Route::get('/manage-project/agreement/{id}', [ProjectController::class, 'agreement']);
    Route::get('/manage-project/edit/{id}', [ProjectController::class, 'edit']);
    Route::delete('/manage-project/{id}', [ProjectController::class, 'destroy']);
    Route::put('/manage-project/update/{id}', [ProjectController::class, 'update']);


    //Role Management Routes
    Route::get('/manage-role', [RoleController::class, 'index']);
    Route::get('/manage-role/add', [RoleController::class, 'create']);
    Route::post('/manage-role/add', [RoleController::class, 'store']);
    Route::delete('/manage-role/{id}', [RoleController::class, 'destroy']);
    Route::get('/manage-role/edit/{id}', [RoleController::class, 'edit']);
    Route::put('/manage-role/update/{id}', [RoleController::class, 'update']);

    //Team Management Routes
    Route::get('/manage-team', [TeamManageController::class, 'index']);
    Route::get('/manage-team/add', [TeamManageController::class, 'create']);
    Route::post('/manage-team/add', [TeamManageController::class, 'store']);
    Route::get('/manage-team/edit/{id}', [TeamManageController::class, 'edit']);
    Route::put('/manage-team/update/{id}', [TeamManageController::class, 'update']);
    Route::delete('/manage-team/delete/{id}', [TeamManageController::class, 'destroy']);
    //Manager Task
    Route::get('/manage-task', [TaskController::class, 'index']);

});

//User Routes
Route::prefix('/dashboard/user')->group(function () {
    Route::get('/manage-task/add', [TaskController::class, 'create']);
});