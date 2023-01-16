@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Subjects')
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Subject</button>
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
                                        <th class="bg-warning">Subject Name</th>
                                        <th class="bg-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td><a href="javascript:void" data-id="{{ $subject->id }}" data-name="{{ $subject->name }}" class="btn btn-success up-btn">Update</a> <a href="javascript:void" data-id="{{ $subject->id }}" class="btn btn-danger del-btn">Delete</a></td>
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
                    <h4 class="modal-title">Add Subject</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="section-form">
                        @csrf
                        <div class="mb-4">
                            <label for="name">Subject Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Add Subject</button>
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
                    <h4 class="modal-title">Update Subject</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="/staff/subjects/update" method="post" id="update-form">
                        @csrf
                        <input type="hidden" name="id" id="subject_id">
                        <div class="mb-4">
                            <label for="name_up">Subject Name</label>
                            <input type="text" name="name" id="name_up" class="form-control">
                        </div>
                        
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Update Subject</button>
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
        var name = $(this).data('name');

        $('#subject_id').val(id);
        $('#name_up').val(name);
        
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
                location.href = '/staff/subjects/delete/' + id;
            } else {
                swal("Cancelled!");
            }
        })
    })
</script>
@endsection