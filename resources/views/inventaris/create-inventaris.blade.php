@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4><span class="text-secondary">Data Inventaris Toko//</span> Buat Data Baru</h4>
    </div>
    <form id="frm_inventaris" action="{{route("inventaris.saveinventaris")}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <div class="card-body">
        <div class="form-group">
            <label>NAMA INVENTARIS TOKO</label>
            <input type="text" class="form-control" id="nama_inventaris" name="nama_inventaris" value="{{old("nama_inventaris")}}">
            <div class="text-danger" id="errnama_inventaris"></div>
        </div>
        <div class="form-group">
            <label>KATEGORI</label>
            <select class="form-control" name="kategori_inventaris_id">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoriInventaris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('kategori_inventaris_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            <div class="text-danger" id="errkategori"></div>
        </div>
        <div class="form-group">
            <label>DESKRIPSI</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi">{{old("deskripsi")}}</textarea>
            <div class="text-danger" id="errdeskripsi"></div>
        </div>
    </div>
    <div class="card-footer">
        <div id="callback"></div>
        <button id="btn-simpan" class="btn btn-primary btn-sm" type="submit">SIMPAN</button>
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

<script>
$(function(){
    $("#frm_inventaris").on("submit", function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var route = $(this).attr("action");
        $.ajax({
            url: route,
            type: "POST",
            data: data,
            beforeSend : function(){
                $(".text-danger").html("");
                $("#callback").addClass("alert alert-primary").html("Mengirim Data . . .");
                $("#btn-simpan").prop("disabled", true);
            },
            success : function(r){
                console.log(r);
                swal({
                    title: 'Berhasil Disimpan',
                    text: 'Apa anda ingin melanjutkan ke upload gambar untuk produk ini ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Nanti saja'
                })
                .then((willUpload) => {
                    if (willUpload) {
                        window.location.href = r.uploadImageRoute;
                    }else{
                        window.location.href = r.backRoute;
                    }
                });
            },
            error: function(e){
                $("#callback").removeClass("alert alert-primary").html("");
                $("#btn-simpan").prop("disabled", false);
                var err = e.responseJSON.errors;
                $.each(err, function (key, value) {
                    $("#err" + key).html(value[0]);
                });

            }
        })
    });
});
</script>
@endsection
