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
            :filters="filters"
            paginator
            :rows="5"
            :rowsPerPageOptions="[5, 10, 20, 50]"
            :globalFilterFields="[
                'name',
            ]"
        >
            <Column field="image" header="Imagen">
                <template #body="slotProps">
                    <img
                        class="img-fluid img-product"
                        :src="'/' + slotProps.data.galleries[0].url"
                        :alt="slotProps.data.galleries[0].alt"
                    />
                </template>
            </Column>
            <Column field="name" header="Articulo" :filter="true"></Column>
            <Column :field="getFormattedPrice" header="Precio"></Column>
            <Column
                :field="getCategoryName"
                header="Categoria"
                :filter="true"
            ></Column>
        </DataTable>
    </div>
</template>
<script setup>
import { ref, onMounted, defineEmits } from "vue";
import { FilterMatchMode } from "primevue/api";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
const props = defineProps({
    userId: { type: Number, default: "" },
});

const products = ref([]);
const emit = defineEmits(["update-products-sold-count"]);

const productsCount = ref("");

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const fetchData = async (user_id) => {
    try {
        const response = await axios.get(`/api/table/sold/${user_id}`);        
        products.value = response.data.map((item) => {
            // Use destructuring to directly access properties
            const { price, category, ...productData } = item;

            return {
                ...productData,
                categoryName: category ? category.name : null,
                formattedPrice: formatPrice(price),
            };
        });
        productsCount.value = response.data.length;
        // Emit the custom event with the products count to the parent component
        emit("update-products-sold-count", productsCount.value);
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

const getFormattedPrice = (rowData) => {
    return rowData.formattedPrice;
};

const getCategoryName = (rowData) => {
    return rowData.categoryName;
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