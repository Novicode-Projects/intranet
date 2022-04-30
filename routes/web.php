<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\LearnerController;
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
    // User
    Route::get('/', function () {return view('index');})->name('user.index')->middleware('guest');
    Route::get('/inscription', [UserController::class, 'create'])->name('user.create')->middleware('guest');
    Route::post('/inscription', [UserController::class, 'store'])->name('user.store')->middleware('guest');

    Route::get('/mot-de-passe-oublie', [UserController::class, 'forgotPassword'])->name('user.forgotPassword')->middleware('guest');
    Route::post('/mot-de-passe-oublie', [UserController::class, 'postEmail'])->name('user.postEmail')->middleware('guest');

    Route::get('/nouveau-mot-de-passe/{token}', [UserController::class, 'resetPassword'])->name('user.resetPassword')->middleware('guest');
    Route::post('/nouveau-mot-de-passe', [UserController::class, 'updatePassword'])->name('user.updatePassword')->middleware('guest');
    
    Route::post('/', [UserController::class, 'login'])->name('user.login')->middleware('guest');
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');
    //Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

    // Mon équipe
    Route::get('/equipe', [DashboardController::class, 'createTeam'])->name('dashboard.createTeam')->middleware('auth'); 
    Route::post('/equipe', [DashboardController::class, 'storeTeam'])->name('dashboard.storeTeam')->middleware('auth'); 
    Route::get('/equipe/{id}', [DashboardController::class, 'editTeam'])->name('dashboard.editTeam')->middleware('auth'); 
    Route::post('/equipe/{id}', [DashboardController::class, 'updateTeam'])->name('dashboard.updateTeam')->middleware('auth'); 
    Route::delete('/equipe/{id}', [DashboardController::class, 'destroyTeam'])->name('dashboard.destroyTeam')->middleware('auth'); 

    // Mes élèves
    Route::get('/salaries', [DashboardController::class, 'createLearner'])->name('dashboard.createLearner')->middleware('auth');
    Route::post('/salaries', [DashboardController::class, 'storeLearner'])->name('dashboard.storeLearner')->middleware('auth');
    Route::get('/salaries/{id}', [DashboardController::class, 'editLearner'])->name('dashboard.editLearner')->middleware('auth'); 
    Route::post('/salaries/{id}', [DashboardController::class, 'updateLearner'])->name('dashboard.updateLearner')->middleware('auth'); 
    Route::delete('/salaries/{id}', [DashboardController::class, 'destroyLearner'])->name('dashboard.destroyLearner')->middleware('auth');

    // Les entreprises
    Route::get('/entreprises', [CompanyController::class, 'create'])->name('company.createCompany')->middleware('auth');
    Route::post('/entreprises', [CompanyController::class, 'store'])->name('company.storeCompany')->middleware('auth');
    Route::get('/entreprises/{id}', [CompanyController::class, 'edit'])->name('company.editCompany')->middleware('auth'); 
    Route::post('/entreprises/{id}', [CompanyController::class, 'update'])->name('company.updateCompany')->middleware('auth'); 
    Route::delete('/entreprises/{id}', [CompanyController::class, 'destroy'])->name('company.destroyCompany')->middleware('auth');

    // Les formations
    Route::get('/formations', [FormationController::class, 'create'])->name('formation.createFormation')->middleware('auth');
    Route::post('/formations', [FormationController::class, 'store'])->name('formation.storeFormation')->middleware('auth');
    Route::get('/formations/{id}', [FormationController::class, 'edit'])->name('formation.editFormation')->middleware('auth'); 
    Route::post('/formations/{id}', [FormationController::class, 'update'])->name('formation.updateFormation')->middleware('auth'); 
    Route::delete('/formations/{id}', [FormationController::class, 'destroy'])->name('formation.destroyFormation')->middleware('auth'); 

    // Les sessions
    Route::get('/sessions', [SessionController::class, 'create'])->name('session.createSession')->middleware('auth');
    Route::post('/sessions', [SessionController::class, 'store'])->name('session.storeSession')->middleware('auth');
    Route::get('/sessions/{id}', [SessionController::class, 'edit'])->name('session.editSession')->middleware('auth'); 
    Route::post('/sessions/{id}', [SessionController::class, 'update'])->name('session.updateSession')->middleware('auth'); 
    Route::delete('/sessions/{id}', [SessionController::class, 'destroy'])->name('session.destroySession')->middleware('auth'); 

    // Pdf
    Route::post('/sessions-pdf/{id}', [PdfController::class, 'store'])->name('pdf.storePdf')->middleware('auth');
    Route::delete('/sessions-pdf/{id}', [PdfController::class, 'destroy'])->name('pdf.destroyPdf')->middleware('auth'); 

    // Learners
    Route::post('/sessions/{id}', [LearnerController::class, 'store'])->name('learner.storeLearner')->middleware('auth');
    Route::delete('/sessions/{id}', [LearnerController::class, 'destroy'])->name('learner.destroyLearner')->middleware('auth'); 

    // 404
    Route::fallback(function() {
        return view('404'); // la vue 404.blade.php
    });