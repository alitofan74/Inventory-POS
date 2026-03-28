@extends('template')
@section('content')
<div class="row">
    <div class="col-3">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Nota</h4>
            </div>
            <form action="{{route("penjualan.checkout")}}" enctype="multipart/form-data" id="frmcheckout">
            @method("POST")
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>NOMOR NOTA</label>
                    <input type="text" class="form-control" id="nomor_nota" name="nomor_nota" value="{{old("nomor_nota")}}">
                    <div class="text-danger" id="errnomor_nota"></div>
                </div>
                <div class="form-group">
                    <label>NAMA PRODUK</label>
                    <select class="form-control" name="select_produk_id" id="select_produk_id">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($produk as $p)
                            <option value="{{ route("produk.detail", $p->id)}}"
                                {{ old('produk_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                    <div class="text-danger" id="errselected_produk_id"></div>
                    <input type="hidden" name="harga_jual" id="harga_jual">
                    <input type="hidden" name="produk_id" id="produk_id">
                </div>
                <div class="form-group">
                    <label>JUMLAH JUAL</label>
                    <input type="number" class="form-control" id="jumlah_jual" name="jumlah_jual" value="{{old("jumlah_jual")}}">
                    <div class="text-danger" id="errjumlah_jual"></div>
                </div>
                <div class="form-group">
                    <label>PENJUALAN DARI</label>
                    @php
                        $jualdari = ["toko", "marketplace"];
                    @endphp
                    <select class="form-control text-uppercase" name="jenis_jual">
                        @foreach ($jualdari as $j)
                        <option value="{{$j}}">{{$j}}</option>
                        @endforeach
                    </select>
                    <div class="text-danger" id="errjenis_jual"></div>
                </div>
                <div id="callback"></div>
                <button id="btn-keranjang" class="btn btn-primary btn-sm" type="submit">Masukkan Keranjang</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-3">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Detail Produk</h4>
            </div>
            <div class="card-body">
    
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Keranjang</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover" id="produk" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="form-group">
                    <label>JUMLAH BAYAR</label>
                    <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" value="{{old("jumlah_bayar")}}">
                    <div class="text-danger" id="errjumlah_bayar"></div>
                </div>
                <div class="form-group">
                    <label>KEMBALIAN</label>
                    <input type="number" class="form-control" id="kembalian" name="kembalian" value="{{old("kembalian")}}">
                    <div class="text-danger" id="errkembalian"></div>
                </div>
                <div id="callback2"></div>
                <button id="btn-checkout" class="btn btn-primary btn-sm" type="submit">CHECKOUT</button>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
$(function(){

    $("#frmcheckout").on("submit", function(e){
        e.preventDefault();
         var data = $(this).serialize();
        var route = $(this).attr("action");
        $.ajax({
            url: route,
            type: "POST",
            data: data,
            beforeSend : function(){
               
            },
            success : function(r){
                console.log(r);
            },
            error: function(e){
                console.log(e.responseText);
            }
        })
    })

});

$(document).on("click", "#select_produk_id", function(){
    var route = $(this).val();
    $.get(route, function (response) {
        if (response.status) {
            var data = response.data;
            $("#harga_jual").val(data.harga_jual);
            $("#produk_id").val(data.id);
        }
    }).fail(function (e) {
        console.log(e.responseText());
    });
});

</script>
@endsection