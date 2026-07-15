@extends('layouts.app')

@section('title', 'Edit ' . $mahasiswa->nama)

@section('content')
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:16px;">
            <h2 style="margin:0;border:none;padding:0;">Edit Mahasiswa</h2>
            <a href="{{ route('mahasiswa.index') }}" style="color:#065A82;">&larr; Kembali</a>
        </div>

        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom:16px;">
                <label style="font-weight:600;display:block;margin-bottom:4px;">Nama Lengkap <span style="color:red;">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" style="width:100%;padding:10px 14px;border:1px solid #ccc;border-radius:8px;font-size:1rem;" required>
                @error('nama') <span style="color:red;font-size:0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="font-weight:600;display:block;margin-bottom:4px;">NIM <span style="color:red;">*</span></label>
                <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" style="width:100%;padding:10px 14px;border:1px solid #ccc;border-radius:8px;font-size:1rem;" required>
                @error('nim') <span style="color:red;font-size:0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="font-weight:600;display:block;margin-bottom:4px;">Program Studi <span style="color:red;">*</span></label>
                <input type="text" name="prodi" value="{{ old('prodi', $mahasiswa->prodi) }}" style="width:100%;padding:10px 14px;border:1px solid #ccc;border-radius:8px;font-size:1rem;" required>
                @error('prodi') <span style="color:red;font-size:0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="font-weight:600;display:block;margin-bottom:4px;">Angkatan <span style="color:red;">*</span></label>
                    <input type="number" name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" style="width:100%;padding:10px 14px;border:1px solid #ccc;border-radius:8px;font-size:1rem;" required>
                    @error('angkatan') <span style="color:red;font-size:0.85rem;">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label style="font-weight:600;display:block;margin-bottom:4px;">IPK <span style="color:red;">*</span></label>
                    <input type="number" step="0.01" name="ipk" value="{{ old('ipk', $mahasiswa->ipk) }}" style="width:100%;padding:10px 14px;border:1px solid #ccc;border-radius:8px;font-size:1rem;" required>
                    @error('ipk') <span style="color:red;font-size:0.85rem;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="margin-bottom:16px;">
                <label style="font-weight:600;display:block;margin-bottom:4px;">Email</label>
                <input type="email" name="email" value="{{ old('email', $mahasiswa->email) }}" style="width:100%;padding:10px 14px;border:1px solid #ccc;border-radius:8px;font-size:1rem;">
                @error('email') <span style="color:red;font-size:0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="font-weight:600;display:block;margin-bottom:4px;">GitHub URL</label>
                <input type="url" name="github" value="{{ old('github', $mahasiswa->github) }}" style="width:100%;padding:10px 14px;border:1px solid #ccc;border-radius:8px;font-size:1rem;">
                @error('github') <span style="color:red;font-size:0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="font-weight:600;display:block;margin-bottom:4px;">Bio</label>
                <textarea name="bio" rows="3" style="width:100%;padding:10px 14px;border:1px solid #ccc;border-radius:8px;font-size:1rem;resize:vertical;">{{ old('bio', $mahasiswa->bio) }}</textarea>
                @error('bio') <span style="color:red;font-size:0.85rem;">{{ $message }}</span> @enderror
            </div>

            <button type="submit" style="background:#065A82;color:white;padding:12px 28px;border:none;border-radius:8px;font-size:1rem;font-weight:600;cursor:pointer;">Perbarui</button>
        </form>
    </div>
@endsection
