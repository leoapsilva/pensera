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

Auth::routes();

Route::get('/courses', [CourseController::class, 'index']);

Route::get('/courses/{course}', [CourseController::class, 'show']);

Route::get('courses-list', function () {
    return Course::with('lectures')->get();
});

Route::get('courses/{course}/lectures', function ($id) {
    return Course::with('lectures')->findOrFail($id);
});

Route::put('lecture/{id}', [LectureController::class, 'update']);

Route::post('lecture', [LectureController::class, 'store']);

Route::delete('lecture/{id}', [LectureController::class, 'delete']);
