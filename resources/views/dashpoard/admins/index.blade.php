@extends('layouts.dashposrd')

@section('title', 'Admins')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admins</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('dashpoard.admins.create') }}" class="btn btn-sm btn-outline-primary">Create Admin</a>
        <x-alert type="success" message="success" />
        <x-alert type="info" message="info" />
        <x-alert type="warning" message="warning" />
        <x-alert type="danger" message="danger" />
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @foreach ($admin->roles as $role)
                            <span class="badge bg-primary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('dashpoard.admins.edit', $admin->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashpoard.admins.destroy', $admin->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No admins found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection