<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Controllers
use App\Http\Controllers\Users;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Propostas;
use App\Http\Controllers\Startup;

// Rota de login - Gera o token
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create-user',[Users::class,'store'])->name("user.store");

Route::middleware(['auth:sanctum'])->group(function () {
    // Rota de logout - Invalida o token
    Route::post('logout', [AuthController::class, 'logout']);

    //Rotas do Usúario
    Route::get('user', [AuthController::class, 'authUser']);
    Route::get('/all-users',[Users::class,'index'])->name("users.index");
    Route::get('/users/{id}', [Users::class, 'show'])->name("users.show");
    Route::post('/users/{id}/edit', [Users::class, 'update'])->name("users.update");
    Route::post('/user/type', [Users::class, 'createTypeUser'])->name("users.create.type");
    Route::delete('/users/{id}', [Users::class, 'destroy'])->name("users.destroy");

    Route::middleware('startup.auth')->group(function () {
        //Rotas da Startup
        Route::get('/all-startup',[Startup::class,'index'])->name("startup.index");
        Route::post('/create-startup',[Startup::class,'store'])->name("startup.store");
        Route::get('/startup/{id}',[Startup::class,"show"])->name("startup.show");
        Route::put('/startup/{id}/edit',[Startup::class,"update"])->name("startup.update");
        Route::delete('/startup/{id}', [Startup::class, 'destroy'])->name("startup.destroy");
        Route::delete('/startup/{id}/group', [Startup::class, 'destroyGroup'])->name("startup.destroy");
    });
    
    //Rotas da Propostas
    Route::get('/all-propostas',[Propostas::class,'index'])->name("propostas.index");
    Route::post('/create-propostas',[Propostas::class,'store'])->name("propostas.store");
    Route::get('/propostas/{id}',[Propostas::class,"show"])->name("propostas.show");
    Route::put('/propostas/{id}/edit',[Propostas::class,"update"])->name("propostas.update");
    Route::delete('/propostas/{id}', [Propostas::class, 'destroy'])->name("propostas.destroy");

});


