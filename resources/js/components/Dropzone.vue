<template>
      <div ref="dropzone" class="dropzone"></div>
</template>
  
  <script>
  import { onMounted, ref } from 'vue';
  import 'dropzone/dist/dropzone.css';
  import 'dropzone/dist/basic.css';
  import Dropzone from 'dropzone';
  
  export default {
    name: 'Dropzone',
    setup() {
      const dropzoneRef = ref(null);  
   
      Dropzone.autoDiscover = false;
  
      onMounted(() => {
        const dropzoneElement = dropzoneRef.value;
        new Dropzone(dropzoneElement, {
         
        });
      });
  
      return {
        dropzoneRef
      };
    }
  };
  </script>
  
  <style scoped>
  .dropzone {
    
  }
  </style>
  