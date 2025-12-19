@extends('layouts.dashposrd')

@section('title', 'roles')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">roles</li>
    <li class="breadcrumb-item active">edit roles</li>
@endsection

@section('content')
    <form action="{{ route('dashpoard.roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('dashpoard.roles.__form', [
            'button_lable' => 'update'
        ])
        </form>
@endsection