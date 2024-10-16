<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PraticaController;
use App\Http\Controllers\IntestatariController;
use App\Http\Controllers\AllegatoController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UtenteController;


Route::get('/welcome', [HomeController::class, 'index'])->name('home');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('pages.index');
    Route::get('/', [PagesController::class, 'index'])->name('pages.index');
    Route::get('/elimina-account', [PagesController::class, 'mostraConfermaEliminazione'])->name('pages.mostra-conferma-eliminazione');
    Route::delete('/elimina-account', [PagesController::class, 'eliminaAccount'])->name('pages.elimina-account');
    Route::get('/elimina-riga/{id}', [PagesController::class, 'deleteRow'])->name('pages.delete-row');
    Route::get('/blank', [PagesController::class, 'blank'])->name('pages.blank');
    Route::get('/pratica', [PraticaController::class, 'pratica'])->name('pages.pratica');
    Route::post('/pratica', [PraticaController::class, 'store']);
    Route::get('/allegati', [AllegatoController::class, 'index'])->name('pages.allegati');
    Route::post('/allegati/upload/{id_pratica}', [AllegatoController::class, 'upload'])->name('pages.allegati.upload');
    Route::get('/allegati/{id_allegato}/visualizza', [AllegatoController::class, 'visualizza'])->name('pages.visualizza');
    Route::get('/allegati/{id_allegato}/scarica', [AllegatoController::class, 'scarica'])->name('pages.scarica');
    Route::get('/intestatari', [IntestatariController::class, 'index'])->name('pages.intestatari');
    Route::post('/intestatari', [IntestatariController::class, 'store']);
    Route::get('/charts', [PagesController::class, 'charts'])->name('pages.charts');
    Route::get('/tables', [PagesController::class, 'tables'])->name('pages.tables');
    Route::get('/elimina-riga/{id}', [PagesController::class, 'eliminaRiga'])->name('pages.elimina-riga');
    Route::get('/visualizza/{id_allegato}', [AllegatoController::class, 'visualizza'])->name('pages.visualizza');
    Route::delete('/elimina-allegato/{id_allegato}', [AllegatoController::class, 'eliminaAllegato'])->name('pages.elimina-allegato');
    Route::get('/card/{id_pratica}', [PagesController::class, 'visualizzaCard'])->name('pages.card');
});

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('pages.forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestFormPost'])->name('pages.forgot-password.post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('pages.reset-password');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPasswordPost'])->name('pages.reset-password.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('pages.login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('pages.register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('pages.logout');


Route::middleware(['web', 'auth', 'admin'])->group(function () {
    Route::get('/tabella-intestatari', [PagesController::class, 'tabellaIntestatari'])->name('pages.tabella-intestatari');
    Route::get('/elimina-intestatari/{id}', [IntestatariController::class, 'eliminaIntestatari'])->name('pages.elimina-intestatari');
    Route::get('/modifica-intestatari/{id}', [IntestatariController::class, 'mostraFormModifica'])->name('pages.modifica-intestatari');
    Route::get('/modifica-intestatari/{id}/get-data', [IntestatariController::class, 'getDataForEdit']);
    Route::put('/modifica-intestatari/{id}', [IntestatariController::class, 'modificaIntestatario'])->name('pages.modifica-intestatari');
    Route::put('/intestatari/{id}', [IntestatariController::class, 'update'])->name('intestatari.update');
    Route::get('/tabella-utenti', [PagesController::class, 'tabellaUtenti'])->name('pages.tabella-utenti');
    Route::get('/elimina-utente/{id}', [UtenteController::class, 'eliminaUtente'])->name('pages.elimina-utente');
    Route::get('/modifica-utente/{id}', [UtenteController::class, 'mostraFormModifica'])->name('pages.modifica-utente');
    Route::get('/modifica-utente/{id}/get-data', [UtenteController::class, 'getUtenteData']);
    Route::put('/modifica-utente/{id}', [UtenteController::class, 'modificaUtente'])->name('pages.modifica-utente');
    Route::put('/utente/{id}', [UtenteController::class, 'update'])->name('utente.update');
    Route::get('/tabella-pratiche', [PagesController::class, 'tabellaPratiche'])->name('pages.tabella-pratiche');
    Route::get('/elimina-pratica/{id}', [PraticaController::class, 'eliminaPratica'])->name('pages.elimina-pratica');
    Route::get('/modifica-pratica/{id}', [PraticaController::class, 'mostraFormModifica'])->name('pages.modifica-pratica');
    Route::get('/modifica-pratica/{id}/get-data', [PraticaController::class, 'getPraticaData']);
    Route::put('/modifica-pratica/{id}', [PraticaController::class, 'modificaPratica'])->name('pages.modifica-pratica');
    Route::put('/pratica/{id}', [PraticaController::class, 'update'])->name('pratica.update');
});
Route::get('/not-found', [PagesController::class, 'notFound'])->name('pages.404');
