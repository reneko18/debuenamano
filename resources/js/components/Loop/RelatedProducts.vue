<template>
    <!-- Card Layout -->
    <div v-if="relatedProducts.length > 0" class="row">
        <div class="'card card-productos col-3" v-for="product in relatedProducts" :key="product.id">
            <a :href="'single-product/' + product.slug" class="card-img" :class="{ 'hovered-img': hoveredTitle === product.id }">
                <img :src="'/' + getProductImage(product)" class="card-img-top" alt="imagen test">
            </a>          
            <div class="card-body">
                <a 
                    :href="'single-product/' + product.slug" 
                    @mouseenter="handleTitleMouseEnter(product.id)"
                    @mouseleave="handleTitleMouseLeave"
                >
                    <h2 class="card-title">{{ product.name }}</h2>
                </a>            
                <p class="card-precio">{{ formatPrice(product.price) }}</p>
            </div>
        </div>
    </div>
    <div v-else>
        <p>No se encontraron productos relacionados.</p>
    </div>
</template>
<script setup>
import { ref,onMounted, defineProps } from "vue";

const props = defineProps({
  categoryId: {
    type: Number,
    required: true
  },
  excludeProductId: {
    type: Number,
    required: true
  }
});

const relatedProducts = ref([]);

const fetchRelatedProducts = async () => {
  const response = await fetch(`/api/related-products?category_id=${props.categoryId}&exclude_id=${props.excludeProductId}`);
  const data = await response.json();
  relatedProducts.value = data;
};

// Function to format price without decimals and with point as thousands separator
const formatPrice = (price) => {
    // Convert price to number if it's a string
    const numericPrice = typeof price === 'string' ? parseFloat(price) : price;
    
    if (isNaN(numericPrice)) {
        return '';
    }
    
    // Use toLocaleString to format with point as thousands separator
    return numericPrice.toLocaleString('es-CL', {
        style: 'currency',
        currency: 'CLP',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    }).replace(/CLP/, ''); // Remove currency symbol
};

//Select first image from the galleries
const getProductImage = (product) => {
  return product.galleries && product.galleries.length > 0
    ? product.galleries[0].url
    : '/img/image-dummy-products.png';
};

//Hovered Product
const hoveredTitle = ref(null);

const handleTitleMouseEnter = (productId) => {
    hoveredTitle.value = productId;
};

const handleTitleMouseLeave = () => {
    hoveredTitle.value = null;
};

onMounted(() => {
  fetchRelatedProducts();
});
</script>