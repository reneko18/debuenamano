<template>
    <div>
        <Tabs>
            <Tab title="Publicaciones">
                <products-published />
            </Tab>

            <Tab title="En vitrina">
                <!-- Content for Tab 2 -->
                <p>This is the content for Tab 2.</p>
            </Tab>

            <Tab title="Tus compras">
                <!-- Content for Tab 3 -->
                <p>This is the content for Tab 3.</p>
            </Tab>
        </Tabs>
    </div>
</template>
<script setup>
import Tabs from "../components/Tabs/Tabs.vue";
import Tab from "../components/Tabs/Tab.vue";
import ProductsPublished from "../components/UserAdmin/ProductsPublished.vue";
</script>
