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

    @include('includes/alert')

    @if (auth()->user()->role_id == 1)
        @if($projects->count() > 0)
            <div class="row">
                @foreach($projects as $project)
                    <div class="col-md-3">
                        <a href="/project/{{$project->id}}/ticket" class="text-decoration-none">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-black-50">{{ $project->name }}</h5>
                                    <p class="card-text text-black-50 mb-3">
                                        @foreach($project->category_project as $item)
                                            <span class="badge badge-pill badge-primary p-2">{{ $item->name }}</span>
                                        @endforeach
                                    </p>
                                    <p class="card-text text-black-50 mb-3">
                                        @if ($project->ticket->where('status_id', 2)->count() == null)
                                            <h1 class="font-weight-bold text-primary">0%</h1> <span class="h5 text-primary"> Proggress</span>
                                        @else
                                            <h1 class="font-weight-bold text-primary">{{round($project->ticket->where('status_id', 2)->count()/$project->ticket->count()*100)}}%</h1> <span class="h5 text-primary"> Proggress</span>
                                        @endif
                                    </p>
                                    @if(auth()->user()->role_id == "1")
                                        <a href="/project/{{ $project->id }}/edit" class="btn btn-small text-success">
                                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                        </a>
                                        <form action="/project/{{ $project->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-small text-danger">
                                                <i class=" fa fa-trash"></i><span class="ml-2">Delete</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    @if ($project->ticket->count() < 0)
                                        <i class="fas fa-circle text-primary"></i><span class="p ml-3">Belum Ada Issue</span>
                                    @else
                                        <i class="fas fa-circle text-primary"></i><span class="p ml-3">{{$project->ticket->count()}} Issues ({{$project->ticket->where("priority_id", 4)->count()}} Urgent) </span> <br>
                                    @endif
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
        @if($currentProjects->project_assigned->count() > 0)
            <div class="row">
                @foreach($currentProjects->project_assigned as $currentProject)
                    <div class="col-md-3">
                        <a href="/project/{{$currentProject->project->id}}/ticket" class="text-decoration-none">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h5 class="card-title text-black-50">{{ $currentProject->project->name }}</h5>
                                    <p class="card-text text-black-50 mb-3">
                                        @foreach($currentProject->project->category_project as $category)
                                            <span class="badge badge-pill badge-primary">{{ $category->name }}</span>
                                        @endforeach
                                    </p>
                                    <p class="card-text text-black-50 mb-3">
                                        @if ($currentProject->project->ticket->where('status_id', 2)->count() == null)
                                            <h1 class="font-weight-bold text-primary">0%</h1> <span class="h5 text-primary"> Proggress</span>
                                        @else
                                            <h1 class="font-weight-bold text-primary">{{round($currentProject->project->ticket->where('status_id', 2)->count()/$currentProject->project->ticket->count()*100) }}%</h1> <span class="h5 text-primary"> Proggress</span>
                                        @endif
                                    </p>
                                    @if(auth()->user()->role_id == "1")
                                        <a href="/project/{{ $currentProject->id }}/edit" class="btn btn-small text-success">
                                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                        </a>
                                        <form action="/project/{{ $currentProject->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-small text-danger">
                                                <i class=" fa fa-trash"></i><span class="ml-2">Delete</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <div class="card-footer">
                                    @if ($currentProject->project->ticket->count() < 0)
                                        <i class="fas fa-circle text-primary"></i><span class="p ml-3">Belum Ada Issue</span>
                                    @else
                                        <i class="fas fa-circle text-primary"></i><span class="p ml-3">{{$currentProject->project->ticket->where('role_id', 1 OR 2)->count()}} Issues ({{$currentProject->project->ticket->where("priority_id", 4)->count()}} Urgent) </span>
                                    @endif
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
