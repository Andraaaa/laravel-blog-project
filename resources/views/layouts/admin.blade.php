<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Andrej Kozlina">

    <title>Fudbalske vesti iz liga petice</title>
    @section('AppendCSS')
    <!-- Bootstrap core CSS -->
    <link href="{{asset ('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    @show
    </head>

  <body>
      @include('components.nav')


<div class="container">

      <div class="row" style="margin-top:80px;">
      @yield('content')
      @include('components.sidebar')
      </div>
    </div>
      @include('components.footer')
  </body>
  @section('appendJavascript')
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @show
</html>
