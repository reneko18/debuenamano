<template>
    <div class="bg-cart mb-5 pb-5">
        <div class="row col-10 mx-auto">   
            <div class="col-10">
                <h2>Articulo</h2>
            </div>
            <div class="col-2">
                <h2>Precio</h2>
            </div>
        </div>
        <div v-if="cartItemsLocal.length > 0">
            <div class="row col-10 mx-auto mb-3 row-prod-cart" v-for="(item, index) in cartItemsLocal" :key="index">       
                <div class="col-8 d-flex align-items-center">
                    <img class="img-prod-cart" :src="'/' + item.galleries[0].url" :alt="item.galleries[0].alt">
                    <h3>{{ item.name }}</h3>
                </div>
                <div class="col-2 d-flex align-items-center">
                    <span class="precio-cart">${{ item.price }}</span>
                </div>
                <div class="col-2 d-flex align-items-center">
                    <a class="cursor-pointer" @click="removeFromCart(index)">X</a>
                </div>
            </div>
        </div>
        <div v-else>
            <p>Tu carrito esta vacio</p>
        </div>
    </div>

    <div v-if="cartItemsLocal.length > 0">
        <div class="col-8 ms-auto">
            <div class="subtotal-cart mb-2 pb-2">
                <h3>Carro</h3>
                <span>$ {{ totalPrice }}</span>
            </div>
            <div class="total-cart">
                <h3>TOTAL</h3>
                <span>$ {{ totalPrice }}</span>
            </div>
        </div>
    </div>

    <div class="mt-5 d-flex justify-content-end">
        <a class="btn boton-principal" @click="nextStep" >Continuar</a>
    </div>

</template>
<script setup>
import { ref, defineEmits } from "vue";
const props = defineProps({
    cartItems: { 
        type: Object, 
        default: () => ({}), 
    },
    totalPrice: { 
        type: String, 
        default:'', 
    },
});
const emit = defineEmits(['next-step', 'remove-from-cart']);

const cartItemsLocal = ref(props.cartItems);

const removeFromCart = (index) => {
    cartItemsLocal.value.splice(index, 1); // Modify the local variable
 
};

const nextStep = () => {
    emit("next-step");
}
</script>

<style scoped>
    .bg-cart{
        background-color: #F8FAF7;
    }
    .bg-cart h2{
        font-size:10px;
        font-weight: 700;
        color: #C0C6B9;
    }
    .row-prod-cart{
        background-color: #fff;
    }
    .img-prod-cart{
        width:100%;
        max-width:80px;
        margin-right:1rem;
    }
    .subtotal-cart, .total-cart{
        display:flex;
        flex-direction: row;
        justify-content: space-between;        
    }
    .subtotal-cart{
        border-bottom: 1px dotted #728C54;
    }
    .subtotal-cart h3,.subtotal-cart span, .total-cart h3, .total-cart span{
        color: #151A0F;
    }
    .subtotal-cart h3, .subtotal-cart span{
        font-size:15px;
        font-weight:400;
    }
    .total-cart h3, .total-cart span{
        font-size:20px;
        font-weight:700;
    }
</style>