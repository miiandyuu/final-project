<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilSAWController;
use App\Http\Controllers\HasilWPController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiBobotController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// Default Auth Laravel UI
// Auth::routes();

// Custom Route Only Login & Register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', [HomeController::class, 'index'])->name('homepage.index');

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/petunjuk', [DashboardController::class, 'petunjuk'])->name('dashboard.petunjuk');

    Route::prefix('kriteria')->group(function() {
        Route::get('/', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::get('/create', [KriteriaController::class, 'create'])->name('kriteria.create');
        Route::post('/', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        Route::put('/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
    });

    Route::prefix('subkriteria')->group(function() {
        Route::get('/', [SubkriteriaController::class, 'index'])->name('subkriteria.index');
        Route::get('/create', [SubkriteriaController::class, 'create'])->name('subkriteria.create');
        Route::get('/{kriteria_id}/edit', [SubkriteriaController::class, 'edit'])->name('subkriteria.edit');
        // Route::post('/', [SubkriteriaController::class, 'store'])->name('subkriteria.store');
        // Route::put('/{id}', [SubkriteriaController::class, 'update'])->name('subkriteria.update');
        // Route::delete('/{id}', [SubkriteriaController::class, 'destroy'])->name('subkriteria.destroy');
    });

    Route::prefix('alternatif')->group(function() {
        Route::get('/', [AlternatifController::class, 'index'])->name('alternatif.index');
        Route::get('/create', [AlternatifController::class, 'create'])->name('alternatif.create');
        Route::post('/', [AlternatifController::class, 'store'])->name('alternatif.store');
        Route::get('/{id}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
        Route::put('/{id}', [AlternatifController::class, 'update'])->name('alternatif.update');
        Route::delete('/{id}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');
    });

    Route::prefix('nilai-bobot')->group(function() {
        Route::get('/', [NilaiBobotController::class, 'index'])->name('nilai-bobot.index');
        Route::get('/create_all', [NilaiBobotController::class, 'create_all'])->name('nilai-bobot.create_all');
        Route::post('/', [NilaiBobotController::class, 'store_all'])->name('nilai-bobot.store_all');
        Route::get('/create_single', [NilaiBobotController::class, 'create_single'])->name('nilai-bobot.create_single');
        // Route::post('/', [NilaiBobotController::class, 'store_single'])->name('nilai-bobot.store_single');
        Route::get('/{alternatif_id}/edit', [NilaiBobotController::class, 'edit'])->name('nilai-bobot.edit');
        Route::put('/{alternatif_id}', [NilaiBobotController::class, 'update'])->name('nilai-bobot.update');
    });

    Route::prefix('wp')->group(function() {
        Route::get('/', [HasilWPController::class, 'index'])->name('wp.index');
        Route::get('/hasil', [HasilWPController::class, 'hasil'])->name('wp.hasil');
    });

    Route::prefix('saw')->group(function() {
        Route::get('/', [HasilSAWController::class, 'index'])->name('saw.index');
        Route::get('/hasil', [HasilSAWController::class, 'hasil'])->name('saw.hasil');
    });

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });
});

// Route::get('routes', function () {
//     $routeCollection = Route::getRoutes();

//     echo "<table style='width:100%'>";
//     echo "<tr>";
//     echo "<td width='10%'><h4>HTTP Method</h4></td>";
//     echo "<td width='10%'><h4>Route</h4></td>";
//     echo "<td width='10%'><h4>Name</h4></td>";
//     echo "<td width='70%'><h4>Corresponding Action</h4></td>";
//     echo "</tr>";
//     foreach ($routeCollection as $value) {
//         echo "<tr>";
//         echo "<td>" . $value->methods()[0] . "</td>";
//         echo "<td>" . $value->uri() . "</td>";
//         echo "<td>" . $value->getName() . "</td>";
//         echo "<td>" . $value->getActionName() . "</td>";
//         echo "</tr>";
//     }
//     echo "</table>";
// });