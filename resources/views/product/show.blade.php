@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Category / Details</h1>
        </div>

        <a href="{{route('category.index')}}" class="btn btn-sm btn-primary mb-5">Go to list</a>
        <div class="mt-5">
            <h3>{{$product->name}}</h3>
            <hr>
            <div class="row">
                <div class="col-md-6"><div class="card"><img src="{{Storage::url($product->image)}}"></div></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <p>Category name: {{$product->category->name}}</p>
                            </div>
                            <div>Attribute name :</div>
                            <table class="table">
                                <tbody>
                                @foreach ( json_decode($product->attribute_name , true) as $item)
                                    <tr>
                                        <td>{{$item}}</td>
                                        <td>{{json_decode($product->attribute_value, true)[$item]}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <p>Description : {{$product->description}}</p>




                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
