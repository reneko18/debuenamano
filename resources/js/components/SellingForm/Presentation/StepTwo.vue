<template>
    <div class="modulo-pasos">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <h2>
                    Si es posible, indícanos la marca y el modelo de tu artículo
                </h2>
                <p class="bajada-h2">
                    Al proporcionar información específica aumentas las
                    posibilidades de que una persona encuentre rápidamente tu
                    producto.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div>
                    <label for="brandName" class="form-label">Marca*</label>
                    <input
                        type="text"
                        class="form-control"
                        id="brandName"
                        placeholder="Ingresa el nombre de la marca"
                        v-model="formData.stepTwoBrandProduct"
                    />
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div>
                    <label for="modelName" class="form-label">Modelo</label>
                    <input
                        type="text"
                        class="form-control"
                        id="modelName"
                        placeholder="Ingresa el modelo del artículo"
                        v-model="formData.stepTwoModelProduct"
                    />
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
    emits: ["nextStep", "constant-emitted"],
    setup(_, { emit }) {
        const mainStep = 1;
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
};
</script>
