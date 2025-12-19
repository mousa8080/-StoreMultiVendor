@extends('layouts.dashposrd')

@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{$category->name }}</li>
    <li class="breadcrumb-item active">show</li>
@endsection

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>store</th>
                <th>status</th>
                <th>created_at</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="" width="50" height="50"></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}$</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status}}</td>
                    <td>{{ $product->created_at }}</td>


                </tr>
            @empty
                <tr>
                    <td colspan="6"> no categories file</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->withQueryString()->links()}}


@endsection