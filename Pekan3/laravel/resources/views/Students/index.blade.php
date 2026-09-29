@extends('layouts.main')
@section('title', 'Daftar Mahasiswa')
@section('content')
    <h2>Daftar Mahasiswa</h2>

    <x-alert type="success" message="Data Mahasiswa berhasil dimuat!" />

    @foreach ($students as $student)
        <div class="card">
            <h3>{{ $student['name'] }}</h3>
            <p><strong>Usia:</strong> {{ $student['age'] }}</p>
            <p><strong>Jurusan:</strong> {{ $student['major'] }}</p>

            @if($student['age'] >= 22)
            <p>Status: <span class="color:green;">Senior</span></p>
            @else
           <p>Status: <span class="color:green;">Junior</span></p>
            @endif
            
             <h4>Mata Kuliah: </h4>
            @forelse($student['courses'] as $course)
                <span class="course">{{ $course}}</span>
            @empty
                <p>Tidak ada mata kuliah terdaftar</p>
            @endforelse
        </div>
    @endforeach
    @endsection
