@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Students')
@section('breadcrumb-main')
<li class="breadcrumb-item">Manage Students</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12" @if (request()->has('form') || request()->has('student')) style="display: none" @endif>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Classes</h4>
                        <div class="mt-4">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary">S/No.</th>
                                            <th class="bg-success">Class</th>
                                            <th>Total Students</th>
                                            <th class="bg-dark">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($forms as $form)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $form->name }}</td>
                                                <td>{{ $form->total_students }}</td>
                                                <td><a href="/staff/students/view/?form={{ $form->id }}" class="btn btn-primary">View Students</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (request()->has('form'))
                <div class="col-xl-12" @if (request()->has('student')) style="display: none" @endif>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Students</h4>
                            <div class="mt-4">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped data-table">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary">S/No.</th>
                                                <th class="bg-info">Admission Number</th>
                                                <th class="bg-success">Full Name</th>
                                                <th class="bg-warning">Gender</th>
                                                <th class="bg-dark">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $stu)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $stu->admission_number }}</td>
                                                    <td>{{ $stu->full_name }}</td>
                                                    <td>{{ $stu->gender }}</td>
                                                    <td><a href="/staff/students/view/?student={{ $stu->id }}" class="btn btn-success">Edit</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (request()->has('student'))
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Student</h4>
                            <div class="mt-4">
                                <form enctype="multipart/form-data" method="post" action="/staff/students/update">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ '/'.$student->passport }}" alt="" class="img-fluid w-50">
                                        </div>
                                    </div>
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
                                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $student->first_name }}">
                                                @if($errors->has('first_name'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('first_name') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="middle_name">Middle Name</label>
                                                <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ $student->middle_name }}">
                                            </div>
                                            <div class="mb-4">
                                                <label for="surname">Surname</label>
                                                <input type="text" name="surname" id="surname" class="form-control" value="{{ $student->surname }}">
                                                @if($errors->has('surname'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('surname') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="dob">Date of birth</label>
                                                <input type="date" name="dob" id="dob" class="form-control" value="{{ $student->dob }}">
                                                @if($errors->has('dob'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('dob') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="">Select gender</option>
                                                    <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                @if($errors->has('gender'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('gender') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="religion">Religion</label>
                                                <select name="religion" id="religion" class="form-control">
                                                    <option value="">Select religion</option>
                                                    <option value="christianity" {{ $student->religion == 'christianity' ? 'selected' : '' }}>Christianity</option>
                                                    <option value="islam" {{ $student->religion == 'islam' ? 'selected' : '' }}>Islam</option>
                                                    <option value="others" {{ $student->religion == 'others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="nationality">Nationality</label>
                                                <input type="text" name="nationality" id="nationality" class="form-control" value="{{ $student->nationality }}">
                                            </div>
                                            <div class="mb-4">
                                                <label for="state">State</label>
                                                <input type="text" name="state" id="state" class="form-control" value="{{ $student->state }}">
                                                @if($errors->has('state'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('state') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="address">Address</label>
                                                <textarea name="address" id="address"  class="form-control" >{{ $student->address }}</textarea>
                                                @if($errors->has('address'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="parent_name">Parent Name</label>
                                                <input type="text" name="parent_name" id="parent_name" class="form-control" value="{{ $student->parent_name }}">
                                                @if($errors->has('parent_name'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('parent_name') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="email">Parent Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ $student->email }}">
                                                @if($errors->has('email'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="phone_number">Parent Phone No.</label>
                                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $student->phone_number }}">
                                                @if($errors->has('phone_number'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('phone_number') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="parent_occupation">Parent Occupation</label>
                                                <input type="text" name="parent_occupation" id="parent_occupation" class="form-control" value="{{ $student->parent_occupation }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="form_joined">Class Joined</label>
                                                <select name="form_joined" id="form_joined" class="form-control">
                                                    <option value="">Select Class</option>
                                                    @foreach ($forms as $form)
                                                        <option value="{{ $form->id }}" {{ $student->form_joined == $form->id ? 'selected' : '' }}>{{ $form->name }}</option>
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
                                                        <option value="{{ $section->id }}" {{ $student->section_id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('section_id'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('section_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="form_id">Current Class</label>
                                                <select name="form_id" id="form_id" class="form-control">
                                                    <option value="{{ $student->form_id }}">{{ $student->form }}</option>
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
                                                        <option value="{{ $arm->id }}" {{ $student->arm_id == $arm->id ? 'selected' : '' }}>{{ $arm->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('arm_id'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('arm_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="admission_number">Admission Number</label>
                                                <input type="text" name="admission_number" id="admission_number" class="form-control" readonly value="{{ $student->admission_number }}">
                                            </div>
                                            @if (session()->has('message'))
                                                <div class="alert alert-success">{{ session('message') }}</div>
                                            @endif
                                            <div class="mb-4">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.data-table').DataTable()

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

