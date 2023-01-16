@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Print Results')
@section('breadcrumb-main')
<li class="breadcrumb-item">Result Manager</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Print Results</h4>
                        <div class="mt-4">
                            <form action="" method="post">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <div class="mb-4">
                                                <label for="section_id">Section</label>
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
                                                <label for="form_id">Class</label>
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
                                                <label for="session">Session</label>
                                                <select name="session_id" id="session" class="form-control">
                                                    <option value="">Select session</option>
                                                    @foreach ($sessions as $session)
                                                        <option value="{{ $session->id }}">{{ $session->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('session_id'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('session_id') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label for="term">Term</label>
                                                <select name="term_id" id="term_id" class="form-control">
                                                    <option value="">Select term</option>
                                                    @foreach ($terms as $term)
                                                        <option value="{{ $term->id }}">{{ $term->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('term_id'))
                                                    <span class="text-danger text-sm text-small">{{ $errors->first('term_id') }}</span>
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
                                                <button type="submit" class="btn btn-primary w-100">Print</button>
                                            </div>
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

