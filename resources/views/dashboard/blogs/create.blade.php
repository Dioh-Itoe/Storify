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
    <h2>Create your blog/story</h2>
    <hr>
    <form action="{{ route('store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" autocomplete="off" placeholder="Title">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="category_id">Post Category</label>
                    <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                         <option label="Choose post category..."></option> 
                         @foreach ($cats as $cat)
                         <option value="{{ $cat->id }}" {{ $cat->id == old('category_id') ? 'selected' : ''}}>{{ $cat->name }}</option>
                         @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    {{-- <input type="text" name="category" class="form-control" placeholder="category"> --}}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="body">Body</label>
                    <textarea name="body" class="form-control @error('body') is-invalid @enderror" rows="6" placeholder="Type story body...">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="featuredImg">Featured Image</label>
                    <input type="file" name="featured_image" class="dropify @error('featured_image') is-invalid @enderror" data-max-file-size="4M" data-allowed-file-extensions="jpg png mpg4 jpeg" id="featuredImg">
                    @error('featured_image')
                        <p class="text-danger"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <legend><h6>Status</h6></legend>
                    <div class="form-check">
                        <input type="radio" name="status" title="Public" class="form-check-input @error('status') is-invalid @enderror" value="1" {{ '1' == old('1') ? 'checked' : '' }}>
                        <label for="active" title="Public" class="form-check-label">Yes</label>
                        @error('status')
                            <p class="text-danger"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input type="radio" name="status" title="Private" class="form-check-input @error('status') is-invalid @enderror" value="0" {{ '0' == old('0') ? 'checked' : '' }}>
                        <label for="active" title="Private" class="form-check-label">No</label>
                        @error('status')
                            <p class="text-danger"> {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary col-md-12 btn-lg">Save</button>
            </div>
    </form>
</div>
@endsection

@section('script')
<script type="text/javascript">
      $(document).ready(function() {
          $('.dropify').dropify();
      } );
  </script>
@endsection