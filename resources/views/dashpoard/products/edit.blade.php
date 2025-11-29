@extends('layouts.dashposrd')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <form action="{{ route('dashpoard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashpoard.products.__form', [
            'button_lable' => 'Update'
        ])
        </form>
@endsection