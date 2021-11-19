@extends('layouts.app')
    @section('content')
            
        <div class="jumbotron bg-white max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="text-center">
                        <h1>Stories/Blogs</h1>
                        <p class="lead">Your number one news update within and outside Cameroon. The bloggers choice!</p>
                        <hr class="my-4">
                        <p>Your number one blog platform. See all your top stories or blog post posted by different individuals all over the country/world. </p>
                    </div>
                </div>

                <div class="col-md-7">
                    @if (!empty($recent_story))
                        <div class="card m-2 p-0">
                            <div class="card-title m-2 p-0">
                                <a href="{{ route('single-story', $recent_story->slug) }}"><h3>{{ $recent_story->title }}</h3></a>
                            </div>
                            <div class="card-text">
                                <div>
                                    <img src="{{ json_decode($recent_story['featured_image'])[1] ?? 'https://media.sproutsocial.com/uploads/2019/09/how-to-write-a-blog-post.svg' }}" alt="Featured Image" height="350px" width="100%">

                                </div>
                                <div class="m-2 p-0">
                                    {{ Str::words($recent_story->body, 25) }}
                                </div>
                                <div class="m-2 p-0">
                                    <a href="#" class="btn btn-primary">Read more...</a>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="justify-center sm:items-center sm:justify-between">
                                    <div class="text-center text-sm text-gray-500 sm:text-left">
                                        <div class="flex items-center justify-content-around">
                                            {{-- <a href="{{ route('single-story', $recent_story->slug) }}"  class="ml-1 mx-1" data-toggle="modal"> --}}
                                            <a id="fixed" href="{{ route('single-story', $recent_story->slug) }}"  class="badge-notification">
                                                <i class="fas fa-comment text-lg"></i>
                                            </a>
                                            @include('like', ['model' => $recent_story])
                                            <span class="">Category: <a href="#">{{ $recent_story->category->name }}</a></span>
                                            <span class="">Posted-on: {{ date('M d, Y', strtotime($recent_story->created_at)) }}</span>
                                            <span class="">By: <a href="#">{{$recent_story->users->name }}</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="relative flex items-top justify-center max-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0 m-4">
            <div class="row">
                @if (count($stories) >  0)
                @foreach ($stories as $story)
                @if ($recent_story->id != $story->id)
                    <div class="col-md-4">
                        <div class="card mx-0 mt-2 p-0">
                            <div class="card-title m-2 p-0">
                                <a href="{{ route('single-story', $story->slug) }}"><h3>{{ $story->title }}</h3></a>
                            </div>
                            <div class="card-text">
                                <div>
                                    <img src="{{ json_decode($story['featured_image'])[1] ?? 'https://media.sproutsocial.com/uploads/2019/09/how-to-write-a-blog-post.svg' }}" alt="Featured Image" height="320px" width="100%">

                                </div>
                                <div class="p-2">
                                    {{ Str::words($story->body, 20) }}
                                </div>
                                <div class="p-2">
                                    <a href="#" class="btn btn-primary">Read more...</a>
                                </div>
                            </div>
                            <div class="card-footer px-0">
                                <div class="justify-center sm:items-center sm:justify-between">
                                    <div class="text-center text-sm text-gray-500 sm:text-left">
                                        <div class="d-flex items-center justify-content-around">
                                            {{-- <a href="{{ route('single-story', $story->slug) }}" class="ml-1 mx-1" data-toggle="modal"> --}}
                                            <a href="{{ route('single-story', $story->slug) }}" class="">
                                            
                                                <i class="fas fa-comment text-lg"></i>
                                            </a>
                                            @include('like', ['model' => $story])
                                            <span class="">Category: <a href="#">{{ $story->category->name }}</a></span>
                                            <span class="">Posted-on: {{ date('M d, Y', strtotime($story->created_at)) }}</span>
                                            <span class="">By: <a href="#">{{$story->users->name }}</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
                @else
                <div class="card">
                    <div class="card-body">
                        <p>No Data Found</p>
                    </div>
                </div>
                @endif
            </div>

        </div>
    @endsection
