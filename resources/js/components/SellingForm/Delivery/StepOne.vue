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
                    <select
                        id="region"
                        class="form-select"
                        :class="errorMessageRegion ? 'is-invalid-dbm' : ''"
                        v-model="selected.region"
                    >
                        <option disabled selected value="">
                            Selecciona una región
                        </option>
                        <option :value="r.regionId" v-for="r in regions">
                            {{ r.regionName }}
                        </option>
                    </select>
                    <div v-if="errorMessageRegion" class="invalid-dbm">
                        {{ errorMessageRegion }}
                    </div>

                    <label for="city" class="form-label">Tu comuna *</label>
                    <select
                        id="city"
                        class="form-select"
                        :class="errorMessageCity ? 'is-invalid-dbm' : ''"
                        v-model="selected.city"
                    >
                        <option disabled selected value="">
                            Selecciona tu comuna
                        </option>
                        <option :value="com.countyName" v-for="com in cities">
                            {{ com.countyName }}
                        </option>
                    </select>
                    <div v-if="errorMessageCity" class="invalid-dbm">
                        {{ errorMessageCity }}
                    </div>

                    <label for="offices" class="form-label"
                        >Sucursal de Chilexpress *</label
                    >
                    <select
                        id="offices"
                        class="form-select"
                        :class="errorMessageOficina ? 'is-invalid-dbm' : ''"
                        v-model="formData.stepSevenChilexpressOffice"
                    >
                        <option disabled selected value="">
                            Selecciona una sucursal
                        </option>
                        <option
                            :value="offi.officeName"
                            v-for="offi in offices"
                        >
                            {{ offi.officeName }}
                        </option>
                    </select>
                    <div v-if="errorMessageOficina" class="invalid-dbm">
                        {{ errorMessageOficina }}
                    </div>

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
                        <select
                            id="regionHouse"
                            class="form-select"
                            :class="errorMessageRegionHouse ? 'is-invalid-dbm' : ''"
                            v-model="selected.region"
                        >
                            <option disabled selected value="">
                                Selecciona una región
                            </option>
                            <option :value="r.regionId" v-for="r in regions">
                                {{ r.regionName }}
                            </option>
                        </select>
                        <div v-if="errorMessageRegionHouse" class="invalid-dbm">
                            {{ errorMessageRegionHouse }}
                        </div>
                    </div>

                    <div>
                        <label for="cityHouse" class="form-label"
                            >Tu comuna *</label
                        >
                        <select
                            id="cityHouse"
                            class="form-select"
                            :class="errorMessageCityHouse ? 'is-invalid-dbm' : ''"
                            v-model="selected.city"
                        >
                            <option disabled selected value="">
                                Selecciona tu comuna
                            </option>
                            <option
                                :value="com"
                                v-for="com in cities"
                            >
                                {{ com.countyName }}
                            </option>
                        </select>
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
<script>
import { useFormStore } from "../../../stores/values";
import { onMounted, watch, ref } from "vue";
export default {
    emits: ["next-step", "constant-emitted"],
    data() {
        return {
            regions: [],
            selected: {
                region: "",
                city: "",
                street: "",
            },
            loading: false,
        };
    },
    setup(_, { emit }) {
        const selectedRef = ref({
            region: "",
            city: "",
        });
        const lastSelected = ref({
            region: "",
            city: "",
        });
        const cities = ref([]);
        const offices = ref([]);
        const mainStep = 4;

        const errorMessageRegion = ref('');
        const errorMessageCity = ref('');
        const errorMessageOficina = ref('');
        const errorMessageRegionHouse = ref('');
        const errorMessageCityHouse = ref('');

        const formStore = useFormStore();
        const formData = formStore.formData;

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

        const getComunasChilexpress = async function () {
            const apiKey = "570f3f00500c433a9b2b94e7b4803c1b";
            const apiUrl =
                "https://testservices.wschilexpress.com/georeference/api/v1.0/coverage-areas";

            try {
                const response = await axios.get(apiUrl, {
                    params: {
                        api_key: apiKey,
                        RegionCode: selectedRef.value.region,
                        type: 1,
                    },
                });
                cities.value = response.data.coverageAreas;
            } catch (error) {
                console.error("Error fetching cities:", error);
            }
        };

        const getCoberturaOptions = async function () {
            const apiUrl =
            "https://testservices.wschilexpress.com/georeference/api/v1.0/offices?Type=0";   
            const regionCode = selectedRef.value.region;
            const cityName = selectedRef.value.city;

            try {
                const response = await axios.get(apiUrl, {
                    headers: {
                        "Cache-Control": "no-cache",
                        "Ocp-Apim-Subscription-Key":
                            "570f3f00500c433a9b2b94e7b4803c1b",
                    },
                    params: {
                        RegionCode: regionCode,
                        CountyName: cityName,
                    },
                });

                console.log(response.status);      
                console.log(response.data.offices);
                offices.value = response.data.offices;
            } catch (error) {
                console.error("Error:", error);
            }
        };

        onMounted(() => {
            emit("constant-emitted", mainStep);
            watch(
                () => selectedRef.value.region,
                (newRegion) => {
                    if (newRegion !== lastSelected.value.region) {
                        getComunasChilexpress.call(this);
                        lastSelected.value.region = newRegion;
                    }
                    formData.stepSevenRegion = lastSelected.value.region;
                }
            );

            watch(
                () => selectedRef.value.city,
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
            //Modi para mantener el dato activo (region)
            if (selectedRef.value.region != null) {
                selectedRef.value.region = formData.stepSevenRegion;
            }
            //Modi para mantener el dato activo (comuna)
            if (selectedRef.value.city != null) {
                selectedRef.value.city = formData.stepSevenCity;
            }
        });

        return {
            formData,
            nextStep,
            selected: selectedRef.value,
            loading: ref(false),
            errorMessageRegion,
            errorMessageCity,
            errorMessageOficina,
            errorMessageRegionHouse,
            errorMessageCityHouse,
            cities,
            offices,
        };
    },
    methods: {
        async getRegionsChilexpress() {
            try {
                const apiKey = "570f3f00500c433a9b2b94e7b4803c1b";
                const apiUrl =
                    "https://testservices.wschilexpress.com/georeference/api/v1.0/regions";

                this.loading = true;
                const response = await axios.get(apiUrl, {
                    params: {
                        api_key: apiKey,
                    },
                });

                this.regions = response.data.regions;
            } catch (error) {
                console.error("Error fetching regions:", error);
            } finally {
                this.loading = false;
            }
        },
        toggleSection(section) {
            this.formData.stepSevenSelectedSection = section;
        },
    },
    mounted() {
        this.getRegionsChilexpress();
    },
};
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
