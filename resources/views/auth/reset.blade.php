@extends('layouts.auth')
@section('title', 'Forgot Password')
@section('content')
<form class="theme-form login-form" method="post" action="/staff/reset">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <input type="hidden" name="email" value="{{ request()->get('email') }}">
    <div class="text-center">
        <img src="/logo.png" class="img-fluid w-25" alt="Logo">
        <h4>{{ env('APP_NAME') }}</h4>
        <h6>Reset Password</h6>
    </div>
    <div class="form-group">
      <label>New Password</label>
      <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
        <input class="form-control" type="password" name="password" required="">
      </div>
      @if ($errors->has('password'))
          <span class="text-danger text-sm text-small">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
          <input class="form-control" type="password" name="password_confirmation" required="">
        </div>
        @if ($errors->has('password_confirmation'))
            <span class="text-danger text-sm text-small">{{ $errors->first('password_confirmation') }}</span>
          @endif
      </div>
    @if (session()->has('status'))
      <div class="alert alert-success">{{ session()->get('status') }}</div>
    @endif
    <div class="form-group">
      <button class="btn btn-primary btn-block" type="submit">Reset</button>
    </div>
    <div class="form-group">
        <a class="link" href="/staff/login">Back to Login</a>
    </div>
</form>
@endsection