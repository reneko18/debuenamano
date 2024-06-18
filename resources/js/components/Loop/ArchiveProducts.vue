<template>
    <div class="container">
        <div class="row">
            <!-- Search Input -->
            <div class="col-12">
                <div class="input-group mb-3">
                    <span class="input-group-text" @click="fetchProducts">
                        <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
                    </span>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="¿Que estás buscando?"
                        v-model="searchQuery"
                        @keyup.enter="fetchProducts"
                    />
                    <button class="btn btn-outline-secondary" type="button" @click="clearSearch">
                        <font-awesome-icon :icon="['fas', 'xmark']" />
                    </button>
                </div>
            </div>
            
            <!--Age Filters-->
            <div class="col-12">
              <div class="d-flex justify-content-center flex-wrap cont-edad">
                <div v-for="age in ageFilters" :key="age.id" class="btn-edad">
                  <input
                    type="radio"
                    class="btn-check"
                    name="age-filters"
                    :id="'age-' + age.id"
                    autocomplete="off"
                    :value="age"
                    v-model="selected.age_filter_id"
                  />
                  <label :for="'age-' + age.id">{{ age.name }}</label>
                </div>
              </div>
            </div>
            <!--End Age Filters-->
        </div><!-- cierre row -->
    </div><!-- cierre container -->

    <div class="bg-blanco-verdoso mt-30 mb-100">
        <div class="container">
            <div class="row"> 
            <div class="col-12">
                <div class="position-relative" v-click-outside-element="closeDropdown">
                    <div class="position-relative div-cat">
                        <input
                            type="text"
                            class="form-control cat-select"
                            :value="selected.category_id.name"
                            @click="showAndCloseDropdown"
                            readonly
                            placeholder="Seleccione una categoría"
                        />
                        <font-awesome-icon
                            :icon="['fas', 'chevron-down']"
                            @click="showAndCloseDropdown"
                        />
                    </div>
                    <div id="dropdown-cats">
                        <div class="accordion" id="accordionCategories">
                            <div v-for="category in categories">
                                <div v-if="category.children == ''" class="cat-sin-hijo">
                                    <input
                                        :id="'cat-' + category.id"
                                        class="btn-check"
                                        :value="category"
                                        type="radio"
                                        name="categoria"
                                        v-model="selected.category_id"
                                    />
                                    <label :for="'cat-' + category.id" class="btn">
                                        {{ category.name }}
                                    </label>
                                </div>
                                <h2 v-else class="accordion-header">
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        :data-bs-target="generateDataBsTarget(category.id)"
                                    >
                                        {{ category.name }}
                                    </button>
                                </h2>
                                <div
                                    :id="generateID(category.id)"
                                    class="accordion-collapse collapse"
                                    data-bs-parent="#accordionCategories"
                                >
                                    <div class="accordion-body">
                                        <div v-for="subcategory in category.children">
                                            <div v-if="category.id == subcategory.parent_id">
                                                <input
                                                    :id="
                                                        'subcat-' +
                                                        subcategory.id
                                                    "
                                                    class="btn-check"
                                                    :value="subcategory"
                                                    type="radio"
                                                    name="subcategoria"
                                                    v-model="selected.category_id"                                                  
                                                />
                                                <label :for="'subcat-' + subcategory.id" class="btn">
                                                    {{subcategory.name}}
                                                </label>
                                            </div>
                                        </div><!-- cierre subcategory -->
                                    </div><!-- cierre accordion-body -->
                                </div>
                            </div><!-- cierre categorie -->
                        </div><!-- cierre accordion -->            
                    </div><!--End Dropdown Cats -->
                </div><!-- cierre closeDropdown -->
            </div><!-- cierre col-12 --> 
    
            <div class="col">
                <select-dbm 
                    :items="genders"   
                    :selected="selected.gender_id"
                    @update:selected="updateSelectedGender"
                    placeholder="Seleccione un género"
                />
            </div>

            <div class="col">                
                <input type="text" class="form-control" v-model="selected.min_price" placeholder="Mínimo">
                <input type="text" class="form-control" v-model="selected.max_price" placeholder="Máximo">
            </div>
        </div>
    </div>  
    

        <div class="container">
            <div class="row">
                <!-- Selected filters tags -->
                <div class="mb-3 d-flex">
                    <div class="flex-grow-1">
                        <span v-for="(filter, index) in appliedFilters" :key="index" class="badge">
                            {{ filter.label }} 
                            <a class="" @click="removeFilter(filter.type)">
                                <svg width="9" height="9" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.08887 1.53027L1.08887 9" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1.08887 1.53027L9.08887 9" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </span>
                    </div><!-- cierre flex-grow-1 --> 
                    <div class="">
                        <a class="enlace" @click="clearFilters">Quitar todos los filtros</a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- cierre bg -->

    <!--Test Select Static-->
    <div class="container">
        <label for="order-shop">Ordenar por</label>
        <select-dbm-static
            :items="order"   
            :selected="selected.order"
            @update:selected-static="updateSelectedOrder"
            :placeholder="placeholderOrder"
        />
    </div>
    <!--End Test Select Static-->

    <div class="container">
        <!-- Layout switch buttons -->
        <div class="d-flex orden-grid">
            <div class="flex-grow-1">
                <p class="archive-resultados">{{ currentPageResults }} de {{ totalResults }} resultados</p>
            </div>
            <div class="d-flex orden">
                <!--Order products-->
                <!--Aqui deber ir el select-dbm-static-->
            </div>
            <div class="d-flex icons-grid">
                <a class="icon-grid" @click="setLayout('col-3')">
                    <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 17 17">
                    <rect class="cls-1" x="9.1" y="13.8" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="13.4" y="13.8" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="4.8" y="13.8" width="3.1" height="3.1"/>
                    <rect class="cls-1" x=".5" y="13.8" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="9.1" y=".9" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="13.4" y=".9" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="4.8" y=".9" width="3.1" height="3.1"/>
                    <rect class="cls-1" x=".5" y=".9" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="9.1" y="5.2" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="13.4" y="5.2" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="4.8" y="5.2" width="3.1" height="3.1"/>
                    <rect class="cls-1" x=".5" y="5.2" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="9.1" y="9.5" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="13.4" y="9.5" width="3.1" height="3.1"/>
                    <rect class="cls-1" x="4.8" y="9.5" width="3.1" height="3.1"/>
                    <rect class="cls-1" x=".5" y="9.5" width="3.1" height="3.1"/>
                    </svg>
                </a>
                <a class="icon-grid" @click="setLayout('col-4')">
                    <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 17 17">
                        <rect class="cls-1" x="5.8" y=".9" width="4.5" height="4.5"/>
                        <rect class="cls-1" y=".9" width="4.5" height="4.5"/>
                        <rect class="cls-1" x="11.5" y=".9" width="4.5" height="4.5"/>
                        <rect class="cls-1" x="11.5" y="6.6" width="4.5" height="4.5"/>
                        <rect class="cls-1" x="11.5" y="12.4" width="4.5" height="4.5"/>
                        <rect class="cls-1" x="5.8" y="6.6" width="4.5" height="4.5"/>
                        <rect class="cls-1" x="5.8" y="12.4" width="4.5" height="4.5"/>
                        <rect class="cls-1" y="6.6" width="4.5" height="4.5"/>
                        <rect class="cls-1" y="12.4" width="4.5" height="4.5"/>
                    </svg>
                </a>
                <a class="icon-grid" @click="setLayout('col-6')">
                    <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 17 17">
                        <rect class="cls-1" x=".5" y=".9" width="7.4" height="7.4"/>
                        <rect class="cls-1" x="9.1" y=".9" width="7.4" height="7.4"/>
                        <rect class="cls-1" x="9.1" y="9.5" width="7.4" height="7.4"/>
                        <rect class="cls-1" x=".5" y="9.5" width="7.4" height="7.4"/>
                    </svg>
                </a>
                <a class="icon-grid" @click="setLayout('list')">
                    <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 17 17">
                        <rect class="cls-1" x="5.8" y=".9" width="10.2" height="4.5"/>
                        <rect class="cls-1" y=".9" width="4.5" height="4.5"/>
                        <rect class="cls-1" x="5.8" y="6.7" width="10.2" height="4.5"/>
                        <rect class="cls-1" x="5.8" y="12.4" width="10.2" height="4.5"/>
                        <rect class="cls-1" y="6.7" width="4.5" height="4.5"/>
                        <rect class="cls-1" y="12.4" width="4.5" height="4.5"/>
                    </svg>
                </a>
            </div>
        </div><!-- cierre Layout switch buttons -->
    
    
        <!-- Display filtered products -->
        <div v-if="filteredProducts.data?.length > 0">
            <!-- Card Layout -->
            <div v-if="layout !== 'list'" class="row">
                <div :class="'card card-productos ' + layout" v-for="product in filteredProducts.data" :key="product.id">
                    <a :href="'single-product/' + product.slug" class="card-img" :class="{ 'hovered-img': hoveredTitle === product.id }">
                        <!-- <img src="/img/image-dummy-products.png" class="card-img-top" alt="imagen test"> -->
                        <img :src="getProductImage(product)" class="card-img-top" alt="imagen test">
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

            <!-- List Layout -->
            <div v-else class="row">
                <div class="card card-productos" v-for="product in filteredProducts.data" :key="product.id">
                    <div class="row g-0">
                        <div class="col-4">
                            <a :href="'single-product/' + product.slug" class="card-img" :class="{ 'hovered-img': hoveredTitle === product.id }">
                                <img src="/img/image-dummy-products.png" class="img-fluid" alt="imagen test">
                            </a>  
                        </div>
                        <div class="col-6">
                            <div class="card-body">   
                                <a 
                                    :href="'single-product/' + product.slug"
                                    @mouseenter="handleTitleMouseEnter(product.id)"
                                    @mouseleave="handleTitleMouseLeave"
                                >
                                    <h2 class="card-title">{{ product.name }}</h2>
                                </a>            
                                <p class="card-precio">{{ formatPrice(product.price) }}</p>
                                <p class="card-parrafo">{{ product.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- cierre Display filtered products -->

        <div v-else>
            No products found.
        </div>

        <Bootstrap5Pagination        
            :data="filteredProducts"   
            @pagination-change-page="fetchProducts"
        />
    </div><!-- cierre container -->

</template>

<script setup>
import { ref,computed, onMounted, reactive, watch } from "vue";
import SelectDbm from "../Dbm/SelectDbm.vue";
import SelectDbmStatic from "../Dbm/SelectDbmStatic.vue";

const products = ref([]);
const categories = ref([]);
const genders = ref([]);
const ageFilters = ref([]);
const searchQuery = ref('');
const layout = ref('col-3'); // Default layout
const setLayout = (newLayout) => {
  layout.value = newLayout;
};

//Hovered Product
const hoveredTitle = ref(null);

const handleTitleMouseEnter = (productId) => {
    hoveredTitle.value = productId;
};

const handleTitleMouseLeave = () => {
    hoveredTitle.value = null;
};

//Select first image from the galleries
const getProductImage = (product) => {
  return product.galleries && product.galleries.length > 0
    ? product.galleries[0].url
    : '/img/image-dummy-products.png';
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


const order = ref([
    {id: 1, value: "desc", name:"Lo más nuevo"},
    {id: 2, value: "price_asc", name:"Menor a mayor precio"},
    {id: 3, value: "price_desc", name:"Mayor a menor precio"},
])

const placeholderOrder = ref("Ordenar por");

//New for filters 
const selected = reactive({
  category_id: '',
  gender_id: null,
  min_price: '',
  max_price: '',
  age_filter_id: '',
  search_query: '',
  order: 'desc',
});

// Data results
const currentPageResults = ref(""); 
const totalResults = ref(null); 

//Categories Dropdown
const dropdown = ref(false);
const activeTrigger = ref(false);
const generateDataBsTarget = (categoryId) => {
    return `#panel-${categoryId}`;
};

const generateID = (id) => {
    return `panel-${id}`;
};

const showAndCloseDropdown = () => {
    if (dropdown.value == false) {
        dropdown.value = true;
        activeTrigger.value = true;
        TweenMax.fromTo(
            "#dropdown-cats",
            0.55,
            {
                autoAlpha: 0,
                y: -10,
            },
            {
                autoAlpha: 1,
                y: 0,
                ease: Power2.easeOut,
            }
        );
    } else {
        dropdown.value = false;
        activeTrigger.value = false;
        TweenMax.to("#dropdown-cats", 0.2, {
            autoAlpha: 0,
            y: -10,
            ease: Power2.easeOut,
        });
    }
};

const closeDropdown = () => {
    dropdown.value = false;
    activeTrigger.value = false;
    TweenMax.to("#dropdown-cats", 0.2, {
        autoAlpha: 0,
        y: -10,
        ease: Power2.easeOut,
    });
};

const filteredProducts = ref([]);

const fetchProducts = async (page = 1) => {
    try {
        // Ensure categoryId, genderId, and ageId are correctly checked before accessing their id properties
        const categoryId = selected.category_id ? selected.category_id.id : null;
        const genderId = selected.gender_id ? selected.gender_id.id : null;
        const ageId = selected.age_filter_id ? selected.age_filter_id.id : null;
        const response = await axios.get(`/api/tienda/all?page=${page}`, {
            params: { 
              ...selected, 
              category_id: categoryId,
              gender_id: genderId,
              min_price: selected.min_price,
              max_price: selected.max_price,
              age_filter_id: ageId,
              search_query: searchQuery.value,
              order: selected.order,
            },
        }); 
        products.value = response.data;
        if(response.data.to === null){
        currentPageResults.value = 0
        } else {
            currentPageResults.value = response.data.to;
        }    
        if (totalResults.value === null) {
          totalResults.value = response.data.total;  
        } else {
          totalResults.value = response.data.total; 
        }
        filteredProducts.value = products.value;
    } catch (error) {
        console.error("Error fetching products:", error);
    }
};

const fetchCategories = async () => {
    try {
        const response = await axios.get("/api/tienda/categories/all");  
        categories.value = response.data.categories;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

const fetchGenders = async () => {
  try{
    const response = await axios.get("/api/tienda/genders");
    genders.value = response.data;
  } catch (error){
      console.error("Error fetching agefilters:", error);
  }
}

const fetchAgeFilters = async () => {
  try{
    const response = await axios.get("/api/tienda/agefilter/all");
    ageFilters.value = response.data;
  } catch (error){
      console.error("Error fetching agefilters:", error);
  }
}

// Handle gender update
const updateSelectedGender = (newGender) => {
  selected.gender_id = newGender;
};

// Handle gender update
const updateSelectedOrder = (newOrder) => {
  selected.order = newOrder;
};

// Compute applied filters for display
const appliedFilters = computed(() => {
    const filters = [];
    if (selected.category_id) filters.push({ type: 'category_id', label: selected.category_id.name });
    if (selected.gender_id) filters.push({ type: 'gender_id', label: selected.gender_id.name });
    if (selected.min_price) filters.push({ type: 'min_price', label: `Min Price: ${selected.min_price}` });
    if (selected.max_price) filters.push({ type: 'max_price', label: `Max Price: ${selected.max_price}` });
    if (selected.age_filter_id) filters.push({ type: 'age', label: selected.age_filter_id.name });
    return filters;    
});


// Remove a specific filter
const removeFilter = (filterType) => {
    switch (filterType) {
        case 'category_id':
            selected.category_id = '';
            break;
        case 'gender_id':
            selected.gender_id = null;
            break;
        case 'min_price':
            selected.min_price = '';
            break;
        case 'max_price':
            selected.max_price = '';
            break;
        case 'age':
            selected.age_filter_id = '';
            break;
        default:
            break;
    }
    fetchProducts(); // Re-fetch products with updated filters
};

// Clear all filters
const clearFilters = () => {
    selected.category_id = '';
    selected.gender_id = null;
    selected.min_price = '';
    selected.max_price = '';
    selected.age_filter_id = '';
    fetchProducts(); // Re-fetch products with cleared filters
};

//Clear Search
const clearSearch = () => {
  searchQuery.value = '';
};

watch(
    () => [
      selected.category_id, 
      selected.gender_id, 
      selected.min_price, 
      selected.max_price, 
      selected.age_filter_id,
      searchQuery.value,
      selected.order
    ],
    () => fetchProducts()
);

onMounted(() => {
    fetchProducts();
    fetchCategories();
    fetchGenders();   
    fetchAgeFilters();   
});
</script>

<style scoped>
  :deep(.badge) {
    cursor: pointer;
  }
</style>