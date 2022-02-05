@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1>{{$articleCategory->title}}</h1>

                <p>{{$articleCategory->description}}</p>



            </div>
            <div class="container my-6">
                <a href="{{ route('articlecategory.index') }}" class="btn btn-info">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection