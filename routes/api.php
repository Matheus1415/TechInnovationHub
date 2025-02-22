<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Controllers
use App\Http\Controllers\Users;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Proposals;
use App\Http\Controllers\Startup;

// Rota de login - Gera o token
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create-user',[Users::class,'store'])->name("user.store");

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    //Rotas do Usúario
    Route::get('user', [AuthController::class, 'authUser']);
    Route::get('/users',[Users::class,'index'])->name("users.index");
    Route::get('/users/{id}', [Users::class, 'show'])->name("users.show");
    Route::post('/users/{id}/edit', [Users::class, 'update'])->name("users.update");
    Route::delete('/users/{id}', [Users::class, 'destroy'])->name("users.destroy");

    Route::middleware('startup.auth')->group(function () {
        //Rotas da Startup
        Route::get('/startup',[Startup::class,'index'])->name("startup.index");
        Route::post('/startup',[Startup::class,'store'])->name("startup.store");
        Route::get('/startup/{id}',[Startup::class,"show"])->name("startup.show");
        Route::put('/startup/{id}/edit',[Startup::class,"update"])->name("startup.update");
        Route::delete('/startup/{id}', [Startup::class, 'destroy'])->name("startup.destroy");
        Route::delete('/startup/{id}/group', [Startup::class, 'destroyGroup'])->name("startup.destroy");
    });
    
    //Rotas da Proposals
    Route::get('/proposalss',[Proposals::class,'index'])->name("proposalss.index");
    Route::post('/proposalss',[Proposals::class,'store'])->name("proposalss.store");
    Route::get('/proposalss/{id}',[Proposals::class,"show"])->name("proposalss.show");
    Route::put('/proposalss/{id}/edit',[Proposals::class,"update"])->name("proposalss.update");
    Route::delete('/proposalss/{id}', [Proposals::class, 'destroy'])->name("proposalss.destroy");
});


