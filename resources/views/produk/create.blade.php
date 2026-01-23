@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4><span class="text-secondary">Data Produk //</span> Buat Data Baru</h4>
    </div>
    <form action="{{route("produk.save")}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <div class="card-body">
        <div class="form-group">
            <label>NAMA PRODUK</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{old("nama_produk")}}">
            @error('nama_produk')
            <div class="text-danger">{{$message}}</div>   
            @enderror
        </div>
        <div class="form-group">
            <label>KATEGORI</label>
            <select class="form-control" name="kategori_produk_id">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoriProduk as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('kategori_produk_id') == $kategori->id ? 'selected' : '' }}>
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
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{old("harga_beli")}}">
            @error('harga_beli')
            <div class="text-danger">{{$message}}</div>   
            @enderror
        </div>
        <div class="form-group">
            <label>HARGA JUAL (Rp)</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{old("harga_jual")}}">
            @error('harga_jual')
            <div class="text-danger">{{$message}}</div>   
            @enderror
        </div>
        <div class="form-group">
            <label>STOK (pcs)</label>
            <input type="number" class="form-control" id="stok" name="stok" value="{{old("stok")}}">
            @error('stok')
            <div class="text-danger">{{$message}}</div>   
            @enderror
        </div>
        <div class="form-group">
            <label>DESKRIPSI</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi">{{old("deskripsi")}}</textarea>
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