@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:16px;">
            <h2 style="margin:0;border:none;padding:0;">Daftar Mahasiswa</h2>
            <a href="{{ route('mahasiswa.create') }}" style="background:#21B0A7;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:0.9rem;">+ Tambah Mahasiswa</a>
        </div>

        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#065A82;color:white;">
                    <th style="padding:10px 12px;text-align:left;">Nama</th>
                    <th style="padding:10px 12px;text-align:left;">NIM</th>
                    <th style="padding:10px 12px;text-align:left;">Prodi</th>
                    <th style="padding:10px 12px;text-align:left;">Angkatan</th>
                    <th style="padding:10px 12px;text-align:left;">IPK</th>
                    <th style="padding:10px 12px;text-align:left;">Ditambahkan oleh</th>
                    <th style="padding:10px 12px;text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $mhs)
                    <tr style="border-bottom:1px solid #e0e0e0;">
                        <td style="padding:10px 12px;">
                            <a href="{{ route('mahasiswa.show', $mhs->id) }}" style="font-weight:600;">{{ $mhs->nama }}</a>
                        </td>
                        <td style="padding:10px 12px;">{{ $mhs->nim }}</td>
                        <td style="padding:10px 12px;">{{ $mhs->prodi }}</td>
                        <td style="padding:10px 12px;">{{ $mhs->angkatan }}</td>
                        <td style="padding:10px 12px;">
                            @if($mhs->ipk >= 3.75)
                                <span class="badge badge-cumlaude">{{ number_format($mhs->ipk, 2) }}</span>
                            @else
                                <span class="badge badge-memuaskan">{{ number_format($mhs->ipk, 2) }}</span>
                            @endif
                        </td>
                        <td style="padding:10px 12px;font-size:0.85rem;color:#888;">
                            {{ $mhs->user->name ?? '—' }}
                        </td>
                        <td style="padding:10px 12px;text-align:center;white-space:nowrap;">
                            @can('update', $mhs)
                                <a href="{{ route('mahasiswa.edit', $mhs->id) }}" style="background:#065A82;color:white;padding:5px 14px;border-radius:6px;text-decoration:none;font-size:0.8rem;display:inline-block;margin-right:4px;">Edit</a>
                                <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus {{ $mhs->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:#c0392b;color:white;padding:5px 14px;border:none;border-radius:6px;font-size:0.8rem;cursor:pointer;">Hapus</button>
                                </form>
                            @else
                                <span style="color:#999;font-size:0.85rem;">(Data orang lain)</span>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:20px;text-align:center;color:#888;">Belum ada data mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('styles')
<style>
    body.dark table tbody tr { border-bottom-color: #2a2a4a; }
    body.dark table tbody tr:hover { background: #1a1a2e; }
    body.dark table thead tr { background: #0a1628 !important; }
</style>
@endpush
