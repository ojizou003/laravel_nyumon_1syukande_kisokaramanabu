<html>

<head>
  <title>家計簿</title>
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="original.css">
</head>

<body>
  <div class="container">
    @yield('content')
  </div>

  <script src="{{asset('js/app.js')}}"></script>
</body>

</html>