@extends('layouts/main')

@if(auth()->user()->role_id == "1")
    @section('title', 'Admin | Profile')
@elseif(auth()->user()->role_id == "2")
    @section('title', 'Member | Profile')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Flash Data -->
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('statusDelete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('statusDelete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 my-3">
            <div class="card shadow">
                <div class="card-header">
                    Image Profile
                </div>

                <div class="card-body">
                    @foreach($Profiles as $Profile)
                        <img src="{{ asset('storage/photos/upload/avatar/'.$Profile->avatar) }}"
                            alt="{{ $Profile->avatar }}" class="rounded-circle my-4 ml-5 mr-5" width="200">
                    @endforeach
                    <form class=" form-signin" action="/image-profile/{{ auth()->user()->id }}" method="POST"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="form-group mt-1">
                            <input class="mt-2" type="file" id="avatar" name="avatar"
                                value="{{ old('avatar') }}">
                            <br>
                            <span class="text-danger">*img 200 X 200</span>
                            <span class="text-danger">*jpeg/jpg/png</span>
                        </div>

                        <div class="form-group my-4">
                            <button class="btn btn-small btn-success btn-block" style="width: 50%; margin-left: 25%;"
                                type="submit">
                                <i class="far fa-save"></i><span class="ml-2">update image</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 my-3">
            <div class="card shadow">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="nav-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab"
                                href="#nav-profile" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                                aria-controls="nav-home" aria-selected="true">Reset Password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                            aria-labelledby="nav-profile-tab">
                            <h2 class="h2 my-4 ml-2">{{ auth()->user()->name }}
                                <small>- Profile</small>
                            </h2>
                            <h5 class="h5 mb-4 ml-2">
                                <b>Email :</b>
                                {{ auth()->user()->email }}
                            </h5>
                            <h5 class="h5 mb-4 ml-2">
                                <b>Jenis Kelamin :</b>
                                {{ auth()->user()->jenis_kelamin }}
                            </h5>
                            <h5 class="h5 mb-4 ml-2">
                                <b>Bagian :</b>
                                @foreach($Profiles as $Profile)
                                    @foreach($Profile->Job as $Job)
                                        {{ $Job->name }}
                                    @endforeach
                                @endforeach
                            </h5>
                            <h5 class="h5 mb-4 ml-2">
                                <b>Nomor Handphone :</b>
                                {{ auth()->user()->no_hp }}
                            </h5>
                            <h5 class="h5 mb-4 ml-2">
                                <b>Alamat :</b>
                                {{ auth()->user()->alamat }}
                            </h5>
                            <a href="/profile/{{ auth()->user()->id }}/edit"
                                class="btn btn-primary text-primary ml-2 mt-3 mb-3">
                                <i class="fa fa-edit text-white"></i><span class="ml-2 text-white">Edit Profile</span>
                            </a>
                        </div>
                        <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <form class=" form-signin" action="{{route('profile.password')}}" method="POST">
                                @csrf
                                @method('put')

                                <div class="form-group my-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="mt-2" for="oldpassword">Password Lama</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control @error('oldpassword') is-invalid @enderror" id="oldpassword" name="oldpassword">
                                            @error('oldpassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="mt-2" for="password">Password Baru</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="mt-2" for="confirmpassword">Konfirmasi Password</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control @error('confirmpassword') is-invalid @enderror" id="confirmpassword" name="confirmpassword">
                                            @error('confirmpassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button style="width: 30%; margin-left: 40%;" class="btn btn-small btn-success btn-block" type="submit"><i
                                            class="far fa-save"></i><span class="ml-2">Ubah Password</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection
