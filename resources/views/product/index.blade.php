@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Product</h1>
        </div>

        <a href="{{route('product.create')}}" class="btn btn-sm btn-primary mb-5">Create</a>

        @if(session()->has('message'))
            <div class="alert alert-success mt-2">
                {{ session()->get('message') }}
            </div>
        @endif
        <table class="table mt-5">
            <thead>
            <tr>
                <th scope="col" width="30%">Image</th>
                <th scope="col" width="25%">Product name</th>
                <th scope="col" width="25%">Category name</th>
                <th scope="col" width="20%">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
            <tr>
                <td><img src="{{Storage::url($product->image)}}" class="img-thumbnail" width="20%"></td>
                <td>{{$product->name}}</td>
                <td>{{$product->category->name}}</td>

                <td>
                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{route('product.show',$product->id)}}" class="btn btn-sm btn-info">Show</a>
                    <form action="{{route('product.destroy',$product->id)}}" method="post" id="delete_form_{{$product->id}}" style="display: none">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" value="{{$product->id}}" name="id">
                    </form>
                    <a href="" class="btn btn-danger btn-sm"
                       onclick="
                           if(confirm('Are sure to delete?'))
                           {
                           event.preventDefault();
                           document.getElementById('delete_form_{{$product->id}}').submit();
                           }else{
                           event.preventDefault();
                           }
                           "> Delete
                    </a>
{{--                    <a href="{{route('product.delete',$product->id)}}" class="btn btn-sm btn-danger">Delete</a>--}}
                </td>
            </tr>
            @empty
                <tr>
                    <td class="text-center">No date Found</td>
                </tr>

            @endforelse
            </tbody>
        </table>
        <div>
            {{ $products->links('pagination.paginate') }}
        </div>
    </div>


@endsection
