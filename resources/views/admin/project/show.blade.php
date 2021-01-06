@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Data Issue')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Data Issue')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 font-weight-bold" style="color: black">User Assigned :</h4><br>
        <form class="form-inline">
            <a href="/project/ticket/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Issue</span>
            </a>
        </form>
    </div>
    <div class="d-sm-flex align-items-center mb-4">
        @foreach($Projects->ProjectAssigned as $item)
            <a type="button" data-toggle="tooltip" data-placement="bottom" title="{{$item->AssignedTo->name}}">
                <img src="{{ asset('storage/photos/upload/avatar/'.$item->AssignedTo->avatar) }}" alt="avatar" width="50px" class="rounded-circle ml-3">
            </a>
        @endforeach
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="/project/{{$idProject}}/filter_status_open"
                method="GET" class="d-inline">
                <button type="submit" class="btn btn-small text-success">
                    <img src="{{ (asset('assets/images/logo/issue-opened.svg')) }}" alt="" width="25%"><span class="ml-2"><b>{{$count_open_ticket}}</b></span><span class="ml-2"><b>Open</b></span>
                </button>
            </form>
            <form action="/project/{{$idProject}}/filter_status_closed"
                method="GET" class="d-inline">
                <button type="submit" class="btn btn-small text-danger">
                    <img src="{{ (asset('assets/images/logo/issue-closed.svg')) }}" alt="" width="25%"><span class="ml-2"><b>{{$count_closed_ticket}}</b></span><span class="ml-2"><b>Closed</b></span>
                </button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Judul Issue</th>
                            @if (auth()->user()->role_id == "1")
                            <th scope="col" class="text-center">Assigned To</th>
                            @endif
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Tickets as $Ticket)
                        <tr>
                            <td class="text-left">
                                <a href="/project/ticket/{{$Ticket->id}}/show" style="text-decoration: none">
                                    {{ $Ticket->title }}
                                </a>
                                @foreach ($Ticket->Priority as $item)
                                        <span class="badge badge-pill text-white" style="background-color: {{ $item->color }}">{{ $item->name }}</span>
                                @endforeach
                                <br>
                                <p style="font-size: 14px">
                                    #{{ $Ticket->id }}
                                    @if ($Ticket->status_id === 1)
                                        opened
                                    @else
                                        was closed
                                    @endif
                                    {{$Ticket->created_at->diffForHumans()}} by {{ $Ticket->author_name }}
                                </p>
                            </td>
                            @if (auth()->user()->role_id == "1")
                            <td class="text-center">
                                @foreach ($Ticket->AssignedTo as $item)
                                    <img src="{{ asset('storage/photos/upload/avatar/'.$item->avatar) }}" alt="avatar" width="40px" class="rounded-circle"><span class="ml-4">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            @endif
                            <td class="text-center">
                                @if (auth()->user()->role_id == "1")
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                        <a href="/project/ticket/{{ $Ticket->id }}/edit" class="btn btn-small text-success">
                                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                        </a>
                                        <form action="/project/ticket/{{ $Ticket->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-small text-danger">
                                                <i class=" fa fa-trash"></i><span class="ml-2">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <a href="/project/ticket/{{ $Ticket->id }}/edit" class="btn btn-small text-success">
                                        <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="/project" class="text-danger float-right">
        <i class="fas fa-arrow-left"><span class="ml-2">Back</span></i>
    </a>
</div>
<!-- /.container-fluid -->
@endsection

@section('js')
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endsection
