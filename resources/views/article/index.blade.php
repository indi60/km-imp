@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Data Artikel')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Data Artikel')
@else
    @section('title', 'Guest | Data Artikel')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="font-size: 32px; color: black"><b>Artikel</b></h1>
        <div class="row">
            @if(auth()->user()->role_id == "1 or 2")
            <form class="form-inline">
                <a href="/article/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Artikel</span>
                </a>
            </form>
            @endif
            <form class="form-inline" method="POST" action="">
                <div class="form-group">
                    <div class="input-group">
                        <select class="form-control form-control-sm @error('job_id') is-invalid @enderror" id="job_id"
                            placeholder="Masukan Kategori Artikel" name="job_id" value="{{ old('job_id') }}">
                            <option value="0" selected disabled>Pilih Kategori Artikel</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}">
                                    {{ $job->name }}
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
    </div>

    @include('includes/alert')

    @if($articles->count() > 0)
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6">
                    <a href="/article/{{$article->id}}/show" style="text-decoration: none">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-black-50">{{ $article->title }}</h5>
                                <p class="card-text text-black-50 mb-3">
                                    @foreach($article->status_article as $item)
                                        @if ($item->id == 1)
                                            <span class="badge badge-pill badge-success">{{ $item->name }}</span>
                                        @else
                                            <span class="badge badge-pill badge-secondary">{{ $item->name }}</span>
                                        @endif
                                    @endforeach
                                </p>
                                <p class="card-text text-black-50 mb-3">
                                    @foreach($article->job as $item)
                                        {{ $item->name }}
                                    @endforeach
                                </p>
                                @if ($article->user_id == auth()->user()->id)
                                    <a href="/article/{{ $article->id }}/edit" class="btn btn-small text-success">
                                        <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                    </a>
                                    <form action="/article/{{ $article->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-small text-danger">
                                            <i class=" fa fa-trash"></i><span class="ml-2">Delete</span>
                                        </button>
                                    </form>
                                @endif
                                @if(auth()->user()->role_id == "1")
                                    <a href="/article/{{ $article->id }}/edit" class="btn btn-small text-success">
                                        <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                    </a>
                                    <form action="/article/{{ $article->id }}" method="POST" class="d-inline">
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
                                    {{ $article->updated_at->diffForHumans() }}</small>
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
