<!DOCTYPE html>

<html lang="en">

<head>
@include('partials.head')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

  @include('partials.topbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('partials.sidebar')
    <div class="content-wrapper">
    <div class="container-fluid">
    @yield('content')
    </div>
    </div>
    @include('partials.footer')
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  @include('partials.javascript')
</body>

</html>