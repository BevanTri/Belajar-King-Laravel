<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::orderByRaw('CAST(nim AS INTEGER)')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|max:255',
            'nim'      => 'required|max:20|unique:mahasiswas,nim',
            'prodi'    => 'required|max:100',
            'angkatan' => 'required|integer|min:2000|max:2099',
            'ipk'      => 'required|numeric|min:0|max:4',
            'email'    => 'nullable|email|max:255',
            'github'   => 'nullable|url|max:255',
            'bio'      => 'nullable|max:500',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $validated = $request->validate([
            'nama'     => 'required|max:255',
            'nim'      => 'required|max:20|unique:mahasiswas,nim,' . $id,
            'prodi'    => 'required|max:100',
            'angkatan' => 'required|integer|min:2000|max:2099',
            'ipk'      => 'required|numeric|min:0|max:4',
            'email'    => 'nullable|email|max:255',
            'github'   => 'nullable|url|max:255',
            'bio'      => 'nullable|max:500',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
