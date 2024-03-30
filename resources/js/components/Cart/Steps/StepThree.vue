<template>
    Form Cart : {{ formCart }}
    <div class="bg-cart mb-5 pb-5">
        <div class="row col-10 mx-auto">   
            <div class="col-10">
                <h2>Articulo</h2>
            </div>
            <div class="col-2">
                <h2>Precio</h2>
            </div>
        </div>
        <div class="row col-10 mx-auto mb-3 row-prod-cart" v-for="item in cartItems">   
            <div class="col-10 d-flex align-items-center">
                <img class="img-prod-cart" :src="'/' + item.galleries[0].url" :alt="item.galleries[0].alt">
                <h3>{{ item.name }}</h3>
            </div>
            <div class="col-2 d-flex align-items-center">
                <span class="precio-cart">${{ item.price }}</span>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h2>Datos de contacto</h2>
        <div class="container mx-auto">        
            <div class="row">
                <div class="col-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" v-model="formCart.firstname" readonly>
                </div>
                <div class="col-6">
                    <label for="lastname" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="lastname" v-model="formCart.lastname" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" v-model="formCart.email" readonly>
                </div>
                <div class="col-6">
                    <label for="phone" class="form-label">Fono</label>
                    <input type="text" class="form-control" id="phone" v-model="formCart.phone" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h2>Datos de envío</h2>
        <div class="container mx-auto">        
            <div>            
                <label for="street" class="form-label">Calle</label>
                <input type="text" class="form-control" id="street" v-model="formCart.street">        
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="region" class="form-label">Región</label> 
                    <input type="text" id="region" class="form-control" :value="formCart.region.regionName" readonly>
                </div>
                <div class="col-6">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" id="city" class="form-control" :value="formCart.city.countyName" readonly>
                </div>
            </div>
        </div>
        <div class="mb-5 d-flex justify-content-start">
            <a class="btn boton-principal" @click="getCotizasForCartItems">Calcular tipos de envío</a>
        </div>        
    </div>

    <div class="row col-10 mx-auto mb-3 row-prod-cart" v-for="(item, index) in cartItems" :key="index">   
        <div class="col-7 d-flex align-items-center">
            <img class="img-prod-cart" :src="'/' + item.galleries[0].url" :alt="item.galleries[0].alt">
            <h3>{{ item.name }}</h3>
        </div>
        <div class="col-5">
            <select class="form-select" v-model="item.selectedService" disabled>
                <option
                    v-for="(service, serviceIndex) in item.services"
                    :key="serviceIndex"
                    :value="service"                  
                >
                    {{ service.serviceDescription }} - $ {{ service.serviceValue }}
                </option>
            </select>             
        </div>
    </div>
    <div>
        <div class="col-8 ms-auto">
            <div class="subtotal-cart mb-2 pb-2">
                <h3>Carro</h3>
                <span>$ {{ totalPrice }}</span>
            </div>
            <div class="subtotal-cart mb-2 pb-2" v-for="cart in cartItems">
                <h3>Envío [ {{ cart.name }} ]</h3>
                <span v-if="cart.selectedService.serviceValue"> $ {{ cart.selectedService.serviceValue }} </span>
                <span v-if="cart.selectedService.additionalServices && cart.selectedService.additionalServices.length > 0"> 
                    <template v-for="(additional, index) in cart.selectedService.additionalServices">
                        {{ additional.serviceDescription }} :  $ {{ additional.serviceValue }}{{ index < cart.selectedService.additionalServices.length - 1 ? ', ' : '' }}
                    </template>
                </span>
            </div>
            <div class="total-cart">
                <h3>TOTAL</h3>
                <span>$ {{ total }}</span>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-5">
        <a class="btn boton-principal" @click="previousStep">Volver</a>
        <a class="btn boton-principal" @click="handleWebpay">Finalizar compra</a>
    </div>
</template>
<script setup>
import { ref ,computed, watch, defineEmits, onMounted } from "vue";
import { useFormStore } from "../../../stores/values";
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

const emit = defineEmits(['previous-step','webpay']);

const previousStep = () => {
    emit('previous-step');
};

const handleWebpay = () => {
    emit('webpay');
};

const formStore = useFormStore();
const formCart = formStore.formCart;
// Compute the total by summing up totalPrice and the shipping cost for each item
const total = computed(() => {
    let shippingTotal = 0;
    let additionalTotal = 0;
    for (const cart of cartItems.value) {
        if (cart.selectedService?.serviceValue) {
            shippingTotal += +cart.selectedService?.serviceValue; // Convert to number using unary plus operator
        }
        if (cart.selectedService.additionalServices) {
            for (const additional of cart.selectedService.additionalServices) {
                additionalTotal += +additional.serviceValue;
            }
        }
    }
    const totalPrice = +props.totalPrice; // Convert totalPrice to a number
    formCart.total = totalPrice + shippingTotal + additionalTotal;
    return totalPrice + shippingTotal + additionalTotal;
});



const cartItems = ref(props.cartItems);


const regionsOri = ref([]);
const countiesOri = ref([]);
// const selectedOri = ref({
//       regionCodeOri:'',
// });
const countiesLoaded = ref(false);
// const selectedCountyOri = ref('');

// const cotizador = ref([]);

const getRegionsOriChilexpress = async () => {
    const apiKey = '570f3f00500c433a9b2b94e7b4803c1b';
    const apiUrl = 'https://testservices.wschilexpress.com/georeference/api/v1.0/regions';

    try {
        const response = await axios.get(apiUrl, {
            params: {
                api_key: apiKey,
            },
        });

        regionsOri.value = response.data.regions;
    } catch (error) {
        console.error(error);
    }
};

const getComunasOriChilexpress = async () => {
    const apiKey = '570f3f00500c433a9b2b94e7b4803c1b';
    const apiUrl = 'https://testservices.wschilexpress.com/georeference/api/v1.0/coverage-areas';
    try {
        const response = await axios.get(apiUrl, {
            params: {
                api_key: apiKey,
                // RegionCode: selectedOri.value.regionCodeOri,
                RegionCode: formCart.region,
                type: 1,
            },
        });

        countiesOri.value = response.data.coverageAreas;      
        countiesLoaded.value = true;
        // selectedCountyOri.value = countiesOri.value[0].countyCode;
        formCart.city = countiesOri.value[0].countyCode;
    } catch (error) {
        console.error(error);
    }
};


// const getCotizasForCartItems = () => {
//     for (const item of Object.values(props.cartItems)) {
//         const { weight, height, width, length, price, delivery_information } = item;
//         getCotizaChilexpress(delivery_information.city_code, weight, height, width, length, price);
//     }
// };

const getCotizasForCartItems = async () => {
    for (const item of Object.values(props.cartItems)) {
        const { weight, height, width, length, price, delivery_information } = item;
        const serviceOptions = await getCotizaChilexpress(delivery_information.city_code, weight, height, width, length, price);
        item.services = serviceOptions; // Update the services for the item
    }
};

// const getCotizaChilexpress = async (originCountyCode, weight, height, width, length, price) => {
//     const apiUrl = 'https://testservices.wschilexpress.com/rating/api/v1.0/rates/courier';
//     const body = {
//         "originCountyCode": originCountyCode,
//         "destinationCountyCode": selectedCountyOri.value,
//         "package": {
//             "weight": weight,
//             "height": height,
//             "width": width,
//             "length": length,
//         },
//         "producttype": 3,
//         "declaredWorth": price,
//         "deliveryTime": 0,
//     };

//     const headers = {
//         'Content-Type': 'application/json',
//         'Cache-Control': 'no-cache',
//         'Ocp-Apim-Subscription-Key': '616e20bc17454bd4b97a37aa1642d46d',
//     };

//     try {
//         const response = await axios.post(apiUrl, body, { headers });
//         console.log(response.status);
//         console.log(response.data);
//         // cotizador.value = response.data.data.courierServiceOptions;
//         // console.log(cotizador.value);
      

//         // Assuming cotizador contains the response received from the API
//         const serviceOptions = response.data.data.courierServiceOptions;
//         // Update cartItems with the service options array  
//         const updatedCartItems = cartItems.value.map(item => ({
//             ...item,
//             services: JSON.parse(JSON.stringify(serviceOptions)) // Create a deep copy of the serviceOptions array
//         }));
        
//         cartItems.value = updatedCartItems;
//     } catch (error) {
//         console.error(error);
//     }
// };


const getCotizaChilexpress = async (originCountyCode, weight, height, width, length, price) => {
    const apiUrl = 'https://testservices.wschilexpress.com/rating/api/v1.0/rates/courier';
    const body = {
        "originCountyCode": originCountyCode,
        // "destinationCountyCode": selectedCountyOri.value,
        "destinationCountyCode": formCart.city,
        "package": {
            "weight": weight,
            "height": height,
            "width": width,
            "length": length,
        },
        "producttype": 3,
        "declaredWorth": price,
        "deliveryTime": 0,
    };

    const headers = {
        'Content-Type': 'application/json',
        'Cache-Control': 'no-cache',
        'Ocp-Apim-Subscription-Key': '616e20bc17454bd4b97a37aa1642d46d',
    };

    try {
        const response = await axios.post(apiUrl, body, { headers });
        const serviceOptions = response.data.data.courierServiceOptions;
        console.log(serviceOptions);
        return serviceOptions; // Return the service options
    } catch (error) {
        console.error(error);
        return []; // Return an empty array if there's an error
    }
};

// Function to send AJAX request
const sendAjaxRequest = async (newValue) => {
    try {
        // Make a POST request to the server
        const response = await axios.post('api/update-total', {
            total: newValue
        });
        console.log(response.data); // Log the response
    } catch (error) {
        console.error(error); // Handle errors
    }
};


// watch(selectedOri, () => {
//     getComunasOriChilexpress(); 
// }, { deep: true });

// watch(formCart.region, () => {
//     getComunasOriChilexpress(); 
// }, { deep: true });

watch(() => formCart.region, () => {
    getComunasOriChilexpress(); 
}, { deep: true });

watch(() => formCart.total, (newValue, oldValue) => {
    if (newValue !== oldValue) {
        sendAjaxRequest(newValue); // Send the new value to the server
        const event = new CustomEvent('ajaxUpdateTotal', { detail: { total: newValue } });
        window.dispatchEvent(event);
    }
});

onMounted(() => {
    getRegionsOriChilexpress();
    sendAjaxRequest();
});
</script>

<style scoped>
.bg-cart{
    background-color: #F8FAF7;
}
.bg-cart h2{
    font-size:10px;
    font-weight: 700;
    color: #C0C6B9;
}
.row-prod-cart{
    background-color: #fff;
}
.img-prod-cart{
    width:100%;
    max-width:80px;
    margin-right:1rem;
}
.subtotal-cart, .total-cart{
    display:flex;
    flex-direction: row;
    justify-content: space-between;        
}
.subtotal-cart{
    border-bottom: 1px dotted #728C54;
}
.subtotal-cart h3,.subtotal-cart span, .total-cart h3, .total-cart span{
    color: #151A0F;
}
.subtotal-cart h3, .subtotal-cart span{
    font-size:15px;
    font-weight:400;
}
.total-cart h3, .total-cart span{
    font-size:20px;
    font-weight:700;
}
</style>