<template>
    <div class="modulo-pasos">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <h2>¿Cuál es el precio de venta de tu artículo?</h2>
                <p class="bajada-h2">
                    Define el precio de venta de tu articulo considerando la
                    comisión de DBM.
                </p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="input-group mb-3">
                <span class="input-group-text">$</span>
                <input
                    type="text"
                    class="form-control input-precio"
                    id="priceItem"
                    placeholder="Precio"
                    v-model="formData.stepEightPrice"
                    @input="feeDBM"
                    v-price-format
                />
            </div>
            <div class="row row-income">
                <div class="col">
                    <p>- $ {{ isNaN(formData.stepEightPriceFee) ? 'Ingrese un precio valido' : formData.stepEightPriceFee }}</p>
                    <p><strong class="price-income">$ {{ isNaN(formData.stepEightPriceFinalAmount) ? 'Ingrese un precio valido' : formData.stepEightPriceFinalAmount }}</strong></p>
                </div>
                <div class="col text-right">
                    <p>Comisión DBM 22%</p>
                    <p><strong>Tu ganancia</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <button class="btn boton-principal" @click="nextStep">
            Guardar etapa y continuar<font-awesome-icon :icon="['fas', 'chevron-right']" />
        </button>
    </div>
    <Toast />
</template>
<script setup>
import Toast from 'primevue/toast';
import { useFormStore } from "../../../stores/valuesTwo";
import { onMounted, defineEmits } from "vue";

const emit = defineEmits(["next-step", "constant-emitted", "active-subtitles"]);

const toast = useToast();

const mainStep = 4;
const subValue = 2;
const formStore = useFormStore();
const formData = formStore.formData;
let fee = 0;
let finalAmount = 0;

//VER EL TEMA DEL FORMATO DEL PRECIO

// const priceFormatDirective = {
//     mounted(el, binding) {
//         const context = binding.instance;

//         el.addEventListener("input", function (e) {
//             // Remove non-numeric characters
//             const value = e.target.value.replace(/[^0-9]/g, "");

//             // Insert a point separator for thousands
//             const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

//             // Set the formatted value as a string
//             e.target.value = formattedValue;

//             // Save the formatted string to formData.stepEightPrice
//             // If you need to save the numeric value, convert it back to a number
//             // context.formData.stepEightPrice = parseFloat(value);
//             context.formData.stepEightPrice = formattedValue;
//         });
//     },
// };

const nextStep = () => {
    formStore.setFormData(formData);
    emit("next-step");
    emit("active-subtitles", subValue);
};



const feeDBM = () => {
    // Remove dots to get the raw number for calculations
    const rawPrice = formData.stepEightPrice.replace(/[.]/g, "");
    // Check if rawPrice is a valid number
    if (!isNaN(rawPrice)) {
        fee = Math.round(rawPrice * 0.22);
        finalAmount = rawPrice - fee;

        // Convert numeric values to strings and format with point as separator and no decimal places
        formData.stepEightPriceFee = fee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        formData.stepEightPriceFinalAmount = finalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    } else {
        // Set a default message when the input is not a valid number
        formData.stepEightPriceFee = 'Ingrese un precio valido';
        formData.stepEightPriceFinalAmount = 'Ingrese un precio valido';
    }
};

onMounted(() => {
    emit("constant-emitted", mainStep);
});
</script>

