@extends('layouts.app')
@section('content')
<form action="/" class="form-inline row" method="GET" style="margin-bottom:1em">
        @csrf
        <div class="form-group" style="margin:0 auto;">
            <input type="text" class="form-control" id="search" name="search" value="{{$searchVal}}" placeholder="Search...">
            <button type="submit" class="btn btn-primary ml-2">Search</button>
            <button class="btn btn-secondary ml-2"><a href="/">Clear</a></button>
        </div>
    </form>
<div class="container">
    <div class="row">
        @foreach($items as $item)
        <div class="card col-4 mt-2 align-items-stretch">
        <img class="card-img-top card-height pt-2" src="{{asset( $item -> image)}}" alt="Item image">
            <div class="card-body">
                <h3 class="card-title">{{ $item -> name}}</h3>
                <p class="card-text">{{ $item -> description}}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: {{ $item -> price}} KM</li>
                    <li class="list-group-item">Stock: {{ $item->stock}}</li>
                </ul>
            </div>
        </div>
        @endforeach
        @if(count($items)===0)
        <div>
            <p> Sorry, not items match your search.</p>
        </div>
        @endif
    </div>
 
    
    <div class="container">
        <div class="pagination">
            {{ $items->links()}}
        </div>

    </div>

    @endsection