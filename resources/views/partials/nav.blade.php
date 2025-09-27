@if(\Session::get('loggedInUserRoles') == null)
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>{{ allSettings()['siteTitle'] }} - {{ allSettings()['siteSlogan'] }}</title>
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/admin/favicon/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/admin/favicon/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/admin/favicon/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/admin/favicon/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/admin/favicon/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/admin/favicon/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/admin/favicon/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/admin/favicon/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/admin/favicon/apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/admin/favicon/android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/admin/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/admin/favicon/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/admin/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('/admin/favicon/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('/admin/favicon/ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="/node_modules/simplebar/dist/simplebar.css">
  <link rel="stylesheet" href="{{ asset('/admin/css/vendors/simplebar.css') }}">
  <link href="{{ asset('/admin/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
  <link href="{{ asset('/admin/css/examples.css') }}" rel="stylesheet">
  <link href="{{ asset('/front/css/developer.css') }}" rel="stylesheet">
  <link href="/node_modules/@coreui/chartjs/dist/css/coreui-chartjs.css" rel="stylesheet">
  <div class="alert alert-warning">Your session is logged out!, Please Log-in! <a href="{{ url('/login') }}">Log-in</a>!</div>
    @if(count(explode('/', url()->current())) > 3)
    @php 
     exit;
    @endphp
  @endif
@else

  <header class="header header-sticky mb-4">
  <div class="container-fluid">
    <button class="header-toggler px-md-0 me-md-3" type="button">
      <svg class="icon icon-lg">
        <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-menu"></use>
      </svg>
    </button><a class="header-brand d-md-none" href="#">
      <svg width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#full"></use>
      </svg></a>
    
    <ul class="header-nav ms-auto" style="display:none;">
      <li class="nav-item"><a class="nav-link" href="#">
          <svg class="icon icon-lg">
            <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-bell"></use>
          </svg></a></li>
      <li class="nav-item"><a class="nav-link" href="#">
          <svg class="icon icon-lg">
            <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-list-rich"></use>
          </svg></a></li>
      <li class="nav-item"><a class="nav-link" href="#">
          <svg class="icon icon-lg">
            <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-envelope-open"></use>
          </svg></a></li>
    </ul>
    
    @if(\Session::get('loggedInUserRoles') && in_array('1', \Session::get('loggedInUserRoles')))
    <ul class="header-nav ms-3">
      <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <span>Welcome !</span>
          <div class="avatar avatar-md"><img class="avatar-img" src="front/images/no-photo-male.jpg"></div></a>
        <div class="dropdown-menu dropdown-menu-end pt-0">
          <div class="dropdown-header bg-light py-2">
            <div class="fw-semibold">Account</div>
          </div><a class="dropdown-item" href="{{ url('/edit-users/'.auth()->user()->id) }}">
            <svg class="icon me-2">
              <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-user"></use>
            </svg> Profile</a><a class="dropdown-item" href="{{ url('/change-password') }}">
            <img src="/admin/assets/permissions.png"> Password</a><a class="dropdown-item" href="#">
          <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ url('/logout') }}">
            <svg class="icon me-2">
              <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-account-logout"></use>
            </svg> Logout</a>
        </div>
      </li>
    </ul>
    @endif
  </div>
  <div class="header-divider"></div>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      @include('partials.breadcrumb')
    </nav>
  </div>
  </header>

@endif