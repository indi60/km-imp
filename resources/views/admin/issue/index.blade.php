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

    @include('includes/alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Judul Issue</th>
                            <th scope="col" class="text-center">Project</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td class="text-left">
                                    <a href="/project/ticket/{{ $ticket->id }}/show" style="text-decoration: none">
                                        {{ $ticket->title }}
                                    </a>
                                    @foreach($ticket->priority as $item)
                                        <span class="badge badge-pill text-white"
                                            style="background-color: {{ $item->color }}">{{ $item->name }}</span>
                                    @endforeach
                                    <br>
                                    <p style="font-size: 14px">
                                        #{{ $ticket->id }}
                                        @if($ticket->status_id === 1)
                                            opened
                                        @else
                                            was closed
                                        @endif
                                        {{ $ticket->created_at->diffForHumans() }} by {{ $ticket->author_name }}
                                    </p>
                                </td>
                                <td class="text-center">
                                    @foreach($ticket->project_has_many as $item)
                                        <p>{{$item->name}}</p>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a href="/issue/{{ $ticket->id }}/edit"
                                        class="btn btn-small text-success">
                                        <i class="fa fa-check-circle"></i><span class="ml-2">Approve</span>
                                    </a>
                                    <form action="issue/{{ $ticket->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-small text-danger">
                                            <i class=" fa fa-trash"></i><span class="ml-2">Delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
