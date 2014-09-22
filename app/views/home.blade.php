@extends('layout')

@section('head')
<script type="text/javascript">

</script>

@stop

@section('content')
<!-- Start #content -->
<div id='content'>
<!-- Start .content-wrapper -->
<div class=content-wrapper>
	<div class="row">
		<div class="col-lg-12 heading">
		<h1 class="page-header">Hello {{Auth::user()->name}}</h1>
		</div>
	</div>
	<div class="outlet">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="tile blue">
                <div class=tile-icon><i class="fa-question s64"></i></div>
                  	<div class=tile-content>
                    <div class=number>{{Question::where('userId','=',Auth::user()->id)->count();}}</div>
                    <h3>Questions</h3>
                </div>
            </div>
        	</div>
        	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile green">
                <div class=tile-icon><i class="fa-comment s64"></i></div>
                  	<div class=tile-content>
                    <div class=number>{{Answer::where('userId','=',Auth::user()->id)->count();}}</div>
                    <h3>Answers</h3>
                </div>
            </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile red">
                <div class=tile-icon><i class="fa-map-marker s64"></i></div>
                  	<div class=tile-content>
                    <div class=number>{{sizeof($locations)}}</div>
                    <h3>Locations</h3>
                </div>
            </div>
            </div>
		</div>
		<!-- End .row -->
		<div class="row">
		<!-- Start .row -->
		<div class="col-lg-6 col-md-6">
          <!-- col-lg-6 start here -->
          <div class="panel panel-default plain">
            <!-- Start .panel -->
            <div class="panel-heading white-bg">
              <h4 class=panel-title>My Questions</h4>
            </div>
            <div class=panel-body>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class=per60>Question
                    <th class=per30>Location 
                    <th class=per10>Answered 
                <tbody>
                @foreach($questions as $q)
                  <tr onclick="document.location = '{{URL::to('map/'.$q->locationId)}}';">
                    <td>{{$q->questionText}}
                    <td>{{Location::where('locationId','=',$q->locationId)->first()->locationName}}
                    <td>
                    @if(Answer::where('questionId','=',$q->questionId)->count()>0)
                    Yes
                    @else
                    No
                    @endif
                @endforeach
              </table>
            </div>
          </div>
          <!-- End .panel -->
        </div>
        <!-- col-lg-6 end here -->     	
      </div>
      <!-- End .row -->

	</div>

@stop