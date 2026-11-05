@extends('layouts.app')

@section('title', 'Kelola Petugas')

@section('content')
<p class="kecil">Khusus admin</p>
<h1 class="judul-halaman">Kelola Petugas</h1>
<p class="lead" style="margin-bottom:24px">Daftar semua akun yang terdaftar ({{ $users->count() }} akun).</p>

<div class="tabel-gulir">
    <table class="tabel">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="peran peran-{{ $user->role }}">{{ $user->role }}</span></td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        {{-- Hanya akun petugas yang punya tombol hapus --}}
                        @if ($user->role == 'petugas')
                            <form action="/admin/petugas/{{ $user->id }}" method="POST"
                                  onsubmit="return confirm('Hapus akun ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="tombol-hapus">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
