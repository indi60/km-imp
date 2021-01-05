@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Tambah Data Artikel')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Tambah Data Artikel')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="font-size: 32px; color: black"><b>Artikel</b></h1>
        @if(auth()->user()->role_id == "1")
        <div class="row">
            <form class="form-inline">
                <a href="/article/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Artikel</span>
                </a>
            </form>
            <form class="form-inline" method="POST" action="">
                <div class="form-group">
                    <div class="input-group">
                        <select class="form-control form-control-sm @error('job_id') is-invalid @enderror" id="job_id"
                            placeholder="Masukan Kategori Artikel" name="job_id" value="{{ old('job_id') }}">
                            <option value="0" selected>Pilih Kategori Artikel</option>
                            @foreach($Jobs as $Job)
                                <option value="{{ $Job->id }}">
                                    {{ $Job->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('job_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        @endif
    </div>

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

    @if($Articles->count() > 0)
        <div class="row">
            @foreach($Articles as $Article)
                <div class="col-md-6">
                    <a href="/article/{{$Article->id}}/show" style="text-decoration: none">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-black-50">{{ $Article->title }}</h5>
                                <p class="card-text text-black-50 mb-3">
                                    @foreach($Article->Job as $item)
                                        {{ $item->name }}
                                    @endforeach
                                </p>
                                @if(auth()->user()->role_id == "1")
                                    <a href="/article/{{ $Article->id }}/edit" class="btn btn-small text-success">
                                        <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                    </a>
                                    <form action="/article/{{ $Article->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-small text-danger">
                                            <i class=" fa fa-trash"></i><span class="ml-2">Delete</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Last updated
                                    {{ $Article->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
    <div class="row justify-content-center" style="margin-top: 15%">
            <div class="col text-center">
                <b>Artikel Belum Tersedia</b>
            </div>
        </div>
    @endif
</div>
<!-- /.container-fluid -->
@endsection
