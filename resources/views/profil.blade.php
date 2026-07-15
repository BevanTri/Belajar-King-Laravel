@extends('layouts.app')

@section('title', 'Profil Mahasiswa')

@section('content')
    <div class="card">
        <h2>Daftar Mahasiswa</h2>
        <p style="color:#888;margin-bottom:16px;">Total data: <strong>{{ $total }}</strong> mahasiswa</p>

        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#065A82;color:white;">
                    <th style="padding:10px 12px;text-align:left;">Nama</th>
                    <th style="padding:10px 12px;text-align:left;">NIM</th>
                    <th style="padding:10px 12px;text-align:left;">Prodi</th>
                    <th style="padding:10px 12px;text-align:left;">Angkatan</th>
                    <th style="padding:10px 12px;text-align:left;">IPK</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $mhs)
                    <tr style="border-bottom:1px solid #e0e0e0;">
                        <td style="padding:10px 12px;">
                            <a href="{{ route('profil.detail', $mhs->id) }}" style="font-weight:600;">{{ $mhs->nama }}</a>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:20px;text-align:center;color:#888;">Belum ada data mahasiswa.</td>
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
