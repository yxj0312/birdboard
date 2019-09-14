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
use Illuminate\Bus\Dispatcher;
use App\Jobs\ReconcileAccount2;
use Illuminate\Routing\Pipeline;

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
    $user = App\User::first();

    // dispatch(new ReconcileAccount($user));

    // Identific with above
    // Then only work after run php artisan queue:work --queue="high"
    // ReconcileAccount::dispatch($user)->onQueue('high');
    ReconcileAccount::dispatch($user);

    // This is what is above doing
    // $job = new ReconcileAccount($user);

    // resolve(Dispatcher::class)->dispatch($job);

    return 'Finished';
});

Route::get('/pipeline', function () {
    $pipeline = app(Pipeline::class);

    $pipeline->send('hello freaking world')
            ->through([
                function ($string, $next) {
                    $string = ucwords($string);

                    return $next($string);
                },

                function ($string, $next) {
                    $string = str_ireplace('freaking', '', $string);

                    return $next($string);
                },

                ReconcileAccount2::class,
            ])
            ->then(function ($string) {
                dump($string);
            });

    return 'Done';
});
