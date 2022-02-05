@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1>Edit category</h1>

                <form action="{{ route('articlecategory.update', [$articleCategory]) }}" method="POST">

                    <input class="form-control" type="text" name="articlecategory_title" value="{{$articleCategory->title}}"></br>
                    <textarea name="articlecategory_description" cols="30" rows="5" class="form-control">{{$articleCategory->description}}</textarea>
                    @csrf
                    <button class="btn btn-success" type="submit">Edit category</button>

                </form>
            </div>
            <div class="container my-6">
                <a href="{{ route('articlecategory.index') }}" class="btn btn-info">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection