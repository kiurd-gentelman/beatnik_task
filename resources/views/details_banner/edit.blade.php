@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Home Banner / Edit</h1>
        </div>

        <a href="{{route('details-banner.index')}}" class="btn btn-sm btn-primary mb-5">Go to list</a>
        @if ($errors->any())
            <div class="alert alert-danger mt-1">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-5">
            <form method="post" action="{{route('details-banner.update', $details_banner->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="category">Banner Content</label>
                    <input type="text" class="form-control" name="banner_content" id="category" aria-describedby="emailHelp" value="{{old('banner_content') ?? $details_banner->content}}">
                </div>
                <div class="form-group">
                    <label for="category">Category Name</label>
                    <select name="product_id" class="form-control" >
                        @foreach($products as $product)
                            <option {{($details_banner->product_id == $product->id)?'selected':''}} value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <img type="file" src="{{old('image')?? Storage::url($details_banner->image)}}" class="img-thumbnail" id="image_preview" width="10%"  alt="">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*" onchange="loadFile(event)" id="upload_image" aria-describedby="imageHelp" value="{{old('image')}}">
                </div>
                <button type="submit" class="btn btn-success btn-sm">Update</button>
            </form>

        </div>

    </div>


@endsection
@section('scripts')
    <script>
        var loadFile = function(event) {
            console.log(3)
            var output = document.getElementById('image_preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
