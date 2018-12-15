<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>VBazurto Content Creator - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">



        <link href="/css/app.css" rel="stylesheet" type="text/css">

    </head>
    <body>


      @include('includes.menu')
      @include('includes.flash-messages')


      <div  class="content">
        @yield('content')
      </div>

      <div id="app" style="display:none">

      </div>



      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="/js/app.js"></script>

      @yield('twitterjs')
    </body>
</html>
