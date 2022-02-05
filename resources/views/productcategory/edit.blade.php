@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1>Edit category</h1>

                <form action="{{ route('productcategory.update', [$productCategory]) }}" method="POST">

                    <input class="form-control" type="text" name="productcategory_title" value="{{$productCategory->title}}"></br>
                    <textarea name="productcategory_description" cols="30" rows="5" class="form-control">{{$productCategory->description}}</textarea>
                    @csrf
                    <button class="btn btn-success" type="submit">Edit category</button>

                </form>
            </div>
            <div class="container my-6">
                <a href="{{ route('productcategory.index') }}" class="btn btn-info">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection