<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $divisions = Division::paginate(10);
        return view('divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name',
        ]);

        Division::create([
            'name' => $request->name,
        ]);

        return redirect()->route('division.index')
            ->with('success', 'Divisi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division): View
    {
        return view('divisions.show', compact('division'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division): View
    {
        return view('divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name,' . $division->id,
        ]);

        $division->update([
            'name' => $request->name,
        ]);

        return redirect()->route('division.index')
            ->with('success', 'Divisi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division): RedirectResponse
    {
        $division->delete();

        return redirect()->route('division.index')
            ->with('success', 'Divisi berhasil dihapus.');
    }
}
