@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4><span class="text-secondary">Data Inventaris Toko //</span> Update Data</h4>
    </div>
    <form action="{{route("inventaris.updateinventaris")}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <input type="hidden" name="id" value="{{$inventaris->id}}">
    <div class="card-body">
        <div class="form-group">
            <label>NAMA INVENTARIS TOKO</label>
            <input type="text" class="form-control" id="nama_inventaris" name="nama_inventaris" value="{{old("nama_inventaris") ? old("nama_inventaris") : $inventaris->nama_inventaris}}">
            @error('nama_inventaris')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>KATEGORI</label>
            @php
                $selected = old('kategori_inventaris_id') ? old('kategori_inventaris_id') : $inventaris->kategori_inventaris_id;
            @endphp
            <select class="form-control" name="kategori_inventaris_id">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoriInv as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ $selected == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_inventaris_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>DESKRIPSI</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi">{{old("deskripsi") ? old("deskripsi") : $inventaris->deskripsi}}</textarea>
            @error('deskripsi')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary btn-sm" type="submit">SIMPAN</button>
        <a href="{{route("inventaris.index")}}" class="btn btn-danger btn-sm">BATAL</a>
    </div>
    </form>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset("otika-assets/bundles/datatables/datatables.min.css")}}">
<link rel="stylesheet" href="{{asset("otika-assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css")}}">
@endsection

@section('javascript')
<script src="{{asset("otika-assets/bundles/datatables/datatables.min.js")}}"></script>
<script src="{{asset("otika-assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{asset("otika-assets/bundles/sweetalert/sweetalert.min.js")}}"></script>
<script src="{{asset("otika-assets/js/page/sweetalert.js")}}"></script>
@endsection
