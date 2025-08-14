<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMPAN LOBAR | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href="{{ route('login') }}" style="display: block; line-height: 1;">
    <b>LOGIN</b><br>
    <span style="font-size: 22px; font-weight: normal;">SIMPAN LOBAR</span>
  </a>
</div>

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('login-proses') }}" method="post">
        @csrf

        <!-- NIK -->
        <div class="input-group mb-3">
          <input type="text" name="NIK" class="form-control @error('NIK') is-invalid @enderror" placeholder="NIK">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
          @error('NIK')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

       <!-- Password -->
      <div class="input-group mb-3">
        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text" style="cursor: pointer;" onclick="togglePassword()">
            <span id="togglePasswordIcon" class="fas fa-eye"></span>
          </div>
        </div>
        @error('password')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-12 mb-3">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="col-8">
            {{-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> --}}
          </div>
      </form>

      {{-- <p class="mb-0" >
        <a href="{{ route('register') }}" class="text-center">Create New Account</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('togglePasswordIcon');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }
</script>

@if ($message = Session::get('success'))
    <script>
        Swal.fire({
        icon: "success",
        title: "Success",
        text: "Logout Berhasil",
});
    </script>
@endif

@if (Session::get('error'))
  <script>
    Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "Email atau Password Salah",
    });
  </script>
@endif
</body>
</html>
