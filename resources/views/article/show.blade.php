@extends('layouts/main')

@if(auth()->user()->role_id == "1")
    @section('title', 'Admin | Detail Artikel')
@elseif(auth()->user()->role_id == "2")
    @section('title', 'Member | Detail Artikel')
@elseif(auth()->user()->role_id == "3")
    @section('title', 'Reporter | Detail Artikel')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0 text-gray-800">{{ $Articles->title }}</h4>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <p class="card-title" style="margin-bottom: -5px">
                        <b>{{ $Articles->author_name }}</b>,
                        <span>
                            created this posts {{ $Articles->created_at->diffForHumans() }}
                        </span>
                    </p>
                </div>

                <div class="card-body">
                    {!! $Articles->content !!}
                </div>
            </div>
        </div>
    </div>

    <a href="/article" class="text-danger float-right">
        <i class="fas fa-arrow-left"><span class="ml-2">Back</span></i>
    </a>
</div>
<!-- /.container-fluid -->
@endsection
