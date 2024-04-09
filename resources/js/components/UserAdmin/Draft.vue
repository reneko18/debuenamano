<template>
    <div>
        <div class="search-box input-group">
            <input
                type="text"
                class="form-control"
                v-model="filters['global'].value"
                placeholder="Buscar una publicación"
            />
            <span class="input-group-text"
                ><font-awesome-icon :icon="['fas', 'magnifying-glass']"
            /></span>
        </div>
        <a href="/formulario-test" class="btn boton-principal mb-5">
            <font-awesome-icon :icon="['fas', 'plus']" />
            Nueva publicación
        </a>
        <DataTable
            :value="products"
            :filters="filters"
            paginator
            :rows="5"
            :rowsPerPageOptions="[5, 10, 20, 50]"
            :globalFilterFields="[
                'name',
            ]"
        >
            <Column field="name" header="Articulo" :filter="true">
                <template #body="slotProps">
                    <a
                        :href="'/formulario-test/' + slotProps.data.slug"
                        target="_blank"
                        >{{ slotProps.data.name }}</a
                    >
                </template>
            </Column>
            <Column field="publish_status" header="Status"/>
        </DataTable>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { FilterMatchMode } from "primevue/api";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
const props = defineProps({
    userId: { 
        type: String, 
        default: "" 
    },
});

const products = ref([]);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});
const fetchData = async (user_id) => {
    try {
        const response = await axios.get(`/api/table/draft/${user_id}`);
        products.value = response.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

onMounted(() => {
    fetchData(props.userId);
});
</script>

<style scoped>
.search-box input {
    background-color: #fff;
    border: 1.2px solid #c0c6b9;
    border-radius: 2px;
}
.search-box input::placeholder {
    color: #c0c6b9;
}
.search-box .input-group-text {
    cursor: pointer;
    height: 45px;
}
/*Cambiar después cuando se pase al app.scss*/
:deep(.p-datatable-table) {
    border-collapse: separate;
    border-spacing: 0 20px;
}
:deep(.p-datatable .p-datatable-thead > tr > th) {
    font-family: "Inter", sans-serif;
    font-size: 10px;
    font-weight: 700;
    color: #c0c6b9;
    text-transform: uppercase;
}
:deep(.p-datatable .p-datatable-tbody > tr) {
    height: 100px;
}
:deep(.p-datatable .p-datatable-tbody > tr > td) {
    font-family: "Inter", sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: #1b1f22;
}
.img-product {
    max-width: 80px;
}
</style>