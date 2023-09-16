<template>
<div class="modulo-pasos">
        <div class="row">
                    <div class=" col-lg-7 col-md-12">
                        <h2>Cuéntanos, en que estado de uso se encuentra el artículo</h2>
                        <p class="bajada-h2">Tu transparencia nos ayuda a construir confianza entre los compradores y garantiza una experiencia de compra satisfactoria para todos.</p>
                    </div>
        </div>
        <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div>
                            <label for="statusItem" class="form-label">Estado</label>
                            <select id="statusItem" class="form-select" v-model="formData.stepFourState">
                                <option selected>Seleccione un estado</option>
                                <option value="Usado en buen estado">Usado en buen estado</option>
                                <option value="Sin uso">Sin uso</option>
                            </select>  
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="usageItem" class="form-label">Tiempo de uso</label>
                                <input type="text" class="form-control" placeholder="00" id="usageItem" v-model="formData.stepFourUsageTime">
                            </div>
                            <div class="col-md-4">
                                <label for="usageItem-pro" class="form-label"></label>
                                <select id="usageItem-pro" class="form-select" v-model="formData.stepFourUsageUnit">
                                    <option selected>Seleccione un estado</option>
                                    <option value="Dias">Dias</option>
                                    <option value="Meses">Meses</option>
                                    <option value="Años">Años</option>
                                </select> 
                            </div>
                        </div>
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



