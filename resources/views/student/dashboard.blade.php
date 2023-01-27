@extends('layouts.sapp')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-4 box-col-4">
                <div class="card custom-card">
                  <div class="card-profile"><img class="rounded-circle" src="/storage/{{ auth('student')->user()->passport }}" alt=""></div>
                  <div class="text-center profile-details">
                    <h4><a href="social-app.html" alt="">{{ auth('student')->user()->full_name }}</a></h4>
                    <h6>{{ $student->admission_number }}</h6>
                  </div>
                  <div class="card-footer row">
                    <div class="col-4 col-sm-4">
                      <h6>DOB</h6>
                      <h3 class="counter">{{ $student->dob }}</h3>
                    </div>
                    <div class="col-4 col-sm-4">
                      <h6>Class</h6>
                      <h3>{{ $student->form }}{{ $student->arm }}</h3>
                    </div>
                    <div class="col-4 col-sm-4">
                      <h6>Gender</h6>
                      <h3>{{ $student->gender }}</h3>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-8 box-col-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profile</h4>
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-md-4">  
                                    <div class="mb-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" value="{{ $student->first_name }}" id="first_name" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" value="{{ $student->dob }}" id="dob" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="nationality">Nationality</label>
                                        <input type="text" value="{{ $student->nationality }}" id="nationality" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pname">Parent Name</label>
                                        <input type="text" value="{{ $student->parent_name }}" id="pname" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="poc">Parent Occupation</label>
                                        <input type="text" value="{{ $student->parent_occupation }}" id="poc" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">  
                                    <div class="mb-4">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" value="{{ $student->middle_name }}" id="middle_name" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="gender">Gender</label>
                                        <input type="text" value="{{ $student->gender }}" id="gender" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="state">State</label>
                                        <input type="text" value="{{ $student->state }}" id="state" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pnum">Parent Phone Number</label>
                                        <input type="text" value="{{ $student->phone_number }}" id="pnum" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">  
                                    <div class="mb-4">
                                        <label for="surname">Surname</label>
                                        <input type="text" value="{{ $student->surname }}" id="surname" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="religion">Religion</label>
                                        <input type="text" value="{{ $student->religion }}" id="religion" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="address">Address</label>
                                        <input type="text" value="{{ $student->address }}" id="address" class="form-control" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="email">Parent Email</label>
                                        <input type="text" value="{{ $student->email }}" id="email" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection