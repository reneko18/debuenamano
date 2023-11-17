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
            <input
                type="text"
                class="form-control"
                id="priceItem"
                placeholder="Precio"
                v-model="formData.stepEightPrice"
                @input="feeDBM"
            />
            <div class="row">
                <div class="col">
                    <p>-${{ fee }}</p>
                    <p>${{ finalAmount }}</p>
                </div>
                <div class="col">
                    <p>Comisión DBM 25%</p>
                    <p>Tu ganancia</p>
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
export default {
    data() {
        return {
            fee: 0,
            finalAmount: 0,
        };
    },
    setup(_, { emit }) {
        const mainStep = 4;

        const formStore = useFormStore();
        const formData = formStore.formData;

        onMounted(() => {
            emit("constant-emitted", mainStep);
        });

        const nextStep = () => {
            formStore.setFormData(formData);
            emit("next-step");
        };

        return {
            formData,
            nextStep,
        };
    },
    methods: {
        feeDBM() {
            this.fee = this.formData.stepEightPrice * 0.25;
            this.fee = Math.round(this.fee);
            this.finalAmount = this.formData.stepEightPrice - this.fee;
            this.fee = this.fee.toLocaleString();
            this.finalAmount = this.finalAmount.toLocaleString();
        },
    },
};
</script>
