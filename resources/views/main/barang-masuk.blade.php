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
                                    <select name="produk_id" class="form-control">
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
                        <form method="GET" action="" >
                            <div class="row mb-2">
                                <div class="col-6">
                                    <select name="produk_id" class="form-control">
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach ($produk as $p)
                                            <option value="{{ $p->id }}"
                                                {{ request('produk_id') == $p->id ? 'selected' : '' }}>
                                                {{ $p->nama_produk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary btn-block h-100">Cari</button>
                                </div>
                            </div>
                        </form>
                        @if (!request('produk_id'))
                            <p class="text-muted">Silakan pilih produk dulu untuk melihat riwayat.</p>
                        @elseif ($brgmasuk->count() == 0)
                            <p class="text-danger">Belum ada riwayat barang masuk untuk produk ini.</p>
                        @else
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
                                    @foreach ($brgmasuk as $r)
                                        <tr>
                                            <td>{{ $r->tanggal_masuk }}</td>
                                            <td>{{ $r->produk->nama_produk }}</td>
                                            <td>{{ $r->jumlah_masuk }}</td>
                                            <td>{{ $r->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
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
<script>
$(function(){
    $("#barangmasuk").DataTable();

});
</script>
@endsection
