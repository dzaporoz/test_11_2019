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


use Illuminate\Support\Facades\Config;

// Get the application mode
$mode = env('TEST_SBJ_MODE', Config::get('constants.end'));
putenv('TEST_SBJ_MODE');
Config::set('constants.end', $mode);

if (Config::get('constants.end') == 'front') {
    $userProvider = Config::get('auth.providers.users');
    $userProvider['model'] = 'App\\Client';
    Config::set('auth.providers.users', $userProvider);
}

// There is no register route in back office part
if (Config::get('constants.end') == 'back') {
    Auth::routes(['register'=>false]);
} else {
    Auth::routes();
}

Route::middleware('auth')->group(function() {

    Route::get('/', function () {
        return Redirect::to('/dashboard');
    });

    Route::fallback(function () {
        abort(404);
    });
    // Set Routes depending on the mode
    if (Config::get('constants.end') == 'back') {
        Route::resource('/client', 'ClientController', ['only' => ['index','show','edit','update']]);
        Route::resource('/user', 'UserController')->middleware('can:manage,App\User');
        Route::get('/dashboard', 'ClientController@index')->name('dashboard');

        // Aliases to /user routes according to subject
        Route::get('/create-user', 'UserController@create')->middleware('can:manage,App\User');
        Route::post('/create-user', 'UserController@store')->middleware('can:manage,App\User');
    } else {
        Route::resource('/user', 'UserController', ['only' => ['create', 'store']]);
        Route::get('/dashboard', 'UserController@create');
        Route::post('/dashboard', 'UserController@store');
    }

});

