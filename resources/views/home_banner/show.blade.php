@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Home banner / Details</h1>
        </div>

        <a href="{{route('home-banner.index')}}" class="btn btn-sm btn-primary mb-5">Go to list</a>


        <div class="mt-5">
            <h3>Category name: {{$home_banner->content}}</h3>
            <hr>
            <img src="{{Storage::url($home_banner->image)}}">

        </div>

    </div>


@endsection
