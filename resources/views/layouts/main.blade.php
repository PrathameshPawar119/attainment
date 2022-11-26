
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('title')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <style>
    img, svg{
      width: 20px;
      height: 20px;
    }
  </style>
  <body>
    @include('layouts.head')
    <div class="alert-section" style="height: 32px;">
      @yield('alert-section')
    </div>
    <div class="container">
        @yield('main-section')

    </div>
    @include('layouts.foot')

  </body>

</html>