@extends('layouts.app')

@section('content')


<div class="container">

    <h1>Products</h1>

    @if (session()->has('success_message'))
    <div class="alert alert-success">Product was deleted.</div>
    @endif

    @if (count($product)== 0)
    <p>There are no products</p>
    @endif

    <div class="container">
        <a href="{{route('productcategory.index')}}">Category list</a>
    </div>

    <div class="container">
        <a class="btn btn-primary" href="{{route('product.create')}}">Upload new products</a>
    </div>

    <div class="container">
        <h4>Sort products</h4>
        <form action="{{route('product.index')}}" method="GET">
            <label for="sortOrder">Sort order</label>
            <div class="input-group">
                <select class="custom-select" name="sortOrder">
                    <option selected value="">Choose...</option>
                    <option value="asc">A-Z</option>
                    <option value="desc">Z-A</option>
                </select>
                @csrf
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit" value="Sort by category">
                </div>
            </div>
        </form>


        <form method="GET" action="{{route('product.filter')}}">
            @csrf
            <label for="category_id">Filter by</label>
            <div class="input-group">
            <select class="custom-select" name="category_id">
                @foreach ($category as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary" type="submit">Filter</button>
            </div>
        </form>

    </div>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-md-4 g-3">
                @foreach ($product as $product)
                <div class="col">
                    <div class="card shadow-sm">
                        @if (strpos($product->image_url, "http") === 0)
                        <img src="{{$product->image_url}}" class="bd-placeholder-img card-img-top" alt="{{$product->title}}" width="100%" height="225">
                        @else
                        <img src="{{'/images/'.$product->image_url}}" class="bd-placeholder-img card-img-top" alt="{{$product->title}}" width="100%" height="225">
                        @endif
                        <div class="card-body">
                            <h3>{{$product->title}}</h3>
                            <h5>{{$product->productsCategory->title}}</h5>
                            <p>{{$product->description}}</p>
                            <h4>{{$product->price}} &euro;</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a class="btn btn-success" href="{{route('product.edit', [$product])}}">Edit</a>

                                    <form action="{{route('product.destroy', [$product])}}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>



@endsection