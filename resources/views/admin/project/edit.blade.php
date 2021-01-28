@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Edit Data Projek')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Edit Data Projek')
@endif

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Edit Project</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/project/{{ $projects->id }}" method="POST">
                @method('put')
                @csrf

                <div class="form-group">
                    <label for="name">Nama Project</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukan Nama Project" name="name" value="{{ $projects->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Kategori Project</label>
                    <div class="input-group mb-3">
                        <select class="custom-select form-control @error('category_id') is-invalid @enderror"
                            id="category_id" placeholder="Masukan Kategori Project" name="category_id">
                            <option value="0" selected disabled>Pilih Kategori Project</option>
                            @foreach ($categoryProjects as $categoryProject)
                                <option value="{{$categoryProject->id}}"
                                    @if ($categoryProject->id === $projects->category_id)
                                        selected
                                    @endif>
                                    {{$categoryProject->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="status_article_id">Status</label>
                    <div class="input-group mb-3">
                        <select class="custom-select form-control @error('status_article_id') is-invalid @enderror" id="status_article_id"
                            placeholder="Masukan Status" name="status_article_id" value="{{ old('status_article_id') }}">
                            <option value="0" selected disabled>Pilih Status</option>
                            @foreach($statusArticles as $statusArticle)
                                <option value="{{ $statusArticle->id }}"
                                    @if ($statusArticle->id === $projects->status_article_id)
                                        selected
                                    @endif>
                                    {{ $statusArticle->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_article_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="assigned_to_user">Assigned To</label>
                    <div class="input-group mb-3">
                        <select class="custom-select selectpicker form-control @error('assigned_to_user') is-invalid @enderror"
                            id="assigned_to_user" name="assigned_to_user[]" multiple data-live-search="true"
                            value="{{ old('assigned_to_user') }}">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    @foreach($projects->project_assigned as $item)
                                        @if ($user->id === $item->assigned_to->id)
                                            selected
                                        @endif
                                    @endforeach>
                                    {{ $user->name }}
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').selectpicker();
    });
</script>
@endsection
