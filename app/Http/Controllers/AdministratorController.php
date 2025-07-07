<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Division;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index()
    {
        $administrators = Administrator::with('division')->paginate(10);
        return view("pages.administrator.index", compact('administrators'));
    }

    public function create()
    {
        $divisions = Division::all();
        return view("pages.administrator.create", compact('divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);

        $admin = Administrator::create($request->only(['name', 'division_id']));
        $admin->cash()->create();
        $admin->deposit()->create();

        return redirect()->route('administrator.index')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function show(Administrator $administrator)
    {
        $administrator->load('division');
        return view("pages.administrator.show", compact('administrator'));
    }

    public function edit(Administrator $administrator)
    {
        $divisions = Division::all();
        return view("pages.administrator.edit", compact('administrator', 'divisions'));
    }

    public function update(Request $request, Administrator $administrator)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);

        $administrator->update($request->only(['name', 'division_id']));

        return redirect()->route('administrator.index')->with('success', 'Pengurus berhasil diperbarui.');
    }

    public function destroy(Administrator $administrator)
    {
        $administrator->delete();
        return redirect()->route('administrator.index')->with('success', 'Pengurus berhasil dihapus.');
    }
}
