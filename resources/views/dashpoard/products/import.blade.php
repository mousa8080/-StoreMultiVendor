@extends('layouts.dashposrd')

@section('title', 'Import Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">Import</li>
@endsection

@section('content')
    <form action="{{ route('dashpoard.products.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <x-form.input label="Products Count" class="form-control-lg" role="input" name="count" type="number"/>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
@endsection