@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Tambah Data Artikel')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Tambah Data Artikel')
@endif

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Artikel</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/article" method="POST">
                @csrf

                <input type="hidden" id="user_id" name="user_id" value="{{ Auth()->user()->id }}">
                <input type="hidden" id="author_name" name="author_name" value="{{ Auth()->user()->name }}">
                <input type="hidden" id="author_email" name="author_email" value="{{ Auth()->user()->email }}">

                <div class="form-group">
                    <label for="status_article_id">Status</label>
                    <div class="input-group mb-3">
                        <select class="custom-select selectpicker form-control @error('status_article_id') is-invalid @enderror" id="status_article_id"
                            placeholder="Masukan Job" name="status_article_id" value="{{ old('status_article_id') }}">
                            <option value="0" selected disabled>Pilih Status</option>
                            @foreach($statusArticles as $statusArticle)
                                <option value="{{ $statusArticle->id }}">
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
                    <label for="job_id">Kategori Artikel</label>
                    <div class="input-group mb-3">
                        <select class="custom-select selectpicker form-control @error('job_id') is-invalid @enderror" id="job_id"
                            placeholder="Masukan Kategori Artikel" name="job_id" value="{{ old('job_id') }}" data-live-search="true">
                            <option value="0" selected disabled>Pilih Kategori Artikel</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}">
                                    {{ $job->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('job_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Judul Artikel</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        placeholder="Masukan Judul Tiket" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content-article"></textarea>
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
    <a href="/article" class="text-danger float-right">
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
    CKEDITOR.replace('content-article', {
        filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    });
</script>
@endsection
