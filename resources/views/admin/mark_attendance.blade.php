@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Mark Attendance')
@section('breadcrumb-main')
<li class="breadcrumb-item">Attendance</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12" @if (request()->has('form') || request()->has('arm')) style="display: none" @endif>
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
                                        @foreach ($forms as $class)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $class->name }}</td>
                                                <td>{{ $class->total_students }}</td>
                                                <td><a href="/staff/attendance/mark/?form={{ $class->id }}" class="btn btn-primary">View Arms</a></td>
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
                <div class="col-xl-12" @if (request()->has('arm')) style="display: none" @endif>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Arms</h4>
                            <div class="mt-4">
                                <h6>Class: {{ $form->name }}</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped data-table">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary">S/No.</th>
                                                <th class="bg-success w-75">Arm</th>
                                                <th class="bg-dark w-25">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arms as $am)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $am->name }}</td>
                                                    <td><a href="/staff/attendance/mark/?form={{ request()->get('form') }}&arm={{ $am->id }}" class="btn btn-success">View Students</a></td>
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
            @if (request()->has('form') && request()->has('arm'))
                <div class="col-xl-12"  @if (request()->has('subject')) style="display: none" @endif>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Students</h4>
                            <div class="mt-4">
                                <h6>Class: {{ $form->name }} {{ $arm->name }}</h6>
                                <div class="mb-4">
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">{{ session()->get('message') }}</div>
                                    @endif
                                </div>
                                <form method="POST" action="/staff/attendance/mark">
                                    @csrf
                                    <input type="hidden" name="form_id" value="{{ request()->get('form') }}">
                                    <input type="hidden" name="arm_id" value="{{ request()->get('arm') }}">
                                    <div class="mb-4">
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped data-table">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary">S/No.</th>
                                                <th class="w-25 bg-danger">Admission Number</th>
                                                <th class="w-50 bg-success">Student</th>
                                                <th class="w-25 bg-dark">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $student->admission_number }}</td>
                                                    <td>{{ $student->full_name }}</td>
                                                    <td>
                                                        <div class="m-checkbox-inline custom-radio-ml">
                                                            <div class="radio radio-success">
                                                                <input type="hidden" name="student_ids[]" value="{{ $student->id }}">
                                                                <input id="present{{ $student->id }}" type="radio" name="status{{ $student->id }}" value="present" {{ $student->attendance == "present" ? 'checked' : '' }} {{ $student->attendance == "" ? 'checked' : '' }}>
                                                                <label class="mb-0" for="present{{ $student->id }}">Present</label>
                                                            </div>
                                                            <div class="radio radio-danger">
                                                                <input id="absent{{ $student->id }}" type="radio" name="status{{ $student->id }}" value="absent" {{ $student->attendance == "absent" ? 'checked' : '' }}>
                                                                <label class="mb-0" for="absent{{ $student->id }}">Absent</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
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
        
    </script>
@endsection

