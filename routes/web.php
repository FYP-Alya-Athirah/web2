<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\StudentController;    
use App\Http\Controllers\TeacherController; 
use App\Http\Controllers\ParentController; 
use App\Http\Controllers\AdminController;     
use App\Http\Controllers\CameraController;      
use App\Http\Controllers\PhotoController; 
use App\Http\Controllers\NoticeController; 
use App\Http\Controllers\AttendanceController; 

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');
	Route::get('/camera-stream', [CameraController::class, 'index'])->name('camera-stream')->middleware('auth');

	Route::get('/students-management', [StudentController::class, 'getList'])->name('students-management');
	Route::post('/add-student', [StudentController::class, 'addStudent']);
	Route::post('/update-student/{id}', [StudentController::class, 'updateStudent']);
	Route::get('/delete-student/{id}', [StudentController::class, 'deleteStudent']);

	Route::get('/teachers-management', [TeacherController::class, 'getList'])->name('teachers-management');
	Route::post('/add-teacher', [TeacherController::class, 'addTeacher']);
	Route::post('/update-teacher/{id}', [TeacherController::class, 'updateTeacher']);
	Route::get('/delete-teacher/{id}', [TeacherController::class, 'deleteTeacher']);

	Route::get('/parents-management', [ParentController::class, 'getList'])->name('parents-management');
	Route::post('/add-parent', [ParentController::class, 'addParent']);
	Route::post('/update-parent/{id}', [ParentController::class, 'updateParent']);
	Route::get('/delete-parent/{id}', [ParentController::class, 'deleteParent']);

	Route::get('/admins-management', [AdminController::class, 'getList'])->name('admins-management');
	Route::post('/add-admin', [AdminController::class, 'addAdmin']);
	Route::post('/update-admin/{id}', [AdminController::class, 'updateAdmin']);
	Route::get('/delete-admin/{id}', [AdminController::class, 'deleteAdmin']);

	Route::get('/photo-management', [ PhotoController::class, 'imageUpload' ])->name('photo-management');
	Route::post('/photo-management', [ PhotoController::class, 'imageUploadPost' ])->name('photo-management-post');	
	
	Route::get('/notice-view', [ NoticeController::class, 'showNotice' ])->name('notice-view');
	Route::get('/children-management', [ StudentController::class, 'showChildren' ])->name('children-management');
	Route::post('/register-parent', [ StudentController::class, 'registerParent' ])->name('register-parent');
	Route::get('/delete-child/{id}', [StudentController::class, 'deleteChild']);

	Route::get('/attendance-list', [AttendanceController::class, 'getList'])->name('attendance-list');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
