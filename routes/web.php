<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Environment\Console;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/courses', [CourseController::class, 'index'])
    ->middleware('auth');

Route::get('/courses/{course}', [CourseController::class, 'show'])
    ->middleware('auth');

Route::get('/courses-list', function () {
    return Course::with('lectures')->get();
})->middleware('auth');


Route::get('courses/{course}/lectures', function ($id) {
    return Course::with('lectures')->findOrFail($id);
})->middleware('auth');

Route::put('lecture/{id}', [LectureController::class, 'update'])
    ->middleware('auth');

Route::post('lecture', [LectureController::class, 'store'])
    ->middleware('auth');

Route::delete('lecture/{id}', [LectureController::class, 'destroy'])
    ->middleware('auth');
