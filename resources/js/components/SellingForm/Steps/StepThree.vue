<template>
        <h2>Medidas y peso aproximado del artículo</h2>
        <p class="bajada-h2">Esto nos ayudará a mostrar las dimensiones precisas en la descripción y garantizar una experiencia de compra sin sorpresas.</p>
        <input type="text" class="form-control" placeholder="Test field" v-model="formData.test">
        <button class="btn btn-primary" @click="prevStep">Previous</button>
        <button class="btn btn-primary" @click="submitForm">Submit</button>
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

    const prevStep = () => {
      formStore.setFormData(formData);
      this.$emit('prev-step');
    };

    const submitForm = () => {
      // You can handle form submission logic here, like sending the data to the server, etc.
      // For simplicity, we'll just reset the form after submission.
      formStore.resetForm();
      this.$emit('reset-form');
    };

    return {
      formData,
      prevStep,
      submitForm,
    };
  },
}
</script>