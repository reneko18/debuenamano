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
                'price',
                'sellerName',
                'publish_status',
            ]"
        >
            <Column field="name" header="Articulo" :filter="true"></Column>
            <Column :field="getFormatDate" header="Fecha publicacion"></Column>
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
            <Column :field="getFormattedPrice" header="Precio"></Column>
            <Column :field="getFormattedReferencePrice" header="Precio de referencia"></Column>
            <Column header="Enlace">
                <template #body="slotProps">
                    <a :href="slotProps.data.editUrl" target="_blank"> ver ficha </a> 
                </template>
            </Column>
            <Column field="publish_status" header="Estado"></Column>
            <Column header="Acciones">
                <template #body="slotProps">
                    <Button icon="pi pi-trash" outlined rounded @click="confirmDelete(slotProps.data)"/>
                </template>
            </Column>
        </DataTable>
    </div>
    <Dialog v-model="displayDialog" modal :visible="displayDialog" @hide="cancelDelete">
      <span>Estas seguro que deseas eliminar este producto?</span>
      <Button label="Anular" class="p-button-text" @click="cancelDelete" />
      <Button label="Eliminar" class="p-button-text" @click="deleteConfirmed" />
    </Dialog>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { FilterMatchMode } from "primevue/api";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import Dialog from 'primevue/dialog';
const products = ref([]);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const selectedProductId = ref(null);
const selectedProductSlug = ref(null);
const displayDialog = ref(false);

const fetchData = async () => {
    try {
        const response = await axios.get("/api/table/adminpublish");
        products.value = response.data.map((item) => ({
            ...item.product,
            categoryName: item.product.category
                ? item.product.category.name
                : null,
            formattedDate:  formatDate(item.product.created_at),
            formattedPrice: formatPrice(item.product.price),
            formattedReferencePrice: formatReferencePrice(item.product.reference_price),
            sellerFullName: item.sellerFullName,
            // editUrl: item.editUrl,
            editUrl: `/admin/productos/${item.product.slug}/edit`,            
        }));       
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

const formatPrice = (price) => {
    const numericPrice = parseFloat(price.replace(/[$,.]/g, ""));

    if (!isNaN(numericPrice) && typeof numericPrice === "number") {
        const formattedPrice = new Intl.NumberFormat("es-CL", {
            style: "currency",
            currency: "CLP",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(numericPrice);

        return formattedPrice;
    } else {
        return "Invalid Price";
    }
};

const formatReferencePrice = (price) => {
    const numericPrice = parseFloat(price.replace(/[$,.]/g, ""));

    if (!isNaN(numericPrice) && typeof numericPrice === "number") {
        const formattedReferencePrice = new Intl.NumberFormat("es-CL", {
            style: "currency",
            currency: "CLP",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(numericPrice);

        return formattedReferencePrice;
    } else {
        return "Invalid Price";
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

const getFormattedPrice = (rowData) => {
    return rowData.formattedPrice;
};

const getFormattedReferencePrice = (rowData) => {
    return rowData.formattedReferencePrice;
};

const getCategoryName = (rowData) => {
    return rowData.categoryName;
};

const confirmDelete = (product) => {
  selectedProductId.value = product.id;
  selectedProductSlug.value = product.slug;
  displayDialog.value = true;
};

const cancelDelete = () => {
  displayDialog.value = false;
};

const deleteConfirmed = async () => {   
    if (selectedProductId.value !== null) {
    try {
      await axios.delete(`/api/products/delete/${selectedProductSlug.value}`);
      const index = products.value.findIndex(product => product.id === selectedProductId.value);
      if (index !== -1) {
        products.value.splice(index, 1); // Remove the product at the found index
      }
      displayDialog.value = false;
    } catch (error) {
      console.error("Error deleting product:", error);
    }
  }
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
