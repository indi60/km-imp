@extends('layouts/main')

@section('title', 'Admin | Data Laporan')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0" style="font-size: 32px; color: black"><b>Data Laporan Pengerjaan Issue</b></h1>
        @if (auth()->user()->role_id == "1")
            <form class="form-inline">
                <a href="{{ url('/exportExcel') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mr-2">
                    <i class="fas fa-file-excel fa-md text-white-50"></i><span class="ml-2">Generate Excel</span>
                </a>
                <a href="{{ url('/exportPDF') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-file-pdf fa-md text-white-50"></i><span class="ml-2">Generate PDF</span>
                </a>
            </form>
        @endif
    </div>

    <form method="GET" action="/sort">
        <div class="form-row">
            <div class="form-group col-md-4">
                <select class="form-control selectpicker mr-3" name="project_id" id="inputGroupSelect02" data-live-search="true">
                    <option selected disabled>Pilih Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">
                            {{ $project->name }} :
                            @foreach($project->category_project as $item)
                                {{$item->name}}
                            @endforeach
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <select class="form-control selectpicker mr-3" name="assigned_to_user" id="inputGroupSelect02" data-live-search="true">
                    <option selected disabled>Pilih User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <select class="form-control selectpicker mr-3" name="status_id" id="inputGroupSelect02">
                    <option selected disabled>Pilih Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="form-group col-md-4">
                <div class="input-group mb-3">
                    <input type="text" name="created_at" class="form-control month" placeholder="Sort by Month" style="cursor: pointer">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <div class="input-group mb-3">
                    <input type="text" name="created_at" class="form-control year" placeholder="Sort by Year" style="cursor: pointer">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary">cari</button>
            </div>
        </div>
    </form>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Judul Tiket</th>
                            <th scope="col" class="text-center">Assigned To</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr>
                            <td class="text-left">
                                <a href="/project/ticket/{{$ticket->id}}/show" style="text-decoration: none">
                                    {{ $ticket->title }}
                                </a>
                                @foreach ($ticket->priority as $item)
                                        <span class="badge badge-pill text-white" style="background-color: {{ $item->color }}">{{ $item->name }}</span>
                                @endforeach
                                <br>
                                <p style="font-size: 14px">
                                    #{{ $ticket->id }} opened {{$ticket->created_at->diffForHumans()}} by {{ $ticket->author_name }}
                                </p>
                            </td>
                            <td class="text-center">
                                @foreach ($ticket->assigned_to as $item)
                                    <img src="{{ asset('storage/photos/upload/avatar/'.$item->avatar) }}" alt="avatar" width="40px" class="rounded-circle">
                                @endforeach
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

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').selectpicker();
    });

    $('.month').datepicker({
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months",
        orientation: "top right",
        todayBtn: "linked",
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
    });

    $('.year').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        orientation: "top right",
        todayBtn: "linked",
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
    });
</script>
@endsection
