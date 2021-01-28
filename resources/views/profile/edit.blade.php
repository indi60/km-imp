@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Edit Profile')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Edit Profile')
@else
    @section('title', 'Guest | Edit Profile')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Edit Profile</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/profile/{{ $userProfiles->id }}" method="POST">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukan Nama Lengkap" name="name" value="{{ $userProfiles->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <br>
                    @if ($userProfiles->jenis_kelamin === "Laki-laki")
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
                    @elseif ($userProfiles->jenis_kelamin === "Perempuan")
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
                        <select class="custom-select form-control @error('job_id') is-invalid @enderror" id="job_id"
                            placeholder="Masukan Job" name="job_id" value="{{ old('job_id') }}">
                            <option value="" selected>Pilih Job</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}"
                                    @if ($job->id === $userProfiles->job_id)
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
                    <label for="no_hp">Nomor HP</label>
                    <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                        placeholder="+62-555-5555-5555" name="no_hp" value="{{ $userProfiles->no_hp }}">
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="4" id="alamat">{{ $userProfiles->alamat }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button style="width: 15%;" class="btn btn-small btn-success btn-block" type="submit"><i
                            class="far fa-save"></i><span class="ml-2">save changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <a href="/profile" class="text-danger float-right">
        <i class="fas fa-arrow-left"><span class="ml-2">Back</span></i>
    </a>
</div>
<!-- container-fluid -->
@endsection
