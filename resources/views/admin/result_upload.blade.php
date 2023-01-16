@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Result Upload')
@section('breadcrumb-main')
<li class="breadcrumb-item">Result Manager</li>
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
                                                <td><a href="/staff/result/upload/?form={{ $class->id }}" class="btn btn-primary">View Arms</a></td>
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
                                                    <td><a href="/staff/result/upload/?form={{ request()->get('form') }}&arm={{ $am->id }}" class="btn btn-success">View Subjects</a></td>
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
                            <h4 class="card-title">Class Subjects</h4>
                            <div class="mt-4">
                                <h6>Class: {{ $form->name }} {{ $arm->name }}</h6>

                                <table class="table table-hover table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary">S/No.</th>
                                            <th class="w-75 bg-success">Subject</th>
                                            <th class="w-25 bg-dark">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classSubjects as $sub)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sub->subject }}</td>
                                                <td><a href="/staff/result/upload/?form={{ request()->get('form') }}&arm={{ request()->get('arm') }}&subject={{ $sub->subject_id }}" class="btn btn-primary">Input Scores</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (request()->has('form') && request()->has('arm') && request()->has('subject'))
                <div class="col-xl-12" >
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Input Scores</h4>
                            <div class="mt-4">
                                <h6>Subject: {{ $subject->name }}</h6>

                                <form method="POST">
                                    @csrf
                                    <input type="hidden" name="form_id" value="{{ request()->get('form') }}">
                                    <input type="hidden" name="arm_id" value="{{ request()->get('arm') }}">
                                    <input type="hidden" name="subject_id" value="{{ request()->get('subject') }}">
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">{{ session()->get('message') }}</div>
                                    @endif
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary">S/No.</th>
                                                <th class="bg-success">Adm. No.</th>
                                                <th class="bg-warning">Full Name</th>
                                                <th class="bg-info">1st PT</th>
                                                <th class="bg-danger">2nd PT</th>
                                                <th class="bg-light">MTT</th>
                                                <th class="bg-primary">Exam</th>
                                                <th class="bg-success">Total</th>
                                                <th class="bg-dark">Grade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <input type="hidden" name="student_ids[]" value="{{ $student->id }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $student->admission_number }}</td>
                                                    <td>{{ $student->full_name }}</td>
                                                    <td><input type="number" name="ca1_scores[]" id="{{ $student->id }}" class="form-control" value="{{ $student->result?->ca1_score }}"></td>
                                                    <td><input type="number" name="ca2_scores[]" id="{{ $student->id }}" class="form-control" value="{{ $student->result?->ca2_score }}"></td>
                                                    <td><input type="number" name="ca3_scores[]" id="{{ $student->id }}" class="form-control" value="{{ $student->result?->ca3_score }}"></td>
                                                    <td><input type="number" name="exam_scores[]" id="{{ $student->id }}" class="form-control" value="{{ $student->result?->exam_score }}"></td>
                                                    <td>{{ $student->result?->total_score }}</td>
                                                    <td>{{ $student->result?->grade }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save Scores
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

        $('#chk-all2').click(function () {
            var chk = this
            var chcks = document.getElementsByClassName('chk2')
            for (var i = 0; i< chcks.length; i++)
            {
                chcks[i].checked = chk.checked
            }
        })

        $('#chk-all1').click(function () {
            var chk = this
            var chcks = document.getElementsByClassName('chk1')
            for (var i = 0; i< chcks.length; i++)
            {
                chcks[i].checked = chk.checked
            }
        })
    </script>
@endsection

