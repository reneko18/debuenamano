import './bootstrap';
import '@mdi/font/css/materialdesignicons.css';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import 'vuetify/styles'
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
const vuetify = createVuetify({
  components,
  directives,
  icons: {
    iconfont: 'mdi', // This sets the iconfont to use MDI icons
  },
})

/*Vue Click outside*/
import vueClickOutsideElement from 'vue-click-outside-element'

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faChevronRight } from '@fortawesome/free-solid-svg-icons'
import { faArrowRight } from '@fortawesome/free-solid-svg-icons'
import { faPenToSquare } from '@fortawesome/free-regular-svg-icons'
import { faTrashCan } from '@fortawesome/free-regular-svg-icons'

/* add icons to the library */
library.add(faChevronRight,faArrowRight,faPenToSquare,faTrashCan)

const app = createApp({});
const pinia = createPinia();



import NewSellingForm from './views/NewSellingForm.vue';

app.use(pinia);
app.use(vuetify);
app.use(vueClickOutsideElement)
app.component('new-selling-form-product', NewSellingForm);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');
