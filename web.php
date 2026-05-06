<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContactController;
use App\Models\Task;
use Illuminate\Validation\Rule;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/dashboard', function () {
    return redirect(route('tasks.index'));
})->middleware('auth')->name('dashboard');



Route::middleware('auth')->group(function () {


Route::resource('tasks', TaskController::class);



Route::post('/tasks/{task}/done', [TaskController::class, 'done'])
    ->name('tasks.done');

Route::get('/archive', [TaskController::class, 'archive'])->name('tasks.archive');

Route::post('/tasks/{task}/archive', [TaskController::class, 'archiveTask'])->name('tasks.archiveTask');

Route::post('/tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');

Route::post('/tasks/{task}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.forceDelete');

});




Route::get('/contact', [ContactController::class, 'showForm']);
Route::post('/contact', [ContactController::class, 'submitForm']);

require __DIR__.'/auth.php';
