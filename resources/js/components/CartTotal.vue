<template>
    <div>
        <ul>
            <li  v-for="item in items" :key="item.id">
                <span>{{item.name}} : </span>
                <span>{{item.count}} * </span>
                <span>{{item.price}} KM</span>
                <span>Total: {{item.total}} KM</span>
            </li>
        </ul>
        <div v-if="total">{{total}} KM</div>
    </div>
</template>
<script>
export default {
    name: "cart-total",
    data(){
        return{
            total: 0
        }
    },
    props:{
        items: Array
    },
    created(){
            this.items.forEach(element => {
                this.total += parseFloat(element.total);
            });
    },
    watch:{
        items:{
            deep: true,
            handler(){
                this.total = 0;
                this.items.forEach(element => {
                    return this.total += parseFloat(element.total);
                });
            }
            
        }
            
    }
}
</script>