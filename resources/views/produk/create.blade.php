@extends('template')
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4><span class="text-secondary">Data Produk //</span> Buat Data Baru</h4>
    </div>
    <form id="frm_produk" action="{{route("produk.save")}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <div class="card-body">
        <div class="form-group">
            <label>NAMA PRODUK</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{old("nama_produk")}}">
            <div class="text-danger" id="errnama_produk"></div>
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
            <div class="text-danger" id="errkategori"></div>
        </div>
        <div class="form-group">
            <label>HARGA BELI (Rp)</label>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{old("harga_beli")}}">
            <div class="text-danger" id="errharga_beli"></div>
        </div>
        <div class="form-group">
            <label>HARGA JUAL (Rp)</label>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{old("harga_jual")}}">
            <div class="text-danger" id="errharga_jual"></div>
        </div>
        <div class="form-group">
            <label>STOK (pcs)</label>
            <input type="number" class="form-control" id="stok" name="stok" value="{{old("stok")}}">
            <div class="text-danger" id="errstok"></div>
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
<script>
$(function(){
    $("#frm_produk").on("submit", function(e){
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