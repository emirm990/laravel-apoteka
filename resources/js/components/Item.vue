<template>
 <div v-if="cart" class="cart-item">
                <div class="cart-item-description">
                    <h3>{{name}}</h3>
                    <p>{{description}}</p>
                </div>
                <div class="cart-item-price">
                    <h4>Price:</h4>
                    <div class="cart-item-price-container">
                        <div>
                            <p class="count" v-if="cart">{{count}}</p>
                            <p> {{price}} KM</p>
                        </div>
                        <p >Total: {{total.toFixed(2)}} KM</p>
                    </div>
                </div>
                <div class="cart-item-controlls">
                    <div class="form-group">
                        <input class="form-control" type="number" name="number_of_items" v-model="value" min="1" >
                        <input type="submit" class="btn btn-primary" value="Add" @click="addToCart">
                        <input  type="submit" value="Remove" class="btn btn-danger" @click="deleteFromCart">
                    </div>
                </div>
            </div>
    <div v-else class="card col-4 mt-2">
            <img class="card-img-top card-height pt-2" :src="image" alt="Item image">
            <div class="card-body">
                <h3 class="card-title">{{name}}</h3>
                <p class="card-text">{{ description}}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: {{ price}} KM</li>
                    <li class="list-group-item">Stock: {{stock}}</li>
                    <form class="form-inline mt-2">
                        <div>
                            <input type="number" name="number_of_items" min="1" value="1" class="form-control form-control-custom">
                            <button @click="addToCart" class="btn btn-primary"><i class="fa fa-cart-plus"></i></button>
                        </div>
                    </form>
                </ul>
            </div>
        </div>  
</template>
<script>
let item;
export default {
    name: "item",
    data(){
        return{
            value: Number(this.count),
            count: 0,
            value: 1,
            total: 0
        }
    },
    created(){
        this.count =  this.initialCount,
        this.total = this.initialTotal
    },
    props:{
        item_id: Number,
        name: String,
        description: String,
        initialCount: Number,
        price: Number,
        stock: Number,
        image: String,
        cart: Boolean,
        initialTotal: Number
    },
    methods:{
        addToCart(){
            axios.post('/cart/add',{
                item_id: this.item_id,
                number_of_items: this.value
            }).then((response)=>{
                this.count = response.data.item.count;
                this.total = response.data.item.count * this.price;
                this.$emit('count-changed',  item = { id: this.item_id, count: this.count, price:this.price, name:this.name, total:this.total});
            })
        },
        deleteFromCart(){
            axios.post('/cart/destroy',{
                item_id: this.item_id,
                number_of_items: this.value
            }).then((response)=>{
                this.count = response.data.item;
                this.total = response.data.total;
                this.$emit('count-changed',  item = { id: this.item_id, count: this.count, price:this.price, name:this.name, total:this.total});
            })
        }
    }
}
</script>