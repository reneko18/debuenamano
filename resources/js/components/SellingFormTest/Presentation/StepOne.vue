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
                    <!-- <select
                        id="productGenre"
                        class="form-select"
                        v-model="formData.stepOneGenre"
                    >
                        <option disabled selected value="">
                            Seleccione un género
                        </option>
                        <option value="Niño">Niño</option>
                        <option value="Niña">Niña</option>
                        <option value="Unisex">Unisex</option>
                    </select> -->
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
                <span class="tit-age-range">Rango de edad de tu articulo*</span>
                <div class="row row-age-range" :class="errorMessageRange ? 'error-dbm' : ''">  
                    <div class="col-md-2" v-if="formData.stepOneShowFirstInput">
                        <input                            
                            type="text"
                            class="form-control"
                            :class="errorMessageRange ? 'is-invalid-dbm' : ''"
                            placeholder="00"
                            id="age-pro"
                            v-model="formData.stepOneAgeIni"  
                            @input="handleNumericInput('stepOneAgeIni')"                          
                        />
                    </div>
                    <div class="col-md-4">   
                        <!-- <select
                            id="neonat-pro"
                            class="form-select"                            
                            v-model="formData.stepOneAgeDateIni"
                        >
                            <option value="Recién nacido">Recién nacido</option>
                            <option value="Semanas">Semanas</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select> -->
                        <select-dbm-static
                            id="neonat-pro"
                            :items="ageDataIni"   
                            :selected="formData.stepOneAgeDateIni"
                            @update:selected-static="updateSelectedAgeIni"
                            placeholder="Seleccione"
                        />
                    </div>
                    <div
                        v-if="formData.stepOneShowFirstInput"
                        class="col-md-1 col-a flex-column justify-content-center"   
                    >
                        <span>a</span>
                    </div>
                    <div v-if="formData.stepOneShowFirstInput" class="col-md-2">  
                        <input
                            type="text"
                            class="form-control"
                            :class="errorMessageRange ? 'is-invalid-dbm' : ''"
                            placeholder="00"
                            id="month-pro"
                            v-model="formData.stepOneAgeFin"
                            @input="handleNumericInput('stepOneAgeFin')"                            
                        />
                    </div>
                    <div  v-if="formData.stepOneShowFirstInput" class="col-md-3">              
                        <!-- <select
                            id="monthsel-pro"
                            class="form-select"                           
                            v-model="formData.stepOneAgeDateFin"
                        >
                            <option value="Semanas">Semanas</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select> -->
                        <select-dbm-static
                            id="monthsel-pro"
                            :items="ageDataFin"   
                            :selected="formData.stepOneAgeDateFin"
                            @update:selected-static="updateSelectedAgeFin"
                            placeholder="Seleccione"
                        />
                    </div>
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
const ageDataIni = ref([
    {id: 1, value: "Recién nacido", name:"Recién nacido"},
    {id: 2, value: "Semanas", name:"Semanas"},
    {id: 3, value: "Meses", name:"Meses"},
    {id: 4, value: "Años", name:"Años"},
]);

const ageDataFin = ref([
    {id: 1, value: "Semanas", name:"Semanas"},
    {id: 2, value: "Meses", name:"Meses"},
    {id: 3, value: "Años", name:"Años"},
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
    const response = await axios.get("/api/tienda/genders");
    genders.value = response.data;
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
    if (!formData.stepOneAgeFin) {
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

const handleNumericInput = (fieldName) => {
    let value = formData[fieldName];
    value = value.replace(/[^0-9]/g, '');
    formData[fieldName] = value;
};

// Handle gender update
const updateSelectedGender = (newGender) => {
    formData.stepOneGenre = newGender;
};

// Handle Age Ini update
const updateSelectedAgeIni = (newAgeDateIni) => {
    formData.stepOneAgeDateIni = newAgeDateIni;
};

// Handle Age Fin update
const updateSelectedAgeFin = (newAgeDateFin) => {
    formData.stepOneAgeDateFin = newAgeDateFin;
};


// Watch for changes in formData.stepOneAgeDateIni
watch(() => formData.stepOneAgeDateIni, (newValue, oldValue) => {
    if (newValue === "Recién nacido") {
        formData.stepOneShowFirstInput = false; // Hide the second select
    } else {
        formData.stepOneShowFirstInput = true; // Show the second select
    }
});

// Watch for changes in textareaHeight and update it accordingly
watch(() => [dropdown.value, activeTrigger.value], () => {
    updateTextareaHeight();
});

// // Call updateTextareaHeight initially to set the correct height
// updateTextareaHeight();

onMounted(() => {
    fetchData(); // Fetch categories data
    fetchGenders();
    emit("constant-emitted", mainStep);
    updateTextareaHeight();
});
</script>