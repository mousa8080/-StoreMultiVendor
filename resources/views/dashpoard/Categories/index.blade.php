@extends('layouts.dashposrd')

@section('title', 'categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>
@endsection

@section('content')
    <div class="mb-5">

        <a href="{{ route('dashpoard.categories.create') }}" class="btn btn-sm btn-outline-primary">Create_CAtegories</a>
        <a href="{{ route('dashpoard.categories.trashed') }}" class="btn btn-sm btn-outline-dark">Trash</a>
        <x-alert type="success" message="success" />
        <x-alert type="info" message="info" />
        <x-alert type="warning" message="warning" />
        <x-alert type="danger" message="danger" />
    </div>
    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" aria-placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" class="form-control mx-2" :value="request('status')">
            <option value="">Select Status</option>
            <option value="Active @selected(request('status') == 'Active')">Active</option>
            <option value="Archived @selected(request('status') == 'Archived')">Archived</option>
        </select>
        <button type="submit" class="btn btn-sm btn-outline-primary">Search</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>id</th>
                <th>name</th>
                <th>parent_name</th>
                <th>products_count</th>
                <th>status</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="" width="50" height="50"></td>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ route('dashpoard.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->parent_name}}</td>
                    <td>{{ $category->products_number}}</td>
                    <td>{{ $category->status}}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashpoard.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashpoard.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            <!-- form method spoofing -->

                            @method('delete') {{-- === --}} {{-- <input type="hidden" name="_method" value="delete"> --}}
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8"> no categories file</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->withQueryString()->links()}}
@endsection