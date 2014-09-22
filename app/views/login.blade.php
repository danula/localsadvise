<!DOCTYPE html>
<html lang=en>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
<meta charset=utf-8>
<title>Login | Locals Advise</title>
<!-- Mobile specific metas -->
<meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=1">
<!-- Force IE9 to render in normal mode -->
<!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
<meta name=author content=Danula>
<meta name=description content="">
<meta name=keywords content="">
<meta name=application-name content="Locals Advise">
<!-- Import google fonts - Heading first/ text second -->
<link rel=stylesheet type=text/css href="http://fonts.googleapis.com/css?family=Open+Sans:400,700|Droid+Sans:400,700">
<!--[if lt IE 9]>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
<![endif]-->
<!-- Css files -->
<!-- build:css assets/css/main.min.css -->
<!-- Icons -->
<link href=assets/css/icons.css rel=stylesheet>
<!-- jQueryUI -->
<link href=assets/css/sprflat-theme/jquery.ui.all.css rel=stylesheet>
<!-- Bootstrap stylesheets (included template modifications) -->
<link href=assets/css/bootstrap.css rel=stylesheet>
<!-- Plugins stylesheets (all plugin custom css) -->
<link href=assets/css/plugins.css rel=stylesheet>
<!-- Main stylesheets (template main css file) -->
<link href=assets/css/main.css rel=stylesheet>
<!-- Custom stylesheets ( Put your own changes here ) -->
<link href=assets/css/custom.css rel=stylesheet>
<!-- endbuild -->
<!-- Fav and touch icons -->
<link rel=apple-touch-icon-precomposed sizes=144x144 href=assets/img/ico/apple-touch-icon-144-precomposed.png>
<link rel=apple-touch-icon-precomposed sizes=114x114 href=assets/img/ico/apple-touch-icon-114-precomposed.png>
<link rel=apple-touch-icon-precomposed sizes=72x72 href=assets/img/ico/apple-touch-icon-72-precomposed.png>
<link rel=apple-touch-icon-precomposed href=assets/img/ico/apple-touch-icon-57-precomposed.png>
<link rel=icon href=assets/img/ico/favicon.ico type=image/png>
<!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
<meta name=msapplication-TileColor content=#3399cc>
<body class=login-page>
<!-- Start #login -->
<div id=login class="animated bounceIn"><img id=logo src=assets/img/logo.png alt="Logo">
  <!-- Start .login-wrapper -->
  <div class=login-wrapper>
    <ul id=myTab class="nav nav-tabs nav-justified bn">
      <li><a href=#log-in data-toggle=tab>Login</a></li>
      <li><a href=#register data-toggle=tab>Register</a></li>
    </ul>
    <div id=myTabContent class="tab-content bn">
      @if(Session::get('registerError'))
      <div class="tab-pane fade" id='log-in'>
      @else
      <div class="tab-pane fade active in" id='log-in'>
      @endif
          @if(Session::get('loginError')!==null)
            <div class="alert alert-danger fade in">
            {{Session::get('loginError')}}
            </div>
          @endif
          {{ Form::open(array('url' => '/login', 'class' => 'form-horizontal mt10'))}}
          <div class=form-group>
            <div class=col-lg-12>
              <input name=email id=email type=email class="form-control left-icon" placeholder="Your email">
              <i class="ec-mail s16 left-input-icon"></i></div>
          </div>
          <div class=form-group>
            <div class=col-lg-12>
              <input type=password name=password id=password class="form-control left-icon" placeholder="Your password">
              <i class="ec-locked s16 left-input-icon"></i> <span class=help-block><a href=#><small></small></a></span></div>
          </div>
          <div class=form-group>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
              <!-- col-lg-12 start here -->
              <label class=checkbox>
                <input type=checkbox name=remember id="remember" value="option"></label>
            </div>
            <!-- col-lg-12 end here -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
              <!-- col-lg-12 start here -->
              <button class="btn btn-success pull-right" type=submit>Login</button>
            </div>
            <!-- col-lg-12 end here -->
          </div>
        </form>
      </div>
      @if(Session::get('registerError'))
      <div class="tab-pane fade active in" id='register'>
      @else
      <div class="tab-pane fade" id='register'>
      @endif
          @foreach($errors->all() as $error)
            <div class="alert alert-danger fade in">
            {{ $error }}
            </div>
          @endforeach
          {{ Form::open(array('url' => '/register', 'class' => 'form-horizontal mt20')) }}
          <div class=form-group>
            <div class=col-lg-12>
              <!-- col-lg-12 start here -->
              {{ Form::text('name', null, array('class'=>'form-control left-icon', 'placeholder'=>'Type your name')) }}
              <i class="ec-user s16 left-input-icon"></i></div>
            <!-- col-lg-12 end here -->
          </div>
          <div class=form-group>
            <div class=col-lg-12>
              <!-- col-lg-12 start here -->
              {{ Form::email('email', null, array('class'=>'form-control left-icon', 'placeholder'=>'Type your email')) }}
              <i class="ec-mail s16 left-input-icon"></i></div>
            <!-- col-lg-12 end here -->
          </div>
          <div class=form-group>
            <div class=col-lg-12>
              <!-- col-lg-12 start here -->
              {{ Form::password('password', array('class'=>'form-control left-icon', 'placeholder'=>'Enter your password')) }}
              <i class="ec-locked s16 left-input-icon"></i></div>
            <!-- col-lg-12 end here -->
            <div class="col-lg-12 mt15">
              <!-- col-lg-12 start here -->
              {{ Form::password('password_confirmation', array('class'=>'form-control left-icon', 'placeholder'=>'Repeat password')) }}
              <i class="ec-locked s16 left-input-icon"></i></div>
            <!-- col-lg-12 end here -->
          </div>
          <div class=form-group>
            <div class=col-lg-12>
              <!-- col-lg-12 start here -->
              <button class="btn btn-success btn-block">Register</button>
            </div>
            <!-- col-lg-12 end here -->
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End #.login-wrapper -->
</div>
<!-- End #login -->
<!-- Javascripts -->
<!-- Load pace first -->
<script src=assets/plugins/core/pace/pace.min.js></script>
<!-- Important javascript libs(put in all pages) -->
<script>window.jQuery || document.write('<script src="assets/js/libs/jquery-2.1.1.min.js">\x3C/script>')</script>
<script src=http://code.jquery.com/ui/1.10.4/jquery-ui.js></script>
<script>window.jQuery || document.write('<script src="assets/js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')</script>
<!--[if lt IE 9]>
  <script type="text/javascript" src="assets/js/libs/excanvas.min.js"></script>
  <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <script type="text/javascript" src="assets/js/libs/respond.min.js"></script>
<![endif]-->
<!-- build:js assets/js/pages/login.js -->
<!-- Bootstrap plugins -->
<script src=assets/js/bootstrap/bootstrap.js></script>
<!-- Form plugins -->
<script src=assets/plugins/forms/icheck/jquery.icheck.js></script>
<script src=assets/plugins/forms/validation/jquery.validate.js></script>
<script src=assets/plugins/forms/validation/additional-methods.min.js></script>
<!-- Init plugins olny for this page -->
<script src=assets/js/pages/login.js></script>
<!-- endbuild -->
<!-- Google Analytics:  -->
