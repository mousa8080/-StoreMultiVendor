@extends('layouts.dashposrd')

@section('title', 'Users')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Create User</li>
@endsection

@section('content')
    <form action="{{ route('dashpoard.users.store') }}" method="post">
        @csrf
        @include('dashpoard.users.__form')
    </form>
@endsection