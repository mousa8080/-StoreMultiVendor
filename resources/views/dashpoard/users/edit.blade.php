@extends('layouts.dashposrd')

@section('title', 'Users')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Users</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <form action="{{ route('dashpoard.users.update', $user->id) }}" method="post">
        @csrf
        @method('put')
        @include('dashpoard.users.__form', [
            'button_lable' => 'Update'
        ])
        </form>
@endsection