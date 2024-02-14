<template>
    <DataTable :value="posts" paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
        <template #header>
            <div style="text-align:left">
                <MultiSelect :modelValue="selectedColumns" :options="columns" optionLabel="header" @update:modelValue="onToggle"    
                    display="chip" placeholder="Select Columns" />
            </div>
        </template>
        <Column v-for="(col, index) of selectedColumns" :field="col.field" :header="col.header" :key="col.field + '_' + index"></Column>
    </DataTable>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import MultiSelect from 'primevue/multiselect';       


const posts = ref([]);   

const columns = ref([
    {field: 'title', header: 'Nombre'},
    {field: 'author.firstname', header: 'Autor'},
    {field: 'postcategories.name', header: 'Categoria'},
    {field: 'created_at', header: 'Fecha de creacion'},
    {field: 'updated_at', header: 'Fecha de modificacion'},
]);

const selectedColumns = ref(columns.value);

const onToggle = (val) => {
    selectedColumns.value = columns.value.filter(col => val.includes(col));
};


const fetchPost = async () => {
    try {
        const response = await axios.get('/api/posts/all');
        posts.value = response.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

onMounted(() => {
    fetchPost();
});
</script>




    