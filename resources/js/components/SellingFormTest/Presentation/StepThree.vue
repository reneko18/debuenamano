<template>
    <div class="modulo-pasos">
        <div class="cont-dimen-1">
            <div class="col-lg-8 col-md-12">
                <h2>01 Medidas y peso aproximado del artículo</h2>
                <p class="bajada-h2">
                    Esto nos ayudará a mostrar las dimensiones precisas en la
                    descripción y garantizar una experiencia de compra sin
                    sorpresas.
                </p>
            </div>
            <div class="row-main-dim">
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="height-pro" class="form-label">Alto*</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="errorMessageSize ? 'is-invalid-dbm' : ''"
                            placeholder="0,0"
                            id="height-pro"
                            v-model="formData.stepThreeHeightReal"  
                            @input="handleNumericInput('stepThreeHeightReal')"                          
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unh-pro" class="form-label"></label>
                        <select
                            id="unh-pro"
                            class="form-select"                      
                            v-model="formData.stepThreeHeightRealUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="width-pro" class="form-label">Ancho*</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="errorMessageSize ? 'is-invalid-dbm' : ''"
                            placeholder="0,0"
                            id="width-pro"
                            v-model="formData.stepThreeWidthReal"
                            @input="handleNumericInput('stepThreeWidthReal')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unw-pro" class="form-label"></label>
                        <select
                            id="unw-pro"
                            class="form-select"                  
                            v-model="formData.stepThreeWidthRealUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="long-pro" class="form-label">Largo*</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="errorMessageSize ? 'is-invalid-dbm' : ''"
                            placeholder="0,0"
                            id="long-pro"
                            v-model="formData.stepThreeLengthReal"
                            @input="handleNumericInput('stepThreeLengthReal')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unl-pro" class="form-label"></label>
                        <select
                            id="unl-pro"
                            class="form-select"                   
                            v-model="formData.stepThreeLengthRealUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
            </div>
            <div v-if="errorMessageSize" class="invalid-dbm">
                    {{ errorMessageSize }}
            </div>
        </div>
        <div class="cont-dimen-2">
            <div class="col-lg-8 col-md-12">
                <h2>02 Medidas y peso artículo embalado</h2>
                <p class="bajada-h2">
                    Basándote en las dimensiones de arriba, ¿Tu artículo
                    embalado para envío sería pequeño o algo más grande?. Te
                    invitamos a elegir el tamaño de embalaje definido por
                    Chilexpress que mejor se adapte a tu artículo
                </p>
            </div>
            <div class="row-main-dim">
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="height-pro" class="form-label">Alto*</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="errorMessageSize ? 'is-invalid-dbm' : ''"
                            placeholder="0,0"
                            id="height-pro"
                            v-model="formData.stepThreeHeight"  
                            @input="handleNumericInput('stepThreeHeight')"                          
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unh-pro" class="form-label"></label>
                        <select
                            id="unh-pro"
                            class="form-select"                      
                            v-model="formData.stepThreeHeightUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="width-pro" class="form-label">Ancho*</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="errorMessageSize ? 'is-invalid-dbm' : ''"
                            placeholder="0,0"
                            id="width-pro"
                            v-model="formData.stepThreeWidth"
                            @input="handleNumericInput('stepThreeWidth')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unw-pro" class="form-label"></label>
                        <select
                            id="unw-pro"
                            class="form-select"                  
                            v-model="formData.stepThreeWidthUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="long-pro" class="form-label">Largo*</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="errorMessageSize ? 'is-invalid-dbm' : ''"
                            placeholder="0,0"
                            id="long-pro"
                            v-model="formData.stepThreeLength"
                            @input="handleNumericInput('stepThreeLength')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unl-pro" class="form-label"></label>
                        <select
                            id="unl-pro"
                            class="form-select"                   
                            v-model="formData.stepThreeLengthUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="weight-pro" class="form-label">Peso</label>
                        <input
                            type="text"
                            class="form-control"
                            :class="errorMessageSize ? 'is-invalid-dbm' : ''"
                            placeholder="0,0"
                            id="weight-pro"
                            v-model="formData.stepThreeWeight"
                            @input="handleNumericInput('stepThreeWeight')"
                        />
                    </div>
                    <div class="col-dim position-relative">
                        <label for="unwe-pro" class="form-label"></label>
                        <select
                            id="unwe-pro"
                            class="form-select"                 
                            v-model="formData.stepThreeWeightUnit"
                        >
                            <option value="g">g</option>
                            <option value="Kg">Kg</option>
                        </select>
                        <!-- Custom Tooltip -->
                        <div class="info-tool">
                            <svg
                                version="1.1"
                                id="info-svg"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                x="0px"
                                y="0px"
                                viewBox="0 0 17 17"
                                style="enable-background: new 0 0 17 17"
                                xml:space="preserve"
                                @mouseenter="showTooltip = true"
                                @mouseleave="showTooltip = false"
                            >
                                <path
                                    class="st0"
                                    d="M8.5,16c4.1,0,7.5-3.4,7.5-7.5C16,4.4,12.6,1,8.5,1C4.4,1,1,4.4,1,8.5C1,12.6,4.4,16,8.5,16z"
                                />
                                <path class="st0" d="M8.5,11.5v-3" />
                                <path class="st0" d="M8.5,5.5L8.5,5.5" />
                            </svg>
                        </div>
                        <div class="custom-tooltip" v-if="showTooltip">
                            <p>
                                El peso del artículo es importante. Si no lo
                                tienes a mano, te sugerimos buscar el dato en el
                                sitio web del proveedor.
                            </p>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <button class="btn boton-principal" @click="nextStep">
            Guardar etapa y continuar<font-awesome-icon
                :icon="['fas', 'chevron-right']"
            />
        </button>
    </div>    
</template>
<script setup>

import { useFormStore } from "../../../stores/valuesTwo";
import { ref, onMounted, defineEmits } from "vue";

const emit = defineEmits(["next-step", "constant-emitted", "active-subtitles","close-step"]);

const mainStep = 1;
const subValue = 1;
const closeStep = 1;
const formStore = useFormStore();
const formData = formStore.formData;
const errorMessageSize = ref('');

const nextStep = async () => {
    if (!formData.stepThreeHeightReal || !formData.stepThreeWidthReal ||  !formData.stepThreeLengthReal || !formData.stepThreeHeight || !formData.stepThreeWidth ||  !formData.stepThreeLength || !formData.stepThreeWeight) {
        // Set an error message and prevent the form from proceeding
        errorMessageSize.value = "Por favor, complete todos los campos para las dimensiones.";
        return;
    }
    errorMessageSize.value = null;
    formStore.setFormData(formData);
    try {
        await submitForm();
        // Introduce a delay of 4 seconds before triggering the emits
        setTimeout(() => {
            emit("next-step");
            emit("active-subtitles", subValue);
            emit("close-step",closeStep);
        }, 2000); 
    } catch (error) {
        console.error(error);
    }
};

const handleNumericInput = (fieldName) => {
    // Get the current value from the corresponding data property
    let value = formData[fieldName];
    // Apply the numeric filtering logic
    value = value.replace(/[^0-9]/g, '');
    // Update the corresponding data property
    formData[fieldName] = value;
};

const submitForm = async () => {
    try {
        const csrfToken = document.head.querySelector(
            'meta[name="csrf-token"]'
        ).content;
        console.log("CSRF Token:", csrfToken);  
        console.log("Datos: ",formData);
        const response = await axios.post(
            "/api/product/store/one",
            formData,
            {
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            }
        );

        console.log(response);             
    } catch (error) {
        console.error(error.response.data);
    }
};

onMounted(() => {
    emit("constant-emitted", mainStep);
});
</script>