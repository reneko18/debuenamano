<template>
    <div>
        <TabView>
            <TabPanel header="Borradores">
                <draft-products />
            </TabPanel>
            <TabPanel header="Solicitud de Publicaciones">
                <products-published />
            </TabPanel>
            <TabPanel header="En vitrina">
                <vitrina />
            </TabPanel>
            <TabPanel header="Productos comprados">
                <sell-products @update-closed-sells="handleUpdateClosedSells" />
            </TabPanel>
            <TabPanel header="Ventas cerradas">
                <template #header>
                    <Badge :value="pendingProductsLength" />
                </template>
                <closing-sell-products 
                    @update:pendingProductsLength="updatePendingProductsLength" 
                    @update-pending-products="handleUpdatePending" 
                    :refresh="shouldRefreshClosingSellProducts"
                />
            </TabPanel>
            <TabPanel header="Pagos">
                <payments 
                    :refresh-data="refreshPending"
                />
            </TabPanel>
            <TabPanel header="Ingresos">
                <incomings 
                    :refresh-data="refreshPending"
                />
            </TabPanel>
        </TabView>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import Badge from 'primevue/badge';
import DraftProducts from "../components/AdminPanel/DraftProducts.vue";
import ProductsPublished from "../components/AdminPanel/ProductsPublished.vue";
import Vitrina from "../components/AdminPanel/Vitrina.vue";
import SellProducts from "../components/AdminPanel/SellProducts.vue";
import ClosingSellProducts from "../components/AdminPanel/ClosingSellProducts.vue";
import Payments from "../components/AdminPanel/Payments.vue";
import Incomings from "../components/AdminPanel/Incomings.vue";

// Define a reactive property to hold the pending products length
const pendingProductsLength = ref(0);

// Method to update the pending products length when the event is emitted by the child component
const updatePendingProductsLength = (newValue) => {
  pendingProductsLength.value = newValue;
};

//Closed Sells
const shouldRefreshClosingSellProducts = ref(false);

const handleUpdateClosedSells = () => {
  shouldRefreshClosingSellProducts.value = true;
};

//Pending
const refreshPending = ref(false);
const handleUpdatePending = () => {
    refreshPending.value = true;
}

</script>
<style scoped>
:deep(.p-tabview .p-tabview-nav li a) {
    font-size: 13px;
    background-color: #c0c6b9;
    color: #fff;
    text-align: center;
    justify-content: center;
    height: 100%;
    padding:  1rem;
    margin-right: 10px;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    transition: 0.4s all ease-out;
}
:deep(.p-tabview .p-tabview-nav li.p-highlight a) {
    background-color: #344026;
    color: #fff;
}
:deep(.p-tabview-title){
    white-space: normal;
}
</style>
