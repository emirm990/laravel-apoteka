@extends('layouts.app')

@section('content')
<form action="/dashboard/edit" class="form-inline row" method="GET">
    @csrf
    <div class="form-group" style="margin:0 auto;">
        <input type="text" class="form-control" id="search" name="search" value="{{$searchVal}}" placeholder="Search...">
        <button type="submit" class="btn btn-primary ml-2">Search</button>
        <button class="btn btn-secondary ml-2"><a href="/dashboard/edit">Clear</a></button>
    </div>
</form>
<div class="container">
    <div class="row">
        @foreach($items as $item)
        <div class="card col-4 mt-2">
        <img class="card-img-top card-height pt-2" src="{{asset( $item -> image)}}" alt="Item image">
            <div class="card-body">
                <h3 class="card-title">{{ $item -> name}}</h3>
                <p class="card-text">{{ $item -> description}}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: {{ $item -> price}} KM</li>
                    <li class="list-group-item">Stock: {{ $item->stock}}</li>
                    <li class="list-group-item">
                        <form class="form-inline" action="/dashboard/{{$item->id}}/delete" method="POST">
                            @csrf
                            <a class="btn btn-warning" href="/items/{{ $item->id}}/edit">Edit</a>
                            <input class="btn btn-danger ml-2" type="submit" value="Delete" onClick="confirmDelete('{{$item->name}}')">
                        </form>
                        <!--<a class="btn btn-danger" onClick="confirmDelete('{{$item->name}}')">Delete</a>-->
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container">
        <div class="pagination">
            {{ $items->links()}}
        </div>
    </div>
</div>
@endsection
<script>
    function confirmDelete(itemName) {
        let choice = confirm('Are you sure you want to delete ' + itemName);
        if (!choice) {
            event.preventDefault();
        }
    }
</script>