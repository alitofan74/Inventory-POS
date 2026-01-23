@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Data Produk</h4>
    </div>
    <div class="card-body">
        <a href="{{route("produk.create")}}" class="btn btn-primary btn-sm">Input Baru</a>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade mt-2">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{session('success')}}
                </div>
            </div>
        @endif
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover" id="produk" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:5%;">#</th>
                    <th>Nama Produk</th>
                    <th style="width:10%;">Stok</th>
                    <th style="width:15%;">Date Created</th>
                    <th style="width:10%;">Date Modified</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($produk as $p)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td class="actions-cell">
                        <span class="actions-space">{{$p->nama_produk}}</span>
                        <div class="actions-button">
                            <button class="custom-btn-action detail text-info" title="Detail" data-route="{{ route('produk.detail', $p->id) }}">
                                <i class="fa fa-eye"></i>
                            </button>
                            <a href="{{route("produk.edit", $p->id)}}" class="custom-btn-action edit text-success" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="custom-btn-action delete text-danger" title="Hapus" data-route="{{ route('produk.delete', $p->id) }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                    <td>{{$p->stok_barang}}</td>
                    <td>{{$p->date_created}}</td>
                    <td>{{$p->date_modified}}</td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('content2')
<div class="modal fade informasi-produk" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Informasi Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col" style="width: 30%">ITEM</th>
                    <th scope="col">VALUE</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Nama Produk</th>
                        <td><span id="txtnama_produk"></span></td>
                    </tr>
                    <tr>
                        <th>Harga Beli</th>
                        <td><span id="txtharga_beli"></span></td>
                    </tr>
                    <tr>
                        <th>Harga Jual</th>
                        <td><span id="txtharga_jual"></span></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td><span id="txtstok"></span></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td><span id="txtkategori"></span></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td><span id="txtdeskripsi"></span></td>
                    </tr>
                </tbody>
            </table>
            <div class="alert alert-info">
                Produk ini belum ada gambar. <a href="#" target="_blank" class="text-dark">Tambah Gambar</a>
            </div>
        </div>
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
<script src="{{asset("otika-assets/bundles/sweetalert/sweetalert.min.js")}}"></script>
<script src="{{asset("otika-assets/js/page/sweetalert.js")}}"></script>
<script>
$(function(){
    $("#produk").DataTable();

});

$(document).on("click", ".delete", function(){
    var route = $(this).data("route")
    swal({
        title: 'Anda yakin ?',
        text: 'Data akan terhapus secara permanen',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = route;
        } 
    });
});

$(document).on("click", ".detail", function(){
    var route = $(this).data("route");
    $.get(route, function (response) {
        if (response.status) {
            var data = response.data;
            for(let key in data){
                if (key == "kategori") {
                    $("#txt"+key).html(data[key].nama_kategori);    
                }else{
                    $("#txt"+key).html(data[key]);
                }
            }
            $(".informasi-produk").modal();
        }
    }).fail(function (e) {
        console.log(e.responseText());
    });
});
</script>
@endsection