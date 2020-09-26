<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href={{ url('/css/bootstrap.min.css') }}>
  <link rel="stylesheet" href={{ url('/css/userdata.css') }}>
  <script src={{ url('/js/jquery-3.5.1.min.js') }}></script>
  <script src={{ url('/js/bootstrap.min.js') }}></script>
  
</head>
<body>

<div class="container">
    @yield('content')
</div>
</body>
</html>