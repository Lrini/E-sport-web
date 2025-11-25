<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="min-h-screen bg-[hsl(210,100%,97%)]">
  <!--navbar-->
  @include('partials.navbar')
  <!--navbar-->
    <main class="pt-20">
        @yield('section')
    </main>
   @include('partials.footer')
</body>
</html>
