@extends('template')
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade mt-2">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="row">
            {{-- CARD KIRI FORM BARANG MASUK --}}
            <div class="col-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4> Barang Masuk </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('savebarangmasuk') }}" method="POST" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>NAMA PRODUK</label>
                                    <select name="produk_id" id="produk_select" class="form-control">
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach ($produk as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                    @error('produk_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>JUMLAH MASUK</label>
                                    <input type="number" class="form-control" name="jumlah_masuk"
                                        value="{{ old('jumlah_masuk') }}">
                                    @error('jumlah_masuk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>KETERANGAN</label>
                                    <textarea class="form-control" name="keterangan">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary btn-block" type="submit">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- CARD KANAN RIWAYAT BARANG MASUK --}}
            <div class="col-7">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4> Riwayat Barang Masuk </h4>
                    </div>
                    <div class="card-body">
                        <div id="infoText" class="text-muted">Silakan pilih produk dulu</div>
                        <table class="table table-sm table-bordered" id="barangmasuk">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('otika-assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('otika-assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('javascript')
    <script src="{{ asset('otika-assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('otika-assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {

            let table = $('#barangmasuk').DataTable({
                paging: true,
                searching: true,
            });

            $("#produk_select").change(function() {
                let produk_id = $(this).val();

                $("#infoText").hide();
                table.clear().draw();

                if (produk_id == "") {
                    $("#infoText").show().text("Silakan pilih produk dulu");
                    return;
                }

                $.get("/ajax/barang-masuk/" + produk_id, function(data) {

                    if (data.length == 0) {
                        $("#infoText").show().text("Belum ada riwayat barang masuk");
                        return;
                    }

                    data.forEach(function(row) {
                        table.row.add([
                            row.tanggal_masuk,
                            row.produk.nama_produk,
                            row.jumlah_masuk,
                            row.keterangan
                        ]);
                    });

                    table.draw();
                });
            });

        });

        
    </script>
@endsection
