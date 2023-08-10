<template>
  <div class="modulo-pasos">
    <div class="row">
      <div class=" col-lg-7 col-md-12">
        <h2>Medidas y peso aproximado del artículo</h2>
        <p class="bajada-h2">Esto nos ayudará a mostrar las dimensiones precisas en la descripción y garantizar una experiencia de compra sin sorpresas.</p>
      </div>
    </div>
    <input type="text" class="form-control" placeholder="Test field" v-model="formData.test">
    <button class="btn boton-principal">Continuar</button>
  </div>   
</template>
<script>
import { useFormStore } from '../../../stores/values';

export default {

  /*data(){
    return {

    }
  },
  methods: {

  },
  */

//Test Code

 setup() {
    const formStore = useFormStore();

    const formData = formStore.formData;


    /*const prevStep = () => {
      formStore.setFormData(formData);
      this.$emit('prev-step');
    };*/

    /*const submitForm = () => {
      formStore.resetForm();
      this.$emit('reset-form');
    };*/

    return {
      formData,  
      //prevStep,
      //submitForm,
    };
  },
}
</script>