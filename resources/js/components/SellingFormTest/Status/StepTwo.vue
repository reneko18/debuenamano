<template>
    <div class="modulo-pasos">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <h2>Observaciones y/o recomendaciones sobre el artículo</h2>
                <p class="bajada-h2">
                    Si hay alguna característica especial, consejo de uso o
                    cualquier otro detalle que quieras compartir con los
                    posibles compradores, te invitamos a que nos lo cuentes.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="position-relative">
                    <label for="obser-pro" class="form-label"
                        >Observación</label
                    >
                    <textarea
                        id="obser-pro"
                        class="form-control"
                        placeholder="Que observaciones presenta el artículo..."
                        v-model="formData.stepFiveDetails"
                        @input="updateCharacterCountObs"
                        rows="4"
                        maxlength="280"
                    ></textarea>
                    <span class="character-count-badge"
                        >{{ characterCountObs }}/280 caracteres</span
                    >
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="position-relative">
                    <label for="reco-pro" class="form-label"
                        >Recomendaciones</label
                    >
                    <textarea
                        id="reco-pro"
                        class="form-control"
                        placeholder="Que recomendación darías para el correcto uso del artículo..."
                        v-model="formData.stepFiveAdvice"
                        @input="updateCharacterCountReco"
                        rows="4"
                        maxlength="280"
                    ></textarea>
                    <span class="character-count-badge"
                        >{{ characterCountReco }}/280 caracteres</span
                    >
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <button class="btn boton-principal" @click="nextStep">
            Continuar
            <font-awesome-icon :icon="['fas', 'chevron-right']" />
        </button>
    </div>
</template>
<script setup>
import { useFormStore } from "../../../stores/valuesTwo";
import { ref, onMounted, defineEmits } from "vue";

const emit = defineEmits(["next-step", "constant-emitted"]);

const mainStep = 2;
const formStore = useFormStore();
const formData = formStore.formData;
const characterCountObs = ref(0);
const characterCountReco = ref(0);

const nextStep = () => {
    formStore.setFormData(formData);
    emit("next-step");
};

const updateCharacterCountObs = () => {
    const text = formData.stepFiveDetails;
    const newCharacterCount = text.length;
    characterCountObs.value = newCharacterCount;
};

const updateCharacterCountReco = () => {
    const text = formData.stepFiveAdvice;
    const newCharacterCount = text.length;
    characterCountReco.value = newCharacterCount;
};

onMounted(() => {
    emit("constant-emitted", mainStep);
});
</script>