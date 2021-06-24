@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Product / create</h1>
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
            <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="category">Product Name</label>
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

                    <table class="" id="invoice_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Attribute</th>
                            <th>value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cloning_row" id="0" >
                            <td></td>
                            <td>
                                <input type="text" name="attribute_name[]" id="attribute_name" class="attribute_name form-control">
                                @error('attribute_name') <span class="help-block text-danger">{{$message}}</span> @enderror
                            </td>
                            <td>
                                <input type="text" name="attribute_value[]" id="attribute_value" class="attribute_value form-control">
                                @error('attribute_name') <span class="help-block text-danger">{{$message}}</span> @enderror

                            </td>
                        </tr>
                        </tbody>

                        <tfoot class="mt-3">
                        <tr>
                            <td colspan="6" >
                                <button type="button" class="btn_add btn btn-primary">+</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="form-group">
                    <label for="category">Product Name</label>
                    <select name="category_id" class="custom-select from-control" id="category">
                        @forelse($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @empty
                        <option>No date found</option>
                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea t class="form-control" id="exampleInputPassword1" name="description">{{old('description')}}</textarea>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Submit</button>
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
                    '<td><input type="number" name="attribute_value[' + numberIncr + ']" step="0.01" class="quantity form-control"></td>' +
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
