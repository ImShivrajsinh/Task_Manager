<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginRegisterController;


Route::controller(LoginRegisterController::class)->group(function(){
    Route::get('/','home')->name('home');
    Route::post('/store','store')->name('store');
    Route::post('/authenticate','authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');

    });
    
Route::controller(TaskController::class)->group(function(){
    Route::any('/dashboard','ShowTask')->name('dashboard');
    Route::post('/addTask','AddTask');
    Route::get('/delete/{id}','DeleteTask')->name('deleteTask');
    Route::put('/UpdateTask', 'UpdateTask')->name('UpdateTask');
    Route::get('/edit-task/{id}','edit');
    Route::get('/markcompleted/{id}','markcompleted')->name('markcompleted');

});
