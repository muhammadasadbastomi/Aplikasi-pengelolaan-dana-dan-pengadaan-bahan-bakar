@extends('layouts.loginRegister')

@section('content')         
<form method="POST" action="{{ route('register') }}">
@csrf
<div class="text-center">
<img src="{{asset('img/logo.png')}}" width="50" alt="">
<h5>Silahkan Daftarkan Akun Anda</h5>
</div>
<div class="login-form-body">
<div class="form-group">
<label for="">Nama  <i class="ti-user"></i></label>
<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

@error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>
<div class="form-group">
<label for="">Email  <i class="ti-email"></i></label>
<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>
<div class="form-group">
<label for="">Password <i class="ti-lock"></i></label> 
<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>
<div class="form-group">
<label for="">Confirm Password <i class="ti-lock"></i></label> 
<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
</div>
<div class="submit-btn-area">
<button id="form_submit" type="submit">Daftar <i class="ti-arrow-right"></i></button>
</div>
<div class="form-footer text-center mt-5">
<p class="text-muted">Sudah punya akun? <a href="register.html">login</a></p>
</div>
</div>
</form>
@endsection
