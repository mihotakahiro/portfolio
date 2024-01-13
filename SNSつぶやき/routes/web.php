<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MutterController; 

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/mutter', [MutterController::class, 'index'])->name('index')->middleware(['auth']);
Route::post('admin/mutter_store', [MutterController::class, 'store'])->name('store');
Route::delete('admin/mutter_delete/{id}', [MutterController::class,'destroy'])->name('delete');;



