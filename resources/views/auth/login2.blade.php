<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Planeta Camión</title>
  <!-- plugins:css -->
  {!! Html::style('melody/vendors/iconfonts/font-awesome/css/all.min.css') !!}
  {!! Html::style('melody/vendors/css/vendor.bundle.base.css') !!}
  {!! Html::style('melody/vendors/css/vendor.bundle.addons.css') !!}
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  {!! Html::style('melody/css/style.css') !!}
  <!-- endinject -->
  {!! Html::style('melody/images/favicon.png') !!}
</head>

  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
          <div class="row flex-grow">
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
              <div class="auth-form-transparent text-left p-3">
                <div class="brand-logo">
                  
                  <h1><b class="text-info">Planeta</b> Camión</h1>
                </div>
                <h2>Bienvenid@!</h2>
              
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                    <h5>Correo electrónico:</h5>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="fa fa-user text-info"></i>
                        </span>
                      </div>
                      <input id="email" type="email" class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <h5>Contraseña: </h5>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="fa fa-lock text-info"></i>
                        </span>
                      </div>
                      <input id="password" type="password" class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> 
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror                     
                    </div>
                  </div>


                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        Recuérdame
                      </label>
                    </div>
                  
                  </div>

                  <div class="my-3">
                    <button type="submit" class="btn btn-info w-100 p-3">Inicio de sesión</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 back-half-bg d-flex flex-row">
              <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; <?=date('Y')?> Ecomsoft Desarrollo de Software</p>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    {!! Html::script('melody/vendors/js/vendor.bundle.base.js') !!}
    {!! Html::script('melody/vendors/js/vendor.bundle.addons.js') !!}
    <!-- endinject -->
    <!-- inject:js -->
    {!! Html::script('melody/js/off-canvas.js') !!}
    {!! Html::script('melody/js/hoverable-collapse.js') !!}
    {!! Html::script('melody/js/misc.js') !!}
    {!! Html::script('melody/js/settings.js') !!}
    {!! Html::script('melody/js/todolist.js') !!}
    <!-- endinject -->
  </body>
</html>
