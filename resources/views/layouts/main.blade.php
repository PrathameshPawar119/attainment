
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('title')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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

    /* alert */
    @keyframes displayNone{
      from{
        opacity: 1;
      }
      to{
        opacity: 0;
      }
    }
    .hideAlert{
      animation:displayNone 1s ease;
      display: block !important;
    }
    /* .PageLinks{
      text-decoration: none;
      font-weight: bold;
      color: rgb(81, 26, 133);
      margin: 10px
    } */
  </style>
  <body>
    @include('layouts.head')
    <div class="alert-section"  style="height: 32px;">
      <div class="alert-component" id="alert-section">
        @yield('alert-section')
      </div>
    </div>
    <div>
        @yield('main-section')
    </div>
    @include('layouts.foot')

  </body>
  <script>
    
    // Function to avoid multiple ajax triggering due to arrow keydowns 
    function debounce(func, wait, immediate) {
      var timeout;
      return function() {
          var context = this, args = arguments;
          var later = function() {
              timeout = null;
              if (!immediate) func.apply(context, args);
          };
          var callNow = immediate && !timeout;
          clearTimeout(timeout);
          timeout = setTimeout(later, wait);
          if (callNow) func.apply(context, args);
      };  
    };

    // Fade out alert component arter 2.5s
    $('#alert-section').delay(3000).fadeOut('slow');

  </script>
</html>