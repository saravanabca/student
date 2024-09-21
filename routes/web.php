<?php

use Illuminate\Support\Facades\Route;


// use App\Http\Controllers\StudentController;



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

// Route::get('/', function () {
//     return view('welcome');
// });
/**Rendering Page **/




Auth::routes();

Route::group(['middleware' => 'guest'], function(){
    

});

Route::get('/', 'StudentController@student');
Route::post('/login', 'LoginController@login')->name('login');
 


// Route::middleware(['auth', 'student'])->group(function () {
//     Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
//     Route::resource('students', StudentController::class);
// });


    Route::post('/student-add', 'StudentController@student_add');
    Route::post('/student-update/{id}', 'StudentController@student_update');
    Route::post('/student-delete', 'StudentController@student_delete');
    Route::get('/student-get', 'StudentController@student_get');