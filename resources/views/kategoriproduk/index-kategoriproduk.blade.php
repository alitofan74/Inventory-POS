@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Data Kategori Produk</h4>
    </div>
    <div class="card-body">
        <a href="{{route("kategoriproduk.createkategori")}}" class="btn btn-primary btn-sm">Input Baru</a>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover" id="kategori-produk" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:5%;">#</th>
                    <th style="width:70%;">Nama Kategori</th>
                    <th>Date Created</th>
                    <th>Date Modified</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoriProduk as $kp)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kp->nama_kategori }}</td>
                    <td>{{ $kp->date_created }}</td>
                    <td>{{ $kp->date_modified }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset("otika-assets/bundles/datatables/datatables.min.css")}}">
<link rel="stylesheet" href="{{asset("otika-assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css")}}">
@endsection

@section('javascript')
<script src="{{asset("otika-assets/bundles/datatables/datatables.min.js")}}"></script>
<script src="{{asset("otika-assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js")}}"></script>
<script>
$(function(){
    $("#kategori-produk").DataTable();
});
</script>
@endsection