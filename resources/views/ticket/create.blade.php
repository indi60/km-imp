@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Tambah Data Tiket')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Tambah Data Tiket')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Tiket</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/project/ticket" method="POST">
                @csrf

                <input type="hidden" id="user_id" name="user_id" value="{{ Auth()->user()->id }}">
                <input type="hidden" id="author_name" name="author_name" value="{{ Auth()->user()->name }}">
                <input type="hidden" id="author_email" name="author_email" value="{{ Auth()->user()->email }}">
                <input type="hidden" id="project_id" name="project_id" value="{{ $idProject }}">
                <input type="hidden" id="status_id" name="status_id" value="1">

                <div class="form-group">
                    <label for="title">Judul Tiket</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        placeholder="Masukan Judul Tiket" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="assigned_to_user">Assigned To</label>
                    <div class="input-group mb-3">
                        <select class="custom-select form-control @error('assigned_to_user') is-invalid @enderror" id="assigned_to_user"
                            name="assigned_to_user" value="{{ old('assigned_to_user') }}">
                            <option value="0" selected>Pilih User yang di Assign</option>
                            @foreach($Users as $User)
                                <option value="{{ $User->id }}">
                                    {{ $User->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to_user')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="priority_id">Priority</label>
                    <div class="input-group mb-3">
                        <select class="custom-select form-control @error('priority_id') is-invalid @enderror" id="priority_id"
                            placeholder="Masukan Job" name="priority_id" value="{{ old('priority_id') }}">
                            <option value="0" selected>Pilih Priority</option>
                            @foreach($Priorities as $Priority)
                                <option value="{{ $Priority->id }}">
                                    {{ $Priority->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('priority_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content-ticket"></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button style="width: 20%;" class="btn btn-small btn-success btn-block" type="submit" id="button"><i
                            class="far fa-save"></i><span class="ml-2">save changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ url('/project/'.$idProject.'/ticket')}}" class="text-danger float-right">
        <i class="fas fa-arrow-left"><span class="ml-2">Back</span></i>
    </a>
</div>
<!-- container-fluid -->

@section('js')
    <script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content-ticket', {
            filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
    </script>
@endsection

@endsection
