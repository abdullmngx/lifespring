@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Grade Settings')
@section('breadcrumb-main')
<li class="breadcrumb-item">Admin Section</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@yield('title')</h4>
                    <div class="mb-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Grade</button>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $err)
                            <div class="alert alert-danger">{{ $err }}</div>
                        @endforeach
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session()->get('message') }}</div>
                    @endif
                    <div class="mb-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover data-table">
                                <thead>
                                    <tr>
                                        <th class="bg-primary">S/No.</th>
                                        <th class="bg-info">Section</th>
                                        <th class="bg-warning">Class</th>
                                        <th class="bg-success">Minimum Score</th>
                                        <th class="bg-danger">Maximum Score</th>
                                        <th class="bg-light">Grade</th>
                                        <th class="bg-primary">Status</th>
                                        <th class="bg-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grades as $grade)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $grade->section }}</td>
                                        <td>{{ $grade->form }}</td>
                                        <td>{{ $grade->min_score }}</td>
                                        <td>{{ $grade->max_score }}</td>
                                        <td>{{ $grade->grade }}</td>
                                        <td>{{ $grade->status }}</td>
                                        <td><a href="javascript:void" data-id="{{ $grade->id }}" data-minscore="{{ $grade->min_score }}" data-maxscore="{{ $grade->max_score }}" data-grade="{{ $grade->grade }}" data-status="{{ $grade->status }}" data-section_id="{{ $grade->section_id }}" data-form_id="{{ $grade->form_id }}" data-form_name="{{ $grade->form }}" class="btn btn-success up-btn">Update</a> <a href="javascript:void" data-id="{{ $grade->id }}" class="btn btn-danger del-btn">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add grade</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="grade-form">
                        @csrf
                        <div class="mb-4">
                            <label for="section">Section</label>
                            <select name="section_id" id="section" class="form-control opt">
                                <option value="">Select Section</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="form">Class</label>
                            <select name="form_id" id="form" class="form-control">
                                <option value="">Select Class</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="min_score">Minimum Score</label>
                            <input type="text" name="min_score" id="min_score" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="max_score">Maximum Score</label>
                            <input type="text" name="max_score" id="max_score" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="grade">Grade </label>
                            <input type="text" name="grade" id="grade" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Select status</option>
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Add grade</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update grade</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="/staff/grades/update" method="post" id="update-form">
                        @csrf
                        <input type="hidden" name="id" id="grade_id">
                        <div class="mb-4">
                            <label for="section_up">Section</label>
                            <select name="section_id" id="section_up" class="form-control opt">
                                <option value="">Select Section</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="form_up">Class</label>
                            <select name="form_id" id="form_up" class="form-control">
                                <option value="">Select Class</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="min_score">Minimum Score</label>
                            <input type="text" name="min_score" id="min_score_up" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="max_score">Maximum Score</label>
                            <input type="text" name="max_score" id="max_score_up" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="grade">Grade </label>
                            <input type="text" name="grade" id="grade_up" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="status">Status</label>
                            <select name="status" id="status_up" class="form-control">
                                <option value="">Select status</option>
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Update grade</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $('.data-table').DataTable()
    $('body').on('click', '.up-btn', function () {
        var modal = new bootstrap.Modal(document.getElementById('upModal'));
        var id = $(this).data('id');
        var section_id = $(this).data('section_id')
        var form_id = $(this).data('form_id')
        var form_name = $(this).data('form_name')
        var min_score = $(this).data('minscore');
        var max_score = $(this).data('maxscore');
        var grade = $(this).data('grade');
        var status = $(this).data('status');

        $('#grade_id').val(id);
        $('#min_score_up').val(min_score);
        $('#max_score_up').val(max_score);
        $('#grade_up').val(grade);

        var sectionOptions = document.getElementById('section_up').options
        for (var x = 0; x < sectionOptions.length; x++)
        {
            if (sectionOptions[x].value == section_id)
            {
                sectionOptions[x].selected = true
            }
        }
        
        if (form_id)
        {
            $('#form_up').html(`<option value="">Select form</option><option value="${form_id}" selected>${form_name}</option>`)
        }

        var statusOptions = document.getElementById('status_up').options;
        for (var i = 0; i < statusOptions.length; i++) {
            if (statusOptions[i].value == status) {
                statusOptions[i].selected = true;
                break;
            }
        }
        modal.show()
    });

    $('body').on('click', '.del-btn', function () {
        var id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Item!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                location.href = '/staff/grades/delete/' + id;
            } else {
                swal("Cancelled!");
            }
        })
    })
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
                $('#form').html(options);
                $('#form_up').html(options)
            }
        })
    })
</script>
@endsection