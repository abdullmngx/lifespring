@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Sections')
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Section</button>
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
                                        <th class="bg-info">Section Name</th>
                                        <th class="bg-warning">Abbreviation</th>
                                        <th class="bg-success">Classes Name</th>
                                        <th class="bg-danger">Total Classes</th>
                                        <th class="bg-light">Order</th>
                                        <th class="bg-dark">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $section->name }}</td>
                                        <td>{{ $section->code }}</td>
                                        <td>{{ $section->forms_name }}</td>
                                        <td>{{ $section->total_forms }}</td>
                                        <td>{{ $section->order }}</td>
                                        <td><a href="javascript:void" data-id="{{ $section->id }}" data-name="{{ $section->name }}" data-code="{{ $section->code }}" data-fname="{{ $section->forms_name }}" data-ttf="{{ $section->total_forms }}" data-order="{{ $section->order }}" class="btn btn-success up-btn">Update</a> <a href="javascript:void" data-id="{{ $section->id }}" class="btn btn-danger del-btn">Delete</a></td>
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
                    <h4 class="modal-title">Add Section</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="section-form">
                        @csrf
                        <div class="mb-4">
                            <label for="name">Section Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="code">Abbreviation</label>
                            <input type="text" name="code" id="code" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="forms_name">Classes Name</label>
                            <input type="text" name="forms_name" id="forms_name" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="total_forms">Total Classes</label>
                            <input type="number" name="total_forms" id="total_forms" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="order">Order</label>
                            <select name="order" id="order" class="form-control">
                                <option value="">Select order</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Add Section</button>
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
                    <h4 class="modal-title">Update Section</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="/staff/sections/update" method="post" id="update-form">
                        @csrf
                        <input type="hidden" name="id" id="section_id">
                        <div class="mb-4">
                            <label for="name_up">Section Name</label>
                            <input type="text" name="name" id="name_up" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="code_up">Abbreviation</label>
                            <input type="text" name="code" id="code_up" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="forms_name_up">Classes Name</label>
                            <input type="text" name="forms_name" id="forms_name_up" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="total_forms_up">Total Classes</label>
                            <input type="number" name="total_forms" id="total_forms_up" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="order_up">Order</label>
                            <select name="order" id="order_up" class="form-control">
                                <option value="">Select order</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Update Section</button>
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
        var code = $(this).data('code');
        var fname = $(this).data('fname');
        var ttf = $(this).data('ttf');
        var order = $(this).data('order');

        $('#section_id').val(id);
        $('#name_up').val(name);
        $('#code_up').val(code);
        $('#forms_name_up').val(fname);
        $('#total_forms_up').val(ttf);
        
        var orderOptions = document.getElementById('order_up').options;
        for (var i = 0; i < orderOptions.length; i++) {
            if (orderOptions[i].value == order) {
                orderOptions[i].selected = true;
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
                location.href = '/staff/sections/delete/' + id;
            } else {
                swal("Cancelled!");
            }
        })
    })
</script>
@endsection