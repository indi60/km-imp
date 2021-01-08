@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Data Projek')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Data Projek')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="font-size: 32px; color: black"><b>Projects</b></h1>
        @if(auth()->user()->role_id == "1")
            <form class="form-inline">
                <a href="/project/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Project</span>
                </a>
            </form>
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
    
    @if (auth()->user()->role_id == 1)    
        @if($Projects->count() > 0)
            <div class="row">
                @foreach($Projects as $Project)
                    <div class="col-md-3">
                        <a href="/project/{{$Project->id}}/ticket" class="text-decoration-none">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-black-50">{{ $Project->name }}</h5>
                                    <p class="card-text text-black-50 mb-3">
                                        @foreach($Project->CategoryProject as $item)
                                            <span class="badge badge-pill badge-primary">{{ $item->name }}</span>
                                        @endforeach
                                    </p>
                                    <p class="card-text text-black-50 mb-3">
                                        <b>Total Issue:
                                        </b>
                                    </p>
                                    <p class="card-text text-black-50 mb-3">
                                            @if ($Project->Ticket->count() < 0)
                                                <i class="fas fa-circle text-primary"></i><span class="p ml-3">Belum Ada Issue</span>
                                            @else
                                                <i class="fas fa-circle text-primary"></i><span class="p ml-3">{{$Project->Ticket->count()}} Issues ({{$Project->Ticket->where("priority_id", 4)->count()}} Urgent) </span> <br>
                                            @endif
                                    </p>
                                    @if(auth()->user()->role_id == "1")
                                        <a href="/project/{{ $Project->id }}/edit" class="btn btn-small text-success">
                                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                        </a>
                                        <form action="/project/{{ $Project->id }}" method="POST" class="d-inline">
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
                                        {{ $Project->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row justify-content-center" style="margin-top: 15%">
                <div class="col text-center">
                    <b>Project Belum Tersedia</b>
                </div>
            </div>
        @endif
    @else
        @if($CurrentProjects->ProjectAssigned->count() > 0)
            <div class="row">
                @foreach($CurrentProjects->ProjectAssigned as $CurrentProject)
                    <div class="col-md-3">
                        <a href="/project/{{$CurrentProject->Project->id}}/ticket" class="text-decoration-none">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-black-50">{{ $CurrentProject->Project->name }}</h5>
                                    <p class="card-text text-black-50 mb-3">
                                        @foreach($CurrentProject->Project->CategoryProject as $category)
                                            <span class="badge badge-pill badge-primary">{{ $category->name }}</span>
                                        @endforeach
                                    </p>
                                    <p class="card-text text-black-50 mb-3">
                                        <b>Total Issue:
                                        </b>
                                    </p>
                                    <p class="card-text text-black-50 mb-3">
                                        @if ($CurrentProject->Project->Ticket->count() < 0)
                                            <i class="fas fa-circle text-primary"></i><span class="p ml-3">Belum Ada Issue</span>
                                        @else
                                            <i class="fas fa-circle text-primary"></i><span class="p ml-3">{{$CurrentProject->Project->Ticket->count()}} Issues ({{$CurrentProject->Project->Ticket->where("priority_id", 4)->count()}} Urgent) </span>
                                        @endif
                                    </p>
                                    @if(auth()->user()->role_id == "1")
                                        <a href="/project/{{ $CurrentProject->id }}/edit" class="btn btn-small text-success">
                                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                        </a>
                                        <form action="/project/{{ $CurrentProject->id }}" method="POST" class="d-inline">
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
                                        {{ $CurrentProject->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row justify-content-center" style="margin-top: 15%">
                <div class="col text-center">
                    <b>Project Belum Tersedia</b>
                </div>
            </div>
        @endif
    @endif
</div>
<!-- /.container-fluid -->
@endsection
