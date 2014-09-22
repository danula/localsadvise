@extends('layout')

@section('head')

{{HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAQbJyNoD2YlRdFHw-6GAck-z1gegALEo4')}}

 <style type="text/css">
      #map-canvas { height: 675px }
    
      .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        padding: 0px 11px 0 13px;
        width: 400px;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
      }

      #pac-input:focus {
        border-color: #4d90fe;
        margin-left: -1px;
        padding-left: 14px;  /* Regular padding-left + 1. */
        width: 401px;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
    </style>

<script type="text/javascript">

function initialize() {
  var myLatlng = new google.maps.LatLng(6.830856, 79.868063);
  var mapOptions = {
    zoom: 14,
    center: myLatlng
  }
  //create new map
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  //create new maps service
  service = new google.maps.places.PlacesService(map);
  //create new marker
  marker = new google.maps.Marker({
      //set the marker position
      position:myLatlng,
      //set a custom icon for the marker
      icon : "{{URL::asset('assets/img/map/red_marker.png')}}",
      //set the marker animation
      animation: google.maps.Animation.DROP,
      //set the map
      map: map,
      //make the marker draggable
      draggable:true,
      //add the mouseover title for the marker
      title: "Add Question"
  });


  var contentString = '<div id="siteNotice">'+'</div>';
      

  infowindow = new google.maps.InfoWindow({
    content: contentString,
    maxwidth:1500
  });

  var markers = [];
  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input')
      );
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));
  
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();
    console.log(places);
    for (var i = 0, marker1; marker1 = markers[i]; i++) {
      marker1.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = map.getBounds();
    for (var i = 0, place; place = places[i]; i++) {
      
      bounds.extend(place.geometry.location);

      if(i==0){
        marker.setPosition(place.geometry.location);
        addplace(place.place_id);
        infowindow.open(map,marker);
        if(places.length==1) return;
        //google.maps.event.trigger(marker,'mouseup');
      }

      // Create a marker for each place.
      var marker2 = new google.maps.Marker({
        map: map,
        icon: "{{URL::asset('assets/img/map/blue_marker.png')}}",
        title: place.name,
        position: place.geometry.location,
        pid: place.place_id
      });

      google.maps.event.addListener(marker2, 'click', function() {
          marker.setPosition(this.position);
          addplace(this.pid);
          infowindow.open(map,marker);
      });
      markers.push(marker2);
    }

    map.fitBounds(bounds);
  });

  google.maps.event.addListener(marker, 'click', function() {
           infowindow.open(map,marker);
  });
  
  google.maps.event.addListener(marker, 'mouseup', function() { 
        //get the current position of the marker
        var pos = marker.getPosition();
        
        //change the search radius with the zoom level
        var r = map.getZoom(); 
        r = (22 - r)*(22 - r)*20;
        var request = {
          location: pos,
          radius: r,
        };
        //send the nearbysearch request to the places library   
        service.nearbySearch(request, callback);
  });



  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
    if(!bounds.contains(marker.getPosition())){
      marker.setPosition(map.getCenter());
      google.maps.event.trigger(marker,'mouseup');  
    }
  });  

}

function addplace(place_id){
  var request = {
    placeId: place_id
  };
  
  service.getDetails(request,function (place, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      //console.log(place);
      currentplace = place;
      marker.setPosition(place.geometry.location);
      map.panTo(place.geometry.location);
      var content = '<h4 id="firstHeading" class="firstHeading">'+'Ask Question'+'</h4>'+
      '<input class="form-control" id="question" name="question" autofocus>'+
      '<h5>about</h5>'+
      '<div class="list-group">'+
      '<a href="#" class="list-group-item active">'+place.name+'</a>'+
      '</div>' +'<button id="button1" class="btn btn-sm btn-primary" onclick="addQuestion()">'+'add'+'</button>';
      infowindow.setContent(content);
    }
  });
}

function addQuestion(){
  var question = document.getElementById('question').value; 
  
  $.post("{{URL::to('question/add')}}",
    { 
      userId :{{Auth::user()->id}},
      placeId :currentplace.place_id, 
      questionText :question,
      locationName :currentplace.name,
      longitude:currentplace.geometry.location.lng(),
      latitude:currentplace.geometry.location.lat(),
      address : currentplace.formatted_address
    },
    function(data,status){ 
      if(status=="success"){
      var content = '<div style="width:150px; height:80px">'+'<h4 id="firstHeading" class="firstHeading">'+'Question added'+'</h4>'+
       '<button class="btn btn-sm btn-success" onclick="infowindow.close();">'+'ok'+'</button>'+'</div>';
      }else{
        var content = '<div style="width:150px">'+'<h4 id="firstHeading" class="firstHeading">'+'Something went wrong!'+'</h4>'+
       '<button class="btn btn-sm btn-danger" onclick="infowindow.close();">'+'ok'+'</button>'+'</div>';
      }
      infowindow.setContent(content);
    });
}

//Handles the information from the API call to Places
function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    addtoInfoWindow(results);
  }
}

//update the infowindow view
function addtoInfoWindow(results){
  var content = '<h4 id="firstHeading" class="firstHeading">'+'Ask Question'+'</h4>'+
    //'<input class="form-control" name="question" autofocus>'+
    '<h5>about</h5>'+
    '<div class="list-group">';
  
  for (var i = 0; i < results.length; i++) {
    if(i==8) break;
    var place = results[i];
    //console.log(place);
    content = content +'<a href="#" onclick="addplace(\''+place.place_id+'\');return false;" class="list-group-item">'+place.name+'</a>';
  }
  content = content + '</div>';
  //'<button class="btn btn-sm btn-primary" onclick="myFunction()">'+'add'+'</button>';
  infowindow.setContent(content);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>


@stop

@section('sidebar-panel')
<h4 class=sidebar-panel-title>Ask Questions</h4>
  <div class=sidebar-panel-content> 
      Click on the location marker to view nearby locations<br><br>
      Drag the marker to any area<br><br>
      Select a location and type your question<br><br>
      You can also use the search box to find a location
</div>
@stop

@section('content')
  <!-- Start #content -->
<div id='content' style="padding:50px 0px 0px">
<!-- Start .content-wrapper -->
<div class=content-wrapper>
  <div class="row">
  <input id="pac-input" class="controls" type="text" placeholder="Search for a location">
  <div id="map-canvas"/>
  </div>
@stop

@section('scripts')
{{HTML::script('http://maps.googleapis.com/maps/api/js?libraries=places')}}
{{HTML::script('assets/js/libs/jquery-2.1.1.min.js')}}
{{HTML::script('http://code.jquery.com/ui/1.10.4/jquery-ui.js')}}
@stop