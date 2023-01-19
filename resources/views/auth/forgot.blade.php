@extends('layouts.auth')
@section('title', 'Forgot Password')
@section('content')
<form class="theme-form login-form" method="post" action="/staff/forgot">
  @csrf
    <div class="text-center">
        <img src="/logo.png" class="img-fluid w-25" alt="Logo">
        <h4>{{ env('APP_NAME') }}</h4>
        <h6>Recover Password</h6>
    </div>
    <p>
        Enter your email address and we will send you steps on how to recover your password.
    </p>
    <div class="form-group">
      <label>Email Address</label>
      <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
        <input class="form-control" type="email" name="email" required="" placeholder="john-doe@exp.com">
      </div>
      @if ($errors->has('email'))
          <span class="text-danger text-sm text-small">{{ $errors->first('email') }}</span>
        @endif
    </div>
    @if (session()->has('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="form-group">
      <button class="btn btn-primary btn-block" type="submit">Recover</button>
    </div>
    <div class="form-group">
        <a class="link" href="/staff/login">Back to Login</a>
    </div>
</form>
@endsection