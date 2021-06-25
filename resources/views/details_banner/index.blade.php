@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Details Banner</h1>
        </div>

        @if($permission <=3)
            <a href="{{route('details-banner.create')}}" class="btn btn-sm btn-primary mb-5">Create</a>
        @endif


        @if(session()->has('message'))
            <div class="alert alert-success mt-2">
                {{ session()->get('message') }}
            </div>
        @endif
        <table class="table table-bordered mt-5">
            <thead>
            <tr>
                <th  width="35%">Details Content</th>
                <th  width="35%">Image</th>
                <th  width="35%">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($details_banner as $banner)
                <tr>
                    <td>{{$banner->content}}</td>
                    <td><img src="{{Storage::url($banner->image)}}" class="img-thumbnail" width="20%"></td>
                    <td>
                        <a href="{{route('details-banner.edit',$banner->id)}}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{route('details-banner.show',$banner->id)}}" class="btn btn-sm btn-info">Show</a>
                        <form action="{{route('details-banner.destroy',$banner->id)}}" method="post" id="delete_form_{{$banner->id}}" style="display: none">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" value="{{$banner->id}}" name="id">
                        </form>
                        <a href="" class="btn btn-danger btn-sm"
                           onclick="
                               if(confirm('Are sure to delete?'))
                               {
                               event.preventDefault();
                               document.getElementById('delete_form_{{$banner->id}}').submit();
                               }else{
                               event.preventDefault();
                               }
                               "> Delete
                        </a>
                        {{--                    <a href="{{route('details-banner.delete',$banner->id)}}" class="btn btn-sm btn-danger">Delete</a>--}}
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
            {{ $details_banner->links('pagination.paginate') }}
        </div>


    </div>


@endsection
