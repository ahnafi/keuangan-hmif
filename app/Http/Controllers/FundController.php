<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index()
    {
        $funds = Fund::paginate(10);
        return view("pages.fund.index", compact('funds'));
    }

    public function create()
    {
        return view("pages.fund.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:funds,name',
        ]);

        Fund::create($request->only(['name']));

        return redirect()->route('fund.index')->with('success', 'Fund created successfully.');
    }

    public function show(Fund $fund)
    {
        return view("pages.fund.show", compact('fund'));
    }

    public function edit(Fund $fund)
    {
        return view("pages.fund.edit", compact('fund'));
    }

    public function update(Request $request, Fund $fund)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:funds,name,' . $fund->id,
        ]);

        $fund->update($request->only(['name']));

        return redirect()->route('fund.index')->with('success', 'Fund updated successfully.');
    }

    public function destroy(Fund $fund)
    {
        $fund->delete();
        return redirect()->route('fund.index')->with('success', 'Fund deleted successfully.');
    }
}
