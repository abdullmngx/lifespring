@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<form class="theme-form login-form" method="POST">
    @csrf
    <div class="text-center">
        <img src="/logo.png" class="img-fluid w-25" alt="Logo">
        <h4>{{ env('APP_NAME') }}</h4>
        <h6>Log in to your account.</h6>
    </div>
    <div class="form-group">
      <label>Username</label>
      <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
        <input class="form-control" type="text" name="username" required="" placeholder="Username">
      </div>
      @if ($errors->has('username'))
        <span class="text-danger text-small text-sm">{{ $errors->first('username') }}</span>
      @endif
    </div>
    <div class="form-group">
      <label>Password</label>
      <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
        <input class="form-control" type="password" name="password" required="" placeholder="*********">
        <div class="show-hide"><span class="show">                         </span></div>
      </div>
      @if ($errors->has('password'))
        <span class="text-danger text-small text-sm">{{ $errors->first('password') }}</span>
      @endif
    </div>
    <div class="form-group">
      <div class="checkbox">
        <input id="checkbox1" type="checkbox" name="remember">
        <label for="checkbox1">Keep me Logged in</label>
      </div><a class="link" href="/staff/forgot">Forgot password?</a>
    </div>
    @if (session()->has('status'))
      <div class="alert alert-success">{{ session()->get('status') }}</div>
    @endif
    <div class="form-group">
      <button class="btn btn-primary btn-block" type="submit">Sign in</button>
    </div>
</form>
@endsection