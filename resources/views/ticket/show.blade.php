@extends('layouts/main')

@if(auth()->user()->role_id == "1")
    @section('title', 'Admin | Detail Tiket')
@elseif(auth()->user()->role_id == "2")
    @section('title', 'Member | Detail Tiket')
@endif

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0 text-gray-800">{{ $Tickets->title }}</h4>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <p class="card-title" style="margin-bottom: -5px">
                        <span>
                            @foreach($Tickets->Status as $item)
                                @if($item->name === "Open")
                                    <span class="badge badge-pill badge-success">
                                        <i class="fas fa-exclamation-circle"></i><span
                                            class="ml-1">{{ $item->name }}</span>
                                    </span>
                                @else
                                    <span class="badge badge-pill badge-danger">
                                        <i class="fas fa-check-circle"></i><span class="ml-1">{{ $item->name }}</span>
                                    </span>
                                @endif
                            @endforeach
                        </span>
                        <b>{{ $Tickets->author_name }}</b>,
                        <span>
                            created this issue {{ $Tickets->created_at->diffForHumans() }}
                        </span>
                    </p>
                </div>

                <div class="card-body">
                    {!! $Tickets->content !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <p class="card-title float-right" style="margin-bottom: -5px"><i class="fas fa-comment mr-1"></i>
                        {{ $Comments->count() }} Comments
                    </p>
                </div>

                <div class="card-body">
                    <section class="comment-sec-area pt-80 pb-80">
                        <div class="container">
                            <div class="row flex-column">
                                @foreach($Tickets->Comment as $Commentar)
                                    <div class="comment">
                                        <div class="comment-list">
                                            <div class="justify-content-between d-flex">
                                                <div class="justify-content-between d-flex">
                                                    @foreach($Commentar->User as $Users)
                                                        <div class="avatar">
                                                            <img src="{{ asset('storage/photos/upload/avatar/'.$Users->avatar) }}"
                                                                alt="{{ $Users->avatar }}" width="50px"
                                                                class="rounded-circle">
                                                        </div>
                                                    @endforeach
                                                    <div>
                                                        <h5>
                                                            <a href="mailto:{{ $Commentar->author_email }}"
                                                                style="text-decoration: none"
                                                                class="ml-3">{{ $Commentar->author_name }}
                                                            </a>
                                                        </h5>
                                                        <p class="ml-3">
                                                            {{ $Commentar->created_at->format('D, d M Y H:i') }}
                                                        </p>
                                                        <p class="ml-3">
                                                            {!! $Commentar->comment_text !!}
                                                            <a class="text-primary ml-3" style="cursor:pointer"
                                                                onclick="showReplyForm('{{ $Commentar->id }}','{{ $Commentar->author_name }}')">
                                                                Reply
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($Commentar->CommentReply->count() > 0)
                                            @foreach($Commentar->CommentReply as $ReplyComments)
                                                <div class="comment-list">
                                                    <div class="justify-content-between d-flex"
                                                        style="margin-left: 60px">
                                                        <div class="justify-content-between d-flex">
                                                            @foreach($ReplyComments->User as $Users)
                                                                <div class="avatar">
                                                                    <img src="{{ asset('storage/photos/upload/avatar/'.$Users->avatar) }}"
                                                                        alt="{{ $Users->avatar }}" width="50px"
                                                                        class="rounded-circle">
                                                                </div>
                                                            @endforeach
                                                            <div>
                                                                <h5>
                                                                    <a href="mailto:{{ $ReplyComments->author_email }}"
                                                                        style="text-decoration: none"
                                                                        class="ml-3">{{ $ReplyComments->author_name }}
                                                                    </a>
                                                                </h5>
                                                                <p class="ml-3">
                                                                    {{ $ReplyComments->created_at->format('D, d M Y H:i') }}
                                                                </p>
                                                                <p class="ml-3">
                                                                    {!! $ReplyComments->comment_reply_text !!}
                                                                    <a class="text-primary ml-2" style="cursor:pointer"
                                                                        onclick="showReplyForm('{{ $Commentar->id }}','{{ $ReplyComments->author_name }}')">
                                                                        Reply
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                        @endif
                                        <div class="comment-list" id="reply-form-{{ $Commentar->id }}"
                                            style="display: none; margin-left: 60px">
                                            <div class="justify-content-between d-flex">
                                                <div class="justify-content-between d-flex">
                                                    <div class="avatar">
                                                        <img src="{{ asset('storage/photos/upload/avatar/'. Auth::user()->avatar) }}"
                                                            alt="{{ Auth::user()->avatar }}" width="50px"
                                                            class="rounded-circle">
                                                    </div>
                                                    <div>
                                                        <h5 class="ml-3">
                                                            <a href="#" style="text-decoration: none">
                                                                {{ Auth::user()->name }}
                                                            </a>
                                                        </h5>
                                                        <p class="ml-3">
                                                            {{ date('D, d M Y H:i') }}
                                                        </p>

                                                        <div class="row flex-row d-flex">
                                                            <form action="/comment-reply" method="post"
                                                                id="reply-form-{{ $Commentar->id }}" style="margin-left: 30px;">
                                                                @csrf

                                                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                                                <input type="hidden" name="author_name" id="author_name" value="{{ Auth::user()->name }}">
                                                                <input type="hidden" name="author_email" id="author_email" value="{{ Auth::user()->email }}">

                                                                <input type="hidden" name="comment_id" id="comment_id" value="{{ $Commentar->id }}">

                                                                <div class="form-group">
                                                                    <label for="">Reply a comment</label>
                                                                    <textarea
                                                                        id="reply-form-{{ $Commentar->id }}-text"
                                                                        name="comment_reply_text" rows="4"
                                                                        class="form-control"
                                                                        style="width: 800px"
                                                                        onfocus="this.placeholder = ''"
                                                                        onblur="this.placeholder = 'Reply message'">
                                                                    </textarea>
                                                                </div>
                                                                <button class="btn btn-primary btn-sm">
                                                                    Reply Comment
                                                                </button>
                                                            </form>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <form action="/comment" method="post">
                        @csrf

                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="author_name" id="author_name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="author_email" id="author_email" value="{{ Auth::user()->email }}">

                        <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $Tickets->id }}">

                        <div class="form-group">
                            <label for="">Leave a comment</label>
                            <textarea name="comment_text" rows="4" class="form-control"
                                placeholder="Type your message" id="reply-form">
                            </textarea>
                        </div>
                        <button class="btn btn-primary btn-sm">Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ url('/project/'.$idProject.'/ticket')}}" class="text-danger float-right">
        <i class="fas fa-arrow-left"><span class="ml-2">Back</span></i>
    </a>
</div>
<!-- /.container-fluid -->

@section('js')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('reply-form', {
        filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    });

    function showReplyForm(commentId, user) {
        var x = document.getElementById(`reply-form-${commentId}`);
        var input = document.getElementById(`reply-form-${commentId}-text`);

        if (x.style.display === "none") {
            x.style.display = "block";
            input.innerText = `@${user} `;
            CKEDITOR.replace(`reply-form-${commentId}-text`, {
                filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
            });
        } else {
            x.style.display = "none";
        }
    }
</script>
@endsection

@endsection
