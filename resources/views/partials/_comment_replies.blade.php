{{-- @if (count($comments) > 0) --}}
    @foreach ($comments as $comment)
        <div class="display-comment">
            <div class="m-0 p-0 d-flex">
                <i class="fas fa-user mr-2"></i><h5 class="my-0"><strong>{{ $comment->name }}</strong></h5> <span class="mx-2 my-0">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>
            </div>
            <div></div>
            <div class="mx-5 p-0">
                <p class="my-0">{{ $comment->comment_body }}</p>
                <div class="flex m-0 p-0 like-comment">
                    @include('like', ['model' => $comment])
                    <a href="#reply{{ $comment->id }}" data-toggle="modal" class="align-center"><i class="fas fa-reply mx-2"></i></a>
                </div>
            </div>
            {{-- <hr class="my-0">
            @include('partials._comment_replies', ['comments' => $comment->replies]) --}}
            {{-- START MODAL FORM TO REPLY A COMMENT --}}
            <div id="reply{{ $comment->id }}" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content px-4">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <h3>Write comment</h3>
                        @if (Auth::check())
                        <form action="{{ route('save-reply', $comment->id) }}" method="post">
                            @csrf
                            {{-- <div class="form-group">
                                <div class="form-row"> --}}
                                    <input type="hidden" name="name" id="" value="{{ $story->users->name }}" class="form-control" placeholder="Name">
                                    <input type="hidden" name="email" id="" value="{{ $story->users->email }}" class="form-control" placeholder="Email">
                                    <input type="hidden" name="parent_id" id="" value="{{ $comment->id }}" class="form-control" placeholder="reply comment">
                                    <input type="hidden" name="author_id" id="" value="{{ $story->users->id}}" class="form-control" placeholder="id">
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
                        <form action="{{ route('save-reply', $comment->id) }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="" class="form-control" placeholder="Email">
                                    <input type="hidden" name="parent_id" id="" value="{{ $comment->id }}" class="form-control" placeholder="reply comment">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="hidden" name="commentable_id" value="{{ $story->id}}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="parent_id" id="" value="{{ $comment->id }}" class="form-control" placeholder="reply comment">
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
                    </div>
                </div>
            </div>
            {{--END  MODAL FORM TO REPLY A COMMENT --}}
            <hr class="my-0">
            @include('partials._comment_replies', ['comments' => $comment->replies])
        </div>
    @endforeach
    {{-- @else
    <p class="text-sm" style="color: darkgray">No Comment Yet.</p>     
@endif  --}}