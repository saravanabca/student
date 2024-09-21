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
    
    
   
    Route::post('/login', 'LoginController@login_auth');
    Route::post('/signup', 'LoginController@signup');


});

Route::get('/', 'LoginController@showLoginForm');

Route::get('/signupform', 'LoginController@signupform');



Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student', 'StudentController@student')->name('student');

    // Request:
    Route::post('/student-add', 'StudentController@student_add');
    Route::post('/student-update/{id}', 'StudentController@student_update');
    Route::post('/student-delete', 'StudentController@student_delete');
    Route::get('/student-get', 'StudentController@student_get');
Route::get('/logout', 'LoginController@logout');
    
});