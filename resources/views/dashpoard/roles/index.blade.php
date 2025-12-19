@extends('layouts.dashposrd')

@section('title', 'roles')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">roles</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashpoard.roles.create') }}" class="btn btn-sm btn-outline-primary">create roles</a>
        <x-alert type="success" message="success" />
        <x-alert type="info" message="info" />
        <x-alert type="warning" message="warning" />
        <x-alert type="danger" message="danger" />
    </div>

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>id</th>
                <th>name</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>delete</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td>{{ $role->updated_at }}</td>
                    <td>
                        @can('update.roles', $role)
                            <a href="{{ route('dashpoard.roles.edit', $role->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                        @endcan
                    </td>
                    <td>
                        @can('delete.roles', $role)
                            <form action="{{ route('dashpoard.roles.destroy', $role->id) }}" method="post">
                                @csrf
                                <!-- form method spoofing -->

                                @method('delete') {{-- === --}} {{-- <input type="hidden" name="_method" value="delete"> --}}
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"> no roles file</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $roles->withQueryString()->links()}}
@endsection