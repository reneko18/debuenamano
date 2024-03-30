import "./bootstrap";
import "@mdi/font/css/materialdesignicons.css";

import { createApp } from "vue";
import { createPinia } from "pinia";

import PrimeVue from "primevue/config";
import ToastService from 'primevue/toastservice';
import router from "./router/router";

import "primevue/resources/themes/lara-light-blue/theme.css"; // Replace with your desired theme
import "primeicons/primeicons.css";
import "primeflex/primeflex.css";

/*Vue Click outside*/
import vueClickOutsideElement from "vue-click-outside-element";

/* import the fontawesome core */
import { library } from "@fortawesome/fontawesome-svg-core";

/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

/* import specific icons */
import { faChevronRight } from "@fortawesome/free-solid-svg-icons";
import { faChevronDown } from "@fortawesome/free-solid-svg-icons";
import { faArrowRight } from "@fortawesome/free-solid-svg-icons";
import { faArrowLeft } from "@fortawesome/free-solid-svg-icons";
import { faPenToSquare } from "@fortawesome/free-regular-svg-icons";
import { faTrashCan } from "@fortawesome/free-regular-svg-icons";
import { faPlus } from "@fortawesome/free-solid-svg-icons";
import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
import { faEyeSlash } from "@fortawesome/free-regular-svg-icons";
import { faEye } from "@fortawesome/free-regular-svg-icons";
import { faAngleLeft } from "@fortawesome/free-solid-svg-icons";
import { faAngleRight } from "@fortawesome/free-solid-svg-icons";
import { faCheck } from "@fortawesome/free-solid-svg-icons";

/* add icons to the library */
library.add(
    faChevronDown,
    faChevronRight,
    faArrowRight,
    faArrowLeft,
    faPenToSquare,
    faTrashCan,
    faPlus,
    faMagnifyingGlass,
    faEye,
    faEyeSlash,
    faAngleLeft,
    faAngleRight,
    faCheck
);

const app = createApp({});
const pinia = createPinia();

import { Bootstrap5Pagination } from "laravel-vue-pagination";
import NewSellingForm from "./views/NewSellingForm.vue";
import SellingFormTwo from "./views/SellingFormTwo.vue";
import PostsLoop from "./components/Post/PostsLoopComponent.vue";
import Chilexpress from "./components/TestChilexpress.vue";
import PostAdminTable from "./components/Post/PostAdminTable.vue";
import AddCartProduct from "./components/Cart/AddCartProduct.vue";
import CartHeader from "./components/Cart/CartHeader.vue";
import CartPage from "./components/Cart/CartPage.vue";
import AdminUser from "./views/AdminUser.vue";
import AdminView from "./views/AdminView.vue";
import Slider from "./components/Home/Slider.vue";
import AdminProductEdit from "./views/AdminProductEdit.vue";
import NewAdmin from "./views/NewAdmin.vue";
import NewCart from "./views/NewCart.vue";

app.use(pinia);
app.use(vueClickOutsideElement);
app.use(router);
app.component("new-selling-form-product", NewSellingForm);
app.component("selling-form-product-two", SellingFormTwo);
app.component("Bootstrap5Pagination", Bootstrap5Pagination);
app.component("posts-loop", PostsLoop);
app.component("post-table", PostAdminTable);
app.component("chilexpress", Chilexpress);
app.component("add-cart-product", AddCartProduct);
app.component("cart-page", CartPage);
app.component("cart-header", CartHeader);
app.component("admin-user", AdminUser);
app.component("admin-view", AdminView);
app.component("admin-product-edit", AdminProductEdit);
app.component("new-admin", NewAdmin);
app.component("new-cart", NewCart);
app.component("slider-home", Slider);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(PrimeVue,{
    locale: {
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octobre', 'Noviembre', 'Diciembre'],
        dateFormat: 'dd/mm/yy',
    }
});
app.use(ToastService);
app.mount("#app");
