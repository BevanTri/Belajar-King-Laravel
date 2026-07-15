@extends('layouts.app')

@section('title', 'Tentang Mata Kuliah')

@section('content')
    <div class="card">
        <h2>{{ $info['matakuliah'] }}</h2>
        <p><span class="info-label">Semester:</span> {{ $info['semester'] }}</p>
        <p><span class="info-label">Dosen Pengampu:</span> {{ $info['dosen'] }}</p>
    </div>
@endsection