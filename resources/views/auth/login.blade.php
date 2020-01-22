@extends('layouts.loginRegister')

@section('content')<form method="POST" action="{{ route('login') }}">
    @csrf
<div class="text-center">
<img src="{{asset('img/logo.png')}}" width="50" alt="">
<h5>Silahkan Login untung menggunakan aplikasi</h5>
</div>
<div class="login-form-body">
<div class="form-group">
<label for="">Email  <i class="ti-email"></i></label>
<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>
<div class="form-group">
<label for="">Password <i class="ti-lock"></i></label> 
<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>
<div class="row mb-4 rmber-area">
<div class="col-6">
<div class="custom-control custom-checkbox mr-sm-2"> <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

<label class="form-check-label" for="remember">
    {{ __('Remember Me') }}
</label>
</div>
</div>
</div>
<div class="submit-btn-area">
<button id="form_submit" type="submit">login <i class="ti-arrow-right"></i></button>
</div>
<div class="form-footer text-center mt-5">
<p class="text-muted">belum punya akun? <a href="register.html">Daftar</a></p>
</div>
</div>
</form>
@endsection
