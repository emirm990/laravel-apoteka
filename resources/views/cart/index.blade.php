@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row cart-all">
        <h1 class="cart-heading">Cart</h1>
        <div class="cart-container">
            @foreach($cartItems as $item)
            <div class="cart-item">
                <!--<img src="{{asset( $item -> image)}}" alt="Item Image">-->
                <div class="cart-item-description">
                    <h3>{{$item->name}}</h3>
                    <p>{{$item->description}}</p>
                </div>
                <div class="cart-item-price">
                    <h4>Price:</h4>
                    <div class="cart-item-price-container">
                        <div>
                            <p class="count">{{$item->count}}</p>
                            <p> {{$item->price}} KM</p>
                        </div>
                        <p>Total: {{$item->total}} KM</p>
                    </div>
                </div>
                <div>
                    <form action="/cart/destroy" method="POST">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="number" name="number_of_items" value="1" min="1" >
                        <input type="hidden" name="item_id" value="{{$item->id}}">
                        <input type="submit" value="Remove" class="btn btn-danger">
                    </div>
                    </form>
                </div>
            </div>
            @endforeach

        </div>
        <div class="cart-total">
            <div>
                <ul>
                    @foreach($cartItems as $item)
                    <li>
                        <span>{{$item->name}} : </span>
                        <span>{{$item->count}} * </span>
                        <span>{{$item->price}} KM</span>
                        <span>Total: {{$item->total}} KM</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <p>Total in cart:
                    <span>{{ $cartPrice }} KM</span></p>
            </div>
        </div>
    </div>

</div>

@endsection

<script>
    
    function removeFromCart(item_id, user_id, number_of_items) {
            number_of_items = event.target.previousElementSibling.value;
            event.preventDefault();
            console.log(item_id, user_id, number_of_items);
            axios.post('/cart/destroy', {
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