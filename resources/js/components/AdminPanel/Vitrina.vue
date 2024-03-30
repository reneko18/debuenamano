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
            :rows="5"
            :rowsPerPageOptions="[5, 10, 20, 50]"
            :globalFilterFields="['sku','name', 'price']"
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
            <Column :field="getFormatDate" header="Fecha publicacion"></Column>
            <Column field="selling_status" header="Disponible">
                <template #body="slotProps">
                    <!-- <Dropdown
                    v-model="slotProps.data.selectedCity"
                    :options="cities"
                    optionLabel="name"
                    placeholder="Select a City"
                /> -->
                    <select
                        class="form-select"
                        v-model="slotProps.data.selectedAvailable"
                        @change="updateSellingStatus(slotProps.data)"
                    >
                        <option
                            value="Sí"
                            :selected="slotProps.data.selling_status === 'Sí'"
                        >
                            Sí
                        </option>
                        <option
                            value="Pendiente"
                            :selected="
                                slotProps.data.selling_status === 'Pendiente'
                            "
                        >
                            Pendiente
                        </option>
                    </select>
                </template>
            </Column>
            <Column header="Medios">
                <template #body="slotProps">
                    <div class="form-check" v-for="media in mediaTypes">
                        <input
                            class="form-check-input"
                            :id="'media_' + media.id"
                            type="checkbox"
                            :value="media.id"
                            v-model="slotProps.data.selectedMedia"
                            @change="updateMediaSelection(slotProps.data)"
                        />
                        <label
                            :for="'media_' + media.id"
                            class="form-check-label"
                        >
                            {{ media.name }}
                        </label>
                    </div>
                    <!-- <Checkbox
                        v-model="slotProps.data.selectedCategories"
                        :inputId="
                            category.key + slotProps.data.selectedCategories
                        "
                        :name="'category_' + slotProps.data.selectedCategories"
                        :value="category.name"
                    />
                    <label
                        :for="category.key + slotProps.data.selectedCategories"
                        >{{ category.name }}</label
                    > -->
                </template>
            </Column>
            <Column
                field="sellerFullName"
                header="Vendedor"
                :filter="true"
            ></Column>
            <Column field="sellerMail" header="Correo" :filter="true"></Column>
            <Column :field="getFormattedPrice" header="Precio"></Column>
            <Column header="Acciones">
                <template #body="slotProps">
                    <Button icon="pi pi-pencil" outlined rounded />
                    <Button
                        icon="pi pi-trash"
                        outlined
                        rounded
                        severity="danger"
                    />
                </template>
            </Column>
            <Column header="En vitrina">
                <template #body="slotProps">
                    <InputSwitch :modelValue="getProductVisibleStatus(slotProps.data)" @update:modelValue="(val) => updateVisibleStatus(slotProps.data, val)" />
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
import Dropdown from "primevue/dropdown";
import Button from "primevue/button";
import Checkbox from "primevue/checkbox";
import InputSwitch from 'primevue/inputswitch';

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const products = ref([]);

const mediaTypes = ref([
    { id: 1, name: "Mail" },
    { id: 2, name: "Whatsapp" },
    { id: 3, name: "Teléfono" },
]);

const fetchProducts = async () => {
    try {
        const response = await axios.get("/api/vitrina");  

        // Check the structure of the response and update the mapping accordingly
        products.value = response.data.map((item) => ({
            ...item.product,
            sellerFullName: item.sellerFullName,
            sellerMail: item.sellerMail,
            // editUrl: item.editUrl,
            editUrl: `/single-product/${item.product.slug}`,  
            categoryName: item.product.category
                ? item.product.category.name
                : null,
            formattedDate:  formatDate(item.product.created_at),
            formattedPrice: formatPrice(item.product.price),
            selectedAvailable: item.product.selling_status,
            selectedMedia: item.product.product_contacts.map((pc) => pc.id),
        }));
    } catch (error) {
        console.error("Error fetching products:", error);
    }
};

const updateSellingStatus = async (product) => {
    try {
        const response = await axios.put(
            `/api/products/status/${product.slug}`,
            {
                selling_status: product.selectedAvailable,
            }
        );

        // Handle the response if needed
        console.log("Product updated successfully:", response.data);
    } catch (error) {
        console.error("Error updating product:", error);
    }
};

const updateMediaSelection = async (product) => {
    try {
        const response = await axios.put(
            `/api/products/contact/${product.slug}`,
            {
                product_contacts: product.selectedMedia,
            }
        );

        // Handle the response if needed
        console.log("Product updated successfully:", response.data);
    } catch (error) {
        console.error("Error updating product:", error);
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

const getCategoryName = (rowData) => {
    return rowData.categoryName;
};

const updateVisibleStatus = (product, newValue) => {
  const newVisibleStatus = newValue ? 'Si' : 'No';
  product.visible_status = newVisibleStatus;
  updateProductVisibilityInDatabase(product.slug, newVisibleStatus);
};

const updateProductVisibilityInDatabase = async (productSlug, visibleStatus) => {
  try {
    await axios.put(`/api/products/visible-status/${productSlug}`, { visible_status: visibleStatus });
    console.log('Product visibility updated in the database');
    fetchProducts();
  } catch (error) {
    console.error('Error updating product visibility:', error);
  }
};

// Computed property to convert visible_status to boolean for InputSwitch
const getProductVisibleStatus = (product) => product.visible_status === 'Si';

onMounted(() => {
    fetchProducts();
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
