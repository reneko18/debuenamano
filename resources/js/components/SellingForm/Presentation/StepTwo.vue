<template>
  <div class="modulo-pasos">
    <div class="row">
      <div class=" col-lg-7 col-md-12">
        <h2>Si es posible, indícanos la marca y el modelo de tu artículo</h2>
        <p class="bajada-h2">Al proporcionar información específica aumentas las posibilidades de que una persona encuentre rápidamente tu producto. </p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div>
          <label for="brandName" class="form-label">Marca*</label>
          <input type="text" v-model="formData.brand" class="form-control" id="brandName" placeholder="Ingresa el nombre de la marca">
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div>
          <label for="modelName" class="form-label">Modelo</label>
          <input type="text" class="form-control" id="modelName" placeholder="Ingresa el modelo del artículo">
        </div>
      </div>
    </div>
    <!-- <button class="btn btn-primary mt-3" @click="nextStepChild">Continuar</button> -->       
    <button class="btn boton-principal" @click="nextStep">Continuar <font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
  </div>
</template>
<script>
import { useFormStore } from '../../../stores/values';

export default {

    emits: ['next-step'],
    setup(_, { emit }) {
    const formStore = useFormStore();

    const formData = formStore.formData;

    const nextStep = () => {
      formStore.setFormData(formData);
      emit('next-step');
    };

    return {
      formData,
      nextStep,
    };
  },
}
</script>