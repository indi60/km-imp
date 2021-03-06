@extends('layouts/main')

@section('title', 'Admin | Data Setting')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="font-size: 32px; color: black"><b>Data Setting</b></h1>
    </div>

    @include('includes/alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <form class="form-inline justify-content-between">
                <h5>Data Job</h5>
                <a href="/job/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Job</span>
                </a>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Nama Job</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <th scope="row" class="text-center"><strong>{{ $loop->iteration }}</strong></th>
                                <td class="text-center">{{ $job->name }}</td>
                                <td class="text-center">
                                    <a href="/job/{{ $job->id }}/edit" class="btn btn-small text-success">
                                        <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                    </a>
                                    <form action="/job/{{ $job->id }}" method="POST" class="d-inline">
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

    <div class="card shadow mb-4">
        <div class="card-header">
            <form class="form-inline justify-content-between">
                <h5>Data Role</h5>
                <a href="/role/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Role</span>
                </a>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Nama Role</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <th scope="row" class="text-center"><strong>{{ $loop->iteration }}</strong></th>
                            <td class="text-center">{{ $role->name }}</td>
                            <td class="text-center">
                                <a href="/role/{{ $role->id }}/edit" class="btn btn-small text-success">
                                    <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                </a>
                                <form action="/role/{{ $role->id }}" method="POST" class="d-inline">
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

    <div class="card shadow mb-4">
        <div class="card-header">
            <form class="form-inline justify-content-between">
                <h5>Data Priority</h5>
                <a href="/priority/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Priority</span>
                </a>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Nama Priority</th>
                            <th scope="col" class="text-center">Warna</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($priorities as $priority)
                        <tr>
                            <th scope="row" class="text-center"><strong>{{ $loop->iteration }}</strong></th>
                            <td class="text-center">{{ $priority->name }}</td>
                            <td style="background-color:{{ $priority->color ?? '#FFFFFF' }}" class="text-center"></td>
                            <td class="text-center">
                                <a href="/priority/{{ $priority->id }}/edit" class="btn btn-small text-success">
                                    <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                </a>
                                <form action="/priority/{{ $priority->id }}" method="POST" class="d-inline">
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

    <div class="card shadow mb-4">
        <div class="card-header">
            <form class="form-inline justify-content-between">
                <h5>Data Status</h5>
                <a href="/status/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Status</span>
                </a>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Nama Status</th>
                            <th scope="col" class="text-center">Warna</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statuses as $status)
                        <tr>
                            <th scope="row" class="text-center"><strong>{{ $loop->iteration }}</strong></th>
                            <td class="text-center">{{ $status->name }}</td>
                            <td style="background-color:{{ $status->color ?? '#FFFFFF' }}" class="text-center"></td>
                            <td class="text-center">
                                <a href="/status/{{ $status->id }}/edit" class="btn btn-small text-success">
                                    <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                </a>
                                <form action="/status/{{ $status->id }}" method="POST" class="d-inline">
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

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5>Deskripsi</h5>
                </div>
                @foreach ($descriptions as $description)
                    <div class="card-body">
                        <p>{{ $description->desc }}</p>
                        <a href="/description/{{ $description->id }}/edit" class="btn btn-small text-success float-right">
                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated
                            {{ $description->updated_at->diffForHumans() }}
                        </small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@section('js')
<script>
    $(document).ready(function () {
        $('#dataTable2').DataTable();
        $('#dataTable3').DataTable();
        $('#dataTable4').DataTable();
    });
</script>
@endsection

@endsection
