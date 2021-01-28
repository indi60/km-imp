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
        <h4 class="h4 mb-0 text-gray-800">{{ $tickets->title }}</h4>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <p class="card-title" style="margin-bottom: -5px">
                        <span>
                            @foreach($tickets->status as $item)
                            @if($item->name === "Open")
                            <span class="badge badge-pill badge-success">
                                <i class="fas fa-exclamation-circle"></i><span class="ml-1">{{ $item->name }}</span>
                            </span>
                            @else
                            <span class="badge badge-pill badge-danger">
                                <i class="fas fa-check-circle"></i><span class="ml-1">{{ $item->name }}</span>
                            </span>
                            @endif
                            @endforeach
                        </span>
                        <b>{{ $tickets->author_name }}</b>,
                        <span>
                            created this issue {{ $tickets->created_at->diffForHumans() }}
                        </span>
                    </p>
                </div>

                <div class="card-body">
                    {!! $tickets->content !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <p class="card-title float-right" style="margin-bottom: -5px"><i class="fas fa-comment mr-1"></i>
                        {{ $comments->count() }} Comments
                    </p>
                </div>

                <div class="card-body">
                    <section class="comment-sec-area pt-80 pb-80">
                        <div class="container">
                            <div class="row flex-column">
                                @foreach($tickets->comment as $commentar)
                                <div class="comment">
                                    <div class="comment-list">
                                        <div class="justify-content-between d-flex">
                                            <div class="justify-content-between d-flex">
                                                @foreach($commentar->user as $users)
                                                <div class="avatar">
                                                    <img src="{{ asset('storage/photos/upload/avatar/'.$users->avatar) }}"
                                                        alt="{{ $users->avatar }}" width="50px" class="rounded-circle">
                                                </div>
                                                @endforeach
                                                <div class="container-fluid">
                                                    <p>
                                                        <strong class="text-primary">
                                                            <a href="mailto:{{ $commentar->author_email }}"
                                                                class="text-decoration-none">{{ $commentar->author_name }}
                                                            </a>
                                                        </strong>
                                                        <span
                                                            class="meta">{{ $commentar->created_at->format('D, d M Y H:i') }}</span>
                                                        <a class="text-primary"
                                                            onclick="showReplyForm('{{ $commentar->id }}','{{ $commentar->author_name }}')"
                                                            style="cursor:pointer"> - Reply
                                                        </a>
                                                    </p>
                                                    <div>
                                                        {!! $commentar->comment_text !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($commentar->comment_reply->count() > 0)
                                    @foreach($commentar->comment_reply as $replyComments)
                                    <div class="comment-list">
                                        <div class="justify-content-between d-flex" style="margin-left: 60px">
                                            <div class="justify-content-between d-flex">
                                                @foreach($replyComments->user as $users)
                                                <div class="avatar">
                                                    <img src="{{ asset('storage/photos/upload/avatar/'.$users->avatar) }}"
                                                        alt="{{ $users->avatar }}" width="50px" class="rounded-circle">
                                                </div>
                                                @endforeach
                                                <div class="container-fluid">
                                                    <p>
                                                        <strong class="text-primary">
                                                            <a href="mailto:{{ $replyComments->author_email }}"
                                                                class="text-decoration-none">{{ $replyComments->author_name }}
                                                            </a>
                                                        </strong>
                                                        <span
                                                            class="meta">{{ $replyComments->created_at->format('D, d M Y H:i') }}</span>
                                                        <a class="text-primary"
                                                            onclick="showReplyForm('{{ $commentar->id }}','{{ $replyComments->author_name }}')"
                                                            style="cursor:pointer"> - Reply Comment
                                                        </a>
                                                    </p>
                                                    <div>
                                                        {!! $replyComments->comment_reply_text !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <div class="comment-list" id="reply-form-{{ $commentar->id }}"
                                        style="display: none; margin-left: 60px">
                                        <div class="justify-content-between d-flex">
                                            <div class="justify-content-between d-flex">
                                                <div class="avatar">
                                                    <img src="{{ asset('storage/photos/upload/avatar/'. Auth::user()->avatar) }}"
                                                        alt="{{ Auth::user()->avatar }}" width="50px"
                                                        class="rounded-circle">
                                                </div>
                                                <div class="container-fluid">
                                                    <p>
                                                        <strong class="text-primary">
                                                            <a href="mailto:{{ Auth::user()->email }}"
                                                                class="text-decoration-none">{{ Auth::user()->name }}
                                                            </a>
                                                        </strong>
                                                        <span class="meta">{{ date('D, d M Y H:i') }}</span>
                                                    </p>
                                                    <form action="/comment-reply" method="post"
                                                        id="reply-form-{{ $commentar->id }}">
                                                        @csrf

                                                        <input type="hidden" name="user_id" id="user_id"
                                                            value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="author_name" id="author_name"
                                                            value="{{ Auth::user()->name }}">
                                                        <input type="hidden" name="author_email" id="author_email"
                                                            value="{{ Auth::user()->email }}">

                                                        <input type="hidden" name="comment_id" id="comment_id"
                                                            value="{{ $commentar->id }}">

                                                        <div class="form-group">
                                                            <label for="">Reply a comment</label>
                                                            <textarea id="reply-form-{{ $commentar->id }}-text"
                                                                name="comment_reply_text" rows="4" class="form-control"
                                                                style="width: 800px" onfocus="this.placeholder = ''"
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

                        <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $tickets->id }}">

                        <div class="form-group">
                            <label for="">Leave a comment</label>
                            <textarea name="comment_text" rows="4" class="form-control" placeholder="Type your message"
                                id="reply-form">
                            </textarea>
                        </div>
                        <div class="float-right">
                            @foreach ($tickets->status as $item)
                            @if ($item->name === "Open")
                            <a href="/ticket/{{$tickets->id}}/closed_ticket" class="btn btn-danger btn-sm">
                                <i class="fas fa-check-circle text-white"></i>
                                <span class="ml-2 text-white">Close issue</span>
                            </a>
                            <button class="btn btn-primary btn-sm" id="comment-btn">Comment</button>
                            @else
                            <a href="/ticket/{{$tickets->id}}/reopen_ticket" class="btn btn-success btn-sm">
                                <i class="fas fa-info-circle text-white"></i>
                                <span class="ml-2 text-white">Reopen issue</span>
                            </a>
                            <button class="btn btn-primary btn-sm" id="comment-btn" disabled>Comment</button>
                            @endif
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ url('/project/'.$idProject.'/ticket') }}" class="text-danger float-right">
        <i class="fas fa-arrow-left"><span class="ml-2">Back</span></i>
    </a>
</div>
<!-- /.container-fluid -->

@section('js')
<script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('reply-form', {
        filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ]) }}",
        filebrowserUploadMethod: 'form',
    });

    function showReplyForm(commentId, user) {
        var x = document.getElementById(`reply-form-${commentId}`);
        var input = document.getElementById(`reply-form-${commentId}-text`);

        if (x.style.display === "none") {
            x.style.display = "block";
            input.innerText = `@${user} `;
            CKEDITOR.replace(`reply-form-${commentId}-text`, {
                filebrowserUploadUrl: "{{ route('upload.upload', ['_token' => csrf_token() ]) }}",
                filebrowserUploadMethod: 'form',
            });
        } else {
            x.style.display = "none";
        }
    }
</script>
@endsection

@endsection
