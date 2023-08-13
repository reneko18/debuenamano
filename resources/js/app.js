import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';


/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faChevronRight } from '@fortawesome/free-solid-svg-icons'
import { faArrowRight } from '@fortawesome/free-solid-svg-icons'
import { faPenToSquare } from '@fortawesome/free-regular-svg-icons'

/* add icons to the library */
library.add(faChevronRight,faArrowRight,faPenToSquare)

const app = createApp({});
const pinia = createPinia();


import SellingForm from './views/SellingForm.vue';
import NewSellingForm from './views/NewSellingForm.vue';

app.use(pinia);
app.component('selling-form-product', SellingForm);
app.component('new-selling-form-product', NewSellingForm);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');
