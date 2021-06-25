@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Product / Edit</h1>
        </div>

        <a href="{{route('product.index')}}" class="btn btn-sm btn-primary mb-5">Go to list</a>
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
            <form method="post" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="product">Product Name</label>
                    <input type="text" class="form-control" name="name" id="product" aria-describedby="emailHelp" value="{{old('name') ?? $product->name}}">
                </div>
                <div class="form-group">
                    <img type="file" src="{{old('image')?? Storage::url($product->image)}}" class="img-thumbnail" id="image_preview" width="10%"  alt="">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" accept="image/*" onchange="loadFile(event)" id="upload_image" aria-describedby="imageHelp" value="{{old('image')}}">
                </div>
                <table class="" id="invoice_table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Attribute</th>
                        <th>value</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( json_decode($product->attribute_name , true) as $key=>$item)
                    <tr class="cloning_row" id="{{$key}}" >

                        <td><button type="button" class="btn btn-danger btn-sm delegated-btn">x</button></td>
                        <td>
                            <input type="text" name="attribute_name[{{$key}}]" id="attribute_name" value="{{$item}}" class="attribute_name form-control">
                            @error('attribute_name') <span class="help-block text-danger">{{$message}}</span> @enderror
                        </td>
                        <td>
                            <input type="text" name="attribute_value[{{$key}}]" id="attribute_value" value="{{json_decode($product->attribute_value, true)[$item]}}" class="attribute_value form-control">
                            @error('attribute_name') <span class="help-block text-danger">{{$message}}</span> @enderror

                        </td>
                    </tr>
                    @endforeach
                    </tbody>

                    <tfoot class="mt-3">
                    <tr>
                        <td colspan="6" >
                            <button type="button" class="btn_add btn btn-primary">+</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
                <div class="form-group">
                    <label for="category">Product Name</label>
                    <select name="category_id" class="custom-select from-control" id="category">
                        @forelse($categories as $category)
                            <option {{($category->id == $product->category_id)}} value="{{$category->id}}">{{$category->name}}</option>
                        @empty
                            <option>No date found</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea  class="form-control" id="exampleInputPassword1" name="description">{{old('description') ?? $product->description}}</textarea>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Update</button>
            </form>

        </div>

    </div>


@endsection
@section('scripts')
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script>
        var loadFile = function(event) {
            console.log(3)
            var output = document.getElementById('image_preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        $(document).ready(function(){

            $(document).on('click','.btn_add' ,function(){
                let trCount = $('#invoice_table').find('tr.cloning_row:last').length;
                // let trCount = $('table#invoice_table tr:last').index() + 1;
                console.log(trCount)
                let numberIncr = trCount > 0 ? parseInt($('#invoice_table').find('tr.cloning_row:last').attr('id')) + 1 : 0;
                $('#invoice_table').find('tbody').append($('' +
                    '<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td><button type="button" class="btn btn-danger btn-sm delegated-btn">x</button></td>' +
                    '<td><input type="text" name="attribute_name[' + numberIncr + ']" class="product_name form-control"></td>' +
                    '<td><input type="text" name="attribute_value[' + numberIncr + ']" step="0.01" class="quantity form-control"></td>' +
                    '</tr>'));
                // trCount++
            });
            $(document).on('click','.delegated-btn',function(e){
                e.preventDefault()
                $(this).parent().parent().remove();
            })

            $('form').on('submit',function(e){
                $('input.product_name').each(function(){ $(this).rules("add",{required:true});});
                $('select.unit').each(function(){ $(this).rules("add",{required:true});});
                $('input.quantity').each(function(){ $(this).rules("add",{required:true});});
                $('input.unit_price').each(function(){ $(this).rules("add",{required:true});});
                $('input.row_sub_total').each(function(){ $(this).rules("add",{required:true});});

                e.preventDefault

            });
        });
    </script>
@endsection

