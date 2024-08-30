<template>
    <div class="sidebar">
        <h2 class="title-admin">DBM Admin</h2>
        <Tree v-model:selectionKeys="selectedKey" :value="nodes" class="w-full" selectionMode="single" @node-select="handleNodeSelect" />       
    </div>
</template>
<script setup>
import { ref, onMounted, defineEmits } from 'vue';
import Tree from 'primevue/tree';
import { NodeService } from '../../services/NodeService';


const nodes = ref(null);
const emit = defineEmits()
const selectedKey = ref(null);



const handleNodeSelect = (node) => {
  if (node.isLogout) {
    NodeService.logout().then(() => {
      // Redirect to login page or perform another action after logout
      window.location.href = '/login'; // Replace with your actual login route
    }).catch(error => {
      console.error('Error logging out:', error);
      // Handle error (e.g., show notification)
    });
  } else {
    emit('nodeSelected', node.component); 
  }
};


onMounted(() => {
    NodeService.getTreeNodes().then((data) => (nodes.value = data));
});
</script>
<style scoped>
    .sidebar{
        width: 100%;
        height:100vh;
        background-color: #333;
    }
    :deep(.p-tree){
        background-color: transparent;
        padding: 1.25rem 0;
        border: unset;
        color: #fff;
    }
    :deep(.p-tree .p-tree-container .p-treenode:focus > .p-treenode-content){
        box-shadow: unset;
    }
    .title-admin{
        color:#fff;
        padding-top:2rem;
        padding-left: 2rem;
    }
</style>