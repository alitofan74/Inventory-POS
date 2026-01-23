@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4>Data Kategori Produk</h4>
    </div>
    <div class="card-body">
        <a href="{{route("kategoriproduk.createkategori")}}" class="btn btn-primary btn-sm">Input Baru</a>
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
                    <td class="actions-cell">
                       <span class="actions-space">{{ $kp->nama_kategori }}</span>
                       <div class="actions-button">
                            <button class="custom-btn-action detail text-info" title="Detail" data-namakategori="{{$kp->nama_kategori}}" data-deskripsi="{{$kp->deskripsi}}">
                                <i class="fa fa-eye"></i>
                            </button>
                            <a href="{{route("kategoriproduk.edit", $kp->id)}}" class="custom-btn-action edit text-success" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="custom-btn-action delete text-danger" title="Hapus" data-route="{{ route('kategoriproduk.delete', $kp->id) }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
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

@section('content2')
<div class="modal fade" id="modalDetail" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Detail Kategori</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" class="form-control" id="detail-namakategori" readonly>
        </div>

        <div class="form-group">
          <label>Deskripsi</label>
          <textarea class="form-control" id="detail-deskripsi" rows="3" readonly></textarea>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Tutup
        </button>
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
    $("#kategori-produk").DataTable();

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
    var nama_kategori = $(this).data("namakategori");
    var deskripsi = $(this).data("deskripsi");

    $("#detail-namakategori").val(nama_kategori);
    $("#detail-deskripsi").html(deskripsi);
    $("#modalDetail").modal();
});
</script>
@endsection