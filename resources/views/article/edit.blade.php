@extends('layouts/main')

@if (auth()->user()->role_id == "1")
    @section('title', 'Admin | Data Tiket')
@elseif (auth()->user()->role_id == "2")
    @section('title', 'Member | Data Tiket')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Edit Tiket</h6>
        </div>

        <div class="card-body">
            <form class=" form-signin" action="/article/{{ $Articles->id }}" method="POST">
                @method('put')
                @csrf

                <input type="hidden" id="user_id" name="user_id" value="{{ Auth()->user()->id }}">
                <input type="hidden" id="author_name" name="author_name" value="{{ Auth()->user()->name }}">
                <input type="hidden" id="author_email" name="author_email" value="{{ Auth()->user()->email }}">

                <div class="form-group">
                    <label for="status_article_id">Status</label>
                    <div class="input-group mb-3">
                        <select class="custom-select form-control @error('status_article_id') is-invalid @enderror" id="status_article_id"
                            placeholder="Masukan Job" name="status_article_id" value="{{ old('status_article_id') }}">
                            <option value="0" selected>Pilih Status</option>
                            @foreach($StatusArticles as $StatusArticle)
                                <option value="{{ $StatusArticle->id }}"
                                    @if ($StatusArticle->id === $Articles->status_article_id)
                                        selected
                                    @endif>
                                    {{ $StatusArticle->name }}
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
                        <select class="custom-select form-control @error('job_id') is-invalid @enderror" id="job_id"
                            placeholder="Masukan Kategori Artikel" name="job_id" value="{{ $Articles->job_id }}">
                            <option value="0" selected>Pilih Kategori Artikel</option>
                            @foreach($Jobs as $Job)
                                <option value="{{ $Job->id }}"
                                    @if ($Job->id === $Articles->job_id)
                                        selected
                                    @endif>
                                    {{ $Job->name }}
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
                        placeholder="Masukan Judul Tiket" name="title" value="{{ $Articles->title }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content-article">{{ $Articles->content }}</textarea>
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

@section('js')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content-article', {
            filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
    </script>
@endsection

@endsection
