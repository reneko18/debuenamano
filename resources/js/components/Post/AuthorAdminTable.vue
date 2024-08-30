<template>
    <ConfirmDialog id="confirm"/>
    <DataTable
        :value="authors"
        paginator 
        :rows="5"
        tableStyle="min-width: 50rem"
    >
        <Column field="authorFullName" header="Nombre del autor" />
        <Column header="Acciones">
            <template #body="slotProps">
                <Button icon="pi pi-pencil" outlined rounded class="mr-3" />
                <Button
                    icon="pi pi-trash"
                    outlined
                    rounded
                    severity="danger"
                    @click="deleteAuthor(slotProps.data.id)"
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

const authors = ref([]);

const fetchAuthors = async () => {
    try {
        const response = await axios.get('/api/authors/all');
        authors.value = response.data.map((item) => ({
            ...item.author,
            authorFullName: item.authorFullName,
        }));
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};


const deleteAuthor = async (id) => {
    confirm.require({
    message: 'Are you sure you want to delete this author?',
    header: 'Confirmation',
    icon: 'pi pi-exclamation-triangle',
        accept: async () => {
            try {
                await axios.delete(`/api/author/delete/${id}`);
                authors.value = authors.value.filter(author => author.id !== id);
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
    fetchAuthors();
});
</script>