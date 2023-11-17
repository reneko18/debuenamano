<template>
    <div class="container mx-auto">
        <h2 class="mb-4">Consulta completa</h2>
        <div>
            <h3 class="mb-4">Origen de la encomienda</h3>
            <div>
                <label for="regionOri" class="mb-4">Region</label>    
                <select id="regionOri" class="form-select" aria-label="Default select example" v-model="selectedOri.regionCodeOri">
                    <option value="">Selecciona una region</option>
                    <option :value="r.regionId" v-for="r in regionsOri">{{ r.regionName }}</option>
                </select>        
            </div>
            <div v-if="countiesLoaded">
                <label for="comunaOri" class="mb-4">Comuna</label>             
                <select id="comunaOri" class="form-select" aria-label="Default select example" v-model="selectedCountyOri">
                    <option :value="com.countyCode" v-for="com in countiesOri">{{ com.countyName }}</option>
                </select>        
            </div>
        </div>
        <div v-if="selectedCountyOri">
            <h3 class="mb-4">Destino de la encomienda</h3>
            <div>
                <label for="regionDest" class="mb-4">Region</label>    
                <select id="regionDest" class="form-select" aria-label="Default select example" v-model="selectedDes.regionCodeDes">
                    <option value="">Selecciona una region</option>
                    <option :value="rDes.regionId" v-for="rDes in regionsDes">{{ rDes.regionName }}</option>
                </select>        
            </div>
            <div v-if="countiesLoadedDes">
                <label for="comunaOri" class="mb-4">Comuna</label>             
                <select id="comunaOri" class="form-select" aria-label="Default select example" v-model="selectedCountyDes">
                    <option :value="comDes.countyCode" v-for="comDes in countiesDes">{{ comDes.countyName }}</option>
                </select>        
            </div>
        </div>
        <div v-if="selectedCountyDes">
            <h3>Dimensiones paquete</h3>
            <div class="row">
                <div class="col">
                    <label for="weight">Peso (Kg)</label>
                    <input class="form-control" type="text" v-model="package.weight">
                </div>
                <div class="col">
                    <label for="height">Alto (cm)</label>
                    <input class="form-control" type="text" v-model="package.height">
                </div>
                <div class="col">
                    <label for="width">Ancho (cm)</label>
                    <input class="form-control" type="text" v-model="package.width">
                </div>
                <div class="col">
                    <label for="length">Largo (cm)</label>
                    <input class="form-control" type="text" v-model="package.length">
                </div>
            </div>
            <div>
                <label for="price">Valor Declarado del paquete</label>
                <input class="form-control" type="text" v-model="price">
            </div>
        </div>

    </div>
    <div class="container mx-auto">
        <h2>Obtener cotizacion</h2>
        <a @click="getCotizaChilexpress">Cotizar</a>

        <div v-for="cot in cotizador">
            <p>Tipo de Entrega: <span>{{ cot.serviceDescription }}</span></p>
            <p>Peso Final: <span>{{ cot.finalWeight }} </span></p>
            <p>Valor de envio: <span>$ {{ cot.serviceValue }} </span></p>
        </div>
    </div>

</template>
<script>
export default {
    data: function () {
        return { 
            regionsOri: [],
            cotizador:[],
            countiesOri:[],
            regionsDes: [],
            countiesDes:[],
            countiesLoaded: false,
            countiesLoadedDes: false,
            selectedOri:{
                regionCodeOri:'',
            },
            selectedDes:{
                regionCodeDes:'',
            },
            selectedCountyOri: '',           
            selectedCountyDes: '',
            package:{
                weight:'',
                height:'',
                width:'',
                length:'',
            },
            price:'',
            deliveryTime:'',
        }
    },
    mounted() {
            this.getRegionsOriChilexpress();
            this.getRegionsDesChilexpress();
    },
    watch: {
            selectedOri: {
                handler: function () {
                        this.getComunasOriChilexpress();                                 
                    },
            deep: true
            },
            selectedDes: {
                handler: function () {
                        this.getComunasDesChilexpress();                                 
                    },
            deep: true
            },          
    },
    methods: {
        getRegionsOriChilexpress() {
            const apiKey = '570f3f00500c433a9b2b94e7b4803c1b';
            const apiUrl = 'https://testservices.wschilexpress.com/georeference/api/v1.0/regions';

            axios.get(apiUrl, {
                params: {
                api_key: apiKey, // Add your API key as a query parameter
                },
            })
                .then((response) => {
                    this.regionsOri = response.data.regions;
                })
                .catch(function (error) {
                console.log(error);
            });
        },
        getComunasOriChilexpress() {
            const apiKey = '570f3f00500c433a9b2b94e7b4803c1b';
            const apiUrl = 'https://testservices.wschilexpress.com/georeference/api/v1.0/coverage-areas';

            axios.get(apiUrl, {
                params: {
                api_key: apiKey,
                RegionCode: this.selectedOri.regionCodeOri,
                type: 1,
                },
            })
                .then((response) => {
                    this.countiesOri = response.data.coverageAreas;      
                    this.countiesLoaded = true;
                    this.selectedCountyOri = this.countiesOri[0].countyCode;
                })
                .catch(function (error) {
                console.log(error);
            });
        },
        getRegionsDesChilexpress() {
            const apiKey = '570f3f00500c433a9b2b94e7b4803c1b';
            const apiUrl = 'https://testservices.wschilexpress.com/georeference/api/v1.0/regions';

            axios.get(apiUrl, {
                params: {
                api_key: apiKey, // Add your API key as a query parameter
                },
            })
                .then((response) => {  
                    this.regionsDes = response.data.regions;
                    console.log(this.regionsDes);
                })
                .catch(function (error) {
                console.log(error);
            });
        },
        getComunasDesChilexpress() {
            const apiKey = '570f3f00500c433a9b2b94e7b4803c1b';
            const apiUrl = 'https://testservices.wschilexpress.com/georeference/api/v1.0/coverage-areas';

            axios.get(apiUrl, {
                params: {
                api_key: apiKey,
                RegionCode: this.selectedDes.regionCodeDes,
                type: 1,
                },
            })
                .then((response) => {
                    this.countiesDes = response.data.coverageAreas;  
                    this.countiesLoadedDes = true;
                    this.selectedCountyDes = this.countiesDes[0].countyCode;
                })
                .catch(function (error) {
                console.log(error);
            });
        },
        getCotizaChilexpress() {
            const apiUrl = 'https://testservices.wschilexpress.com/rating/api/v1.0/rates/business';
            const body = {
                "originCountyCode": this.selectedCountyOri,
                "destinationCountyCode": this.selectedCountyDes,
                "package": {
                    "weight": this.package.weight,
                    "height": this.package.height,
                    "width": this.package.width,
                    "length": this.package.length,
                },
                "producttype": 3,
                "declaredWorth": this.price,
                "deliveryTime": 0,
            };
            const headers = {
                'Content-Type': 'application/json',
                'Cache-Control': 'no-cache',
                'Ocp-Apim-Subscription-Key': '616e20bc17454bd4b97a37aa1642d46d',
            };

            axios.post(apiUrl, body, {
                headers: headers,
            })
            .then((response) => {
                console.log(response.status);
                console.log(response.data);
                this.cotizador = response.data.data.courierServiceOptions;
                console.log(this.cotizador);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>