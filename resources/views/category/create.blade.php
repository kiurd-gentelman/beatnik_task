@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Category / create</h1>
        </div>

        <a href="{{route('category.index')}}" class="btn btn-sm btn-primary mb-5">Go to list</a>
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
            <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="category">Category Name</label>
                    <input type="text" class="form-control" name="name" id="category" aria-describedby="emailHelp" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <img type="file" src="{{old('image')?? asset('images/default-category.jpg')}}" class="img-thumbnail" id="image_preview" width="10%"  alt="">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*" onchange="loadFile(event)" id="upload_image" aria-describedby="imageHelp" value="{{old('image')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea  class="form-control" id="exampleInputPassword1" name="description">{{old('description')}}</textarea>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Submit</button>
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
