@extends('layouts.dashposrd')

@section('title', 'Admins')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admins</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <form action="{{ route('dashpoard.admins.update', $admin->id) }}" method="post">
        @csrf
        @method('put')
        @include('dashpoard.admins.__form', [
            'button_lable' => 'Update'
        ])
        </form>
@endsection