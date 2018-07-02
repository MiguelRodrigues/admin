<!doctype html>
<html lang="{{ app()->getLocale() }}" class="fontawesome-i2svg-active fontawesome-i2svg-complete">
<script type="text/javascript">window["_gaUserPrefs"] = { ioo : function() { return true; } }</script>

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Laravel</title>

      
      <!-- LANDING PAGE -->

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
 




      <!-- ADMIN  -->

      <!-- Bootstrap CSS CDN -->
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->


      <!-- Our Custom CSS -->
      <link rel="stylesheet" href="css/app.css">

      <!-- Our Custom CSS -->
      <link rel="stylesheet" href="css/custom.css">

      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

      <!-- Font Awesome JS -->
      <script defer="" src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>

      <script defer="" src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>



        
    </head>
    <body>
       <div id="app">
       <main-app></main-app>
       </div>
       



       <script src="{{ asset('js/app.js')}}"></script>





       <!-- jQuery CDN - Slim version (=without AJAX) -->
      <script src="js/jquery-3.3.1.slim.min.js"></script>
    
      <!-- Popper.JS -->
      <script src="js/popper.min.js"></script>
    
      <!-- Bootstrap JS -->
      <!-- <script src="js/bootstrap.min.js" crossorigin="anonymous"></script> -->


      <!-- jQuery Custom Scroller CDN -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

      <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
      </script>





    </body>
</html>