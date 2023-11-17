<template>
    <button @click.prevent="addToCart" class="btn boton-principal">
        añadir a tu carro
    </button>
</template>
<script setup>
import useProduct from "../../composables/products";
const { add } = useProduct();
const productId = defineProps(["productId"]);

const addToCart = async () => {
    try {
        await add(productId);
    } catch (error) {
        console.log(error);
    }
};
</script>
