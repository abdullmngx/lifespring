@extends('layouts.sapp')
@section('title', 'My Result')
@section('content')
    <div class="container-fluid">
        <div class="row">   
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@yield('title')</h4>
                        <div class="mt-4">
                            <form action="" method="post">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="mb-4">
                                                <label for="form_id">Class</label>
                                                <select name="form_id" id="form_id" class="form-control">
                                                    <option value="">Select class</option>
                                                    @foreach ($forms as $form)
                                                        <option value="{{ $form->form_id }}">{{ $form->form }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('form_id'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('form_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="arm">Arm</label>
                                                <select name="arm_id" id="arm" class="form-control">
                                                    <option value="">Select arm</option>
                                                    @foreach ($arms as $arm)
                                                        <option value="{{ $arm->arm_id }}">{{ $arm->arm }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('arm_id'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('arm_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="session">Session</label>
                                                <select name="session_id" id="session" class="form-control">
                                                    <option value="">Select session</option>
                                                    @foreach ($sessions as $session)
                                                        <option value="{{ $session->session_id }}">{{ $session->session }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('session_id'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('session_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="term">Term</label>
                                                <select name="term_id" id="term_id" class="form-control">
                                                    <option value="">Select term</option>
                                                    @foreach ($terms as $term)
                                                        <option value="{{ $term->term_id }}">{{ $term->term }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('term_id'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('term_id') }}</span>
                                                @endif
                                            </div>
                                            @if ($config->value == 'card')
                                            <div class="mb-4">
                                                <label for="pin">Card Pin</label>
                                                <input type="text" name="pin" id="pin" class="form-control">
                                                @if($errors->has('pin'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('pin') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="serial">Card Serial</label>
                                                <input type="text" name="serial" id="serial" class="form-control">
                                                @if($errors->has('serial'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('serial') }}</span>
                                                @endif
                                            </div>
                                            @endif
                                            @if (session()->has('message'))
                                                <div class="alert alert-success">{{ session('message') }}</div>
                                            @endif
                                            <div class="mb-4">
                                                <button type="submit" class="btn btn-primary w-100">Print</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection