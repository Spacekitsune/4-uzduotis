@extends('layouts.app')

@section('content')


<div class="container">

    <h1>Product category list</h1>

    @if (session()->has('success_message'))
    <div class="alert alert-success">Category was deleted.</div>
    @elseif (session()->has('error_message'))
    <div class="alert alert-danger">Delete is not possible while category has products.</div>
    @endif

    @if (count($productCategory)== 0)
    <p>There are no article categories</p>
    @endif



    <div class="input-group mb-3">

        <form method="GET" action="{{route('productcategory.index')}}">
            @csrf

            <select class="custom-select" name="sortCollumn" style="text-transform: uppercase;">

                @foreach ($select_array as $key=>$item)

                @if($item == $sortCollumn || ($key == 0 && empty($sortCollumn)) )
                <option value="{{$item}}" selected style="text-transform: uppercase;">{{$item}}</option>
                @else
                <option value="{{$item}}" style="text-transform: uppercase;">{{$item}}</option>
                @endif

                @endforeach
            </select>


            <select class="custom-select" name="sortOrder">
                @if ($sortOrder == 'asc' || empty($sortOrder))
                <option value="asc" selected>A-Z</option>
                <option value="desc">Z-A</option>
                @else
                <option value="asc">A-Z</option>
                <option value="desc" selected>Z-A</option>
                @endif
            </select>
            <button class="btn btn-outline-secondary" type="submit">Sort</button>
        </form>
    </div>

        <div class="container">
            <a class="btn btn-primary" href="{{route('productcategory.create')}}">Create new category</a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Products</th>
                <th>Action</th>
            </tr>

            @foreach ($productCategory as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->title}}</td>
                <td>{{$category->description}}</td>
                <td>{{count($category->categoryProducts)}}</td>
                <td>
                    <a class="btn btn-success" href="{{route('productcategory.edit', [$category])}}">Edit</a>
                    <form action="{{route('productcategory.destroy', [$category])}}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>
    </div>



    @endsection