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
                'sku',
                'name',
                'price',
                'sellerFullName',
                'originZone',
                'destinyZone',
                'buyerFullName',
                'publish_status',
            ]"
        >
            <Column field="sku" header="Sku" :filter="true">
                <template #body="slotProps">
                    <a :href="slotProps.data.editUrl">{{ slotProps.data.sku }}</a>
                </template>
            </Column>
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
            <Column :field="getFormatDate" header="Fecha publicacion"></Column>
            <Column field="sell_date" header="Fecha de venta"></Column>
            <Column
                field="buyerFullName"
                header="Comprador"
                :filter="true"
            ></Column>
            <Column
                field="originZone"
                header="Origen"
                :filter="true"
            ></Column>         
            <Column 
                field="publish_status" 
                header="Estados"
            >
                <template #body="slotProps">
                    <select
                        class="form-select"
                        v-model="slotProps.data.admin_status"
                        @change="updateAdminStatus(slotProps.data)"
                    >
                        <option
                            value="Comprado"
                            :selected="slotProps.data.admin_status === 'Comprado'"
                        >
                            Comprado
                        </option>
                        <option
                            value="En Courier"
                            :selected="
                                slotProps.data.admin_status === 'En Courier'
                            "
                        >
                            En Courier                           
                        </option>
                        <option
                            value="Entregado"
                            :selected="
                                slotProps.data.admin_status === 'Entregado'
                            "
                        >
                            Entregado                           
                        </option>
                        <option
                            value="Devuelto"
                            :selected="
                                slotProps.data.admin_status === 'Devuelto'
                            "
                        >
                            Devuelto                           
                        </option>
                        <option
                            value="Finalizado"
                            :selected="
                                slotProps.data.admin_status === 'Finalizado'
                            "
                        >
                            Finalizado                           
                        </option>
                    </select>
                </template>            
            </Column>
            <Column :field="getFormattedDeliveryPrice" header="Monto envio">
                <template #body="slotProps">
                    <span><strong>{{ slotProps.data.formattedDeliveryPrice }}</strong></span>
                </template>
            </Column>
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

const emit = defineEmits(["update-closed-sells"]);

const fetchData = async () => {
    try {
        const response = await axios.get("/api/table/adminselling");
        console.log(response.data);
        products.value = response.data.map((item) => ({
            ...item.product,
            editUrl: `/admin/productos/${item.product.slug}/edit`, 
            categoryName: item.product.category
                ? item.product.category.name
                : null,
            formattedDate:  formatDate(item.product.created_at),
            formattedPrice: formatPrice(item.product.price),
            sellerFullName: item.sellerFullName,        
            buyerFullName: item.buyerFullName,
            originZone: item.product.delivery_information.city_name + ' - ' + item.product.delivery_information.region_name,  
            formattedDeliveryPrice: formatPrice(item.deliveryPrice),
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

const getFormattedDeliveryPrice = (rowData) => {
    return rowData.formattedDeliveryPrice;
}

const getCategoryName = (rowData) => {
    return rowData.categoryName;
};

const updateAdminStatus = async (product) => {
    try {
        const response = await axios.put(
            `/api/products/admin-status/${product.slug}`,
            {
                product_admin_status: product.admin_status,
            }
        );

        // Handle the response if needed
        console.log("Product updated successfully:", response.data);
        emit("update-closed-sells");
    } catch (error) {
        console.error("Error updating product:", error);
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

.tab-content {
    min-height: 271px;
    padding: 20px;
    border-radius: 6px;
    background: #f9fafa;
}

.tabs__header {
    display: flex;
    list-style: none;
    padding: 0;
    margin-bottom: 0;
    margin-left: 12vw;
}

.tabs__header li.selected {
    background-color: #344026;
    color: #fff;
}
</style>