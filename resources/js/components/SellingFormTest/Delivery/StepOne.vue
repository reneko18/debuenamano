<template>
    <div class="modulo-pasos">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <h2>Envío o retiro del artículo</h2>
                <p class="bajada-h2">
                    Una vez que tu artículo sea vendido, ¿lo dejarás en la
                    sucursal de Chilexpress más cercana o prefieres que
                    gestionemos el retiro en tu domicilio? La elección es tuya.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="cont-option-delivery">
                    <input
                        type="radio"
                        class="btn-check"
                        name="delivery-option"
                        id="chilexpress"
                        value="Chilexpress"
                        v-model="formData.stepSevenOptionDelivery"
                    />
                    <label
                        class="btn"
                        for="chilexpress"
                        @click="toggleSection('Chilexpress')"
                    >
                        <span>LO LLEVO A LA</span>
                        <span>Sucursal de Chilexpress</span>
                    </label>
                </div>
                <div class="cont-option-delivery">
                    <input
                        type="radio"
                        class="btn-check"
                        name="delivery-option"
                        id="house"
                        value="Domicilio"
                        v-model="formData.stepSevenOptionDelivery"
                    />
                    <label
                        class="btn"
                        for="house"
                        @click="toggleSection('Domicilio')"
                    >
                        <span>PREFIERO EL RETIRO</span>
                        <span>Retiro a domicilio</span>
                    </label>
                </div>
            </div>
            <div class="col-8">
                <div v-if="formData.stepSevenSelectedSection === 'Chilexpress'">
                    <p>
                        Super, necesitamos selecciones la sucursal a la que
                        llevarías el artículo, esto nos permitirá calcular el
                        costo del envío para la persona que compre tu producto:
                    </p>

                    <label for="region" class="form-label">Tu región *</label>
                    <select-dbm-static
                        id="region"
                        class="select-chilexpress"
                        :items="regions"   
                        :selected="selected.region"
                        @update:selected-static="updateSelectedRegion"
                        placeholder="Selecciona una región"
                    />
                    <div v-if="errorMessageRegion" class="invalid-dbm">
                        {{ errorMessageRegion }}
                    </div>

                    <label for="city" class="form-label">Tu comuna *</label>
                    <select-dbm-static
                        id="city"
                        class="select-chilexpress"
                        :items="cities"   
                        :selected="selected.city"
                        @update:selected-static="updateSelectedCity"
                        placeholder="Selecciona tu comuna"
                    />
                    <div v-if="errorMessageCity" class="invalid-dbm">
                        {{ errorMessageCity }}
                    </div>        
                    <template v-if="officesError.statusCode === 0">
                        <label for="offices" class="form-label">Sucursal de Chilexpress *</label>
                        <select-dbm-static
                            id="offices"
                            class="select-chilexpress"
                            :items="offices"   
                            :selected="formData.stepSevenChilexpressOffice"
                            @update:selected-static="updateSelectedOffice"
                            placeholder="Selecciona una sucursal"
                        />
                        <div v-if="errorMessageOficina" class="invalid-dbm">
                            {{ errorMessageOficina }}
                        </div>
                    </template>
                    <template v-else>
                        <p>{{ officesError.statusDescription }}</p>
                    </template>
                </div>
                <div
                    v-else-if="
                        formData.stepSevenSelectedSection === 'Domicilio'
                    "
                >
                    <p>
                        Nos ajustamos a tus necesidades, ingresa la dirección
                        del lugar donde se encuentra el artículo y asegúrate de
                        que este correctamente embalado el día que vaya a
                        retirarlo Chilexpress:
                    </p>
                    <div>
                        <label for="street" class="form-label"
                            >Calle / Avenida</label
                        >
                        <input
                            type="text"
                            id="street"
                            class="form-control"
                            placeholder="Ingresa tu dirección"
                            v-model="formData.stepSevenStreet"
                        />
                    </div>
                    <div>
                        <label for="number" class="form-label">Nª</label>
                        <input
                            type="text"
                            id="number"
                            class="form-control"
                            placeholder="Ingresa el número"
                            v-model="formData.stepSevenStreetNumber"
                        />
                    </div>
                    <div>
                        <label for="dptoHouse" class="form-label"
                            >Depto/casa</label
                        >
                        <input
                            type="text"
                            id="dptoHouse"
                            class="form-control"
                            placeholder="Ingresa los datos"
                            v-model="formData.stepSevenStreetDptoHouse"
                        />
                    </div>

                    <div>
                        <label for="regionHouse" class="form-label"
                            >Tu región *</label
                        >
                        <select-dbm-static
                            id="regionHouse"
                            class="select-chilexpress"
                            :items="regions"   
                            :selected="selected.region"
                            @update:selected-static="updateSelectedRegion"
                            placeholder="Selecciona una región"
                        />
                        <div v-if="errorMessageRegionHouse" class="invalid-dbm">
                            {{ errorMessageRegionHouse }}
                        </div>
                    </div>

                    <div>
                        <label for="cityHouse" class="form-label"
                            >Tu comuna *</label
                        >
                        <select-dbm-static
                            id="cityHouse"
                            class="select-chilexpress"
                            :items="cities"   
                            :selected="selected.city"
                            @update:selected-static="updateSelectedCity"
                            placeholder="Selecciona tu comuna"
                        />
                        <div v-if="errorMessageCityHouse" class="invalid-dbm">
                            {{ errorMessageCityHouse }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <button class="btn boton-principal" @click="nextStep">
            Continuar <font-awesome-icon :icon="['fas', 'chevron-right']" />
        </button>
    </div>
</template>
<script setup>
import { onMounted, watch, ref } from "vue";
import { useFormStore } from "../../../stores/valuesTwo";
import SelectDbmStatic from "../../Dbm/SelectDbmStatic.vue";

const emit = defineEmits(["next-step", "constant-emitted"]);

const selected = ref({
    region: "",
    city: "",
});

const lastSelected = ref({
    region: "",
    city: "",
});

const cities = ref([]);
const offices = ref([]);
const officesError = ref({
     statusCode: 0, 
     statusDescription: 'No hay oficinas de Chilexpress en la comuna seleccionada, por favor, intenta con otra comuna',
});
const mainStep = 4;

const errorMessageRegion = ref('');
const errorMessageCity = ref('');
const errorMessageOficina = ref('');
const errorMessageRegionHouse = ref('');
const errorMessageCityHouse = ref('');

const formStore = useFormStore();
const formData = formStore.formData;

// Define and initialize regions as an empty array
const regions = ref([]);
const loading = ref(false); // Define loading as a ref and initialize it

const nextStep = () => {
    if (formData.stepSevenSelectedSection === 'Chilexpress' && !formData.stepSevenRegion) {
        // Set an error message and prevent the form from proceeding
        errorMessageRegion.value = "Por favor, seleccione una region.";
        return;
    }

    if (formData.stepSevenSelectedSection === 'Chilexpress' && !formData.stepSevenCity) {
        // Set an error message and prevent the form from proceeding
        errorMessageCity.value = "Por favor, seleccione una ciudad.";
        return;
    }
    if (formData.stepSevenSelectedSection === 'Chilexpress' && !formData.stepSevenChilexpressOffice) {
        // Set an error message and prevent the form from proceeding
        errorMessageOficina.value = "Por favor, seleccione una oficina";
        return;
    }

    if (formData.stepSevenSelectedSection === 'Domicilio' && !formData.stepSevenRegion) {
        // Set an error message and prevent the form from proceeding
        errorMessageRegionHouse.value = "Por favor, seleccione una region.";
        return;
    }
    if (formData.stepSevenSelectedSection === 'Domicilio' && !formData.stepSevenCity) {
        // Set an error message and prevent the form from proceeding
        errorMessageCityHouse.value = "Por favor, seleccione una ciudad.";
        return;
    }

    errorMessageRegion.value = null;
    errorMessageCity.value = null;
    errorMessageOficina.value = null;
    errorMessageRegionHouse.value = null;
    errorMessageCityHouse.value = null;
    formStore.setFormData(formData);
    emit("next-step");
};

const toggleSection = (section) => {
    formData.stepSevenSelectedSection = section;
};

const getRegionsChilexpress = async function () {
    const apiKey = "570f3f00500c433a9b2b94e7b4803c1b";
    const apiUrl = "https://testservices.wschilexpress.com/georeference/api/v1.0/regions";

    try {
        loading.value = true;
        const response = await axios.get(apiUrl, {
            params: {
                api_key: apiKey,
            },
        });    
        regions.value = response.data.regions.map(region => ({
            id: region.regionId,
            name: region.regionName,
            value: region.regionId
        }));
    } catch (error) {
        console.error("Error fetching regions:", error);
    } finally {
        loading.value = false;
    }
};

const getComunasChilexpress = async function () {
    const apiKey = "570f3f00500c433a9b2b94e7b4803c1b";
    const apiUrl = "https://testservices.wschilexpress.com/georeference/api/v1.0/coverage-areas";

    try {
        loading.value = true;
        const response = await axios.get(apiUrl, {
            params: {
                api_key: apiKey,
                RegionCode: selected.value.region,
                type: 1,
            },
        });     
        cities.value = response.data.coverageAreas.map(city => ({
            id: city.countyCode,
            name: city.countyName,
            value: city,
        }));
    } catch (error) {
        console.error("Error fetching cities:", error);
    } finally {
        loading.value = false;
    }
};

const getCoberturaOptions = async function () {
    const apiUrl = "https://testservices.wschilexpress.com/georeference/api/v1.0/offices?Type=0";   
    const regionCode = selected.value.region;            
    const cityName = selected.value.city;

    try {
        const response = await axios.get(apiUrl, {
            headers: {
                "Cache-Control": "no-cache",
                "Ocp-Apim-Subscription-Key": "570f3f00500c433a9b2b94e7b4803c1b",
            },
            params: {
                RegionCode: regionCode,
                CountyName: cityName.countyName,
            },
        });
        offices.value = response.data.offices.map(office => ({
            id: office.officeCode,
            name: office.officeName,
            value: office.officeName,
        }));
        officesError.value.statusCode = response.data.statusCode;
    } catch (error) {
        console.error("Error:", error);
    }
};

// Handle region update
const updateSelectedRegion = (newRegion) => {
    selected.value.region = newRegion;
};

// Handle city update
const updateSelectedCity = (newCity) => {
    selected.value.city = newCity;
};

// Handle offices update
const updateSelectedOffice = (newOffice) => {
    formData.stepSevenChilexpressOffice = newOffice;
};

onMounted(() => {
    emit("constant-emitted", mainStep);
    // Call getComunasChilexpress when component is mounted
    getRegionsChilexpress();
    watch(
        () => selected.value.region,
        (newRegion) => {
            if (newRegion !== lastSelected.value.region) {
                getComunasChilexpress.call(this);
                lastSelected.value.region = newRegion;
            }
            formData.stepSevenRegion = lastSelected.value.region;
        }
    );

    watch(
        () => selected.value.city,
        (newCity) => {
            if (newCity !== lastSelected.value.city) {
                getCoberturaOptions.call(this);
                lastSelected.value.city = newCity;
            }
            formData.stepSevenCity = lastSelected.value.city;
        }
    );

    watch(
        () => formData.stepSevenOptionDelivery,
        (newOptionDelivery) => {
            if (newOptionDelivery === "Domicilio") {
                formData.stepSevenChilexpressOffice = "";
            }
        }
    );

    // Set the initial selected region and city values from formData
    selected.value.region = formData.stepSevenRegion;
    selected.value.city = formData.stepSevenCity;
});

</script>

<style scoped>
.cont-option-delivery label {
    display: flex;
    flex-direction: column;
    align-items: baseline;
    width: 100%;
    height: auto;
    background-color: #fff;
    border-radius: 2px;
    border: 1px dashed #c0c6b9;
    padding: 1.8rem 1rem;
    margin-bottom: 1rem;
}
.cont-option-delivery label span:first-child {
    font-size: 9px;
    font-weight: 700;
    color: #454545;
    line-height: 14px;
    margin-bottom: 2px;
}

.cont-option-delivery label span:last-child {
    font-family: "Quicksand", sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #728c54;
    line-height: 16px;
}

.cont-option-delivery .btn-check:checked + .btn {
    background-color: #728c54;
}
.cont-option-delivery .btn-check:checked + .btn span {
    color: #fff;
}
</style>
