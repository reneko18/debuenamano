<template>    
    <div class="modulo-pasos step1-sell-form">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <h2>Cuéntanos ¿Qué artículo quieres vender?</h2>
                <p class="bajada-h2">
                    Nombra tu artículo, selecciona una categoría,
                    características que le corresponda y danos una breve
                    descripción.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12 left-column">
                <div>
                    <label for="productName" class="form-label">Nombre*</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="errorMessageName ? 'is-invalid-dbm' : ''"
                        id="productName"
                        placeholder="Nombre del artículo"
                        v-model="formData.stepOneNameProduct"
                    />
                    <div v-if="errorMessageName" class="invalid-dbm">
                        {{ errorMessageName }}
                    </div>
                </div>

                <div
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
                            :class="errorMessageCat ? 'is-invalid-dbm' : ''"
                            :value="formData.stepOneCategoryProduct.name"
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
                                <div
                                    v-if="category.children == ''"
                                    class="cat-sin-hijo"
                                >
                                    <input
                                        :id="'cat-' + category.id"
                                        class="btn-check"
                                        :value="category"
                                        type="radio"
                                        name="categoria"
                                        v-model="
                                            formData.stepOneCategoryProduct
                                        "
                                    />
                                    <label
                                        :for="'cat-' + category.id"
                                        class="btn"
                                        @click="closeDropdown"
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
                                                    :value="subcategory"
                                                    type="radio"
                                                    name="subcategoria"
                                                    v-model="
                                                        formData.stepOneCategoryProduct
                                                    "
                                                />
                                                <label
                                                    :for="
                                                        'subcat-' +
                                                        subcategory.id
                                                    "
                                                    class="btn"
                                                    @click="closeDropdown"
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
                    <div v-if="errorMessageCat" class="invalid-dbm">
                        {{ errorMessageCat }}
                    </div>
                </div>
                <div class="cont-genre">
                    <label for="productGenre" class="form-label">Género</label>
                    <select-dbm
                        id="productGenre"
                        :items="genders"   
                        :selected="formData.stepOneGenre"
                        @update:selected="updateSelectedGender"
                        placeholder="Seleccione un género"
                    />
                </div>
            </div>
            <div class="col-lg-7 col-md-12">                
                <div class="row row-age-range" :class="errorMessageRange ? 'error-dbm' : ''">  
                    <label for="range-age" class="form-label">Rango de edad de tu articulo*</label>
                    <select-dbm-static
                            id="range-age"
                            :items="rangeAge"   
                            :selected="formData.stepOneRangeAge"
                            @update:selected-static="updateSelectedRangeAge"
                            placeholder="Seleccione un rango"
                    />
                </div>
                <div v-if="errorMessageRange" class="invalid-dbm">
                    {{ errorMessageRange }}
                </div>

                <div>
                    <label for="desc-pro" class="form-label"
                        >Breve descripción*</label
                    >
                    <div class="position-relative">
                        <textarea
                            id="desc-pro"
                            class="form-control"
                            :class="errorMessageDesc ? 'is-invalid-dbm' : ''"
                            placeholder="Describe el artículo..."
                            v-model="formData.stepOneDescriptionProduct"
                            @input="updateCharacterCount"
                            :style="{ height: textareaHeight + 'px' }"
                            rows="4"
                            maxlength="280"
                        ></textarea>
                        <span class="character-count-badge"
                            >{{ characterCount }}/280 caracteres</span
                        >
                        <div v-if="errorMessageDesc" class="invalid-dbm">
                            {{ errorMessageDesc }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <button class="btn boton-principal" @click="nextStep">
            Continuar <font-awesome-icon :icon="['fas', 'chevron-right']" />
        </button>
    </div>
</template>
<script setup>
import { useFormStore } from "../../../stores/valuesTwo";
import { ref, watch , onMounted, defineEmits } from "vue";
import SelectDbm from "../../Dbm/SelectDbm.vue";
import SelectDbmStatic from "../../Dbm/SelectDbmStatic.vue";

const emit = defineEmits(["constant-emitted"]);

const mainStep = 1;
const formStore = useFormStore();
const formData = formStore.formData;
const characterCount = ref(0);
const errorMessageName = ref('');
const errorMessageCat = ref('');
const errorMessageRange = ref('');
const errorMessageDesc = ref('');
const dropdown = ref(false);
const activeTrigger = ref(false);
const textareaHeight = ref(100);
const categories = ref([]);
const genders = ref([]);
const rangeAge = ref([
    {id: 1, value: 1, name:"Recién nacido"},
    {id: 2, value: 2, name:"3 a 12 Meses"},
    {id: 3, value: 3, name:"12 a 24 Meses"},
    {id: 4, value: 4, name:"2 a 6 Años"},
    {id: 5, value: 5, name:"Todas las edades"},
]);

const fetchData = async () => {
    try {
        const response = await axios.get("/api/categories");
        categories.value = response.data.categories;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

const fetchGenders = async () => {
  try{
    const response = await axios.get("/api/product/getgenders");
    genders.value = response.data.map(gender => ({
        id: gender.id,
        name: gender.name,
        value: gender.id,
    }));
  } catch (error){
      console.error("Error fetching agefilters:", error);
  }
}

const nextStep = () => {
    if (!formData.stepOneNameProduct) {
        errorMessageName.value = "Por favor, ingrese un nombre para el artículo.";
        return;
    }

    if (!formData.stepOneCategoryProduct) {
        errorMessageCat.value = "Por favor, ingrese una categoría.";
        return;
    }
    if (!formData.stepOneRangeAge) {
        errorMessageRange.value = "Por favor, complete todos los campos de rango de edad.";
        return;
    }
    if (!formData.stepOneDescriptionProduct) {
        errorMessageDesc.value = "Por favor, ingrese una descripción para el artículo.";
        return;
    }

    errorMessageName.value = null;
    errorMessageCat.value = null;
    errorMessageRange.value = null;
    errorMessageDesc.value = null;

    formStore.setFormData(formData);
    emit("next-step");
};

const updateCharacterCount = () => {
    const text = formData.stepOneDescriptionProduct;
    const newCharacterCount = text.length;
    characterCount.value = newCharacterCount;
};

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

const updateTextareaHeight = () => {
    const catHeight = document.querySelector(".cat-select").offsetHeight + 24;
    const genreHeight = document.querySelector(".cont-genre").offsetHeight;
    const leftHeight = catHeight + genreHeight;
    textareaHeight.value = leftHeight;
};

// Handle gender update
const updateSelectedGender = (newGender) => {
    formData.stepOneGenre = newGender;
};

// Handle Range Age update
const updateSelectedRangeAge = (newRangeAge) => {
    formData.stepOneRangeAge = newRangeAge;
};

// Watch for changes in textareaHeight and update it accordingly
watch(() => [dropdown.value, activeTrigger.value], () => {
    updateTextareaHeight();
});

onMounted(() => {
    fetchData(); 
    fetchGenders();
    emit("constant-emitted", mainStep);
    updateTextareaHeight();
});
</script>