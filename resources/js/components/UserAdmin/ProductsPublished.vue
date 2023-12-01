<template>
    <div>
        <input v-model="filters['global'].value" placeholder="Search..." />
        <DataTable
            :value="products"
            v-model:filters="filters"
            :globalFilterFields="['name', 'price', 'publish_status']"
        >
            <Column field="name" header="Articulo" :filter="true"></Column>
            <Column
                field="category_id"
                header="Categoria"
                :filter="true"
            ></Column>
            <Column field="price" header="Precio"></Column>
            <Column field="publish_status" header="Estado"></Column>
        </DataTable>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { FilterMatchMode } from "primevue/api";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
// const products = ref([]);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const products = [
    {
        id: 1,
        name: "Product 1",
        category_id: 1,
        price: 10,
        publish_status: "Published",
    },
    {
        id: 2,
        name: "Product 2",
        category_id: 2,
        price: 20,
        publish_status: "Draft",
    },
    {
        id: 3,
        name: "Product 3",
        category_id: 1,
        price: 15,
        publish_status: "Published",
    },
    {
        id: 4,
        name: "Product 4",
        category_id: 3,
        price: 25,
        publish_status: "Published",
    },
    {
        id: 5,
        name: "Product 5",
        category_id: 2,
        price: 18,
        publish_status: "Draft",
    },
    {
        id: 6,
        name: "Product 6",
        category_id: 3,
        price: 30,
        publish_status: "Draft",
    },
    {
        id: 7,
        name: "Product 7",
        category_id: 1,
        price: 22,
        publish_status: "Published",
    },
    {
        id: 8,
        name: "Product 8",
        category_id: 2,
        price: 17,
        publish_status: "Published",
    },
    {
        id: 9,
        name: "Product 9",
        category_id: 3,
        price: 28,
        publish_status: "Draft",
    },
    {
        id: 10,
        name: "Product 10",
        category_id: 1,
        price: 12,
        publish_status: "Draft",
    },
];

// const fetchData = (user_id) => {
//     axios
//         .get(`/api/table/${user_id}`)
//         .then((response) => {
//             products.value = response.data;
//         })
//         .catch((error) => {
//             console.error("Error fetching data:", error);
//         });
// };

// onMounted(() => {
//     // Assuming your Laravel server is running on http://localhost:8000
//     fetchData(1); // Replace 1 with the actual user_id

//     // Other component setup...
// });
</script>
