<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>VBazurto Content Creator - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">


        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

        <!-- <link href="/css/app.css" rel="stylesheet" type="text/css">
        <script src="/js/app.js"></script> -->

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">


    </head>
    <body>


      @include('includes.menu')
      <br>
      @include('includes.flash-messages')
      <br>

      <div  class="content">
        @yield('content')
      </div>

      <div id="app" style="display:none">

      </div>



      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="{{ mix('js/app.js') }}"></script>

      @yield('twitterjs')
    </body>
</html>
