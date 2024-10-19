<?php

use App\Http\Controllers\Startup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Controllers
use App\Http\Controllers\Users;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Rotas do Usúario
Route::get('/all-users',[Users::class,'index'])->name("users.index");
Route::post('/create-users',[Users::class,'store'])->name("users.store");
Route::get('/users/{id}', [Users::class, 'update'])->name("users.show");
Route::post('/users/{id}/edit', [Users::class, 'update'])->name("users.update");
Route::delete('/users/{id}/delete', [Users::class, 'destroy'])->name("users.destroy");

//Rotas da Startup
Route::get('/all-startup',[Startup::class,'index'])->name("startup.index");
Route::post('/create-startup',[Startup::class,'store'])->name("startup.store");
Route::get('/startup/{id}',[Startup::class,"show"])->name("startup.show");
Route::put('/startup/{id}/edit',[Startup::class,"update"])->name("startup.update");
Route::delete('/startup/{id}/delete', [Startup::class, 'destroy'])->name("startup.destroy");
