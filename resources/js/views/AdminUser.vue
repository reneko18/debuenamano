<template>
    <div class="row container">
        <div class="col-6"></div>
        <div class="col-6">
            <div>
                <span>
                    Publicados : <strong>{{ productsPublishedCount }}</strong>
                </span>
                <span>
                    En vitrina : <strong>{{ productsDisplayedCount }}</strong>
                </span>
                <span>
                    Comprados : <strong>{{ productsPurchasedCount }}</strong>
                </span>
            </div>
        </div>
    </div>

    <div>
        <Tabs>
            <Tab title="Publicaciones" icon="fa-regular fa-eye">
                <published
                    :user-id="userId"
                    @update-products-published-count="
                        updateProductsPublishedCount
                    "
                />
            </Tab>

            <Tab title="En vitrina">
                <displayed
                    :user-id="userId"
                    @update-products-displayed-count="
                        updateProductsDisplayedCount
                    "
                />
            </Tab>

            <Tab title="Tus compras">
                <purchased
                    :user-id="userId"
                    @update-products-purchased-count="
                        updateProductsPurchasedCount
                    "
                />
            </Tab>
            <Tab title="Favoritos"><h1>Tab 3</h1> </Tab>
            <Tab title="Tu Cuenta"> 
                <my-account :user-id="userId" :user-slug="userSlug" />
            </Tab>
        </Tabs>
    </div>
</template>
<script setup>
import { ref } from "vue";
import Tabs from "../components/Tabs/Tabs.vue";
import Tab from "../components/Tabs/Tab.vue";
import Published from "../components/UserAdmin/Published.vue";
import Displayed from "../components/UserAdmin/Displayed.vue";
import Purchased from "../components/UserAdmin/Purchased.vue";
import MyAccount from "../components/UserAdmin/MyAccount.vue";
const props = defineProps({
    userId: { type: Number, default: "" },
    userSlug: { type: String, default: "" },
});

const productsPublishedCount = ref("");
const productsDisplayedCount = ref("");
const productsPurchasedCount = ref("");

const updateProductsPublishedCount = (count) => {
    productsPublishedCount.value = count;
};

const updateProductsDisplayedCount = (count) => {
    productsDisplayedCount.value = count;
};
const updateProductsPurchasedCount = (count) => {
    productsPurchasedCount.value = count;
};
</script>
