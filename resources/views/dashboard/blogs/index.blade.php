@extends('app.layout')
@section('sidebar')
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Blogger</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('index') }}">
            <i class="fa fa-blog"></i>
            <span>Blogs/Stories</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('allstorycats') }}">
            <i class="fa fa-list-alt"></i>
            <span>Category</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
  
@endsection
@section('content')
<div class="container">
    
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
    
    <div class="d-flex justify-content-between">
        <div>
            <h2>Stories</h2> 
        </div>
        <div class="my-2">
            @can('create', App\Models\Story::class)
                <a class="btn btn-primary" href="{{ route('create') }}">Add story</a>
            @endcan
        </div>
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Story Title</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $i = 0;
                @endphp

                @if (count(Auth::user()->stories))
                @foreach (Auth::user()->stories as $story)

                @php
                 $i++;
                @endphp
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{ $story->title }}</td>
                    <td>{{ Str::words($story->body, 15) }}</td>
                    <td>{{  $story->status == 1 ? 'On' : 'Off' }}</td>
                    <td>
                        <ul class="action-links">

                            @can('view', $story)
                            <li>
                                <a href="#" data-toggle="modal"> <i class="fa fa-eye"></i></a>
                            </li>
                            @endcan
                                                
                            @can('update',$story)
                            <li>
                                <a href="{{ route('edit',$story->slug) }}"> <i class="fa fa-edit"></i></a>
                            </li>
                            @endcan

                            @can('delete', $story)
                            <li>
                                <a href="#delete{{ $story->slug }}" data-toggle="modal"> <i class="fa fa-trash"></i></a>
                            </li>
                            @endcan
                        </ul>
                    </td>
                </tr>
                
                <div id="delete{{ $story->slug }}" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong>{{ $story->title }} ?</strong></p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <a href="{{ route('delete', $story->slug) }}" type="submit" class="btn btn-primary">Yes</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </tbody>
            
            
        </table>
    </div>
</div>
@endsection