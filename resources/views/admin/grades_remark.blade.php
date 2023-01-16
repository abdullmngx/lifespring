@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Grade Remarks')
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Grade Remark</button>
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
                                        <th class="bg-success">Grade</th>
                                        <th class="bg-danger">Remark</th>
                                        <th class="bg-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grade_remarks as $grade_remark)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $grade_remark->section }}</td>
                                        <td>{{ $grade_remark->form }}</td>
                                        <td>{{ $grade_remark->grade }}</td>
                                        <td>{{ $grade_remark->remark }}</td>
                                        <td><a href="javascript:void" data-id="{{ $grade_remark->id }}" data-grade_id="{{ $grade_remark->grade_id }}" data-remark="{{ $grade_remark->remark }}" data-section_id="{{ $grade_remark->section_id }}" data-form_id="{{ $grade_remark->form_id }}" data-form_name="{{ $grade_remark->form }}" class="btn btn-success up-btn">Update</a> <a href="javascript:void" data-id="{{ $grade_remark->id }}" class="btn btn-danger del-btn">Delete</a></td>
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
                    <h4 class="modal-title">Add grade Remark</h4>
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
                            <label for="grade">Grade</label>
                            <select name="grade_id" id="grade" class="form-control">
                                <option value="">Select Grade</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->grade }} - {{ $grade->section }} - {{ $grade->form }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="remark">Remark</label>
                            <textarea name="remark" id="remark" class="form-control"></textarea>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Add</button>
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
                    <h4 class="modal-title">Update grade remark</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="/staff/grade-remarks/update" method="post" id="update-form">
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
                            <label for="grade_up">Grade</label>
                            <select name="grade_id" id="grade_up" class="form-control">
                                <option value="">Select Grade</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="remark_up">Remark</label>
                            <textarea name="remark" id="remark_up" class="form-control"></textarea>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Update</button>
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
        var grade_id = $(this).data('grade_id');
        var remark = $(this).data('remark');

        $('#grade_id').val(id);
        $('#remark_up').val(remark);

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
        
        var gradeOptions = document.getElementById('grade_up').options;
        for (var i = 0; i < gradeOptions.length; i++) {
            if (gradeOptions[i].value == grade_id) {
                gradeOptions[i].selected = true;
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
                location.href = '/staff/grade-remarks/delete/' + id;
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