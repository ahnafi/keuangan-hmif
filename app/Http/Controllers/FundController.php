<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index()
    {
        return response()->view("pages.fund.index");
    }
}
