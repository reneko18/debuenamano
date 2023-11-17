import "./bootstrap";
import "@mdi/font/css/materialdesignicons.css";

import { createApp } from "vue";
import { createPinia } from "pinia";
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
const vuetify = createVuetify({
    components,
    directives,
    icons: {
        iconfont: "mdi", // This sets the iconfont to use MDI icons
    },
});
import PrimeVue from "primevue/config";
import router from "./router/router";

/*Vue Click outside*/
import vueClickOutsideElement from "vue-click-outside-element";

/* import the fontawesome core */
import { library } from "@fortawesome/fontawesome-svg-core";

/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

/* import specific icons */
import { faChevronRight } from "@fortawesome/free-solid-svg-icons";
import { faArrowRight } from "@fortawesome/free-solid-svg-icons";
import { faPenToSquare } from "@fortawesome/free-regular-svg-icons";
import { faTrashCan } from "@fortawesome/free-regular-svg-icons";

/* add icons to the library */
library.add(faChevronRight, faArrowRight, faPenToSquare, faTrashCan);

const app = createApp({});
const pinia = createPinia();

import { Bootstrap5Pagination } from "laravel-vue-pagination";
import NewSellingForm from "./views/NewSellingForm.vue";
import PostsLoop from "./components/Post/PostsLoopComponent.vue";
import Chilexpress from "./components/TestChilexpress.vue";
import PostAdminTable from "./components/Post/PostAdminTable.vue";
import AddCartProduct from "./components/Cart/AddCartProduct.vue";
import CartHeader from "./components/Cart/CartHeader.vue";
import CartPage from "./components/Cart/CartPage.vue";

app.use(pinia);
app.use(vuetify);
app.use(PrimeVue);
app.use(vueClickOutsideElement);
app.use(router);
app.component("new-selling-form-product", NewSellingForm);
app.component("Bootstrap5Pagination", Bootstrap5Pagination);
app.component("posts-loop", PostsLoop);
app.component("post-table", PostAdminTable);
app.component("chilexpress", Chilexpress);
app.component("add-cart-product", AddCartProduct);
app.component("cart-page", CartPage);
app.component("cart-header", CartHeader);
app.component("font-awesome-icon", FontAwesomeIcon);
app.mount("#app");
