@extends('layout')

@section('head')
{{HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAQbJyNoD2YlRdFHw-6GAck-z1gegALEo4')}}

<style type="text/css">
      #map-canvas { height: 675px; width: 100% }
</style>

<script type="text/javascript">

function initialize() {
        contentString = '';
        infowindows = [];
        lastOpenInfowindow = new google.maps.InfoWindow();
        @foreach($locations as $loc)
    
        var lat = {{ $loc->latitude }};
        var lon = {{ $loc->longitude }};
        var location = new google.maps.LatLng(lat,lon);
        
        @if($loc->locationId===1)
        var mapOptions = {
          center: location,
          zoom: 12
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
        //var bounds = map.getBounds();
        @endif


        //bounds.extend(location);

        var marker = new google.maps.Marker({
            position: location,        
            icon : "{{URL::asset('assets/img/map/red_marker.png')}}",
            animation: google.maps.Animation.DROP,
            map: map,
            title:"{{$loc->locationName}}"
          });
        contentString = '<div style="line-height:1.35;overflow:hidden!important;white-space:nowrap;">'+'<h4>'+"{{$loc->locationName}}"+'</h4>';

        //loop for each question
        @foreach($questions[$loc->locationId] as $q)
        
        questionText = '{{$q->questionText}}';  
        qUserId = {{$q->userId}};        
          
        contentString = contentString +
          '<div class="panel panel-default toggle panelRefresh panelClose showControls" style="width:500px" id="p{{$q->questionId}}">'+
            '<div class="panel-heading">'+
              '<h4 class="panel-title">'+questionText+'</h4>'+
            '</div>'+
            '<div class="panel-body gray-bg">';
                          

        //loop for each answer
        @foreach($answers[$loc->locationId][$q->questionId] as $ans)
            contentString = contentString + 
              '<div class="panel panel-info plain toggle panelRefresh panelClose showControls mb0" id="p{{$ans->answerId}}">'+
                '<div class="panel-heading">'+
                  '<h4 class="panel-title">'+"Answered by {{User::where('id','=',$ans->userId)->first()->name}}"+'</h4>'+
                '</div>'+
                '<div class="panel-body teal-bg">'+"{{$ans->answerText}}"+'</div>'+
              '</div>'+'<p></p>';

        //end of loop for each answer
        @endforeach

        contentString = contentString + '<div>'+
          '<input class="form-control" style="width:88%;float:left;" id="question{{$q->questionId}}" name="question" placeholder="Type your answer" autofocus>'+
          '<button id="button{{$q->questionId}}" class="btn btn-sm btn-primary" style="float:right;"  onclick="addAnswer('+{{$loc->locationId}}+','+{{$q->questionId}}+')">'+'add'+'</button>'+'</div>';
        contentString = contentString +'</div>'+'</div>';  

        //end of loop for each question
        @endforeach          
        
        contentString = contentString +'</div>';

        openInfoWindow(map,marker,contentString,'{{$loc->locationId}}');
        
        @if($loc->locationId==$defaultLocation)
        map.panTo(location);
        google.maps.event.trigger(marker,'click');

        @endif

        //end of loop for each location
        @endforeach
        //map.fitBounds(bounds);
}
 
function openInfoWindow(map,marker,content,locationId){
        var infowindow = new google.maps.InfoWindow({
            content: content,
              maxwidth:600
        });
        infowindows[locationId] = infowindow;
        google.maps.event.addListener(marker, 'click', function() {
           lastOpenInfowindow.close();
           lastOpenInfowindow = infowindows[locationId];
           infowindow.open(map,marker);
        });

}
     
function addAnswer(locationId,questionId){
   var answerText = document.getElementById('question'+questionId).value; 
   console.log(answerText,locationId,questionId);
   $.post("{{URL::to('answer/add')}}",
    { 
      userId :{{Auth::user()->id}},
      locationId : locationId,
      questionId : questionId,  
      answerText :answerText,
    },
    function(data,status){ 
      if(status=="success"){
      var content = '<div style="width:150px; height:80px">'+'<h4 id="firstHeading" class="firstHeading">'+'Answer added'+'</h4>'+
       '<button class="btn btn-sm btn-success" onclick="infowindows['+locationId+'].close();">'+'ok'+'</button>'+'</div>';
      }else{
        var content = '<div style="width:150px">'+'<h4 id="firstHeading" class="firstHeading">'+'Something went wrong!'+'</h4>'+
       '<button class="btn btn-sm btn-danger" onclick="infowindow.close();">'+'ok'+'</button>'+'</div>';
      }
      infowindows[locationId].setContent(content);
   });

}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
@stop

@section('sidebar-panel')
<h4 class=sidebar-panel-title>Answer the Questions</h4>
  <div class=sidebar-panel-content> 
      Click on the location markers to view the questions
      <br><br>
      Type your answer and click the add button
</div>
@stop

@section('content')
<!-- Start #content -->
<div id='content' style="padding:50px 0px 0px">
<!-- Start .content-wrapper -->
<div class=content-wrapper>
  <div id="map-canvas"/>

@stop

@section('scripts')
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places"></script>
{{HTML::script('assets/js/libs/jquery-2.1.1.min.js')}}
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
@stop