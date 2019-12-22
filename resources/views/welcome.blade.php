@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="/" class="form-inline row" method="GET">
            @csrf
            <div class="form-group" style="margin:0 auto;">
                <input type="text" class="form-control" id="search" name="search" value="{{$searchVal}}" placeholder="Search...">
                <button type="submit" class="btn btn-primary ml-2">Search</button>
            </div>
        </form>
        </form>
        
        <div class="row">
        @foreach($items as $item)
            <div class="card col-4 mt-2">
                <div class="card-body">
                    <h3 class="card-title">{{ $item -> name}}</h3>
                    <p class="card-text">{{ $item -> description}}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Price: {{ $item -> price}}</li>
                        <li class="list-group-item">Stock: {{ $item->stock}}</li>
                        @if(isset($user->admin))
                            @if($user->admin === 1)
                                <li class="list-group-item">
                                    <a class="card-link" href="/items/{{ $item->id}}/edit">Edit</a>
                                </li>
                            @endif
                        @endif
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