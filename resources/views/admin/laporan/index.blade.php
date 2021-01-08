@extends('layouts/main')

@section('title', 'Admin | Data Laporan')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-5">
        <h1 class="h3 mb-0 text-gray-800">Data Laporan Pengerjaan Issue</h1>
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
                <label for="sort_project" class="mr-2">Sort by Project :</label>
                <select class="custom-select mr-3" name="project_id" id="inputGroupSelect02">
                    <option selected>Pilih Project</option>
                    @foreach($Projects as $Project)
                        <option value="{{ $Project->id }}">
                            {{ $Project->name }} :
                            @foreach($Project->CategoryProject as $item)
                                {{$item->name}}
                            @endforeach
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="sort_user" class="mr-2">Sort by User :</label>
                <select class="custom-select mr-3" name="assigned_to_user" id="inputGroupSelect02">
                    <option selected>Pilih User</option>
                    @foreach($Users as $User)
                        <option value="{{ $User->id }}">
                            {{ $User->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="sort_status" class="mr-2">Sort by Status :</label>
                <select class="custom-select mr-3" name="status_id" id="inputGroupSelect02">
                    <option selected>Pilih Status</option>
                    @foreach($Statuses as $Status)
                        <option value="{{ $Status->id }}">
                            {{ $Status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="sort_month" class="mr-2">Sort by Month :</label>
                <input type="month" name="created_at" class="form-control mr-3">
            </div>
            <div class="form-group col-md-4">
                <label for="sort_year" class="mr-2">Sort by Year :</label>
                <select class="custom-select mr-3" name="updated_at" id="inputGroupSelect02">
                    <option selected value="">Choose...</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                </select>
            </div>
            <div class="form-group col-md-4 mt-2 text-center">
                <button type="submit" class="btn btn-primary mt-4">cari</button>
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
                            <td class="text-center">
                                @foreach ($Ticket->AssignedTo as $item)
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
