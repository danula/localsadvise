<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    {{HTML::style('assets/css/main.min.css')}}
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    {{HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAQbJyNoD2YlRdFHw-6GAck-z1gegALEo4')}}
    {{HTML::script('app/views/map.js')}}
  </head>
  
  <body>
  <div id="map-canvas"/>

  <script src="assets/plugins/core/pace/pace.min.js"></script>
  <script>window.jQuery || document.write('<script src="assets/js/libs/jquery-2.1.1.min.js">\x3C/script>')</script>
  <script src="assets/js/libs/jquery-2.1.1.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>window.jQuery || document.write('<script src="assets/js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')</script>
  <script src="assets/js/pages/panels.js"></script>

  </body>
</html>