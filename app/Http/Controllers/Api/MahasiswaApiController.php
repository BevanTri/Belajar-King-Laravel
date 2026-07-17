<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

class MahasiswaApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $mahasiswas = Mahasiswa::with('user')->orderByRaw('CAST(nim AS INTEGER)')->get();
        return MahasiswaResource::collection($mahasiswas);
    }

    public function show($id): MahasiswaResource
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
        return new MahasiswaResource($mahasiswa);
    }

    public function store(Request $request): JsonResponse
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

        $validated['user_id'] = $request->user()->id;

        $mahasiswa = Mahasiswa::create($validated);

        return response()->json([
            'message' => 'Data mahasiswa berhasil ditambahkan.',
            'data'    => new MahasiswaResource($mahasiswa->load('user')),
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        Gate::authorize('update', $mahasiswa);

        $rules = [
            'nama'   => 'required|max:255',
            'email'  => 'nullable|email|max:255',
            'github' => 'nullable|url|max:255',
            'bio'    => 'nullable|max:500',
        ];

        $isAdmin = $request->user()?->is_admin;

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

        if ($request->user()->id === $mahasiswa->user_id && isset($validated['email'])) {
            $request->user()->update(['email' => $validated['email']]);
        }

        return response()->json([
            'message' => 'Data mahasiswa berhasil diperbarui.',
            'data'    => new MahasiswaResource($mahasiswa->fresh()->load('user')),
        ]);
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        Gate::authorize('delete', $mahasiswa);

        $mahasiswa->delete();

        return response()->json(['message' => 'Data mahasiswa berhasil dihapus.']);
    }
}
