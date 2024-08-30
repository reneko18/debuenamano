<template>
    <div class="container row p-5">
        <div class="col-6">
            <div class="mb-3">
                <label for="category" class="form-label">Nombre de la categoria</label>
                <input type="text" class="form-control" id="category" v-model="category">
            </div>
            <a class="btn boton-principal" @click="createCategory">Crear categoria</a>
        </div>
    </div>
    <Toast />
</template>
<script setup>
import { ref, defineEmits } from 'vue';
import { useToast } from "primevue/usetoast";

const emit = defineEmits(['categoryCreated']);

const toast = useToast();

const category = ref("");


const createCategory = async () => {
  try {   
    const response = await axios.post('/api/postcategory/store', {
      category: category.value,
    });
    toast.add({
        severity: 'success',
        summary: 'Success',
        detail: 'La categoria ha sido creado con éxito',
        life: 3000,
    });
    console.log("Author created successfully:", response.data);
    // Emit event to switch to "Ver Categorias" view
    // Delay the emit by 4000 milliseconds (4 seconds)
    setTimeout(() => {
      emit('categoryCreated'); // Emit the event after the delay
    }, 3000); 
  } catch (error) {
    console.error("Error creating post:", error);
  }
};
</script>