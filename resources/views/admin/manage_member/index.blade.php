@extends('layouts/main')

@section('title', 'Admin | Data User')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="font-size: 32px; color: black"><b>Data Member</b></h1>
    </div>

    @include('includes/alert')
    
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
                        @foreach($members as $member)
                        <tr>
                            <th scope="row" class="text-center"><strong>{{ $loop->iteration }}</strong></th>
                            <td class="text-center">{{ $member->name }}</td>
                            <td class="text-center">{{ $member->jenis_kelamin }}</td>
                            <td class="text-center">
                                @if ($member->job_id == null)
                                    <p>Customer</p>
                                @else
                                    @foreach ($member->Job as $item)
                                        {{ $item->name }}
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">{{ $member->alamat }}</td>
                            <td class="text-center">{{ $member->no_hp }}</td>
                            <td class="text-center">{{ $member->email }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                    <a href="/manage-member/{{ $member->id }}/edit" class="btn btn-small text-success">
                                        <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                    </a>
                                    <form action="/manage-member/{{ $member->id }}" method="POST" class="d-inline">
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
                        @foreach($guests as $guest)
                        <tr>
                            <th scope="row" class="text-center"><strong>{{ $loop->iteration }}</strong></th>
                            <td class="text-center">{{ $guest->name }}</td>
                            <td class="text-center">{{ $guest->jenis_kelamin }}</td>
                            <td class="text-center">{{ $guest->alamat }}</td>
                            <td class="text-center">{{ $guest->no_hp }}</td>
                            <td class="text-center">{{ $guest->email }}</td>
                            <td class="text-center">
                                <form action="manage-member/approve/{{ $guest->id }}" method="POST" class="d-inline">
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
