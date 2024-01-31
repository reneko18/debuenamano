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
        <div class="col-lg-5 col-md-12">
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
                    <p>- $ {{ formData.stepEightPriceFee }}</p>
                    <p><strong class="price-income">$ {{ formData.stepEightPriceFinalAmount }}</strong></p>
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
            Continuar <font-awesome-icon :icon="['fas', 'chevron-right']" />
        </button>
    </div>
</template>
<script>
import { useFormStore } from "../../../stores/values";
import { onMounted } from "vue";
const priceFormatDirective = {
    mounted(el, binding) {
        const context = binding.instance;

        el.addEventListener("input", function (e) {
            // Remove non-numeric characters
            const value = e.target.value.replace(/[^0-9]/g, "");

            // Insert a point separator for thousands
            const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // Set the formatted value as a string
            e.target.value = formattedValue;

            // Save the formatted string to formData.stepEightPrice
            // If you need to save the numeric value, convert it back to a number
            // context.formData.stepEightPrice = parseFloat(value);
            context.formData.stepEightPrice = formattedValue;
        });
    },
};

export default {
    directives: {
        "price-format": priceFormatDirective,
    },
    emits: ["next-step", "constant-emitted", "active-subtitles"],
    data() {
        return {
            fee: 0,
            finalAmount: 0,
        };
    },
    setup(_, { emit }) {
        const mainStep = 4;
        const subValue = 2;
        const formStore = useFormStore();
        const formData = formStore.formData;

        onMounted(() => {
            emit("constant-emitted", mainStep);
        });

        const nextStep = () => {
            formStore.setFormData(formData);
            emit("next-step");
            emit("active-subtitles", subValue);
        };

        return {
            formData,
            nextStep,
        };
    },
    methods: {
        feeDBM() {
            // Remove dots to get the raw number for calculations
            const rawPrice = this.formData.stepEightPrice.replace(/[.]/g, "");
            this.fee = Math.round(rawPrice * 0.22);
            this.finalAmount = rawPrice - this.fee;

            // Convert numeric values to strings and format with point as separator and no decimal places
            this.formData.stepEightPriceFee = this.fee
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            this.formData.stepEightPriceFinalAmount = this.finalAmount
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
    },
};
</script>
