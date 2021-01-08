@extends('layouts/main')

@section('title', 'Admin | Data User')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="font-size: 32px; color: black"><b>Data Member</b></h1>
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
            <form class="form-inline">
                <a href="/manage-member/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Member</span>
                </a>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Nama Lengkap</th>
                            <th scope="col" class="text-center">Jenis Kelamin</th>
                            <th scope="col" class="text-center">Job</th>
                            <th scope="col" class="text-center">Alamat</th>
                            <th scope="col" class="text-center">No HP</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Members as $Member)
                        <tr>
                            <th scope="row" class="text-center"><strong>{{ $loop->iteration }}</strong></th>
                            <td class="text-center">{{ $Member->name }}</td>
                            <td class="text-center">{{ $Member->jenis_kelamin }}</td>
                            <td class="text-center">
                                @if ($Member->job_id == null)
                                    <p>Customer</p>
                                @else
                                    @foreach ($Member->Job as $item)
                                        {{ $item->name }}
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">{{ $Member->alamat }}</td>
                            <td class="text-center">{{ $Member->no_hp }}</td>
                            <td class="text-center">{{ $Member->email }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                    <a href="/manage-member/{{ $Member->id }}/edit" class="btn btn-small text-success">
                                        <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                    </a>
                                    <form action="/manage-member/{{ $Member->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-small text-danger">
                                            <i class=" fa fa-trash"></i><span class="ml-2">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="font-size: 32px; color: black"><b>Data Guest User</b></h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable2" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Nama Lengkap</th>
                            <th scope="col" class="text-center">Jenis Kelamin</th>
                            <th scope="col" class="text-center">Alamat</th>
                            <th scope="col" class="text-center">No HP</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Guests as $Guest)
                        <tr>
                            <th scope="row" class="text-center"><strong>{{ $loop->iteration }}</strong></th>
                            <td class="text-center">{{ $Guest->name }}</td>
                            <td class="text-center">{{ $Guest->jenis_kelamin }}</td>
                            <td class="text-center">{{ $Guest->alamat }}</td>
                            <td class="text-center">{{ $Guest->no_hp }}</td>
                            <td class="text-center">{{ $Guest->email }}</td>
                            <td class="text-center">
                                <form action="manage-member/approve/{{ $Guest->id }}" method="POST" class="d-inline">
                                    @method('put')
                                    @csrf
                                    <button type="submit" class="btn btn-small text-success">
                                        <i class=" fa fa-check-circle"></i><span class="ml-2">Approve</span>
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

@section('js')
<script>
    $(document).ready(function () {
        $('#dataTable2').DataTable();
    });

</script>
@endsection
