@extends('layouts.app')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
    .like-comment a,.like-but{
        background-color: rgba(8, 23, 241, 0.24);
        margin: 1px;
    }
</style>

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-2">
            <h1>{{ ucfirst($story->title) }}</h1>
            <hr class="m-0 p-0">
            <a href="#">{{ ucfirst($story->category->name) }}</a>
        </div>
        <div class="col-md-10 col-md-offset-2">
            <img src="{{ json_decode($story['featured_image'])[1] ?? 'https://media.sproutsocial.com/uploads/2019/09/how-to-write-a-blog-post.svg' }}" alt="Featured Image" height="500px" width="100%">
            <p>{{ $story->body }}</p>
        </div>
        <div id="" class="col-md-10 col-md-offset-2">
            <hr>
            <div class="py-2">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('danger') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <h5>Comments Area</h5>
            <div class="col-md-10 col-md-offset-2">
                @include('partials._comment_replies', ['comments' => $story->comments, 'commentable_id' => $story->id])
            </div>
            <br>
            {{-- start check if user is authenticated to display form depending if authenticated or not--}}
            @if (Auth::check())
            <form action="{{ route('save-comment', $story->id) }}" method="post">
                @csrf
                {{-- <div class="form-row">
                    <div class="form-group"> --}}
                        <input type="hidden" name="name" id="" value="{{ $story->users->name }}">
                        <input type="hidden" name="email" id="" value="{{ $story->users->email }}">
                        <input type="hidden" name="author_id" id="" value="{{ $story->users->id }}" >
                        <input type="hidden" name="commentable_id" value="{{ $story->id}}">
                    {{-- </div>
                </div> --}}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea name="comment_body" id=""  rows="5" class="form-control" placeholder="Enter Comment..."></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary form-control">Post Comment</button>
                    </div>
                </div>
            </form>
                
            @else
            <form action="{{ route('save-comment', $story->id) }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="" class="form-control" placeholder="Email">
                    </div>
                </div>
                 <div class="form-row">
                    <div class="form-group">
                        <input type="hidden" name="commentable_id" value="{{ $story->id}}">
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea name="comment_body" id=""  rows="5" class="form-control" placeholder="Enter Comment..."></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary form-control">Post Comment</button>
                    </div>
                </div>
            </form>
            @endif
            {{-- stop check if user is authenticated or not--}}
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    
</script>
    
@endsection