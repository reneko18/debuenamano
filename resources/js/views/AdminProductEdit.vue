<template>
    <div class="container">
        <div><h2>Presentación</h2></div>
        <div class="row">
            <div class="col-lg-5 col-md-12 left-column">
                <div>
                    <label for="productName" class="form-label">Nombre*</label>
                    <input
                        type="text"
                        class="form-control"
                        id="productName"
                        placeholder="Nombre del artículo"
                        v-model="productInfo.name"
                    />
                </div>
                <!-- <div
                    class="position-relative"
                    v-click-outside-element="closeDropdown"
                >
                    <div class="position-relative div-cat">
                        <label for="testCat" class="form-label"
                            >Categoría*</label
                        >
                        <input
                            id="testCat"
                            type="text"
                            class="form-control cat-select"
                            :value="productInfo?.category?.name"
                            @click="showAndCloseDropdown"
                            readonly
                        />
                        <i
                            class="fa-solid fa-chevron-down"
                            @click="showAndCloseDropdown"
                        ></i>
                    </div> 
                    <div id="dropdown-cats">
                        <div class="accordion" id="accordionCategories">
                            <div v-for="category in categories">
                                <div
                                    v-if="category.children == ''"
                                    class="cat-sin-hijo"
                                >
                                    <input
                                        :id="'cat-' + category.id"
                                        class="btn-check"
                                        :value="category.name"
                                        type="radio"
                                        name="categoria"
                                        v-model="finalCategory"
                                    />
                                    <label
                                        :for="'cat-' + category.id"
                                        class="btn"
                                        >{{ category.name }}</label
                                    >
                                </div>
                                <h2 v-else class="accordion-header">
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        :data-bs-target="
                                            generateDataBsTarget(category.id)
                                        "
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
                                        <div
                                            v-for="subcategory in category.children"
                                        >
                                            <div
                                                v-if="
                                                    category.id ==
                                                    subcategory.parent_id
                                                "
                                            >
                                                <input
                                                    :id="
                                                        'subcat-' +
                                                        subcategory.id
                                                    "
                                                    class="btn-check"
                                                    :value="subcategory.name"
                                                    type="radio"
                                                    name="categoria"
                                                    v-model="finalCategory"
                                                />
                                                <label
                                                    :for="
                                                        'subcat-' +
                                                        subcategory.id
                                                    "
                                                    class="btn"
                                                    >{{
                                                        subcategory.name
                                                    }}</label
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="cont-genre">
                    <label for="productGenre" class="form-label">Género</label>
                    <select
                        id="productGenre"
                        class="custom-select form-control-border"
                        v-model="productInfo.genre"
                    >         
                        <option value="Niño">Niño</option>
                        <option value="Niña">Niña</option>
                        <option value="Unisex">Unisex</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <span class="tit-age-range">Rango de edad de tu articulo*</span>
                <div class="row row-age-range">
                    <div class="col-md-2"> 
                        <input
                            type="number"
                            class="form-control"
                            placeholder="00"
                            id="age-pro"
                            v-model="productInfo.age_ini"
                        />
                    </div>
                    <div class="col-md-4">
                        <label for="neonat-pro" class="form-label"></label>
                        <select
                            id="neonat-pro"
                            class="custom-select form-control-border"
                            v-model="productInfo.age_date_ini"
                        >       
                            <option value="Recién nacido">Recién nacido</option>
                            <option value="Semanas">Semanas</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select>
                    </div>
                    <div
                        class="col-md-1 col-a flex-column justify-content-center"                       
                    >
                        <span>a</span>
                    </div>
                    <div class="col-md-2">
                        <label for="month-pro" class="form-label"></label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="00"
                            id="month-pro"
                            v-model="productInfo.age_fin"
                        />
                    </div>
                    <div class="col-md-3">
                        <label for="monthsel-pro" class="form-label"></label>
                        <select
                            id="monthsel-pro"
                            class="custom-select form-control-border"
                            v-model="productInfo.age_date_fin"
                        >     
                            <option value="Semanas">Semanas</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="desc-pro" class="form-label"
                        >Breve descripción*</label
                    >
                    <div class="position-relative">
                        <textarea
                            id="desc-pro"
                            class="form-control"
                            placeholder="Describe el artículo..."
                            v-model="productInfo.description"
                            @input="updateCharacterCount"                            
                            rows="4"
                            maxlength="280"
                        ></textarea>
                        <span class="character-count-badge"
                            >{{ characterCount }}/280 caracteres</span
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <a class="btn btn-primary" @click="UpdateProductStatus">Validar</a>
    </div>
</template>
<script setup>
import { ref, onMounted, onUpdated, watch } from "vue";
const props = defineProps({
    productSlug: { type: String, default: "" },
});

const productInfo = ref('');
const characterCount = ref(0);
// const textareaHeight = ref(100);
// const categories = ref([]);
// const dropdown = ref(false);
// const activeTrigger = ref(false);
// const finalCategory = ref('');

const updateCharacterCount = () => { 
            const text = productInfo.value.description;
            const newCharacterCount = text.length;
            characterCount.value = newCharacterCount;
};

watch(() => productInfo.value.description, (newValue) => {
    characterCount.value = newValue.length;
});

// const updateTextareaHeight = () => {
//             const catHeight =
//                 document.querySelector(".cat-select").offsetHeight + 24;
//             const genreHeight =
//                 document.querySelector(".cont-genre").offsetHeight;
//             const leftHeight = catHeight + genreHeight;

//             // Update the textareaHeight data property to match the left column height
//             textareaHeight.value = leftHeight;
// };

// const generateDataBsTarget = (categoryId) => {
//             // Generate the dynamic data-bs-target value
//             return `#panel-${categoryId}`;
// };
// const generateID = (id) => {
//             return `panel-${id}`;
// };

// const showAndCloseDropdown = () => {
//     if (dropdown.value == false) {
//         dropdown.value = true;
//         activeTrigger.value = true;
//         TweenMax.fromTo(
//             "#dropdown-cats",
//             0.55,
//             {
//                 autoAlpha: 0,
//                 y: -10,
//             },
//             {
//                 autoAlpha: 1,
//                 y: 0,
//                 ease: Power2.easeOut,
//             }
//         );
//     } else {
//         dropdown.value = false;
//         activeTrigger.value = false;
//         TweenMax.to("#dropdown-cats", 0.2, {
//             autoAlpha: 0,
//             y: -10,
//             ease: Power2.easeOut,
//         });
//     }
// };

// const closeDropdown = () => {
//     dropdown.value = false;
//     activeTrigger.value = false;
//     TweenMax.to("#dropdown-cats", 0.2, {
//         autoAlpha: 0,
//         y: -10,
//         ease: Power2.easeOut,
//     });
// };

const fetchData = async (product_id) => {
    try {
        const response = await axios.get(`/api/products/edit/${product_id}`);
        productInfo.value = response.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

const UpdateProductStatus = async() => {
    try {
        const response = await axios.put(
            `/api/product/updatestatus/${props.productSlug}`, 
            {
                name: productInfo.value.name,
                genre: productInfo.value.genre,
                age_ini: productInfo.value.age_ini,
                age_date_ini: productInfo.value.age_date_ini,
                age_fin: productInfo.value.age_fin,
                age_date_fin: productInfo.value.age_date_fin,
                description: productInfo.value.description,
                publish_status: 'En vitrina',
            }
        );  
        console.log("Product updated successfully:", response.data);
    } catch (error) {
        console.error("Error updating product:", error);
    }
}

// const fetchCategories = async() => {
//     try{
//         const response = await axios.get("/api/categories");
//         categories.value = response.data;
//     } catch (error){
//         console.error("Error fetching data:", error);
//     }
// };

// onUpdated(() => {
//     updateTextareaHeight();
// });

onMounted(() => {
    fetchData(props.productSlug);
    // fetchCategories();
});
</script>