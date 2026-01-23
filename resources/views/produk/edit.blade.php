@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4><span class="text-secondary">Data Produk //</span> Update Data</h4>
    </div>
    <form action="{{route("produk.update")}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <input type="hidden" name="id" value="{{$produk->id}}">
    <div class="card-body">
        <div class="form-group">
            <label>NAMA PRODUK</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{old("nama_produk") ? old("nama_produk") : $produk->nama_produk}}">
            @error('nama_produk')
            <div class="text-danger">{{$message}}</div>   
            @enderror
        </div>
        <div class="form-group">
            <label>KATEGORI</label>
            @php
                $selected = old('kategori_produk_id') ? old('kategori_produk_id') : $produk->kategori_produk_id; 
            @endphp
            <select class="form-control" name="kategori_produk_id">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoriProduk as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ $selected == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_produk_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>HARGA BELI (Rp)</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{old("harga_beli") ? old("harga_beli") : $produk->harga_beli}}">
            @error('harga_beli')
            <div class="text-danger">{{$message}}</div>   
            @enderror
        </div>
        <div class="form-group">
            <label>HARGA JUAL (Rp)</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{old("harga_jual") ? old("harga_jual") : $produk->harga_jual}}">
            @error('harga_jual')
            <div class="text-danger">{{$message}}</div>   
            @enderror
        </div>
        <div class="form-group">
            <label>DESKRIPSI</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi">{{old("deskripsi") ? old("deskripsi") : $produk->deskripsi}}</textarea>
            @error('deskripsi')
            <div class="text-danger">{{$message}}</div>   
            @enderror
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary btn-sm" type="submit">SIMPAN</button>
        <a href="{{route("produk.index")}}" class="btn btn-danger btn-sm">BATAL</a>
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