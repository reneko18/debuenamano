<template>
    <div>
      <div class="test-cart">Cart : {{ cartCount }}</div>
      <div class="test-cart"></div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import useProduct from '../../composables/products';

  const { getCount } = useProduct();
  const cartCount = ref(0);

  onMounted(async() => {
    cartCount.value = await getCount();
  });
  </script>
  
  <style scoped>
    .test-cart {
      color: #fff;
    }
  </style>