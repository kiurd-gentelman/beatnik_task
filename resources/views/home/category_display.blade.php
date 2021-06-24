@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Category by product</h1>
        </div>

        <ul class="list-group">
            @forelse($categories as $category)
            <li class="list-group-item" aria-current="true">Category : {{$category->name}}</li>
            <li class="list-group-item ">
                <ul class="list-group list-group-horizontal ">
                    @forelse($category->limit_product as $product)
                    <li class="list-group-item">Product : {{$product->name}}</li>
                    @empty
                        <div class="w-100">
                            <p class=" text-danger d-flex justify-content-center "> no date found</p>
                        </div>
                    @endforelse
                </ul>
            </li>
            @empty
                <li class="list-group-item text-danger">No date found</li>
            @endforelse
        </ul>
    </div>



@endsection
