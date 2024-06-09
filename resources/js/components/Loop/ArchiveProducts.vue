<template>
    <div class="container">
        <div class="row">
            <!-- Search Input -->
            <div class="col-12">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Buscar producto"
                        v-model="searchQuery"
                        @keyup.enter="fetchProducts"
                    />
                    <button class="btn btn-outline-secondary" type="button" @click="fetchProducts">Buscar</button>
                </div>
            </div>
            <!--Results-->
            <div>
                <p>{{ currentPageResults }} de {{ totalResults }} resultados</p>
            </div>
            <!--Age Filters-->
            <div class="col-12">
              <div class="d-flex flex-wrap">
                <div v-for="age in ageFilters" :key="age.id" class="me-2 mb-2">
                  <input
                    type="radio"
                    class="btn-check"
                    name="age-filters"
                    :id="'age-' + age.id"
                    autocomplete="off"
                    :value="age"
                    v-model="selected.age_filter_id"
                  />
                  <label class="btn btn-secondary" :for="'age-' + age.id">{{ age.name }}</label>
                </div>
              </div>
            </div>
            <!--End Age Filters-->
            <div class="col">
                <div  class="position-relative" v-click-outside-element="closeDropdown">
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
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>            
                  </div>
              </div>
              <!--End Dropdown Cats-->
            </div>
            <!-- Genre -->
            <div class="col">
                <select class="form-select" v-model="selected.genre">
                    <option value="">Todos los géneros</option>
                    <option v-for="genre in genres" :value="genre.name">{{ genre.name }}</option>
                </select>
            </div>

            <div class="col">                
                <input type="text" class="form-control" v-model="selected.min_price" placeholder="Mínimo">
                <input type="text" class="form-control" v-model="selected.max_price" placeholder="Máximo">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button class="btn btn-danger" @click="clearFilters">Clear All Filters</button>
            </div>
        </div>
    </div>

    <!-- Selected filters tags -->
    <div class="mb-3">
      <span v-for="(filter, index) in appliedFilters" :key="index" class="badge bg-secondary me-1">
        {{ filter.label }} 
        <button class="btn-close btn-close-white" @click="removeFilter(filter.type)"></button>
      </span>
    </div>

    <!--Order products-->
    <div class="col">
        <label for="order-shop" class="mb-3">Ordenar por</label>
        <select
            id="order-shop"
            class="form-select"
            v-model="selected.order"
        >
            <option value="asc">Ascendente</option>
            <option value="desc">Descendente</option>
        </select>
    </div>

    <!-- Layout switch buttons -->
    <div class="mb-3">
      <button class="btn btn-primary me-2" @click="setLayout('col-3')">4 Cards per Row</button>
      <button class="btn btn-secondary me-2" @click="setLayout('col-4')">3 Cards per Row</button>
      <button class="btn btn-info me-2" @click="setLayout('col-6')">2 Cards per Row</button>
      <button class="btn btn-success" @click="setLayout('list')">List Layout</button>
    </div>

    <!-- Display filtered products -->
    <div v-if="filteredProducts.data?.length > 0">
      <!-- Card Layout -->
      <div v-if="layout !== 'list'" class="row">
        <div :class="'card ' + layout" v-for="product in filteredProducts.data" :key="product.id">
          <a :href="'single-product/' + product.slug">
            <img src="/img/image-dummy-products.png" class="card-img-top" alt="imagen test">
          </a>          
          <div class="card-body">
            <a :href="'single-product/' + product.slug">
              <h5 class="card-title">{{ product.name }}</h5>
            </a>            
            <p class="card-text">$ {{ product.price }}</p>
          </div>
        </div>
      </div>

      <!-- List Layout -->
      <div v-else class="row">
        <div class="col-12 row" v-for="product in filteredProducts.data" :key="product.id">
          <div class="col-4">
            <a :href="'single-product/' + product.slug">
              <img src="/img/image-dummy-products.png" class="card-img-top" alt="imagen test">
            </a>  
          </div>
          <div class="col-8">
            <a :href="'single-product/' + product.slug">
              <h5>{{ product.name }}</h5>
            </a>            
            <p>$ {{ product.price }}</p>
            <p>{{ product.description }}</p>
          </div>
        </div>
      </div>

    </div>
    <div v-else>
      No products found.
    </div>

    <Bootstrap5Pagination        
        :data="filteredProducts"   
        @pagination-change-page="fetchProducts"
    />

</template>
<script setup>
import { ref,computed, onMounted, reactive, watch } from "vue";

const products = ref([]);
const categories = ref([]);
const ageFilters = ref([]);
const searchQuery = ref('');
const genres = ref([
  { name: "Niño" },
  { name: "Niña" },
  { name: "Unisex" }
]);
const layout = ref('col-3'); // Default layout
const setLayout = (newLayout) => {
  layout.value = newLayout;
};

//New for filters 
const selected = reactive({
  category_id: '',
  genre: '',
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
        let categoryId = selected.category_id.id;
        if (!categoryId) {
            categoryId = null;
        }
        let ageId = selected.age_filter_id.id;
        if (!ageId) {
            ageId = null;
        }
        const response = await axios.get(`/api/tienda/all?page=${page}`, {
            params: { 
              ...selected, 
              category_id: categoryId,
              genre: selected.genre,
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

const fetchAgeFilters = async () => {
  try{
    const response = await axios.get("/api/tienda/agefilter/all");
    ageFilters.value = response.data;
  } catch (error){
      console.error("Error fetching agefilters:", error);
  }
}

// Compute applied filters for display
const appliedFilters = computed(() => {
    const filters = [];
    if (selected.category_id) filters.push({ type: 'category_id', label: selected.category_id.name });
    if (selected.genre) filters.push({ type: 'genre', label: selected.genre });
    if (selected.min_price) filters.push({ type: 'min_price', label: `Min Price: ${selected.min_price}` });
    if (selected.max_price) filters.push({ type: 'max_price', label: `Max Price: ${selected.max_price}` });
    if (selected.age_filter_id) filters.push({ type: 'age', label: selected.age_filter_id.name });
    return filters;
});

// Remove a specific filter
// Remove a specific filter
const removeFilter = (filterType) => {
    switch (filterType) {
        case 'category_id':
            selected.category_id = '';
            break;
        case 'genre':
            selected.genre = '';
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
    selected.genre = '';
    selected.min_price = '';
    selected.max_price = '';
    selected.age_filter_id = '';
    fetchProducts(); // Re-fetch products with cleared filters
};

watch(
    () => [
      selected.category_id, 
      selected.genre, 
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
    fetchAgeFilters();   
});
</script>

<style scoped>
  :deep(.badge) {
    cursor: pointer;
  }
</style>