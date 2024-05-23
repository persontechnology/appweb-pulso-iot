<?php

use App\Http\Controllers\AlertaController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceProfileController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\LecturaController;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class,'welcome'])->name('welcome');
Route::get('/no-tiene-inquilino', [WelcomeController::class,'noTieneInquilino'])->name('no-tiene-inquilino');
Route::get('/cuenta-inactiva',[WelcomeController::class,'cuentaInactiva'])->name('cuenta-inactiva');

Route::get('/l-c',function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    // Artisan::call('storage:link');
    // Artisan::call('key:generate');
    // Artisan::call('migrate --seed');
});




Route::middleware(['auth','check.tenant_id','verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
    Route::resource('clientes', ClienteController::class);
    
    Route::resource('dispositivos', DispositivoController::class);
    Route::resource('lecturas', LecturaController::class);


   
    
    


    


});

require __DIR__.'/auth.php';
