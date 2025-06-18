<?php

namespace App\Http\Controllers;

use App\Models\Saham;
use Illuminate\Http\Request;

class SahamController extends Controller
{
    public function index()
    {
        $sahams = Saham::all();
        return view('saham.index', compact('sahams'));
    }

    public function create()
    {
        return view('saham.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'entry_date' => 'required|date',
        ]);

        Saham::create($request->all());
        return redirect()->route('saham.index')->with('success', 'Saham berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $saham = Saham::findOrFail($id);
        return view('saham.edit', compact('saham'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'entry_date' => 'required|date',
        ]);

        $saham = Saham::findOrFail($id);
        $saham->update($request->all());
        return redirect()->route('saham.index')->with('success', 'Saham berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $saham = Saham::findOrFail($id);
        $saham->delete();
        return redirect()->route('saham.index')->with('success', 'Saham berhasil dihapus.');
    }
}

