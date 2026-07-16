@extends('layouts.app')

@section('title', 'Detail ' . $mahasiswa->nama)

@section('content')
    <div class="hero-card">
        <h1>{{ $mahasiswa->nama }}</h1>
        <p>{{ $mahasiswa->prodi }} &bull; Angkatan {{ $mahasiswa->angkatan }}</p>
        @if($mahasiswa->ipk >= 3.75)
            <span class="badge badge-cumlaude">Cumlaude</span>
        @else
            <span class="badge badge-memuaskan">Sangat Memuaskan</span>
        @endif
    </div>

    <div class="card">
        <h2>Informasi</h2>
        <p><span class="info-label">NIM:</span> {{ $mahasiswa->nim }}</p>
        <p><span class="info-label">IPK:</span> {{ number_format($mahasiswa->ipk, 2) }}</p>
        <p><span class="info-label">Email:</span> {{ $mahasiswa->email ?? '-' }}</p>
        <p><span class="info-label">GitHub:</span> <a href="{{ $mahasiswa->github }}">{{ $mahasiswa->github ?? '-' }}</a></p>
        <p><span class="info-label">Ditambahkan oleh:</span> {{ $mahasiswa->user->name ?? '—' }}</p>
        <p style="margin-top:12px;">{{ $mahasiswa->bio ?? '-' }}</p>
    </div>

    <div style="text-align:center;margin-top:16px;display:flex;justify-content:center;gap:12px;flex-wrap:wrap;">
        @can('update', $mahasiswa)
            <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" style="background:#065A82;color:white;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600;font-size:0.9rem;">Edit Profil</a>
        @endcan
        @if(auth()->user()?->is_admin)
            <a href="{{ route('mahasiswa.index') }}" style="color:#065A82;padding:10px 24px;">&larr; Kembali ke daftar</a>
        @endif
    </div>
@endsection
