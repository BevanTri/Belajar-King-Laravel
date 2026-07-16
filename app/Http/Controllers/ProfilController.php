<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user->is_admin) {
            $mhs = $user->mahasiswa;
            return $mhs
                ? redirect()->route('mahasiswa.show', $mhs->id)
                : redirect()->route('profile.edit');
        }

        $mahasiswas = Mahasiswa::with('user')->orderByRaw('CAST(nim AS INTEGER)')->get();

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

        $validated['user_id'] = auth()->id();

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        Gate::authorize('update', $mahasiswa);

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        Gate::authorize('update', $mahasiswa);

        $rules = [
            'nama'     => 'required|max:255',
            'email'    => 'nullable|email|max:255',
            'github'   => 'nullable|url|max:255',
            'bio'      => 'nullable|max:500',
        ];

        $isAdmin = auth()->user()?->is_admin;

        if ($isAdmin) {
            $rules['nim']      = 'required|max:20|unique:mahasiswas,nim,' . $id;
            $rules['prodi']    = 'required|max:100';
            $rules['angkatan'] = 'required|integer|min:2000|max:2099';
            $rules['ipk']      = 'required|numeric|min:0|max:4';
        }

        $validated = $request->validate($rules);

        if (!$isAdmin) {
            $validated['nim']      = $mahasiswa->nim;
            $validated['prodi']    = $mahasiswa->prodi;
            $validated['angkatan'] = $mahasiswa->angkatan;
            $validated['ipk']      = $mahasiswa->ipk;
        }

        $mahasiswa->update($validated);

        if (auth()->id() === $mahasiswa->user_id && isset($validated['email'])) {
            auth()->user()->update(['email' => $validated['email']]);
        }

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        Gate::authorize('delete', $mahasiswa);

        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
