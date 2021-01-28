@extends('layouts/main')

@section('title', 'Admin | Edit Data Member')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Edit Member</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/manage-member/{{ $members->id }}" method="POST">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukan Nama Lengkap" name="name" value="{{ $members->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <br>
                    @if ($members->jenis_kelamin === "Laki-laki")
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="Laki-laki" name="jenis_kelamin" class="custom-control-input"
                                value="Laki-laki" checked>
                            <label class="custom-control-label" for="Laki-laki">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="Perempuan" name="jenis_kelamin" class="custom-control-input"
                                value="Perempuan">
                            <label class="custom-control-label" for="Perempuan">Perempuan</label>
                        </div>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    @elseif ($members->jenis_kelamin === "Perempuan")
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="Laki-laki" name="jenis_kelamin" class="custom-control-input"
                                value="Laki-laki">
                            <label class="custom-control-label" for="Laki-laki">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="Perempuan" name="jenis_kelamin" class="custom-control-input"
                                value="Perempuan" checked>
                            <label class="custom-control-label" for="Perempuan">Perempuan</label>
                        </div>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    @endif
                </div>

                <input type="hidden" id="role_id" name="role_id" value="2">

                <div class="form-group">
                    <label for="job_id">Job</label>
                    <div class="input-group mb-3">
                        <select class="custom-select selectpicker form-control @error('job_id') is-invalid @enderror" id="job_id"
                            placeholder="Masukan Job" name="job_id" value="{{ old('job_id') }}">
                            <option value="" selected disabled>Pilih Job</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}"
                                    @if ($job->id === $members->job_id)
                                        selected
                                    @endif>
                                    {{ $job->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('job_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                        placeholder="Masukan Alamat" name="alamat" value="{{ $members->alamat }}">
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP</label>
                    <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                        placeholder="+62-555-5555-5555" name="no_hp" value="{{ $members->no_hp }}">
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Masukan Email" name="email" value="{{ $members->email }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Masukan Password" name="password" value="{{ $members->password }}">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button style="width: 20%;" class="btn btn-small btn-success btn-block" type="submit">
                        <i class="far fa-save"></i><span class="ml-2">save changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <a href="/manage-member" class="text-danger float-right">
        <i class="fas fa-arrow-left"><span class="ml-2">Back</span></i>
    </a>
</div>
<!-- container-fluid -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').selectpicker();
    });
</script>
@endsection
