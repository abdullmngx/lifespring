@extends('layouts.app')
@include('partials.datatable')
@section('title', 'Cards')
@section('breadcrumb-main')
    <li class="breadcrumb-item">Admin Section</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cards</h4>
                        <div class="mt-4">
                            <div class="mb-4">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cards-modal">Generate New cards</button>
                                <a href="/staff/cards/clear-used" class="btn btn-danger" onclick="return confirm('this action will delete all used cards! are you sure to proceed?')">Clear used cards</a>
                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#printModal">Print</button>
                            </div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th class="bg-dark">S/N</th>
                                            <th class="bg-secondary">Pin</th>
                                            <th class="bg-success">Serial</th>
                                            <th class="bg-warning">Status</th>
                                            <th class="bg-danger">Batch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cards as $card)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $card->pin }}</td>
                                                <td>{{ $card->serial }}</td>
                                                <td>{{ $card->status }}</td>
                                                <td>{{ $card->batch }}</td>
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

    <div class="modal fade" id="cards-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Generate Cards</h4>
                    <a href="#" data-bs-dismiss="modal" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="no">Number of cards</label>
                            <input type="number" name="no" id="no" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="usage">Maximum Usage</label>
                            <input type="number" name="usage" id="usage" class="form-control">
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Generate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="printModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Generate Cards</h4>
                    <a href="#" data-bs-dismiss="modal" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <form action="/staff/cards/print" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="batch">Batch</label>
                            <input type="text" name="batch" id="batch" class="form-control">
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Print</button>
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
    </script>
@endsection