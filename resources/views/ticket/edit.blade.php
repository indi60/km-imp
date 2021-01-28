@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Edit Data Tiket')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Edit Data Tiket')
@else
    @section('title', 'Guest | Edit Data Tiket')
@endif

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Edit Tiket</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/project/ticket/{{ $tickets->id }}" method="POST">
                @method('put')
                @csrf

                <input type="hidden" id="user_id" name="user_id" value="{{ Auth()->user()->id }}">
                <input type="hidden" id="author_name" name="author_name" value="{{ Auth()->user()->name }}">
                <input type="hidden" id="author_email" name="author_email" value="{{ Auth()->user()->email }}">
                <input type="hidden" id="project_id" name="project_id" value="{{ $idProject }}">
                <input type="hidden" id="status_id" name="status_id" value="1">

                <div class="form-group">
                    <label for="title">Judul Tiket</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        placeholder="Masukan Judul Tiket" name="title" value="{{ $tickets->title }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="assigned_to_user">Assigned To</label>
                    <div class="input-group mb-3">
                        <select class="custom-select form-control @error('assigned_to_user') is-invalid @enderror"
                            id="assigned_to_user" name="assigned_to_user" value="{{ old('assigned_to_user') }}" data-live-search="true">
                            <option value="0" selected disabled>Pilih User yang di Assign</option>
                            @foreach($projects->project_assigned as $user)
                                <option value="{{ $user->assigned_to->id }}"
                                    @if ($user->assigned_to->id === $tickets->assigned_to_user)
                                        selected
                                    @endif>
                                    {{ $user->assigned_to->name }}
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
                        <select class="custom-select form-control @error('priority_id') is-invalid @enderror"
                            id="priority_id" name="priority_id" value="{{ old('priority_id') }}" data-live-search="true">
                            <option value="0" selected disabled>Pilih Priority</option>
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}"
                                    @if ($priority->id === $tickets->priority_id)
                                        selected
                                    @endif>
                                    {{ $priority->name }}
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
                    <textarea class="form-control" name="content" id="content-ticket">{{ $tickets->content }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button style="width: 20%;" class="btn btn-small btn-success btn-block" type="submit"><i
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
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').selectpicker();
    });
</script>
<script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('content-ticket', {
        filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    });
</script>
@endsection
