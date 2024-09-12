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
                    v-model="formattedPrice"
                    @input="handleInput"
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
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <h3>Precio de referencia</h3>
                <p class="bajada-h3-precio">
                    Busca en internet el precio de referencia. Fíjate en si el producto está con descuento o no y en cuánto vale hoy ese producto.
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
                    v-model="formattedPriceReference"
                    @input="handleInputReference"
                />
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
import { useFormStore } from "../../../stores/valuesTwo";
import { computed, watch, onMounted, defineEmits } from "vue";

const props = defineProps({
    userId: { 
        type: String, 
        default: "" 
    },
    productId: { 
        type: String, 
        default: "" 
    },
    productSlug: { 
        type: String, 
        default: "" 
    },
    userBank: { 
        type: [Object, String], 
        default: null, 
    },
});

const emit = defineEmits(["next-step", "constant-emitted", "active-subtitles","close-step"]);

const mainStep = 4;
const subValue = 2;
const closeStep = 2;
const formStore = useFormStore();
const formData = formStore.formData;
let fee = 0;
let finalAmount = 0;

const nextStep = async () => {
    formStore.setFormData(formData);
    try {
        await submitForm();
        setTimeout(() => {
            emit("next-step");
            emit("active-subtitles", subValue);
            emit("close-step",closeStep);
        }, 2000); 
    } catch (error) {
        console.error(error);
    }
};

const submitForm = async () => {
    try {
        const csrfToken = document.head.querySelector(
            'meta[name="csrf-token"]'
        ).content;
        console.log("CSRF Token:", csrfToken);  
        console.log("Datos: ", formData);
              
        const slug = props.productSlug ? props.productSlug : formData.stepZeroSlug;

        const response = await axios.post(
            `/api/product/store/two/${slug}`,
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


const formattedPrice = computed(() => {
  if (formData.stepEightPrice === '') return '';
  return formData.stepEightPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});

const formattedPriceReference = computed(() => {
  if (formData.stepEightPriceReference === '') return '';
  return formData.stepEightPriceReference.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});

const updatePrice = (value) => {
  const numericValue = value.replace(/\./g, '');
  formData.stepEightPrice = isNaN(numericValue) ? '' : parseInt(numericValue, 10);
  feeDBM();
};

const updatePriceReference = (value) => {
  const numericValue = value.replace(/\./g, '');
  formData.stepEightPriceReference = isNaN(numericValue) ? '' : parseInt(numericValue, 10);
};

const handleInput = (event) => {
  updatePrice(event.target.value);
};

const handleInputReference = (event) => {
  updatePriceReference(event.target.value);
};

const feeDBM = () => {
  const rawPrice = formData.stepEightPrice;

  if (!isNaN(rawPrice) && rawPrice !== null && rawPrice !== '') {
    const fee = Math.round(rawPrice * 0.22);
    const finalAmount = rawPrice - fee;

    formData.stepEightPriceFee = fee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    formData.stepEightPriceFinalAmount = finalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  } else {
    formData.stepEightPriceFee = 'Ingrese un precio valido';
    formData.stepEightPriceFinalAmount = 'Ingrese un precio valido';
  }
};

watch(() => formData.stepEightPrice, (newVal) => {
  feeDBM();
});

// const feeDBM = () => {
//     // Remove dots to get the raw number for calculations
//     const rawPrice = formData.stepEightPrice.replace(/[.]/g, "");
//     // Check if rawPrice is a valid number
//     if (!isNaN(rawPrice)) {
//         fee = Math.round(rawPrice * 0.22);
//         finalAmount = rawPrice - fee;

//         // Convert numeric values to strings and format with point as separator and no decimal places
//         formData.stepEightPriceFee = fee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
//         formData.stepEightPriceFinalAmount = finalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
//     } else {
//         // Set a default message when the input is not a valid number
//         formData.stepEightPriceFee = 'Ingrese un precio valido';
//         formData.stepEightPriceFinalAmount = 'Ingrese un precio valido';
//     }
// };

onMounted(() => {
    emit("constant-emitted", mainStep);
});
</script>

