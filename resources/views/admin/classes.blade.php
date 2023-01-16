@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Classes')
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover data-table">
                                <thead>
                                    <tr>
                                        <th class="bg-primary">S/No.</th>
                                        <th class="bg-success">Section</th>
                                        <th class="bg-info">Class Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($forms as $form)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $form->section_name }}</td>
                                        <td>{{ $form->name }}</td>
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
@section('scripts')
    <script>
        $('.data-table').DataTable();
    </script>
@endsection
