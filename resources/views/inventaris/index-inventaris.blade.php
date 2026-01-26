@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Data Inventaris Toko</h4>
    </div>
    <div class="card-body">
        <a href="{{route("inventaris.createinventaris")}}" class="btn btn-primary btn-sm">Input Baru</a>
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
            <table class="table table-striped table-hover" id="inventaris" style="width:100%;">
            <thead>
                <tr>
                    <th style="width:5%;">#</th>
                    <th>Nama Inventaris</th>
                    <th style="width:15%;">Date Created</th>
                    <th style="width:10%;">Date Modified</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($inventaris as $inv)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td class="actions-cell">
                        <span class="actions-space">{{$inv->nama_inventaris}}</span>
                        <div class="actions-button">
                            <button class="custom-btn-action detail text-info" title="Detail" data-route="{{ route('inventaris.detailinventaris', $inv->id) }}">
                                <i class="fa fa-eye"></i>
                            </button>
                            <a href="{{route("inventaris.editinventaris", $inv->id)}}" class="custom-btn-action edit text-success" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="custom-btn-action delete text-danger" title="Hapus" data-route="{{ route('inventaris.deleteinventaris', $inv->id) }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                    <td>{{$inv->date_created}}</td>
                    <td>{{$inv->date_modified}}</td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('content2')
<div class="modal fade informasi-inventaris" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Informasi Inventaris</h5>
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
                        <th>Nama Inventaris</th>
                        <td><span id="txtnama_inventaris"></span></td>
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
            <div id="info-gambar"></div>
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
    $("#inventaris").DataTable();

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
            if (data["gambar"] == null) {
                var routeImg = "{{url('inventaris-toko/upload-gambar/')}}/"+data["id"];
                $("#info-gambar").html("<div class='alert alert-info'>Produk ini belum ada gambar.<a href='"+routeImg+"' class='text-dark'>Tambah Gambar</a></div>");
            }else{
                var routeImg = "{{asset('storage/')}}/"+data["gambar"];
                $("#info-gambar").html("<div class='col-12 d-flex justify-content-center'><img src='"+routeImg+"' class='img img-thumbnail' width='30%'></div>")
            }
            $(".informasi-inventaris").modal();
        }
    }).fail(function (e) {
        console.log(e.responseText());
    });
});
</script>
@endsection
