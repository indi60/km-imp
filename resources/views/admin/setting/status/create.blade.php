@extends('layouts/main')

@section('title', 'Admin | Tambah Data Status')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
@endsection

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Status</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/status" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Status</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukan Nama Status" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="color">Warna Status</label>
                    <input type="text" class="form-control colorpicker @error('color') is-invalid @enderror" id="color"
                        placeholder="Masukan Warna Status" name="color" value="{{ old('color') }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button style="width: 20%;" class="btn btn-small btn-success btn-block" type="submit"><i
                            class="far fa-save"></i><span class="ml-2">save changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <a href="/setting" class="text-danger float-right">
        <i class="fas fa-arrow-left"><span class="ml-2">Back</span></i>
    </a>
</div>
<!-- container-fluid -->

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
<script>
    $('.colorpicker').colorpicker();
</script>
@endsection

@endsection
