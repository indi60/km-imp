@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Edit Data Projek')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Edit Data Projek')
@endif

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endsection

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Edit Project</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/project/{{ $Projects->id }}" method="POST">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="name">Nama Project</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukan Nama Project" name="name" value="{{ $Projects->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Kategori Project</label>
                    <div class="input-group mb-3">
                        <select class="custom-select form-control @error('category_id') is-invalid @enderror"
                            id="category_id" placeholder="Masukan Kategori Project" name="category_id">
                            <option value="0" selected>Pilih Kategori Project</option>
                            @foreach ($CategoryProjects as $CategoryProject)
                                <option value="{{$CategoryProject->id}}"
                                    @if ($CategoryProject->id === $Projects->category_id)
                                        selected
                                    @endif>
                                    {{$CategoryProject->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="assigned_to_user">Assigned To</label>
                    <div class="input-group mb-3">
                        <select class="custom-select selectpicker form-control @error('assigned_to_user') is-invalid @enderror"
                            multiple data-live-search="true" id="assigned_to_user" name="assigned_to_user[]"
                            value="{{ old('assigned_to_user') }}">
                            @foreach($Users as $User)
                                <option value="{{ $User->id }}"
                                    @foreach($Projects->ProjectAssigned as $item)
                                        @if ($User->id === $item->AssignedTo->id)
                                            selected
                                        @endif
                                    @endforeach>
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
                    <button style="width: 20%;" class="btn btn-small btn-success btn-block" type="submit"><i
                            class="far fa-save"></i><span class="ml-2">save changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <a href="/project" class="text-danger float-right">
        <i class="fas fa-arrow-left"><span class="ml-2">Back</span></i>
    </a>
</div>
<!-- container-fluid -->
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').selectpicker();
    });
</script>
@endsection
