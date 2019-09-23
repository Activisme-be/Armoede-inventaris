<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Inventory\CategoryController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PersonsController;
use App\Http\Controllers\Users\AccountController;
use App\Http\Controllers\Auth\PasswordSecurityController;

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
Route::get('/home', 'HomeController@index')->name('home');

// Activity routes
Route::get('{user}/logs', [ActivityController::class, 'show'])->name('users.activity');

// Categories routes
Route::get('/categorieen', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categorie/nieuw', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categorie/nieuw', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categorie/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/categorie/verwijderen/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Notification routes
Route::get('/notificaties/markAll', [NotificationController::class, 'markAll'])->name('notifications.markAll');
Route::get('/notificaties/markOne/{notification}', [NotificationController::class, 'markOne'])->name('notifications.markAsRead');
Route::get('/notificaties/{type?}', [NotificationController::class, 'index'])->name('notifications.index');

// Persons routes
Route::get('/personen', [PersonsController::class, 'index'])->name('persons.overview');
Route::get('/personen/nieuw', [PersonsController::class, 'create'])->name('persons.create');
Route::post('/personen/nieuw', [PersonsController::class, 'store'])->name('persons.store');
Route::get('/persoon/{person}', [PersonsController::class, 'show'])->name('persons.show');
Route::patch('/persoon/{person}', [PersonsController::class, 'update'])->name('persons.update');
Route::match(['get', 'delete'], '/personen/verwijder/{person}', [PersonsController::class, 'destroy'])->name('persons.delete');

// Person notes route
Route::get('/persoon/{person}/notities', [NotesController::class, 'index'])->name('person.notes.overview');
Route::get('/persoon/{person}/nieuwe-notitie', [NotesController::class, 'create'])->name('person.notes.create');
Route::post('/persoon/{person}/nieuwe-notitie', [NotesController::class, 'store'])->name('person.notes.store');
Route::get('/notitie/verwijderen/{note}', [NotesController::class, 'destroy'])->name('person.notes.delete');
Route::get('/notitie/wijzig/{note}', [NotesController::class, 'edit'])->name('person.notes.edit');
Route::patch('/notitie/wijzig/{note}', [NotesController::class, 'update'])->name('person.notes.update');
Route::get('/notitie/{note}', [NotesController::class, 'show'])->name('person.notes.show');


// User Settings routes
Route::get('/account', [AccountController::class, 'index'])->name('account.settings');
Route::get('/account/beveiliging', [AccountController::class, 'indexSecurity'])->name('account.security');
Route::patch('/account/informatie', [AccountController::class, 'updateInformation'])->name('account.settings.info');
Route::patch('/account/beveiliging', [AccountController::class, 'updateSecurity'])->name('account.settings.security');

// 2FA routes
Route::post('/gebruiker/genereer-2fa-token', [PasswordSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
Route::post('/gebruiker/2fa', [PasswordSecurityController::class, 'enable2fa'])->name('enable2fa');
Route::post('/gebruiker/deactiveer-2fa', [PasswordSecurityController::class, 'disable2fa'])->name('disable2fa');

Route::post('/2faVerify', function () {
    return redirect()->route('home');
})->name('2faVerify')->middleware('2fa');
