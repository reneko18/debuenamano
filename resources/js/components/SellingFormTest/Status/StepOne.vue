<template>
    <div class="modulo-pasos">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <h2>
                    Cuéntanos, en que estado de uso se encuentra el artículo
                </h2>
                <p class="bajada-h2">
                    Tu transparencia nos ayuda a construir confianza entre los
                    compradores y garantiza una experiencia de compra
                    satisfactoria para todos.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div>
                    <label for="statusItem" class="form-label">Estado*</label>
                    <select
                        id="statusItem"
                        class="form-select"
                        :class="errorMessageStatus ? 'is-invalid-dbm' : ''"
                        v-model="formData.stepFourState"
                    >
                        <option disabled selected value="">
                            Seleccione un estado
                        </option>
                        <option value="Usado en buen estado">
                            Usado en buen estado
                        </option>
                        <option value="Sin uso">Sin uso</option>
                    </select>
                    <div v-if="errorMessageStatus" class="invalid-dbm">
                        {{ errorMessageStatus }}
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12" v-if="formData.stepFourState !== 'Sin uso'">
                <div class="row">
                    <div class="col-md-3">
                        <label for="usageItem" class="form-label"
                            >Tiempo de uso*</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            :class="errorMessageUsageTime ? 'is-invalid-dbm' : ''"
                            placeholder="00"
                            id="usageItem"
                            v-model="formData.stepFourUsageTime"
                            @input="handleNumericInput('stepFourUsageTime')"
                        />
                    </div>
                    <div class="col-md-4">
                        <label for="usageItem-pro" class="form-label"></label>
                        <select
                            id="usageItem-pro"
                            class="form-select"
                            :class="errorMessageUsageTime ? 'error-dbm' : ''"
                            v-model="formData.stepFourUsageUnit"
                        >
                            <option value="Dias">Dias</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select>
                    </div>
                </div>
                <div v-if="errorMessageUsageTime" class="invalid-dbm">
                    {{ errorMessageUsageTime }}
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
import { ref, onMounted, defineEmits } from "vue";

const emit  = defineEmits(["next-step", "constant-emitted"]);

const mainStep = 2;
const formStore = useFormStore();
const formData = formStore.formData;
const errorMessageStatus = ref('');
const errorMessageUsageTime = ref('');

const nextStep = () => {
    if (!formData.stepFourState) {
        // Set an error message and prevent the form from proceeding
        errorMessageStatus.value = "Por favor, ingrese un estado para el articulo";
        return;
    }
    if (!formData.stepFourUsageTime && formData.stepFourState !== 'Sin uso') {
        // Set an error message and prevent the form from proceeding
        errorMessageUsageTime.value = "Por favor, ingrese un tiempo de uso";
        return;
    }
    errorMessageStatus.value = null;
    errorMessageUsageTime.value = null;

    formStore.setFormData(formData);
    emit("next-step");
};

const handleNumericInput = (fieldName) => {
    // Get the current value from the corresponding data property
    let value = formData[fieldName];
    // Apply the numeric filtering logic
    value = value.replace(/[^0-9]/g, '');
    // Update the corresponding data property
    formData[fieldName] = value;
};

onMounted(() => {
    emit("constant-emitted", mainStep);
});
</script>