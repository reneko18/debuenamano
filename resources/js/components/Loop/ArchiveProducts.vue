<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- <select class="form-select" v-model="selectedCategory" @change="applyFilters">
                    <option value="">Todas las categorias</option>
                    <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                </select> -->
                <div  class="position-relative" v-click-outside-element="closeDropdown">
                  <div class="position-relative div-cat">
                      <input
                          type="text"
                          class="form-control cat-select"
                          :value="selectedCategory.name"
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
                                      v-model="selectedCategory"
                                      @change="applyFilters"
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
                                                  v-model="selectedCategory"
                                                  @change="applyFilters"
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
            </div>
            <div class="col">
                <select class="form-select" v-model="selectedGenre" @change="applyFilters">
                    <option value="">Todos los géneros</option>
                    <option v-for="genre in genres" :value="genre.name">{{ genre.name }}</option>
                </select>
            </div>
            <!-- Age Filter -->
            <div class="col">
              <input type="text" class="form-control" v-model="iniAge" v-if="iniAgeDate !== 'Recién nacido'" @input="applyFilters" placeholder="Edad Inicial">
              <select class="form-select" v-model="iniAgeDate" @change="applyFilters">
                <option value="" disabled>Seleccione</option>
                <option value="Recién nacido">Recién nacido</option>
                <option value="Semanas">Semanas</option>
                <option value="Meses">Meses</option>
                <option value="Años">Años</option>
              </select>
              <input type="text" class="form-control" v-model="endAge" v-if="iniAgeDate !== 'Recién nacido'" @input="applyFilters" placeholder="Edad Final">
              <select class="form-select" v-model="endAgeDate" v-if="iniAgeDate !== 'Recién nacido'" @change="applyFilters">
                <option value="" disabled>Seleccione</option>
                <option value="Semanas">Semanas</option>
                <option value="Meses">Meses</option>
                <option value="Años">Años</option>
              </select>
            </div>

            <div class="col">                
                <input type="text" class="form-control" v-model="minPrice" @input="applyFilters" placeholder="Mínimo">
                <input type="text" class="form-control" v-model="maxPrice" @input="applyFilters" placeholder="Máximo">
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
        {{ filter }} <button class="btn-close btn-close-white" @click="removeFilter(index)"></button>
      </span>
    </div>

    <!-- Layout switch buttons -->
    <div class="mb-3">
      <button class="btn btn-primary me-2" @click="setLayout('col-3')">4 Cards per Row</button>
      <button class="btn btn-secondary me-2" @click="setLayout('col-4')">3 Cards per Row</button>
      <button class="btn btn-info me-2" @click="setLayout('col-6')">2 Cards per Row</button>
      <button class="btn btn-success" @click="setLayout('list')">List Layout</button>
    </div>

    <!-- Display filtered products -->
    <div v-if="filteredProducts.length > 0">
      <!-- Card Layout -->
      <div v-if="layout !== 'list'" class="row">
        <div :class="'card ' + layout" v-for="product in filteredProducts" :key="product.id">
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
        <div class="col-12 row" v-for="product in filteredProducts" :key="product.id">
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



</template>
<script setup>
import { ref, onMounted, watchEffect } from "vue";

const products = ref([]);
const categories = ref([]);
const genres = ref([
  { name: "Niño" },
  { name: "Niña" },
  { name: "Unisex" }
]);
const selectedCategory = ref('');
const selectedGenre = ref('');
const minPrice = ref('');
const maxPrice = ref('');
const iniAge = ref('');
const iniAgeDate = ref('');
const endAge = ref('');
const endAgeDate = ref('');
const layout = ref('col-3'); // Default layout
// const isCardLayout = ref(true); // Boolean to track the current layout
const setLayout = (newLayout) => {
  layout.value = newLayout;
};

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

const fetchProducts = async () => {
    try {
        const response = await axios.get("/api/tienda/all");  
        products.value = response.data;
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
        console.error("Error fetching products:", error);
    }
};

const applyFilters = () => {
  filteredProducts.value = products.value.filter(product => {
    // return (!selectedCategory.value || product.category_id === selectedCategory.value) &&
    //        (!selectedGenre.value || product.genre === selectedGenre.value);
    // Filter by category
    const categoryPass = !selectedCategory.value || product.category_id === selectedCategory.value.id;
    // Filter by Genre
    const genrePass = !selectedGenre.value || product.genre === selectedGenre.value;
    // Filter by price range
    const minPass = !minPrice.value || parseFloat(product.price) >= parseFloat(minPrice.value);
    const maxPass = !maxPrice.value || parseFloat(product.price) <= parseFloat(maxPrice.value);

    // Age filter logic
    let agePass = true;
    if (iniAgeDate.value === 'Recién nacido') {
      agePass = product.age_date_ini === 'Recién nacido';
    } else {
      const iniAgePass = !iniAge.value || (parseInt(product.age_ini) >= parseInt(iniAge.value) && product.age_date_ini === iniAgeDate.value);
      const endAgePass = !endAge.value || (parseInt(product.age_fin) <= parseInt(endAge.value) && product.age_date_fin === endAgeDate.value);
      agePass = iniAgePass && endAgePass;
    }

    return categoryPass && genrePass && minPass && maxPass && agePass;
  });
};

const appliedFilters = ref([]);

const removeFilter = (index) => {
  appliedFilters.value.splice(index, 1);
  if (appliedFilters.value.length === 0) {
    selectedCategory.value = '';
    selectedGenre.value = '';
    minPrice.value = '';
    maxPrice.value = '';
    iniAge.value = '';
    iniAgeDate.value = '';
    endAge.value = '';
    endAgeDate.value = '';
  }
  applyFilters();
};

const clearFilters = () => {
  selectedCategory.value = '';
  selectedGenre.value = '';
  minPrice.value = '';
  maxPrice.value = '';
  iniAge.value = '';
  iniAgeDate.value = '';
  endAge.value = '';
  endAgeDate.value = '';
  appliedFilters.value = [];
  applyFilters();
};


// Watch for changes in selectedCategory, minPrice, and maxPrice to update appliedFilters
watchEffect(() => {
  appliedFilters.value = [];
  // if (selectedCategory.value) {
  //   const category = categories.value.find(cat => cat.id === selectedCategory.value.id);
  //   if (category) appliedFilters.value.push(category.name);
  // }
  if (selectedCategory.value) {
        appliedFilters.value.push(selectedCategory.value.name);
  }
  if (selectedGenre.value) {
    const genre = genres.value.find(gen => gen.name === selectedGenre.value);
    if (genre) appliedFilters.value.push(genre.name);
  }
  if (minPrice.value) appliedFilters.value.push(`Mínimo: ${minPrice.value}`);
  if (maxPrice.value) appliedFilters.value.push(`Máximo: ${maxPrice.value}`);
  if (iniAge.value || iniAgeDate.value === 'Recién nacido') {
    appliedFilters.value.push(`Edad Inicial: ${iniAge.value} ${iniAgeDate.value}`);
  }
  if (endAge.value) {
    appliedFilters.value.push(`Edad Final: ${endAge.value} ${endAgeDate.value}`);
  }
});

onMounted(() => {
    fetchProducts();
    fetchCategories();    
});
</script>

<style scoped>
  :deep(.badge) {
    cursor: pointer;
  }
</style>