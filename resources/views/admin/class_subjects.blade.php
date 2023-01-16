@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Class Subjects')
@section('breadcrumb-main')
<li class="breadcrumb-item">Admin Section</li>
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
                                                <td><a href="/staff/class-subjects/?form={{ $class->id }}" class="btn btn-primary">View Arms</a></td>
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
                                                <th class="bg-success">Arm</th>
                                                <th class="bg-dark">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arms as $am)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $am->name }}</td>
                                                    <td><a href="/staff/class-subjects/?form={{ request()->get('form') }}&arm={{ $am->id }}" class="btn btn-success">View Subjects</a></td>
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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Class Subjects</h4>
                            <div class="mt-4">
                                <h6>Class: {{ $form->name }} {{ $arm->name }}</h6>

                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary w-50"><input type="checkbox" id="chk-all1" class="form-check-input"> <label for="chk-all1" class="form-check-label">Class Subjects</label></th>
                                            <th class="bg-success w-50"><input type="checkbox" id="chk-all2" class="form-check-input"> <label for="chk-all2" class="form-check-label">General Subjects</label></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <form action="/staff/class-subjects/remove" method="post">
                                                    @csrf
                                                    @foreach ($classSubjects as $subject)
                                                        <div class="mb-4 form-check">
                                                            <input type="checkbox" name="subjects[]" id="{{ $subject->subject }}{{ $subject->id }}" class="form-check-input chk1" value="{{ $subject->id }}">
                                                            <label for="{{ $subject->subject }}{{ $subject->id }}" class="form-check-label">
                                                                {{ $subject->subject }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    @if (session()->has('deleted'))
                                                        <div class="alert alert-danger">{{ session()->get('deleted') }}</div>
                                                    @endif
                                                    <button type="submit" class="btn btn-danger">Remove from class</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="" method="post">
                                                    @csrf
                                                    <input type="hidden" name="form_id" value="{{ request()->get('form') }}">
                                                    <input type="hidden" name="arm_id" value={{ request()->get('arm') }}>
                                                    @foreach ($subjects as $subject)
                                                        <div class="mb-4 form-check">
                                                            <input type="checkbox" name="subjects[]" id="{{ $subject->name }}{{ $subject->id }}" class="form-check-input chk2" value="{{ $subject->id }}">
                                                            <label for="{{ $subject->name }}{{ $subject->id }}" class="form-check-label">
                                                                {{ $subject->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    @if (session()->has('message'))
                                                        <div class="alert alert-success">
                                                            {{ session()->get('message') }}
                                                        </div>
                                                    @endif
                                                    @if ($errors->any())
                                                        @foreach ($errors->all() as $err)
                                                            <div class="alert alert-danger">{{ $err }}</div>
                                                        @endforeach
                                                    @endif
                                                    <button type="submit" class="btn btn-primary">Add to Class</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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

