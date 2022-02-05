@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1>Upload new product</h1>

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">


                    <input class="form-control" type="text" name="product_title" placeholder="Title">
                    <textarea class="form-control" name="product_description" cols="30" rows="5">Product description</textarea>
                    <input class="form-control" type="number" step="0.01" name="product_price" placeholder="Product price">
                    <label for="product_categoryId">Select product category</label>
                    <select class="form-control" name="product_categoryId">
                        @foreach ($selected_values as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    <input class="form-control" type="file" name="product_imageUrl" required autofocus>
                    @csrf
                    <button class="btn btn-success" type="submit">Update image</button>

                </form>
            </div>
            <div class="container my-6">
                <a href="{{ route('product.index') }}" class="btn btn-info">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection