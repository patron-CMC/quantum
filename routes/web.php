<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\FreightsController;
use App\Http\Controllers\PaymentsController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/freights/published', [FreightsController::class, 'show_published'])
    ->name('freights_published');

Route::get('/freights/executing', [FreightsController::class, 'show_executing'])
    ->name('freights_executing');

Route::get('/payments', [PaymentsController::class, 'show_payments'])
    ->name('payments');


Route::get('freight-card/{freight_id}', [FreightsController::class, 'show_FreightCard'])
    ->name('FreightCard');
Route::get('freight-card/{freight_id}/cancel-by-client',
    [FreightsController::class, 'cancel_by_client']);
Route::get('profile/{user_id}',
    [FreightsController::class, 'user_profile'])->name('user_profile');
Route::get('/freight-card/{freight_id}/to-executing',
    [FreightsController::class, 'to_executing']);
Route::get('/freight-card/{freight_id}/to-opened',
    [FreightsController::class, 'to_opened']);
Route::get('/freight-card/{freight_id}/to-confirm',
    [FreightsController::class, 'to_confirm']);
Route::get('/freight-card/{freight_id}/cancel-by-driver',
    [FreightsController::class, 'cancel_by_driver']);
Route::get('/freight-card/{freight_id}/confirm-exec',
    [FreightsController::class, 'confirm_exec']);


Route::get('/dashboard/vehicles', [CarsController::class, 'show'])->name('vehicles');

Route::get('/dashboard/vehicles/add', function () {
    return view('vehicles_addition');
});
Route::post('/dashboard/vehicles/add', [CarsController::class, 'add'])->name('add_car');

Route::get('/dashboard/vehicles/delete/{id}', [CarsController::class, 'delete']);


Route::get('/publish-freight', function () {
    return view('freight_addition');
});
Route::post('/publish-freight', [FreightsController::class, 'publish'])->name('publish_freight');

Route::get('/search-freight', function () {
    return view('freight_search');
});
Route::post('/search-freight', [FreightsController::class, 'search'])->name('search_freight');

Route::get('/search-freight/freightsList', function (){
    return view('freights_searchList');
})->name('freights_searchList');

Route::get('/book-freight/{freight_id}/{user_id}', [FreightsController::class, 'book']);


require __DIR__.'/auth.php';
