@extends('layouts.app')
@include('partials.datatable')
@section('title', 'View Attendance')
@section('breadcrumb-main')
<li class="breadcrumb-item">Attendance</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12" @if(request()->has('form') && request()->has('arm')) style="display: none"  @endif>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">View Attendance</h4>
                        <div class="mt-4">
                            <form action="" method="get">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="mb-4">
                                                <label for="form_id">Class</label>
                                                <select name="form" id="form_id" class="form-control">
                                                    <option value="">Select class</option>
                                                    @foreach($forms as $form)
                                                        <option value="{{ $form->id }}">{{ $form->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="arm">Arm</label>
                                                <select name="arm" id="arm" class="form-control">
                                                    <option value="">Select arm</option>
                                                    @foreach ($arms as $arm)
                                                        <option value="{{ $arm->id }}">{{ $arm->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="session">Session</label>
                                                <select name="session" id="session" class="form-control">
                                                    <option value="">Select session</option>
                                                    @foreach ($sessions as $session)
                                                        <option value="{{ $session->id }}">{{ $session->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="term">Term</label>
                                                <select name="term" id="term_id" class="form-control">
                                                    <option value="">Select term</option>
                                                    @foreach ($terms as $term)
                                                        <option value="{{ $term->id }}">{{ $term->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <button type="submit" class="btn btn-primary w-100">Proceed</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (request()->has('form') && request()->has('arm'))
            <div class="col-xl-12">
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
                                            <th class="bg-light">Presence</th>
                                            <th class="bg-dark">Absence</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $stu)
                                            @php 
                                                $attendance = $stu->attendances ?? [];
                                                $present = [];
                                                $absent = [];
                                                foreach ($attendance as $att)
                                                {
                                                    if ($att->status == 'present')
                                                    {
                                                        $present[] = $att;
                                                    }
                                                    else {
                                                        $absent[] = $att;
                                                    }
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $stu->admission_number }}</td>
                                                <td>{{ $stu->full_name }}</td>
                                                <td>{{ $stu->gender }}</td>
                                                <td>{{ count($present) }}</td>
                                                <td>{{ count($absent) }}</td>
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

