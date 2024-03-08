<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
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
Route::get('qr-code/examples/v-card', function () 
{
  $t = url('/i/everest');
$a = \QRCode::url('http://google.com')
                    ->setSize(2)
                    ///->setOutfile(public_path() . '/media/qr_2/10/test.png')
                    ->setMargin(6)
                    ->png();
    return response($a)->header('Content-type','image/png');;
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', [LoginController::class, 'logout']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('users', [UserController::class, 'index'])->name('users.index');


/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__ . '/Frontend/');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group([
    'prefix' => 'admin', 'as' => 'admin.',
    'middleware' => 'admin'
], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__ . '/Backend/');
});
