<template>
  <div class="modulo-pasos">
    <div class="row">
      <div class=" col-lg-7 col-md-12">
        <h2>Medidas y peso aproximado del artículo</h2>
        <p class="bajada-h2">Esto nos ayudará a mostrar las dimensiones precisas en la descripción y garantizar una experiencia de compra sin sorpresas.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1">
          <label for="height-pro" class="form-label">Alto</label>
          <input type="text" class="form-control" placeholder="0,0" id="height-pro" v-model="formData.test">
      </div>
      <div class="col-md-1">
          <label for="unh-pro" class="form-label"></label>
          <select id="unh-pro" class="form-select" aria-label="Select Height">
              <option selected>cm</option>
              <option value="1">cm</option>
              <option value="2">in</option>              
          </select>
      </div>
      <div class="col-md-1">
          <label for="width-pro" class="form-label">Ancho</label>
          <input type="text" class="form-control" placeholder="0,0" id="width-pro">
      </div>
      <div class="col-md-1">
          <label for="unw-pro" class="form-label"></label>
          <select id="unw-pro" class="form-select" aria-label="Select Width">
              <option selected>cm</option>
              <option value="1">cm</option>
              <option value="2">in</option>              
          </select>
      </div>
      <div class="col-md-1">
          <label for="long-pro" class="form-label">Largo</label>
          <input type="text" class="form-control" placeholder="0,0" id="long-pro">
      </div>
      <div class="col-md-1">
          <label for="unl-pro" class="form-label"></label>
          <select id="unl-pro" class="form-select" aria-label="Select Long">
              <option selected>cm</option>
              <option value="1">cm</option>
              <option value="2">in</option>              
          </select>
      </div>
      <div class="col-md-1">
          <label for="weight-pro" class="form-label">Peso</label>
          <input type="text" class="form-control" placeholder="0,0" id="weight-pro">
      </div>
      <div class="col-md-1">
          <label for="unwe-pro" class="form-label"></label>
          <select id="unwe-pro" class="form-select" aria-label="Select Weight">
              <option selected>g</option>
              <option value="1">g</option>
              <option value="2">Kg</option>              
          </select>
      </div>
    </div>
    <button class="btn boton-principal" @click="nextStep">Guardar etapa y continuar <font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
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