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
        <DataTable
            :value="products"
            v-model:filters="filters"
            paginator
            ref="dt"
            :rows="5"
            :rowsPerPageOptions="[5, 10, 20, 50]"
            :globalFilterFields="[
                'sku',
                'name',
                'price',
                'sellerFullName',
                'originZone',
                'buyerFullName',
                'publish_status',
            ]"
        >
            <template #header>
                <div style="text-align: left">
                    <Button label="Export" @click="exportCSV($event)" />
                </div>
            </template>
            <Column field="sku" header="Sku" :filter="true"></Column>
            <Column field="name" header="Articulo" :filter="true"></Column>
            <Column
                field="sellerFullName"
                header="Vendedor"
                :filter="true"
            ></Column>
            <Column field="sell_date" header="Fecha de venta"></Column>
            <Column field="payment_date" header="Fecha de pago"></Column>
            <Column :field="getFormattedTotalAmount" header="Monto pago">
                <template #body="slotProps">
                    <span><strong>{{ slotProps.data.formattedTotalAmount }}</strong></span>
                </template>
            </Column>
            <Column field="iva" header="Iva"></Column>
            <Column field="netAmount" header="Monto neto"></Column>
            <Column field="orderId" header="N° orden de compra"></Column>
        </DataTable>
    </div>
</template>
<script setup>
import { ref, onMounted, watch } from "vue";
import { FilterMatchMode } from "primevue/api";
import DataTable from "primevue/datatable";
import Button from 'primevue/button';
import Column from "primevue/column";

const props = defineProps({
    refreshData: { type: Boolean, default: "" },
});

const shouldRefresh = ref(props.refreshData);

const dt = ref();
const products = ref([]);
const exportCSV = () => {
    dt.value.exportCSV();
};

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const fetchData = async () => {
    try {
        const response = await axios.get("/api/table/adminpayments");
        products.value = response.data.map((item) => ({
            ...item.product,
            categoryName: item.product.category
                ? item.product.category.name
                : null,
            formattedDate:  formatDate(item.product.created_at),
            formattedPrice: formatPrice(item.product.price),
            sellerFullName: item.sellerFullName,        
            buyerFullName: item.buyerFullName,
            originZone: item.product.delivery_information.city_name + ' - ' + item.product.delivery_information.region_name, 
            formattedTotalAmount: formatPriceSum(parseInt(item.deliveryPrice) + parseInt(item.product.price)),
            iva: formatPriceSum((parseInt(item.deliveryPrice) + parseInt(item.product.price))*0.19), 
            netAmount: formatPriceSum((parseInt(item.deliveryPrice) + parseInt(item.product.price))*0.81),
            orderId: item.orderId,
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

const formatPriceSum = (price) => {
    const numericPrice = price;
  
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

const formatDate = (date) => {
    const dateObject = new Date(date);
    const day = dateObject.getDate().toString().padStart(2, '0');
    const month = (dateObject.getMonth() + 1).toString().padStart(2, '0');
    const year = dateObject.getFullYear();
    const finalDate = `${day}/${month}/${year}`;
    return finalDate;
};

const getFormattedTotalAmount = (rowData) => {
    return rowData.formattedTotalAmount;
};

const getFormatDate = (rowData) => {
    return rowData.formattedDate;
}

const getFormattedPrice = (rowData) => {
    return rowData.formattedPrice;
};

const getCategoryName = (rowData) => {
    return rowData.categoryName;
};

// Watch for changes in the refresh prop
watch(() => props.refreshData, (newValue) => {
  if (newValue) {
    fetchData(); // Fetch data again to refresh the component
    shouldRefresh.value = false; // Reset the refresh flag
  }
});

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