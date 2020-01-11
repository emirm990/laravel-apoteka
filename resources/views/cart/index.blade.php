@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row cart-all">
        <h1 class="cart-heading">Cart</h1>
        <div class="cart-container">
            <items-container :items='{{ json_encode($cartItems) }}' :cart="{{ json_encode(true) }}" />
        </div>
    </div>
</div>

@endsection