<?php
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

use App\Jobs\ReconcileAccount;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('projects', 'ProjectsController');

    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');

    Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store');

    Route::get('/home', 'HomeController@index')->name('home');
});

Route::get('/settings/access', 'AccessTokenController@show');
Route::patch('/settings/access', 'AccessTokenController@update');

Auth::routes();

// Route::get('/job', function(){
//      dispatch(function (){
//          logger('Hello there');
//      });

//      return 'Finished';
// });

// Route::get('/job', function () {
//     dispatch(function () {
//         logger('I have to tell you about the furture');
//     })->delay(now()->addMinutes(2));

//     return 'Finished';
// });

Route::get('/job', function () {
    $user =  App\User::first();
    dispatch(new ReconcileAccount($user));

    return 'Finished';
});
