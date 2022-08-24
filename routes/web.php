<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return "internal_support_ticket_backend";
});

Route::resource('ticket',TicketController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::resource('ticket',TicketController::class);
	Route::get('change_priority',[TicketController::class,'changePriority'])->name('ticket.changePriority');
	Route::get('change_status',[TicketController::class,'changeStatus'])->name('ticket.changeStatus');
	Route::get('change_type',[TicketController::class,'changeTicketType'])->name('ticket.change_type');
	Route::get('change_source',[TicketController::class,'changeTicketSource'])->name('ticket.change_source');
	Route::get('change_agent',[TicketController::class,'changeAgent'])->name('ticket.change_agent');

	Route::resource('contact',ContactController::class);
    Route::get('get_requesters',[ContactController::class,'getRequesters'])->name('contact.get_requesters');
    Route::post('check_email',[ContactController::class,'checkEmail'])->name('contact.checkEmail');

	Route::resource('notes',NoteController::class);
    Route::get('get-note-data',[NoteController::class,'getNoteDetails'])->name('notes.get_note_data');
    Route::get('delete-note',[NoteController::class,'deleteNote'])->name('notes.delete_note');

	Route::resource('company',CompanyController::class);
    Route::post('check_repeat_name',[CompanyController::class,'checkRepeatName'])->name('company.checkName');
    Route::get('get_companies',[CompanyController::class,'getCompanies'])->name('company.get_companies');

    Route::resource('to-do',TodoController::class);
    Route::post('to-do-update',[TodoController::class,'updateDetails'])->name('todo.update');
    Route::post('mark_as_done',[TodoController::class,'markAsDone'])->name('todo.mark_as_done');
    Route::post('delete_todo',[TodoController::class,'deleteTodo'])->name('todo.delete');

    Route::get('get_agents', [UserController::class,'getAgents'])->name('user.get_agents');
});

