@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Berita</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Judul</label>
            <input type="text" name="judul" required>
        </div>
        <div>
            <label>Konten</label>
            <textarea name="konten" rows="5" required></textarea>
        </div>
        <div>
            <label>Gambar</label>
            <input type="file" name="gambar" accept="image/*">
        </div>
        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
