<template>  
    <section class="container">
        <div class="row">
            <div class="col-3 nav-pasos">
                <ul class="main-list">
                    <li
                        class="titulo-pasos"
                        :class="{ active: currentStep === index }"
                        v-for="(item, index) in linkCollection"
                        :key="index"
                        @click="setCurrentStep(index)"
                    >
                        <div class="number-title">
                            <span class="number">{{ item.mainTitle.number + 1 }}</span>
                            <span class="main-title">{{ item.mainTitle.name }}</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <component
                    :is="formSteps[currentStep]"
                    :cart-items="cartItems"
                    :total-price="totalPrice"
                    @next-step="nextStep"
                    @previous-step="previousStep"
                    @webpay="handleWebpay"
                />
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted} from "vue";
import StepOne from "../components/Cart/Steps/StepOne.vue"
import StepTwo from "../components/Cart/Steps/StepTwo.vue"
import StepThree from "../components/Cart/Steps/StepThree.vue"
import { useFormStore } from "../stores/values/";


const props = defineProps({
    cartItems: { 
        type: Object, 
        default: () => ({}), 
    },
    totalPrice: { 
        type: String, 
        default:'', 
    },
});

const formStore = useFormStore();
const formCart = formStore.formCart;

const currentStep = ref(0);

const formSteps = ref([
    StepOne,
    StepTwo,
    StepThree
]);

const linkCollection = ref([
    {
        mainTitle: {
            name: "Tu Carro",
            number: 0,
        },
    },
    {
        mainTitle: {
            name: "Despacho",
            number: 1,
        },
    },
    {
        mainTitle: {
            name: "Confirmar compra",
            number: 2,
        },
    },
]);

const setCurrentStep = (index) => {
    currentStep.value = index;
};

const nextStep = () => {
    currentStep.value++;
};

const previousStep = () => {
    currentStep.value--;
};

const paymentForm = ref(null);

// const handleWebpay = () => {
//     if (paymentForm.value) {
//         paymentForm.value.submit();
//     } else {
//         console.error('Payment form is not available');
//     }
// };

//New order Data 
const handleWebpay = () => {
    if (paymentForm.value) {
        // Extract the required data from props.cartItems
        const orderData = props.cartItems.map(item => ({
            id: item.id,
            selectedService: item.selectedService
        }));

         // Wrap the orderData array inside an object with the key 'items'
         const requestData = { items: orderData, form: formCart };

        // Send an HTTP POST request to your Laravel backend to save the order
        axios.post('/api/orders', requestData)
            .then(response => {
                // Handle success
                console.log('Order saved successfully:', response.data);
                // Now you can proceed with submitting the payment form
                paymentForm.value.submit();
            })
            .catch(error => {
                // Handle error
                console.error('Error saving order:', error);
            });
    } else {
        console.error('Payment form is not available');
    }
};

// Use onMounted to ensure paymentForm is initialized after component mount
onMounted(() => {
    paymentForm.value = document.querySelector('#paymentForm');
});

</script>


<style scoped>
.main-list {
    list-style: none;
    padding: 0;
}
.titulo-pasos {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin: 5px 0;
    cursor: pointer;
}

.titulo-pasos.item-0:before,
.titulo-pasos.item-1:before,
.titulo-pasos.item-2:before,
.titulo-pasos.item-3:before {
    content: "";
    position: absolute;
    border-left: 2px dashed #728c54;
    left: 23px;
    bottom: -8px;
    z-index: 1;
    height: 100%;
    top: 20px;
}

.titulo-pasos.active.item-0:before,
.titulo-pasos.active.item-1:before,
.titulo-pasos.active.item-2:before,
.titulo-pasos.active.item-3:before {
    content: "";
    position: absolute;
    border-left: 2px solid #728c54;
    left: 23px;
    bottom: -8px;
    z-index: 1;
    height: 100%;
    top: 20px;
}

.number-title {
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2;
}

.number-title .number {
    color: #728c54;
    border: 2px solid #728c54;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    text-align: center;
    line-height: 28px;
    background-color: #fff;
    margin-right: 1rem;
}

.titulo-sub-pasos {
    margin-left: 1rem;
}
.titulo-sub-pasos .active {
    background-color: #d29c37;
    color: #fff;
    display: inline-flex;
}
/*.separator {
  flex-grow: 1;
  width: 2px;
  border-left: 2px dashed #728C54;
  margin-top: 10px;
}*/

/*.separator.expanded {
  height: 100px;
}*/

.item-4 .separator {
    border-left: 2px dashed transparent;
}

.item-4 .separator.expanded {
    height: 100%;
}

.cont-subtitles {
    display: flex;
    flex-direction: row;
}
</style>