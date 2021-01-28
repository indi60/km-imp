@extends('layouts/main')

@section('title', 'Admin | Edit Data Job')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Edit Job</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/job/{{ $jobs->id }}" method="POST">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="name">Nama Job</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukan Nama Job" name="name" value="{{ $jobs->name }}">
                    @error('name')
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
@endsection
