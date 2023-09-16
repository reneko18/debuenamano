<template>
    <div class="modulo-pasos">
            <div class="row">
                <div class=" col-lg-7 col-md-12">
                    <h2>Observaciones y/o recomendaciones sobre el artículo</h2>
                    <p class="bajada-h2">Si hay alguna característica especial, consejo de uso o cualquier otro detalle que quieras compartir con los posibles compradores, te invitamos a que nos lo cuentes.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div>
                        <label for="obser-pro" class="form-label">Observación</label>
                        <textarea id="obser-pro" class="form-control" placeholder="Que observaciones presenta el artículo..." v-model="formData.stepFiveDetails"></textarea>                          
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div>
                        <label for="reco-pro" class="form-label">Recomendaciones</label>
                        <textarea id="reco-pro" class="form-control" placeholder="Que recomendación darías para el correcto uso del artículo..." v-model="formData.stepFiveAdvice"></textarea>                          
                    </div>
                </div>
            </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
      <button class="btn boton-principal" @click="nextStep">Guardar etapa y continuar <font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
    </div>
</template>
<script>
    import { useFormStore } from '../../../stores/values';
    import { onMounted } from 'vue';
    export default {
        setup(_, { emit }) {
            const mainStep = 2;

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
    }
</script>
    
    