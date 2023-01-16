@extends('layouts.app')
@section('title', 'Add Staff')
@section('breadcrumb-main')
    <li class="breadcrumb-item">Manage Staff</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@yield('title')</h4>
                        <div class="mt-4">
                            <form action="" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="passport">Passport</label>
                                            <input type="file" name="passport" id="passport" class="form-control">
                                            @if ($errors->has('passport'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('passport') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="name">Full Name</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                            @if ($errors->has('name'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="email">Email Address</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                            @if ($errors->has('email'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control">
                                            @if ($errors->has('phone_number'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('phone_number') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            @if ($errors->has('gender'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('gender') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" name="dob" id="dob" class="form-control">
                                            @if ($errors->has('dob'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('dob') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="religion">Religion</label>
                                            <select name="religion" id="religion" class="form-control">
                                                <option value="">Select Religion</option>
                                                <option value="islam">Islam</option>
                                                <option value="christianity">Christianity</option>
                                                <option value="others">others</option>
                                            </select>
                                            @if ($errors->has('religion'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('religion') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="nationality">Nationality</label>
                                            <input type="text" name="nationality" id="nationality" class="form-control">
                                            @if ($errors->has('nationality'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('nationality') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="state">State</label>
                                            <input type="text" name="state" id="state" class="form-control">
                                            @if ($errors->has('state'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('state') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control"></textarea>
                                            @if ($errors->has('address'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="role">Role</label>
                                            <select name="role" id="role" class="form-control">
                                                <option value="">Select role</option>
                                                <option value="super_admin">Super Admin</option>
                                                <option value="subject_teacher">Subject Teacher</option>
                                                <option value="class_teacher">Class Teacher</option>
                                            </select>
                                            @if ($errors->has('role'))
                                                <span class="text-danger text-small text-sm">{{ $errors->first('role') }}</span>
                                            @endif
                                        </div>
                                        @if (session()->has('message'))
                                            <div class="alert alert-success">{{ session()->get('message') }}</div>
                                        @endif
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary">Add Staff</button>
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