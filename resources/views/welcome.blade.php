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
    <?php 
        // dump($items->items());
       // die();
    ?>
    <items-container :items='{{ json_encode($items->items()) }}' :cart="{{ json_encode(false) }}" />
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
            event.preventDefault();
            number_of_items = event.target.previousElementSibling.value;
            axios.post('/cart/add', {
                    item_id,
                    user_id,
                    number_of_items
                })
                .then(res => {
                    items_in_cart.innerText = res.data.total;
                }).catch(err => {
                    console.log(err)
                })
        }
    </script>