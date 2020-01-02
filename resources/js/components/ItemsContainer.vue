<template>
<div > 
  <Item v-for="item in items" 
        :key="item.id" 
        :item_id="item.id" 
        :name="item.name" 
        :description="item.description" 
        :initialCount="item.count" 
        :price="item.price" 
        :initialTotal="item.total"
        @count-changed="emitCatched"
    />
    <cart-total :items="itemsChanged"/> 
</div>
</template>
<script>
import Item from "./Item";
import CartTotal from "./CartTotal";
export default {
    name: "items-container",
    components:{
        Item,
        CartTotal
    },
    methods:{
        emitCatched(event){
            if(this.itemsChanged.length > 0){
                let foundItem = this.itemsChanged.findIndex(element => element.id == event.id);
                if(foundItem !== -1){
                    this.itemsChanged[foundItem].count = event.count;
                    this.itemsChanged[foundItem].total = event.total;
                    if(event.count < 1){
                        this.itemsChanged.splice(foundItem, 1);
                    }
                }else{
                    this.itemsChanged.push(event);
                }
            }else{
                this.itemsChanged.push(event)
            }
            
           
        }
    },
    props:{
        items: Array
    },
    created(){
        this.itemsChanged = this.items;
    },
    data(){
        return{
            itemsChanged: []
        }
        
    }
}
</script>