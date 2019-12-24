@extends('layouts.app')
@section('content')
<div class="container">
    <form action="/items/{{$item->id}}/edit" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @if(Session::has('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
        @endif
        <div class="form-group">
            <img src="{{asset( $item -> image)}}" alt="Item image">
        </div>
        <div class="form-group">
            <label for="image">Product image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name}}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="textarea" class="form-control" id="description" name="description">{{$item->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}" step="0.05">
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $item->stock }}" step="1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection