@extends('template')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h4><span class="text-secondary">Data Inventaris //</span> Management Gambar</h4>
                </div>
                <div class="card-body">
                <form action="{{route("inventaris.simpan-gambar")}}" method="post" enctype="multipart/form-data">
                @method("POST")
                @csrf
                <input type="hidden" name="id" value="{{$inventaris->id}}">
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
                    <div class="form-group row mb-4">
                      <div class="col-12 d-flex justify-content-center">
                        <div id="image-preview" class="image-preview">
                          <label for="image-upload" id="image-label">Choose File</label>
                          <input type="file" name="gambar" id="image-upload" />
                        </div>
                        @error('gambar')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary btn-block">UPLOAD</button>
                        <a href="{{route("inventaris.index")}}" class="btn btn-danger btn-block">BATAL</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card card-primary">
                <div class="card-header">
                    <h4><span class="text-secondary">Data Inventaris //</span> Detail Inventaris</h4>
                </div>
                <div class="card-body">
                    @if ($inventaris->gambar !== "")
                    <div class="col-12 d-flex justify-content-center">
                        <img src="{{asset("storage/".$inventaris->gambar)}}" class="img img-thumbnail " width="30%">
                    </div>
                    @endif
                    <br>
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
                                <td>{{$inventaris->nama_inventaris}}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{$inventaris->kategori->nama_kategori}}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{$inventaris->deskripsi}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')

@endsection

@section('javascript')
<script src="{{asset("otika-assets/bundles/jquery-selectric/jquery.selectric.min.js")}}"></script>
<script src="{{asset("otika-assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js")}}"></script>
<script>
"use strict";

$("select").selectric();
$.uploadPreview({
  input_field: "#image-upload",   // Default: .image-upload
  preview_box: "#image-preview",  // Default: .image-preview
  label_field: "#image-label",    // Default: .image-label
  label_default: "Choose File",   // Default: Choose File
  label_selected: "Change File",  // Default: Change File
  no_label: false,                // Default: false
  success_callback: null          // Default: null
});

</script>
@endsection
