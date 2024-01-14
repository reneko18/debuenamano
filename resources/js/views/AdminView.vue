<template>
    <div>
        <Tabs>
            <Tab title="Solicitud de Publicaciones">
                <products-published />
            </Tab>

            <Tab title="En vitrina">
                <vitrina />
            </Tab>

            <Tab title="Tus compras">
                <p>This is the content for Tab 3.</p>
            </Tab>
        </Tabs>
    </div>
</template>
<script setup>
import Tabs from "../components/Tabs/Tabs.vue";
import Tab from "../components/Tabs/Tab.vue";
import ProductsPublished from "../components/AdminPanel/ProductsPublished.vue";
import Vitrina from "../components/AdminPanel/Vitrina.vue";
</script>
