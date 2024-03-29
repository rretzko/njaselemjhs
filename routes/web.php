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

Route::group(['middleware' => 'auth'],
    function () {

        //Route::get('/dashboard', function () {
         //   return view('dashboard');
        //})->name('dashboard');

        Route::get('/administration', [App\Http\Controllers\Administration\AdministrationController::class, 'index'])
            ->name('administration.index');

        /** ADJUDICATORS */
        Route::get('/adjudication', [App\Http\Controllers\Adjudication\AdjudicatorController::class, 'index'])
            ->name('adjudication.index');
        Route::get('/adjudication/show/{adjudicator}/{student}', [App\Http\Controllers\Adjudication\AdjudicatorController::class, 'show'])
            ->name('adjudication.show');
        Route::post('/adjudication/update/{adjudicator}/{student}', [App\Http\Controllers\Adjudication\AdjudicatorController::class, 'update'])
            ->name('adjudication.update');

        /** CUT-OFFS **/
        Route::get('/administration/cutoffs', [App\Http\Controllers\Administration\CutoffController::class, 'index'])
            ->name('administration.cutoffs');
        Route::get('/administration/cutoffs/finalscores', [App\Http\Controllers\Administration\CutoffController::class, 'finalScores'])
            ->name('administration.cutoffs.finalscores');
        Route::get('/administration/cutoffs/{event}', [App\Http\Controllers\Administration\CutoffController::class, 'show'])
            ->name('administration.cutoffs.show');
        Route::get('/administration/cutoffs/{event}/{ensemble}', [App\Http\Controllers\Administration\CutoffensembleController::class, 'show'])
            ->name('administration.cutoffs.ensemble.show');
        Route::get('/administration/cutoffs/update/{event}/{ensemble}/{voicepart}/{score}', [App\Http\Controllers\Administration\CutoffController::class, 'update'])
            ->name('administration.cutoffs.ensemble.update');

        /** DASHBOARD */
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
            ->name('dashboard');

        /** ADMINISTRATOR MISC */
        Route::get('/administration/changepassword', [App\Http\Controllers\Administration\ChangePasswordController::class, 'edit'])
            ->name('administration.changepassword.edit');
        Route::post('/administration/changepassword/update', [App\Http\Controllers\Administration\ChangePasswordController::class, 'update'])
            ->name('administration.changepassword.update');
        Route::get('/administration/loginas', [App\Http\Controllers\Administration\LogInAsController::class, 'edit'])
            ->name('administration.loginas.edit');
        Route::post('/administration/loginas/update', [App\Http\Controllers\Administration\LogInAsController::class, 'update'])
            ->name('administration.loginas.update');


        /** DIRECTORS **/
        Route::get('/administration/director/{director}', [App\Http\Controllers\Administration\DirectorController::class, 'edit'])
            ->name('administration.director');

        Route::post('/administration/director/update/{director}', [App\Http\Controllers\Administration\DirectorController::class, 'update'])
            ->name('administration.director.update');

        Route::post('/administration/director/store/{director}', [App\Http\Controllers\Administration\DirectorController::class, 'store'])
            ->name('administration.director.store');

        Route::get('/administration/directors', [App\Http\Controllers\Administration\DirectorController::class, 'index'])
            ->name('administration.directors');

        Route::get('/administration/njacda/download/directors', [App\Http\Controllers\Administration\ExportDirectorsController::class, 'export'])
            ->name('administration.download.directors');

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

        /** EVENT ADJUDICATORS */
        Route::get('/administration/adjudicators/{event}', [App\Http\Controllers\Administration\AdjudicatorController::class, 'create'])
            ->name('administration.adjudicators');
        Route::get('/administration/adjudicators/add/{event}', [App\Http\Controllers\Administration\AdjudicatorController::class, 'create'])
            ->name('administration.adjudicators.create');
        Route::get('/administration/adjudicators/edit/{event}/{ensemble}/{room}', [App\Http\Controllers\Administration\AdjudicatorController::class, 'edit'])
            ->name('administration.adjudicators.edit');
        Route::post('/administration/adjudicators/store/{event}', [App\Http\Controllers\Administration\AdjudicatorController::class, 'store'])
            ->name('administration.adjudicators.store');
        Route::post('/administration/adjudicators/update/{event}/{room}', [App\Http\Controllers\Administration\AdjudicatorController::class, 'update'])
            ->name('administration.adjudicators.update');

        /** EVENT ENSEMBLES */
        Route::get('/administration/events/ensemble/edit/{event}', [App\Http\Controllers\Administration\EventensembleController::class, 'edit'])
            ->name('administration.events.ensembles.edit');
        Route::post('/administration/events/ensemble/update/{event}', [App\Http\Controllers\Administration\EventensembleController::class, 'update'])
            ->name('administration.events.ensembles.update');

        /** EVENT ROOMS */
        Route::get('/administration/rooms/{event}', [App\Http\Controllers\Administration\RoomController::class, 'index'])
            ->name('administration.rooms');
        Route::get('/administration/rooms/add/{event}', [App\Http\Controllers\Administration\RoomController::class, 'create'])
            ->name('administration.rooms.create');
        Route::get('/administration/rooms/edit/{room}', [App\Http\Controllers\Administration\RoomController::class, 'edit'])
            ->name('administration.rooms.edit');
        Route::post('/administration/rooms/store/{event}', [App\Http\Controllers\Administration\RoomController::class, 'store'])
            ->name('administration.rooms.store');
        Route::post('/administration/rooms/update/{event}', [App\Http\Controllers\Administration\RoomController::class, 'update'])
            ->name('administration.rooms.update');

        /** REPORTS */
        Route::get('/administration/reports', [App\Http\Controllers\Administration\Reports\ReportsController::class, 'index'])
            ->name('administration.reports');
        Route::get('/administration/reports/adjudicationbackup/{ensemble}', [App\Http\Controllers\Administration\Reports\AdjudicationbackupController::class, 'index'])
            ->name('administration.reports.adjudicationbackup');
        //Route::get('/administration/reports/adjudicationbackup', [App\Http\Controllers\Administration\Reports\AdjudicationbackupController::class, 'index'])
        //    ->name('administration.reports.adjudicationbackup');

        Route::get('/administration/reports/participants', [App\Http\Controllers\Administration\Reports\CsvParticipantsController::class, 'index'])
            ->name('administration.reports.participants');
        Route::get('/administration/reports/participants/ensemble/{event}/{ensemble}', [App\Http\Controllers\Administration\Reports\CsvParticipantsController::class, 'download'])
            ->name('administration.reports.participants.ensemble');
        Route::get('participants/export/', [\App\Http\Controllers\Administration\Reports\CsvParticipantsController::class, 'export']);

        /** SCORES PDFs */
        Route::get('/administration/reports/scores', [App\Http\Controllers\Administration\Reports\PdfscoresController::class, 'index'])
            ->name('administration.reports.scores');
        Route::get('/administration/reports/scores/ensemble/{event}/{ensemble}', [App\Http\Controllers\Administration\Reports\PdfscoresController::class, 'download'])
            ->name('administration.reports.scores.ensemble');

        /** SCORES CSVs */
        Route::get('/administration/reports/scores/csv/ensemble/{event}/{ensemble}', [App\Http\Controllers\Administration\Reports\CsvscoresController::class, 'export'])
            ->name('administration.reports.scores.csv.ensemble');

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

