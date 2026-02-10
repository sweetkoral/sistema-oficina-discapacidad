<?php

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

Route::get('/migrate-db', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true, '--seed' => true]);
        return "Base de datos migrada y sembrada con éxito.";
    } catch (\Exception $e) {
        return "Error al migrar la base de datos: " . $e->getMessage();
    }
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('beneficiaries', \App\Http\Controllers\BeneficiaryController::class);

    Route::get('/reports', [\App\Http\Controllers\ReportsController::class, 'index'])->name('reports.index');
    Route::get('/reports/generate', [\App\Http\Controllers\ReportsController::class, 'generate'])->name('reports.generate');

    Route::get('/export/excel', [\App\Http\Controllers\ExportController::class, 'excel'])->name('export.excel');
    Route::get('/export/pdf', [\App\Http\Controllers\ExportController::class, 'pdf'])->name('export.pdf');
});

require __DIR__ . '/auth.php';
