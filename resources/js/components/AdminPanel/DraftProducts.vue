<template>
    <div>
        <div class="w-100 mb-3 flex justify-content-end">
            <Button icon="pi pi-refresh" rounded raised @click="refreshData"/>
        </div>
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
        <DataTable
            :value="products"
            v-model:filters="filters"
            paginator
            :rows="5"
            :rowsPerPageOptions="[5, 10, 20, 50]"
            :globalFilterFields="[
                'name',
                'sellerName',
            ]"
        >
            <Column field="name" header="Articulo" :filter="true"></Column>
            <Column
                :field="getCategoryName"
                header="Categoria"
                :filter="true"
            ></Column>
            <Column
                field="sellerFullName"
                header="Vendedor"
                :filter="true"
            ></Column>
        </DataTable>
    </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { FilterMatchMode } from "primevue/api";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
const products = ref([]);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const fetchData = async () => {
    try {
        const response = await axios.get("/api/table/admindraft");
        products.value = response.data.map((item) => ({
            ...item.product,
            categoryName: item.product.category
                ? item.product.category.name
                : null,
            sellerFullName: item.sellerFullName,  
            editUrl: `/admin/productos/${item.product.slug}/edit`,            
        }));       
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

const getCategoryName = (rowData) => {
    return rowData.categoryName;
};

function refreshData(){
    fetchData();
}

onMounted(() => {
    fetchData();
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
</style>