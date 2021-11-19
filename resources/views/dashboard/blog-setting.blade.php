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
    <li class="nav-item active">
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
    <li class="nav-item ">
        <a class="nav-link" href="/dashboard/category/allstoriescat">
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
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <a href="{{ route('index') }}" class="link-overlay"></a>
                  <div class="no-gutters align-items-center">
                    <div class="col mr-2 d-flex justify-content-between">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Blog/Stories</div>
                      <div class="col-auto">
                        <i class="fa fa-blog fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      {{ count(Auth::user()->stories) }}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <a href="{{ route('allstorycats') }}" class="link-overlay"></a>
                  <div class="no-gutters align-items-center">
                    <div class="col mr-2 d-flex justify-content-between">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Categories</div>
                      <div class="col-auto">
                        <i class="fa fa-list-alt fa-2x text-gray-300"></i>
                      </div>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      {{ count(Auth::user()->categories) }}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
          </div>
    </div>
    
@endsection