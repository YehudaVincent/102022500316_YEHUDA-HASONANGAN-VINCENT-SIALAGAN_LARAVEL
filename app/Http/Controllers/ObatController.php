<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    private function rules(): array
    {
        return [
            'nama_obat' => 'required|string|max:255',
            'kategori'  => 'required|in:Analgesik & Antipiretik,Antibiotik,Vitamin & Suplemen',
            'sediaan'   => 'required|in:Tablet,Kapsul,Sirup,Bubuk',
            'pabrikan'  => 'required|in:Kimia Farma,Kalbe Farma,Dexa Medica,Unknown',
        ];
    }

    // READ
    public function index()
    {
        $obat = Obat::all();
        return view('obat.index', compact('obat'));
    }

    // CREATE (tampilkan form)
    public function create()
    {
        return view('obat.form', ['obat' => new Obat()]);
    }

    // CREATE (simpan)
    public function store(Request $request)
    {
        Obat::create($request->validate($this->rules()));

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil ditambahkan.');
    }

    // UPDATE (tampilkan form)
    public function edit(Obat $obat)
    {
        return view('obat.form', compact('obat'));
    }

    // UPDATE (simpan)
    public function update(Request $request, Obat $obat)
    {
        $obat->update($request->validate($this->rules()));

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diubah.');
    }

    // DELETE
    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil dihapus.');
    }
}
