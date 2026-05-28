@extends('template')
@section('content')
<div class="row">
    <div class="col-3">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Pilih Barang</h4>
            </div>
            <form action="{{route("penjualan.keranjang")}}" enctype="multipart/form-data" id="frmkeranjang">
            <input type="hidden" name="nomor_nota" value="{{$nota}}">
            @method("POST")
            @csrf
            <div class="card-body">
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
                </div>
                <div class="form-group">
                    <label>JUMLAH JUAL</label>
                    <input type="number" class="form-control" id="jumlah_jual" name="jumlah_jual" value="{{old("jumlah_jual")}}">
                    <div class="text-danger" id="errjumlah_jual"></div>
                </div>
                <input type="hidden" name="txtproduk_id" id="txtproduk_id">
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
                <div id="loading" style="display: none;">
                    <small class="text-muted">Loading...</small>
                </div>
                <i><strong>Nama Barang</strong></i> <br>
                <span class="text-grey" id="displaynama_barang">Silahkan pilih barang</span> <br><br>

                <i><strong>Harga Jual</strong></i> <br>
                <span class="text-grey" id="displayharga_jual">-</span> <br><br>

                <i><strong>Stok Akhir</strong></i> <br>
                <span class="text-grey" id="displaystok">-</span> <br>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Keranjang</h4> <span class="text-grey">(nomor nota : {{$nota}})</span>
            </div>
            <div class="card-body">
                <form action="{{route("penjualan.checkout")}}" enctype="multipart/form-data" id="frmcheckout">
                <input type="hidden" name="nomor_notacheckout" value="{{$nota}}">
                @method("POST")
                @csrf
                <table class="table table-striped" id="produk" style="width:100%;">
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
                        @foreach ($penjualan->details as $d)
                        <tr id="row-{{$d->produk->id}}">
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger btn-delete" data-url="{{route("penjualan.hapusItem", $d->id)}}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                            <td>{{$d->produk->nama_produk}}</td>
                            <td>{{$d->harga_jual_format}}</td>
                            <td class="qty">{{$d->jumlah_jual_format}}</td>
                            <td class="subtotal">{{$d->subtotal_format}}</td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <label>GRAND TOTAL</label>
                    <h2 id="grand_total">{{$penjualan->grandtotal_format}}</h2>
                </div>
                <div class="form-group">
                    <label>JUMLAH BAYAR</label>
                    <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" value="{{old("jumlah_bayar")}}">
                    <div class="text-danger" id="errjumlah_bayar"></div>
                </div>
                <div class="form-group">
                    <label>KEMBALIAN</label>
                    <input type="text" class="form-control" id="kembalian" name="kembalian" value="{{old("kembalian")}}">
                    <div class="text-danger" id="errkembalian"></div>
                </div>
                <div class="form-group">
                    <label>PENJUALAN DARI</label>
                    @php
                        $jualdari = ["toko", "marketplace"];
                    @endphp
                    <select class="form-control text-uppercase" name="jenis_jual">
                        @foreach ($jualdari as $j)
                        <option value="{{$j}}" {{$penjualan->jenis_jual == $j ? "selected" : ""}}>{{$j}}</option>
                        @endforeach
                    </select>
                    <div class="text-danger" id="errjenis_jual"></div>
                </div>
                <div class="form-group">
                    <label>METODE BAYAR</label>
                    @php
                        $metode = ["cash", "qris", "transfer"];
                    @endphp
                    <select class="form-control text-uppercase" name="metode_bayar">
                        @foreach ($metode as $m)
                        <option value="{{$m}}" {{$penjualan->metode_bayar == $m ? "selected" : ""}}>{{$m}}</option>
                        @endforeach
                    </select>
                    <div class="text-danger" id="errmetode_bayar"></div>
                </div>
                <div id="callback2"></div>
                <button id="btn-checkout" class="btn btn-primary btn-sm" type="submit">CHECKOUT</button>
                <a href="{{route("penjualan.cancel")}}" class="btn btn-danger btn-sm">BATALKAN PENJUALAN</a>
                </form>
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

    $("#frmkeranjang").on("submit", function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var route = $(this).attr("action");
        $.ajax({
            url: route,
            type: "POST",
            data: data,
            beforeSend : function(){
               $("#btn-keranjang").prop("disabled", true).text("Loading...");
            },
            success : function(r){
                if(r.status){
                    console.log(r);
                    // 🔹 append ke table
                    var rowCount = $("#produk tbody tr").length + 1;

                    var rowId = "row-" + r.data.produk_id;
                    // cek apakah row sudah ada
                    if ($("#" + rowId).length) {
                        $("#" + rowId).find(".qty").text(r.data.jumlah_jual);
                        $("#" + rowId).find(".subtotal").text(r.data.subtotal);
                    } else {
                        var rowCount = $("#produk tbody tr").length + 1;

                        var html = `
                            <tr id="${rowId}">
                                <td>${rowCount}</td>
                                <td>${r.data.nama_produk}</td>
                                <td>${r.data.harga}</td>
                                <td class="qty">${r.data.jumlah_jual}</td>
                                <td class="subtotal">${r.data.subtotal}</td>
                            </tr>
                        `;

                        $("#produk tbody").append($(html).hide().fadeIn(300));
                    }

                    $("#grand_total").text(r.data.grandtotal);


                    // 🔹 reset form
                    $("#frmkeranjang").trigger("reset");

                    // 🔹 reset hidden input
                    $("#txtharga_jual").val('');
                    $("#txtproduk_id").val('');

                    // 🔹 reset display produk 
                    $("#displaynama_barang").text("Silakan pilih barang");
                    $("#displayharga_jual").text("-");
                    $("#displaystok").text("-");

                    $("#btn-keranjang").prop("disabled", false).text("Masukkan Keranjang");
                }
            },
            error: function(e){
                console.log(e.responseText);
            }
        })
    });

});

$(document).ready(function(){
    $('#jumlah_bayar').on('keyup', function () {
        let bayar = $('#jumlah_bayar').val();
        let grandTotalText = $("#grand_total").text();
        let grandTotal = ambilAngkaDariText(grandTotalText);

        let kembalian = bayar - grandTotal;
        if (kembalian < 0) {
            $('#kembalian').val('Rp 0');
        } else {
            $('#kembalian').val('Rp ' + formatRupiah(kembalian));
        }
        
    });

    $('#jumlah_bayar').on('blur', function () {
        let angka = ambilAngka($(this).val());
        if (angka > 0) {
            $(this).val('Rp ' + formatRupiah(angka));
        } else {
            $(this).val('');
        }
    });

    function ambilAngkaDariText(text) {
        return parseInt(text.replace(/[^0-9]/g, '')) || 0;
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }
});

$(document).on("click", "#select_produk_id", function(){
    var route = $(this).val();

    if (!route) {
        $("#displaynama_barang").text("Silakan pilih barang");
        $("#displayharga_jual").text("-");
        $("#displaystok").text("-");
        return;
    }

    $("#loading").show();
    $("#displaynama_barang").text("...");
    $("#displayharga_jual").text("...");
    $("#displaystok").text("...");

    $.get(route, function (response) {
        if (response.status) {
            var data = response.data;
            $("#displaynama_barang").text(data.nama_produk);
            $("#displayharga_jual").text(data.harga_jual_format);
            $("#displaystok").text(data.stok_barang);
            $("#txtharga_jual").val(data.harga_jual);
            $("#txtproduk_id").val(data.id);
        }
    }).fail(function (e) {
        console.log(e.responseText());
    }).always(function(){
        $("#loading").hide();
    });
});

$(document).on('click', '.btn-delete', function (e) {
    e.preventDefault();
    let route = $(this).data('url');
    let row = $(this).closest('tr');

    if (!confirm('Hapus item ini?')) return;

    $.ajax({
        url: route,
        type: 'GET',
        success: function (res) {
            if (res.status) {
                // hapus row dari table
                row.fadeOut(200, function() {
                    $(this).remove();
                });

                // update grand total
                $('#grand_total').text('Rp ' + res.grandtotal);
            }
        }
    });
});

</script>
@endsection