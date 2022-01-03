<?php

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
});

Route::group(['middleware' => 'auth'],function() {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/administration', [App\Http\Controllers\Administration\AdministrationController::class, 'index'])
        ->name('administration.index');

    /** DIRECTORS **/
    Route::get('/administration/director/{director}', [App\Http\Controllers\Administration\DirectorController::class, 'edit'])
        ->name('administration.director');

    Route::post('/administration/director/update/{director}', [App\Http\Controllers\Administration\DirectorController::class, 'update'])
        ->name('administration.director.update');

    Route::post('/administration/director/store/{director}', [App\Http\Controllers\Administration\DirectorController::class, 'store'])
        ->name('administration.director.store');

    Route::get('/administration/directors', [App\Http\Controllers\Administration\DirectorController::class, 'index'])
        ->name('administration.directors');

    Route::get('/administration/njacda/upload/directors', [App\Http\Controllers\Administration\ImportDirectorsController::class, 'create'])
        ->name('administration.upload.directors');

    /** DIRECTORS and STUDENTS */
    Route::post('/administration/njacda/import/{filename}', [App\Http\Controllers\Administration\ImportDirectorsController::class, 'store'])
        ->name('administration.import');

    /** EVENTS */
    Route::get('/administration/events', [App\Http\Controllers\Administration\EventController::class, 'index'])
        ->name('administration.events');
    Route::get('/administration/events/add', [App\Http\Controllers\Administration\EventController::class, 'create'])
        ->name('administration.events.create');
    Route::get('/administration/events/edit/{event}', [App\Http\Controllers\Administration\EventController::class, 'edit'])
        ->name('administration.events.edit');
    Route::post('/administration/events/store', [App\Http\Controllers\Administration\EventController::class, 'store'])
        ->name('administration.events.store');
    Route::post('/administration/events/update/{event}', [App\Http\Controllers\Administration\EventController::class, 'update'])
        ->name('administration.events.update');

    /** EVENT ENSEMBLES */
    Route::get('/administration/events/ensemble/edit/{event}', [App\Http\Controllers\Administration\EventensembleController::class, 'edit'])
        ->name('administration.events.ensembles.edit');
    Route::post('/administration/events/ensemble/update/{event}', [App\Http\Controllers\Administration\EventensembleController::class, 'update'])
        ->name('administration.events.ensembles.update');

    /** STUDENTS **/
    Route::get('/administration/students/{director}', [App\Http\Controllers\Administration\StudentController::class, 'index'])
        ->name('administration.students');

    Route::get('/administration/students/edit/{student}', [App\Http\Controllers\Administration\StudentController::class, 'edit'])
        ->name('administration.students.edit');

    Route::post('/administration/students/update/{student}', [App\Http\Controllers\Administration\StudentController::class, 'update'])
        ->name('administration.students.update');

    Route::get('/administration/njacda/upload/students', [App\Http\Controllers\Administration\ImportStudentsController::class, 'create'])
        ->name('administration.upload.students');

    Route::get('/administration/njacda/import/students', [App\Http\Controllers\Administration\ImportStudentsController::class, 'store'])
        ->name('administration.import.students');

});

