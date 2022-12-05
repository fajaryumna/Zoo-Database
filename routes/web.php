<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZooKeeperController;
use App\Http\Controllers\CageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ServiceController;


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

Route::middleware(['auth'])->group(function(){
    // route for zoo keeper 
    Route::get('add_zoo', [ZooKeeperController::class, 'create']) -> name('zoo_keeper.create'); 
    Route::post('store_zoo', [ZooKeeperController::class, 'store']) -> name('zoo_keeper.store');
    Route::get('/zoo', [ZooKeeperController::class, 'index'])->name('zoo_keeper.index');
    Route::get('edit_zoo/{id}', [ZooKeeperController::class, 'edit'])->name('zoo_keeper.edit');
    Route::post('update_zoo/{id}', [ZooKeeperController::class, 'update'])->name('zoo_keeper.update');
    Route::post('delete_zoo/{id}', [ZooKeeperController::class, 'delete'])->name('zoo_keeper.delete');

    // route for zoo keeper trash
    Route::get('/zoo_keeper/trash', [ZooKeeperController::class, 'trash'])->name('zoo_keeper.trash');
    Route::post('/zoo_keeper/softDeleted/{id}', [ZooKeeperController::class, 'softDeleted'])->name('zoo_keeper.softDeleted');
    Route::post('/zoo_keeper/delete/{id}', [ZooKeeperController::class, 'delete'])->name('zoo_keeper.delete');
    Route::get('/zoo_keeper/restore/{id}', [ZooKeeperController::class, 'restore'])->name('zoo_keeper.restore');

    // route for cage 
    Route::get('add_cage', [CageController::class, 'create']) -> name('cage.create'); 
    Route::post('store_cage', [CageController::class, 'store']) -> name('cage.store');
    Route::get('/cage', [CageController::class, 'index'])->name('cage.index');
    Route::get('edit_cage/{id}', [CageController::class, 'edit'])->name('cage.edit');
    Route::post('update_cage/{id}', [CageController::class, 'update'])->name('cage.update');
    Route::post('delete_cage/{id}', [CageController::class, 'delete'])->name('cage.delete');

    // route for crage trash
    Route::get('/cage/trash', [CageController::class, 'trash'])->name('cage.trash');
    Route::post('/cage/softDeleted/{id}', [CageController::class, 'softDeleted'])->name('cage.softDeleted');
    Route::post('/cage/delete/{id}', [CageController::class, 'delete'])->name('cage.delete');
    Route::get('/cage/restore/{id}', [CageController::class, 'restore'])->name('cage.restore');

    // route for animal 
    Route::get('add_animal', [AnimalController::class, 'create']) -> name('animal.create'); 
    Route::post('store_animal', [AnimalController::class, 'store']) -> name('animal.store');
    Route::get('/animal', [AnimalController::class, 'index'])->name('animal.index');
    Route::get('edit_animal/{id}', [AnimalController::class, 'edit'])->name('animal.edit');
    Route::post('update_animal/{id}', [AnimalController::class, 'update'])->name('animal.update');
    Route::post('delete_animal/{id}', [AnimalController::class, 'delete'])->name('animal.delete');

    // route for animal trash
    Route::get('/animal/trash', [AnimalController::class, 'trash'])->name('animal.trash');
    Route::post('/animal/softDeleted/{id}', [AnimalController::class, 'softDeleted'])->name('animal.softDeleted');
    Route::post('/animal/delete/{id}', [AnimalController::class, 'delete'])->name('animal.delete');
    Route::get('/animal/restore/{id}', [AnimalController::class, 'restore'])->name('animal.restore');

    Route::get('/', [ServiceController::class, 'index'])->name('service.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', function() {
    \Auth::logout();
    return redirect('/');
});