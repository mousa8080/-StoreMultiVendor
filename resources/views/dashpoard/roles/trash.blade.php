@extends('layouts.dashposrd')

@section('title', 'categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">trash</li>
@endsection

@section('content')
    <div class="mb-5">

        <a href="{{ route('dashpoard.categories.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
     <x-alert type="success" message="success"/>
     <x-alert type="info" message="info"/>
     <x-alert type="warning" message="warning"/>
     <x-alert type="danger" message="danger"/>
    </div>
    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4" >
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
                <th>status</th>
                <th>created_at</th>
                <th>deleted_at</th>    
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td><img src="{{ asset('storage/'.$category->image) }}" alt="" width="50" height="50"></td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status}}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->deleted_at }}</td>
                   
                    <td>
                        <form action="{{ route('dashpoard.categories.restore', $category->id) }}" method="post">
                            @csrf
                            <!-- form method spoofing -->
                            @method('put') {{-- === --}} {{-- <input type="hidden" name="_method" value="delete"> --}}
                            <button type="submit" class="btn btn-sm btn-outline-success">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashpoard.categories.forceDelete', $category->id) }}" method="post">
                            @csrf
                            <!-- form method spoofing -->
                            @method('delete') {{-- === --}} {{-- <input type="hidden" name="_method" value="delete"> --}}
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7"> no categories file</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->withQueryString()->links()}}
@endsection