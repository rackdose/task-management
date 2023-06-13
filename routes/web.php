<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth')->group(function () {
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks');
    Route::post('tasks', [TaskController::class, 'store'])->name('store');
    Route::get('tasks/{id}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::post('tasks/{id}/update', [TaskController::class, 'update'])->name('update');
    Route::delete('tasks/{id}', [TaskController::class, 'destroy'])->name('destroy');
});

/*Route::get('todos/{todoId}', 'TaskController@show');
Route::get('new-todo', 'TaskController@create');
Route::post('store-todo', 'TaskController@store');
Route::get('todos/{todoId}/edit','TaskController@edit');
Route::post('todos/{todoId}/update','TaskController@update');
Route::get('todos/{todoId}/delete','TaskController@destroy');
Route::get('todos/{todoId}/complete','TaskController@complete');

Route::get('completed',function(){
    return view('completed')->with('todos',Todo::all());
});*/

require __DIR__.'/auth.php';
