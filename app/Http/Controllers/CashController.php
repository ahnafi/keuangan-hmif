<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use Illuminate\Http\Request;

class CashController extends Controller
{
    public function index()
    {
        $cash = Cash::get();

        return response()->view("pages/home",compact("cash"));
    }
}
