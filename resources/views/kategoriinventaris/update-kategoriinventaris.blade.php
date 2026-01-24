@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4><span class="text-secondary">Data Kategori Inventaris //</span> Update Kategori Inventaris</h4>
    </div>
    <form action="{{route("kategoriinv.updatekategori")}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <input type="hidden" name="id" id="id" value="{{$kategoriInventaris->id}}">
    <div class="card-body">
        <div class="form-group">
            <label>NAMA KATEGORI</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{old("nama_kategori") ? old("nama_kategori") : $kategoriInventaris->nama_kategori}}">
            @error('nama_kategori')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>DESKRIPSI</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi">{{old("deskripsi") ? old("deskripsi") : $kategoriInventaris->deskripsi}}</textarea>
            @error('deskripsi')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary btn-sm" type="submit">SIMPAN</button>
        <a href="{{route("kategoriinv.index")}}" class="btn btn-danger btn-sm">BATAL</a>
    </div>
    </form>
</div>
@endsection
