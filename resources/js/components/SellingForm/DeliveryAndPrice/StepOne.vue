<template>
    <div class="modulo-pasos">
            <div class="row">
                <div class=" col-lg-7 col-md-12">
                    <h2>Envío o retiro del artículo</h2>
                    <p class="bajada-h2">Una vez que tu artículo sea vendido, lo enviarás a la sucursal del courier o prefieres que gestionemos su retiro.</p>
                    <p>Llevas el articulo a la sucursal o prefieres que gestionemos el retiro</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="sucursalYes">
                        <label class="form-check-label" for="sucursalYes">Sí, puedo llevarlo a la sucursal</label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="sucursalNo">
                        <label class="form-check-label" for="sucursalNo">No, prefiero que vengan a retirarlo (costo adicional $3.500)</label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <p>*Ten presente que la persona que compre tu artículo eligirá si desea que el envío sea por Chilexpress o Blue Express</p>
                </div>
            </div> 
            
            <div>
                <p>El artículo será retirado en la siguiente dirección:</p>
            </div>  
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div>
                        <label for="addName" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="addName" placeholder="Direccion" v-model="formData.stepSixAddress">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div>
                        <label for="contPhone" class="form-label">Contacto nombre + fono </label>
                        <input type="text" class="form-control" id="contPhone" placeholder="--" v-model="formData.stepSixContact">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <label for="region-pro">Región</label>
                    <select id="region" class="form-select" v-model="formData.stepSixRegion" @change="loadCities">
                        <option value="" disabled>Seleccione una region</option>
                        <option v-for="region in regions" :value="{ id: region.id, name: region.name }">{{ region.name }}</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-12">
                    <label for="comuna-pro">Comuna</label>
                    <select id="comuna-pro" class="form-select" v-model="formData.stepSixCity">
                        <option value="" disabled>Seleccione una ciudad</option>
                        <option v-for="city in cities" :value="{ id: city.id, name: city.name }">{{ city.name }}</option>
                    </select>
                </div>

                <div class="col-lg-4 col-md-12">
                    <a href="#">
                        <font-awesome-icon :icon="['far', 'pen-to-square']" />
                        <span>Cambiar dirección</span>
                    </a>
                </div>
            </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
      <button class="btn boton-principal" @click="nextStep">Continuar <font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
    </div>
</template>
<script>
import { useFormStore } from '../../../stores/values';
import { onMounted } from 'vue';
export default {
    data() {
        return {
            cities: [],
            regions: [], // Populate this with the list of regions initially.
        };
    },
    setup(_, { emit }) {
        const mainStep = 4;

        const formStore = useFormStore();
        const formData = formStore.formData;

        onMounted(() => {
        emit('constant-emitted', mainStep); 
        });

        const nextStep = () => {
        formStore.setFormData(formData);
        emit('next-step');
        };

        return {
        formData,
        nextStep,
        };

    },
    created() {
    axios.get('/api/regions')
        .then(response => {
            this.regions = response.data;
            console.log(this.regions);
        })
        .catch(error => {
            console.error(error);
        });
    },
    methods: {
        loadCities() {
            if (this.formData.stepSixRegion.id) {
                axios.get(`/api/cities/${this.formData.stepSixRegion.id}`)
                    .then(response => {
                        this.cities = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                // Clear the cities if no region is selected.
                this.cities = [];
            }
        },
    },
}
</script>