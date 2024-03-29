
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('title')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('head')
  </head>
  <style>
    img, svg{
      width: 20px;
      height: 20px;
    }
    img:hover{
      cursor: pointer;
    }
    .MainContainer{
      align-items: center;
    }
    .upperSection{
      display: grid;
      grid-template-columns: 2fr 3fr;
      grid-template-rows: 1fr;
      grid-gap: 14px;
      margin: 4px auto;
      align-items: center;
    }
    .LowerAttainmentTable table{
        border: 9px transparent;
        background:linear-gradient(to right, rgb(248, 234, 248), rgb(226, 233, 247));
        text-align: center;
        border-radius: 8px;
    }
    .LowerAttainmentTable table tbody tr{
        border-bottom: 1px;
        border-bottom-color: white;
        border-radius: 8px;
    }
    .LowerAttainmentTable table tbody tr td{
        background:linear-gradient(to right, rgb(244, 217, 244), rgb(207, 218, 241));
        border-radius: 8px;
    }
    .highlightTd{
        background: linear-gradient(to right, rgb(255, 248, 255), rgb(245, 241, 248));
        border:2px transparent;
        border-radius: 4px;
    }
  </style>
  <body>
    @include('layouts.head')
    <div class="MainContainer">
        <div class="upperSection container">
            <div class="upperLeft">
              @yield('upperLeft-section')
            </div>
            <div class="upperRight">
              @yield('upperRight-section')
            </div>
        </div>
        <div class="lowerSection container">
          @yield('lower-section')
        </div>
    </div>
    @include('layouts.foot')

  </body>

  <script>
        // Fade out alert component arter 2.5s
    $('#alert-section').delay(2500).fadeOut('slow');
  </script>
</html>