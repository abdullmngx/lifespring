@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Staff')
@section('breadcrumb-main')
<li class="breadcrumb-item">Manage Staff</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
                <div class="col-xl-12" @if (request()->has('staff')) style="display: none" @endif>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Staff</h4>
                            <div class="mt-4">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped data-table">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary">S/No.</th>
                                                <th class="bg-info">Staff ID</th>
                                                <th class="bg-success">Full Name</th>
                                                <th class="bg-warning">Gender</th>
                                                <th class="bg-danger">Phone Number</th>
                                                <th class="bg-dark">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($staffs as $sta)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $sta->staff_id }}</td>
                                                    <td>{{ $sta->name }}</td>
                                                    <td>{{ $sta->gender }}</td>
                                                    <td>{{ $sta->phone_number }}</td>
                                                    <td><a href="/staff/staff/view/?staff={{ $sta->id }}" class="btn btn-success">Edit</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @if (request()->has('staff'))
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Student</h4>
                            <div class="mt-4">
                                <form enctype="multipart/form-data" method="post" action="/staff/staff/update">
                                    @csrf
                                    <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <img src="/storage/{{ $staff->passport }}" alt="" class="img-fluid w-50">
                                        </div>
                                    </div>
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
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $staff->name }}">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger text-small text-sm">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="email">Email Address</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ $staff->email }}">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger text-small text-sm">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="phone_number">Phone Number</label>
                                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $staff->phone_number }}">
                                                @if ($errors->has('phone_number'))
                                                    <span class="text-danger text-small text-sm">{{ $errors->first('phone_number') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="">Select Gender</option>
                                                    <option value="male" {{ $staff->gender == "male" ? "selected" : "" }}>Male</option>
                                                    <option value="female" {{ $staff->gender == "female" ? "selected" : "" }}>Female</option>
                                                </select>
                                                @if ($errors->has('gender'))
                                                    <span class="text-danger text-small text-sm">{{ $errors->first('gender') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="dob">Date of Birth</label>
                                                <input type="date" name="dob" id="dob" class="form-control" value="{{ $staff->dob }}">
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
                                                    <option value="islam" {{ $staff->religion == "islam" ? "selected" : "" }}>Islam</option>
                                                    <option value="christianity" {{ $staff->religion == "christianity" ? "selected" : "" }}>Christianity</option>
                                                    <option value="others" {{ $staff->religion == "others" ? "selected" : "" }}>others</option>
                                                </select>
                                                @if ($errors->has('religion'))
                                                    <span class="text-danger text-small text-sm">{{ $errors->first('religion') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="nationality">Nationality</label>
                                                <input type="text" name="nationality" id="nationality" class="form-control" value="{{ $staff->nationality }}">
                                                @if ($errors->has('nationality'))
                                                    <span class="text-danger text-small text-sm">{{ $errors->first('nationality') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="state">State</label>
                                                <input type="text" name="state" id="state" class="form-control" value="{{ $staff->state }}">
                                                @if ($errors->has('state'))
                                                    <span class="text-danger text-small text-sm">{{ $errors->first('state') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="address">Address</label>
                                                <textarea name="address" id="address" class="form-control">{{ $staff->address }}</textarea>
                                                @if ($errors->has('address'))
                                                    <span class="text-danger text-small text-sm">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="role">Role</label>
                                                <select name="role" id="role" class="form-control">
                                                    <option value="">Select role</option>
                                                    <option value="super_admin" {{ $staff->role == "super_admin" ? "selected" : "" }}>Super Admin</option>
                                                    <option value="subject_teacher" {{ $staff->role == "subject_teacher" ? "selected" : "" }}>Subject Teacher</option>
                                                    <option value="class_teacher" {{ $staff->role == "class_teacher" ? "selected" : "" }}>Class Teacher</option>
                                                </select>
                                                @if ($errors->has('role'))
                                                    <span class="text-danger text-small text-sm">{{ $errors->first('role') }}</span>
                                                @endif
                                            </div>
                                            @if (session()->has('message'))
                                                <div class="alert alert-success">{{ session()->get('message') }}</div>
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

