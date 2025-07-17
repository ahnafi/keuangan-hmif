<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DepositPenaltyController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\TransactionController;
use App\Models\DepositPenalty;
use App\Models\DivisionCashAccess;
use Illuminate\Support\Facades\Route;

Route::get("/", [CashController::class, "index"])->name("home");
Route::get("/deposit", [DepositController::class, "index"])->name("deposit.index");
Route::get('/deposit/history', [DepositController::class, "history"])->name('deposit.history');

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
    Route::resource('division', DivisionController::class);
    // balance
    Route::get("/balance", [BalanceController::class, "index"])->name("balance.index");
    // cash
    Route::get("/cash/create", [CashController::class, "create"])->name("cash.create");
    Route::post("/cash", [CashController::class, "store"])->name("cash.store");
    Route::get("/cash/{cash}/history", [CashController::class, "history"])->name("cash.history");
    Route::delete("/cash/{cash}", [CashController::class, "destroy"])->name("cash.destroy");
    Route::delete("/cash/{cash}/history/{fundId}", [CashController::class, "destroyHistory"])->name("cash.history.destroy");
    Route::put("/cash/{cash}/history/{fundId}", [CashController::class, "updateHistory"])->name("cash.history.update");
    Route::get("/cash/transaction", [CashController::class, "transaction"])->name("cash.transaction.history");
    // deposit
    Route::post('/deposit/store', [DepositController::class, "store"])->name("deposit.store");
    Route::put('/deposit/update', [DepositController::class, "update"])->name("deposit.update");
    Route::delete('/deposit/destroy', [DepositController::class, "destroy"])->name("deposit.destroy");
    Route::get('/deposit/{deposit}/manage', [DepositController::class, "manage"])->name("deposit.manage");
    Route::post('/deposit/penalty', [DepositPenaltyController::class, "store"])->name("deposit.penalty.store");
    Route::put('/deposit/{deposit}/penalty/{depositPenalty}', [DepositPenaltyController::class, "update"])->name("deposit.penalty.update");
    Route::delete('/deposit/{deposit}/penalty/{depositPenalty}', [DepositPenaltyController::class, "destroy"])->name("deposit.penalty.destroy");
});

// route untuk divisi yang mempunyai kas
// DivisionCashAccess::