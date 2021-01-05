@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Tabel Ticket')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Tabel Ticket')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Ticket</h1>
        <form class="form-inline">
            <a href="/project/ticket/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i>Tambah Tiket
            </a>
        </form>
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
            <form action="/filter_status_open"
                method="GET" class="d-inline">
                <button type="submit" class="btn btn-small text-success">
                    <img src="{{ (asset('images/logo/issue-opened.svg')) }}" alt="" width="25%"><span class="ml-2"><b>{{$count_open_ticket}}</b></span><span class="ml-2"><b>Open</b></span>
                </button>
            </form>
            <form action="/filter_status_closed"
                method="GET" class="d-inline">
                <button type="submit" class="btn btn-small text-danger">
                    <img src="{{ (asset('images/logo/issue-closed.svg')) }}" alt="" width="25%"><span class="ml-2"><b>{{$count_closed_ticket}}</b></span><span class="ml-2"><b>Closed</b></span>
                </button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Judul Tiket</th>
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
                                    #{{ $Ticket->id }} opened {{$Ticket->created_at->diffForHumans()}} by {{ $Ticket->author_name }}
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
