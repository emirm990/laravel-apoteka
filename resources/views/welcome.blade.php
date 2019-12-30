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
                    @auth
                    <form class="form-inline mt-2">
                        <div>
                            <input type="number" name="number_of_items" min="1" value="1" class="form-control form-control-custom">
                            <button onClick="addToCart('{{$item->id}}','{{auth()->id()}}')" class="btn btn-primary"><i class="fa fa-cart-plus"></i></button>
                        </div>
                    </form>
                    
                    @endauth
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
    <script>
        function addToCart(item_id, user_id, number_of_items) {
            number_of_items = event.target.previousElementSibling.value;
            event.preventDefault();
            console.log(item_id, user_id, number_of_items);
            axios.post('/cart/add', {
                    item_id,
                    user_id,
                    number_of_items
                })
                .then(res => {
                    console.log(items_in_cart);
                    
                    items_in_cart.innerText = res.data.total;
                }).catch(err => {
                    console.log(err)
                })
        }
    </script>