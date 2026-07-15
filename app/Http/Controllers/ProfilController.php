<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;

class ProfilController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::orderByRaw('CAST(nim AS INTEGER)')->get();
        $total = $mahasiswas->count();

        return view('profil', compact('mahasiswas', 'total'));
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('profil-detail', compact('mahasiswa'));
    }
}