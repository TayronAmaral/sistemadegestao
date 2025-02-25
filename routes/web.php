<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupoEconomicoController;
use App\Http\Controllers\BandeiraController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\AuditController; // Importa o controlador de auditoria
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Protegendo o dashboard e algumas páginas com autenticação e verificação de e-mail
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/grupoeconomico', [GrupoEconomicoController::class, 'index'])->name('grupoeconomico');
});

// Grupo de rotas protegidas apenas por autenticação
Route::middleware('auth')->group(function () {
    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD automático para os recursos
    Route::resource('users', UserController::class);
    Route::resource('grupos', GrupoEconomicoController::class);
    Route::resource('bandeiras', BandeiraController::class);
    Route::resource('unidades', UnidadeController::class);
    Route::resource('colaboradores', ColaboradorController::class);

    // Relatórios
    Route::get('/relatorios/colaboradores', [RelatorioController::class, 'colaboradores'])->name('relatorios.colaboradores');
    Route::get('/relatorios/colaboradores/export/excel', [RelatorioController::class, 'exportExcel'])->name('relatorios.colaboradores.export.excel');
    Route::get('/relatorios/colaboradores/export/pdf', [RelatorioController::class, 'exportPdf'])->name('relatorios.colaboradores.export.pdf');

    // Auditorias
    Route::get('/audits', [AuditController::class, 'index'])->name('audits.index'); // Listar auditorias
    Route::resource('audits', AuditController::class)->only(['show']); // Exibir detalhes de uma auditoria específica
});

// Inclui as rotas de autenticação padrão do Laravel
require __DIR__.'/auth.php';
