@extends('layouts.dashposrd')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <form action="{{ route('dashpoard.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashpoard.products.__form')
    </form>
@endsection