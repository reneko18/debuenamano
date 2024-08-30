<template>
    <div class="row">
        <div class="col-2 col-sidebar">
            <sidebar @nodeSelected="handleNodeSelected"/>
        </div>
        <div class="col-10">
            <component 
                :is="selectedComponent" 
                @postCreated="handlePostCreated" 
                @authorCreated="handleAuthorCreated"
                @categoryCreated="handleCategoryCreated"
            />
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import Sidebar from "../components/NewAdmin/Sidebar.vue"
import PostAdminTable from "../components/Post/PostAdminTable.vue"
import AuthorAdminTable from "../components/Post/AuthorAdminTable.vue"
import CategoriesAdminTable from "../components/Post/CategoriesAdminTable.vue"

const selectedComponent = ref(null);

const handleNodeSelected = (componentName) => {
  selectedComponent.value = componentName;
};

// Handle the "postCreated" event and switch to the "Ver Posts" view
const handlePostCreated = () => {
  selectedComponent.value = PostAdminTable;  // Switch to "Ver Posts"
};

// Handle the "authorCreated" event and switch to the "Ver Autores" view
const handleAuthorCreated = () => {
  selectedComponent.value = AuthorAdminTable;  // Switch to "Ver Autores"
};

// Handle the "categoryCreated" event and switch to the "Ver Categorias" view
const handleCategoryCreated = () => {
  selectedComponent.value = CategoriesAdminTable;  // Switch to "Ver Categorias"
};
</script>
<style scoped>
    .col-sidebar{
        padding: 0;
    }
</style>