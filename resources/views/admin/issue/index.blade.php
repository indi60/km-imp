@extends('layouts/main')

@if(auth()->user()->role_id == "1")
    @section('title', 'Admin | Data Issue')
@elseif(auth()->user()->role_id == "2")
    @section('title', 'Member | Data Issue')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 font-weight-bold" style="color: black">Data Issue Customer</h4>
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

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Judul Issue</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Tickets as $Ticket)
                            <tr>
                                <td class="text-left">
                                    <a href="/project/ticket/{{ $Ticket->id }}/show" style="text-decoration: none">
                                        {{ $Ticket->title }}
                                    </a>
                                    @foreach($Ticket->Priority as $item)
                                        <span class="badge badge-pill text-white"
                                            style="background-color: {{ $item->color }}">{{ $item->name }}</span>
                                    @endforeach
                                    <br>
                                    <p style="font-size: 14px">
                                        #{{ $Ticket->id }}
                                        @if($Ticket->status_id === 1)
                                            opened
                                        @else
                                            was closed
                                        @endif
                                        {{ $Ticket->created_at->diffForHumans() }} by {{ $Ticket->author_name }}
                                    </p>
                                </td>
                                <td class="text-center">
                                    <a href="/issue/{{ $Ticket->id }}/edit"
                                        class="btn btn-small text-success">
                                        <i class="fa fa-check-circle"></i><span class="ml-2">Approve</span>
                                    </a>
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
