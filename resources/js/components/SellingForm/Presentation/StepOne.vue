<template>    
    <div class="modulo-pasos">
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
                    <select
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
                    </select>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <span class="tit-age-range">Rango de edad de tu articulo*</span>
                <div class="row row-age-range" :class="errorMessageRange ? 'error-dbm' : ''">  
                    <div class="col-md-2" v-if="formData.stepOneShowFirstInput">
                        <input                            
                            type="number"
                            class="form-control"
                            :class="errorMessageRange ? 'is-invalid-dbm' : ''"
                            placeholder="00"
                            id="age-pro"
                            v-model="formData.stepOneAgeIni"
                        />
                    </div>
                    <div class="col-md-4">   
                        <select
                            id="neonat-pro"
                            class="form-select"                            
                            v-model="formData.stepOneAgeDateIni"
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
                        <input
                            type="number"
                            class="form-control"
                            :class="errorMessageRange ? 'is-invalid-dbm' : ''"
                            placeholder="00"
                            id="month-pro"
                            v-model="formData.stepOneAgeFin"
                        />
                    </div>
                    <div class="col-md-3">              
                        <select
                            id="monthsel-pro"
                            class="form-select"                           
                            v-model="formData.stepOneAgeDateFin"
                        >
                            <option value="Semanas">Semanas</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select>
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
<script>
import { useFormStore } from "../../../stores/values";
import { ref, computed, onMounted } from "vue";

export default {
    emits: ["nextStep", "constant-emitted"],
    data() {
        return {
            categories: [],            
            dropdown: false,
            activeTrigger: false,
            textareaHeight: 100,            
        };
    },
    watch: {
        "formData.stepOneAgeDateIni": function (newValue, oldValue) {
            if (newValue === "Recién nacido") {
                this.formData.stepOneShowFirstInput = false; // Hide the second select
            } else {
                this.formData.stepOneShowFirstInput = true; // Show the second select
            }
        },
    },
    updated() {
        this.updateTextareaHeight();
    },
    created() {
        // Make an Axios GET request to your API
        axios
            .get("/api/categories")
            .then((response) => {
                this.categories = response.data.categories;
            })
            .catch((error) => {
                console.error("Error fetching categories:", error);
            });
    },
    setup(_, { emit }) {
        const mainStep = 1;
        const formStore = useFormStore();
        const formData = formStore.formData;
        // const characterCount = computed(() => formStore.characterCount);
        const characterCount = ref(0);
        const errorMessageName = ref('');
        const errorMessageCat = ref('');
        const errorMessageRange = ref('');
        const errorMessageDesc = ref('');

        onMounted(() => {
            emit("constant-emitted", mainStep);
        });

        const nextStep = () => {
            if (!formData.stepOneNameProduct) {
                // Set an error message and prevent the form from proceeding
                errorMessageName.value = "Por favor, ingrese un nombre para el artículo.";
                return;
            }

            if (!formData.stepOneCategoryProduct) {
                // Set an error message and prevent the form from proceeding
                errorMessageCat.value = "Por favor, ingrese una categoría.";
                return;
            }
            if (!formData.stepOneAgeFin) {
                // Set an error message and prevent the form from proceeding
                errorMessageRange.value = "Por favor, complete todos los campos de rango de edad.";
                return;
            }
            if (!formData.stepOneDescriptionProduct) {
                // Set an error message and prevent the form from proceeding
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

        // const updateCharacterCount = () => {
        //     // // const textWithoutSpaces =
        //     // //     formData.stepOneDescriptionProduct.replace(/\s/g, "");
        //     // const newCharacterCount = textWithoutSpaces.length;
        //     // formStore.setCharacterCount(newCharacterCount);
        // };

        const updateCharacterCount = () => {
            const text = formData.stepOneDescriptionProduct;
            const newCharacterCount = text.length;
            characterCount.value = newCharacterCount;
        };

        return {
            characterCount,
            formData, 
            errorMessageName,
            errorMessageCat,
            errorMessageRange,
            errorMessageDesc,
            nextStep,           
            updateCharacterCount,
        };
    },
    methods: {
        generateDataBsTarget(categoryId) {
            // Generate the dynamic data-bs-target value
            return `#panel-${categoryId}`;
        },
        generateID(id) {
            return `panel-${id}`;
        },
        showAndCloseDropdown() {
            if (this.dropdown == false) {
                this.dropdown = true;
                this.activeTrigger = true;
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
                this.dropdown = false;
                this.activeTrigger = false;
                TweenMax.to("#dropdown-cats", 0.2, {
                    autoAlpha: 0,
                    y: -10,
                    ease: Power2.easeOut,
                });
            }
        },
        closeDropdown() {
            this.dropdown = false;
            this.activeTrigger = false;
            TweenMax.to("#dropdown-cats", 0.2, {
                autoAlpha: 0,
                y: -10,
                ease: Power2.easeOut,
            });
        },
        updateTextareaHeight() {
            const catHeight =
                document.querySelector(".cat-select").offsetHeight + 24;
            const genreHeight =
                document.querySelector(".cont-genre").offsetHeight;
            const leftHeight = catHeight + genreHeight;

            // Update the textareaHeight data property to match the left column height
            this.textareaHeight = leftHeight;
        },
    },
};
</script>
