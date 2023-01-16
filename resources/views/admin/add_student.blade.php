@extends('layouts.app')
@section('title', 'Add Student')
@section('breadcrumb-main')
    <li class="breadcrumb-item">Manage Students</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Add Student
                        </h4>
                        <div class="mt-4">
                            <form action="" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="passport">Passport</label>
                                            <input type="file" name="passport" id="passport" class="form-control">
                                            @if($errors->has('passport'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('passport') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control">
                                            @if($errors->has('first_name'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="middle_name">Middle Name</label>
                                            <input type="text" name="middle_name" id="middle_name" class="form-control">
                                        </div>
                                        <div class="mb-4">
                                            <label for="surname">Surname</label>
                                            <input type="text" name="surname" id="surname" class="form-control">
                                            @if($errors->has('surname'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('surname') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="dob">Date of birth</label>
                                            <input type="date" name="dob" id="dob" class="form-control">
                                            @if($errors->has('dob'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('dob') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="">Select gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            @if($errors->has('gender'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('gender') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="religion">Religion</label>
                                            <select name="religion" id="religion" class="form-control">
                                                <option value="">Select religion</option>
                                                <option value="christianity">Christianity</option>
                                                <option value="islam">Islam</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="nationality">Nationality</label>
                                            <input type="text" name="nationality" id="nationality" class="form-control">
                                        </div>
                                        <div class="mb-4">
                                            <label for="state">State</label>
                                            <input type="text" name="state" id="state" class="form-control">
                                            @if($errors->has('state'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('state') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address"  class="form-control"></textarea>
                                            @if($errors->has('address'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="parent_name">Parent Name</label>
                                            <input type="text" name="parent_name" id="parent_name" class="form-control">
                                            @if($errors->has('parent_name'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('parent_name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="email">Parent Email</label>
                                            <input type="email" name="email" id="email" class="form-control">
                                            @if($errors->has('email'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="phone_number">Parent Phone No.</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control">
                                            @if($errors->has('phone_number'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('phone_number') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="parent_occupation">Parent Occupation</label>
                                            <input type="text" name="parent_occupation" id="parent_occupation" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="form_joined">Class Joined</label>
                                            <select name="form_joined" id="form_joined" class="form-control">
                                                <option value="">Select Class</option>
                                                @foreach ($forms as $form)
                                                    <option value="{{ $form->id }}">{{ $form->name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('form_joined'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('form_joined') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="section_id">Current Section</label>
                                            <select name="section_id" id="section_id" class="form-control opt">
                                                <option value="">Select section</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('section_id'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('section_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="form_id">Current Class</label>
                                            <select name="form_id" id="form_id" class="form-control">
                                                <option value="">Select class</option>
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
                                                    <option value="{{ $arm->id }}">{{ $arm->name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('arm_id'))
                                                <span class="text-danger text-sm text-small">{{ $errors->first('arm_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="admission_number">Admission Number</label>
                                            <input type="text" name="admission_number" id="admission_number" class="form-control">
                                        </div>
                                        @if (session()->has('message'))
                                            <div class="alert alert-success">{{ session('message') }}</div>
                                        @endif
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary">Register Student</button>
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
@section('scripts')
    <script>
        $('.opt').change(function () {
            var section_id = $(this).val();
            $.ajax({
                url: '/api/get-forms/' + section_id,
                type: 'GET',
                success: function (data) {
                    var forms = data;
                    var options = '<option value="">Select class</option>';
                    forms.forEach(form => {
                        options += '<option value="' + form.id + '">' + form.name + '</option>';
                    })
                    $('#form_id').html(options);
                }
            })
        })
    </script>
@endsection