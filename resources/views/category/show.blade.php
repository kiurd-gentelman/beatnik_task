@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Category / Details</h1>
        </div>

        <a href="{{route('category.index')}}" class="btn btn-sm btn-primary mb-5">Go to list</a>


        <div class="mt-5">
            <h3>Category name: {{$category->name}}</h3>
            <hr>
            <p>Description : {{$category->description}}</p>

        </div>

    </div>


@endsection
