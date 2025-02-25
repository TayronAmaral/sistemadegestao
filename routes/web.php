<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupoEconomicoController;
use App\Http\Controllers\BandeiraController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\AuditController; 

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/grupoeconomico', [GrupoEconomicoController::class, 'index'])->name('grupoeconomico');
});

Route::middleware('auth')->group(function () {    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('users', UserController::class);
    Route::resource('grupos', GrupoEconomicoController::class);
    Route::resource('bandeiras', BandeiraController::class);
    Route::resource('unidades', UnidadeController::class);
    Route::resource('colaboradores', ColaboradorController::class);
  
    Route::get('/relatorios/colaboradores', [RelatorioController::class, 'colaboradores'])->name('relatorios.colaboradores');
    Route::get('/relatorios/colaboradores/export/excel', [RelatorioController::class, 'exportExcel'])->name('relatorios.colaboradores.export.excel');
    Route::get('/relatorios/colaboradores/export/pdf', [RelatorioController::class, 'exportPdf'])->name('relatorios.colaboradores.export.pdf');
    
    Route::get('/audits', [AuditController::class, 'index'])->name('audits.index'); 
    Route::resource('audits', AuditController::class)->only(['show']); 
});

require __DIR__.'/auth.php';
