<?php

use App\Http\Controllers\BloodTypeController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\carInfoController;
use App\Http\Controllers\carFuelController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
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
})->name('home');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('certificate/assign', [CertificateController::class, 'assignIndex'])->name('certificate.assignIndex');
    Route::post('certificate/assign', [CertificateController::class, 'assign'])->name('certificate.assign');
    Route::get('blood-type/assign', [BloodTypeController::class, 'assignIndex'])->name('blood-type.assignIndex');
    Route::post('blood-type/assign', [BloodTypeController::class, 'assign'])->name('blood-type.assign');
});

Route::group(['middleware' => ['admin']], function () {
    Route::resource('certificate', CertificateController::class);
    Route::resource('blood-type', BloodTypeController::class);
    Route::get('user/verify-users', [UserController::class, 'verifyUsersIndex'])->name('user.get-verify-users');
    Route::post('user/verify-users/{user}', [UserController::class, 'verifyUser'])->name('user.verify-user');
    Route::post('user/unverify-users/{user}', [UserController::class, 'unVerifyUser'])->name('user.un-verify-user');
    Route::get('user/all', [UserController::class, 'UsersIndex'])->name('user.all');
    Route::get('serial/find', [carInfoController::class, 'findBySerial'])->name('serial.find');
    Route::get('/serial', function () {
        return view('serial');
    })->name('serial');
    Route::post('/serial', [carFuelController::class, 'store'])->name('serial.store');;

    Route::get('/search', [carInfoController::class, 'search']);
});
