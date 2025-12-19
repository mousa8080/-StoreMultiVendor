@extends('layouts.dashposrd')

@section('title', 'roles')

@section('breadcrumb')
    @parent
    <li id="breadcrumb-create-role" class="breadcrumb-item active">create roles</li>
@endsection

@section('content')
    <form action="{{ route('dashpoard.roles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashpoard.roles.__form')
    </form>
@endsection