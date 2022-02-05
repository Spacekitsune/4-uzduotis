@extends('layouts.app')

@section('content')


<div class="container">

    <h1>Search results</h1>

    @if (session()->has('success_message'))
    <div class="alert alert-success">Product was deleted.</div>
    @endif

    @if (count($product)== 0)
    <p>There are no products</p>
    @endif


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