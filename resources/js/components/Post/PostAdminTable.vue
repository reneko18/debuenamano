<template>
    <ConfirmDialog id="confirm"/>
    <DataTable 
        :value="posts" 
        paginator 
        :rows="10" 
        :rowsPerPageOptions="[5, 10, 20, 50]" 
        tableStyle="min-width: 50rem"
    >
        <Column field="title" header="Nombre del post" />  
        <Column field="authorFullName" header="Autor" />
        <Column field="categoryName" header="Categoría" />
        <Column :field="getFormatDate" header="Fecha publicacion" /> 
        <Column header="Acciones">
            <template #body="slotProps">
                <Button icon="pi pi-pencil" outlined rounded class="mr-3" />
                <Button
                    icon="pi pi-trash"
                    outlined
                    rounded
                    severity="danger"
                    @click="deletePost(slotProps.data.id)"
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

const posts = ref([]);   

const fetchPost = async () => {
    try {
        const response = await axios.get('/api/posts/all');
        posts.value = response.data.map((item) => ({
            ...item,
            formattedDate:  formatDate(item.created_at),
        }));
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

const formatDate = (date) => {
    const dateObject = new Date(date);
    const day = dateObject.getDate().toString().padStart(2, '0');
    const month = (dateObject.getMonth() + 1).toString().padStart(2, '0');
    const year = dateObject.getFullYear();
    const finalDate = `${day}/${month}/${year}`;
    return finalDate;
};

const getFormatDate = (rowData) => {
    return rowData.formattedDate;
}

const deletePost = async (id) => {
    confirm.require({
    message: 'Are you sure you want to delete this post?',
    header: 'Confirmation',
    icon: 'pi pi-exclamation-triangle',
        accept: async () => {
            try {
                await axios.delete(`/api/post/delete/${id}`);
                posts.value = posts.value.filter(post => post.id !== id);
            } catch (error) {
                console.error("Error deleting post:", error);
            }
        },
        reject: () => {
        // Do nothing on reject
        }
  });
};

onMounted(() => {
    fetchPost();
});
</script>




    