<template>
    <div class="container py-5">
        <div class="col-6">
            <div class="mb-3">
                <label for="title" class="form-label">Titulo del post</label>
                <input type="text" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Categoria del post</label>
                <select type="text" class="form-select" id="category">
                    <option disabled selected value="">Seleccione una categoria</option>
                    <option :value="postcategory.id" v-for="postcategory in postscategories">{{ postcategory.name }}</option>
                </select>
            </div>
            <div class="mb-3">
                
                <label for="author" class="form-label">Autor post</label>
                <select type="text" class="form-select" id="author">
                    <option disabled selected value="">Seleccione un  autor</option>
                    <option :value="author.id" v-for="author in authors">{{ author.firstname }} {{ author.lastname }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Contenido del post</label>
                <Editor v-model="editorValue" editorStyle="height: 320px" />
            </div>
            <a class="btn boton-principal">Crear post</a>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import Editor from 'primevue/editor';

const postscategories = ref([]);
const authors = ref([]);
const editorValue = ref('');

const fetchPostCategories = async () => {
    try {
        const response = await axios.get('/api/postscategories');
        postscategories.value = response.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

const fetchAuthors = async () => {
    try {
        const response = await axios.get('/api/authors');
        authors.value = response.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

onMounted(() => {
    fetchPostCategories();
    fetchAuthors();
});
</script>