<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\TransactionController;
use App\Models\DivisionCashAccess;
use Illuminate\Support\Facades\Route;

Route::get("/", [CashController::class, "index"])->name("home");
Route::get("/deposit", [DepositController::class, "index"])->name("deposit.index");

Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "showLoginForm"])->name("login");
    Route::post("/login", [AuthController::class, "login"]);
});

Route::middleware("auth")->group(function () {
    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
});

// Routes untuk bendahara
Route::middleware(["auth", "role:bendahara"])->group(function () {
    Route::resource('fund', FundController::class);
    Route::resource('administrator', AdministratorController::class);
    Route::resource('transaction', TransactionController::class);
    Route::get("/balance", [BalanceController::class, "index"])->name("balance.index");
});

// route untuk divisi yang mempunyai kas
// DivisionCashAccess::