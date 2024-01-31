<template>
    <div class="row">
        <div class="col-2 col-sidebar">
            <sidebar @nodeSelected="handleNodeSelected"/>
        </div>
        <div class="col-10">
            <component :is="selectedComponent" />
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import Sidebar from "../components/NewAdmin/Sidebar.vue"
import AdminView from './AdminView.vue';

const selectedComponent = ref(null);

const handleNodeSelected = (componentName) => {
  selectedComponent.value = componentName;
};
</script>
<style scoped>
    .col-sidebar{
        padding: 0;
    }
</style>