@extends('layouts/main')

@section('title', 'Admin | Data Kategori Project')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0" style="font-size: 32px; color: black"><b>Data Kategori Project</b></h1>
    </div>

    @include('includes/alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form class="form-inline">
                <a href="/category-project/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2">
                    <i class="fas fa-plus fa-md text-white-50"></i><span class="ml-2">Tambah Kategori Project</span>
                </a>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">No.</th>
                            <th scope="col" class="text-center">Nama Kategori Project</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoryProjects as $categoryProject)
                        <tr>
                            <th scope="row" class="text-center"><strong>{{ $loop->iteration }}</strong></th>
                            <td class="text-center">{{ $categoryProject->name }}</td>
                            <td class="text-center">
                                <a href="/category-project/{{ $categoryProject->id }}/edit" class="btn btn-small text-success">
                                    <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                </a>
                                <form action="/category-project/{{ $categoryProject->id }}" method="POST" class="d-inline">
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
