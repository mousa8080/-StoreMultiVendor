@extends('layouts.dashposrd')

@section('title', 'Admins')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Create Admin</li>
@endsection

@section('content')
    <form action="{{ route('dashpoard.admins.store') }}" method="post">
        @csrf
        @include('dashpoard.admins.__form')
    </form>
@endsection