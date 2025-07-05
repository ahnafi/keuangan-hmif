<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        return response()->view("pages.deposit");
    }
}
