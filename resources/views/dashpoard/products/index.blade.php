@extends('layouts.dashposrd')

@section('title', 'products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection

@section('content')
    <div class="mb-5">

        <a href="{{ route('dashpoard.products.create') }}" class="btn btn-sm btn-outline-primary">Create Product</a>
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
                <th>category</th>
                <th>store</th>
                <th>price</th>
                <th>status</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="" width="50" height="50"></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A'}}</td>
                    <td>{{ $product->store->name ?? 'N/A'}}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                        <a href="{{ route('dashpoard.products.edit', $product->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashpoard.products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8"> no products found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->withQueryString()->links()}}
@endsection