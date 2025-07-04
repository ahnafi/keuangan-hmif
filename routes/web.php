<?php

use App\Http\Controllers\CashController;
use Illuminate\Support\Facades\Route;

Route::get("/", [CashController::class, "index"])->name("home");
Route::get("/deposit", fn() => view("pages/deposit"))->name("deposit.index");

// Route::middleware("guest")->group(function () {
//     Route::get("/login", fn() => view("auth/login"))->name("login");
// });

// Route::post("/logout", fn() => redirect()->route("home"))->name("logout");

// Route::middleware(["auth", "role:bendahara"])->group(function(){
//     // Routes untuk bendahara
//     Route::get("/dashboard", fn() => view("dashboard/bendahara"))->name("dashboard.bendahara");
//     Route::get("/admin/funds", fn() => view("admin/funds"))->name("admin.funds");
//     Route::get("/admin/transactions", fn() => view("admin/transactions"))->name("admin.transactions");
// });

