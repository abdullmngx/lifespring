@extends('layouts.app')
@section('title', 'Configurations')
@section('breadcrumb-main')
    <li class="breadcrumb-item">Admin Section</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Configurations
                        </h4>
                        <div class="mt-4">
                            <div class="mb-4">
                                @if(session()->has('message'))
                                    <div class="alert alert-success">{{ session()->get('message') }}</div>
                                @endif
                            </div>
                            <form method="post">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary">
                                                    Config Name
                                                </th>
                                                <th class="bg-dark">
                                                    Value
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($configs as $config)
                                                <tr>
                                                    <td>
                                                        {{ $config->title }}
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="names[]" value="{{ $config->name }}">
                                                        @switch($config->field_type)
                                                            @case('select')
                                                                <select name="values[]" class="form-control">
                                                                    @foreach ($config->data as $data)
                                                                        <option value="{{ $data['id'] }}" {{ $config['value'] == $data['id'] ? 'selected' : '' }}>{{ $data['name'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @break
                                                        
                                                            @default
                                                                
                                                        @endswitch
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Save Configuration</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection