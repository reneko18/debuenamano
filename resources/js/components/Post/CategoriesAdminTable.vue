<template>
    <ConfirmDialog id="confirm"/>
    <DataTable
        :value="categories"
        paginator 
        :rows="5"
        tableStyle="min-width: 50rem"
    > 
        <Column field="name" header="Nombre de la categoria" />
        <Column header="Acciones">
            <template #body="slotProps">
                <Button icon="pi pi-pencil" outlined rounded class="mr-3" />
                <Button
                    icon="pi pi-trash"
                    outlined
                    rounded
                    severity="danger"
                    @click="deleteCategory(slotProps.data.id)"
                />
            </template>
        </Column>
    </DataTable>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column'; 
import Button from "primevue/button";
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from 'primevue/useconfirm';

const confirm = useConfirm();

const categories = ref([]);

const fetchCategories = async () => {
    try {
        const response = await axios.get('/api/postscategories/all');
        categories.value= response.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

const deleteCategory = async (id) => {
    confirm.require({
    message: 'Are you sure you want to delete this category?',
    header: 'Confirmation',
    icon: 'pi pi-exclamation-triangle',
        accept: async () => {
            try {
                await axios.delete(`/api/postcategory/delete/${id}`);
                categories.value = categories.value.filter(category => category.id !== id);
            } catch (error) {
                console.error("Error deleting author:", error);
            }
        },
        reject: () => {
        // Do nothing on reject
        }
  });
};

onMounted(() => {
    fetchCategories();
});
</script>