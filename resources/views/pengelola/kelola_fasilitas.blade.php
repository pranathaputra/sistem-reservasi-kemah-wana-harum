@extends('layouts.pengelola')

@section('content')

<h2>Kelola Fasilitas</h2>

<form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="nama_fasilitas" placeholder="Nama Fasilitas" required>
    <br><br>

    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
    <br><br>

    <input type="file" name="foto">
    <br><br>

    <button type="submit">Tambah Fasilitas</button>
</form>

<hr>

<h3>Daftar Fasilitas</h3>

@foreach($fasilitas as $item)

<form action="{{ route('admin.fasilitas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="nama_fasilitas" value="{{ $item->nama_fasilitas }}">
    <br>

    <textarea name="deskripsi">{{ $item->deskripsi }}</textarea>
    <br>

    <input type="file" name="foto">
    <br>

    <button type="submit">Update</button>

    <a href="{{ route('admin.fasilitas.delete', $item->id) }}">
        Hapus
    </a>

</form>

<hr>

@endforeach

@endsection