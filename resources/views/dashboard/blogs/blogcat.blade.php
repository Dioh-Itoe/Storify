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
    <li class="nav-item">
        <a class="nav-link" href="{{ route('index') }}">
            <i class="fa fa-blog"></i>
            <span>Blogs/Stories</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item active">
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
        <div class="">
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
            <h2>Blog Categories</h2> 
            <a class="btn btn-primary" data-toggle="modal"  href="#add">Add Category</a>
        </div>
        <div id="add" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('add-blog-category') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" autocomplete="off" class="form-control name">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" autocomplete="off" class="form-control slug">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($cats as $cat)
                @php
                    $i++;
                @endphp 
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $cat->name }}</td>
                    <td>
                        <ul class="d-flex list-unstyled justify-space-between">
                            <li class="p-2"><a href="#edit{{ $cat->slug }}" data-toggle="modal"> <i class="fa fa-edit"></i> </a></li>
                            <li class="p-2"><a href="#delete{{ $cat->slug }}" data-toggle="modal"> <i class="fa fa-trash"></i> </a></li>
                        </ul>
                    </td>
                </tr>

                <div id="edit{{ $cat->slug }}" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('updateCat', $cat->slug) }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ $cat->name }}" autocomplete="off" class="form-control name">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" value="{{ $cat->slug }}" autocomplete="off" class="form-control slug">
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="delete{{ $cat->slug }}" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong>{{ $cat->name }} ?</strong></p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <a href="{{ route('deleteblogCat', $cat->slug) }}" type="submit" class="btn btn-primary">Yes</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
        
                @endforeach
            </tbody>
          </table>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $('.name').keyup(function(e) {
        e.preventDefault();
        var str = $('.name').val();
        var slug = str.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
        $('.slug').attr('value', slug);
    });
</script>
    
@endsection