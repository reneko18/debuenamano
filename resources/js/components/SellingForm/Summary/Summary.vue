<template>
    <div>
        <h1 class="text-center mb-5">Aqui va el resumen de todas las etapas</h1>
        <h2>Etapa 1</h2>
        <h3>Presentación</h3>
        <h4>Nombre del producto:</h4>
        <p>{{ formData.stepOneName }}</p>
        <h4>Categoría del producto:</h4>
        <p>{{ formData.stepOneCategory }}</p>
        <h4>Género del producto:</h4>
        <p>{{ formData.stepOneGenre }}</p>
        <h4>Género del producto:</h4>
        <p>{{ formData.stepOneGenre }}</p>
        <h4>Edad: {{ formData.stepOneGenre }}</h4>
        <p>Desde: {{ formData.stepOneAgeIni }} {{ formData.stepOneAgeDateIni }}</p>
        <p>Hasta: {{ formData.stepOneAgeFin }} {{ formData.stepOneAgeDateFin }}</p>
        <h4>Descripcion</h4>
        <p>{{ formData.stepOneProductDescription }}</p>      
        <h4>Marca</h4>
        <p>{{ formData.stepTwoBrand }}</p>
        <h4>Modelo</h4>
        <p>{{ formData.stepTwoModel }}</p> 
        <h4>Alto</h4>
        <p>{{ formData.stepThreeHeight }} {{ formData.stepThreeHeightUnit }}</p>
        <h4>Ancho</h4>
        <p>{{ formData.stepThreeWidth }} {{ formData.stepThreeWidthUnit }}</p>
        <h4>Largo</h4>
        <p>{{ formData.stepThreeLong }} {{ formData.stepThreeLongUnit }}</p>
        <h4>Peso</h4>
        <p>{{ formData.stepThreeWeight }} {{ formData.stepThreeWeightUnit }}</p>
        <h2 class="mt-5">Etapa 2</h2>
        <h4>Estado</h4>
        <p>{{ formData.stepFourState }}</p>
        <h4>Tiempo de uso</h4>
        <p>{{ formData.stepFourUsageTime }} {{ formData.stepFourUsageUnit }}</p>
        <h4>Observación</h4>
        <p>{{ formData.stepFiveDetails }}</p>
        <h4>Recomendaciones</h4>
        <p>{{ formData.stepFiveAdvice }}</p>
        <h2 class="mt-5">Etapa 3</h2>
        <h4>Fotografías</h4>
        <h2 class="mt-5">Etapa 4</h2>
        <h4>Dirección</h4>
        <p>{{ formData.stepSixAddress }}</p>
        <h4>Contacto nombre + fono</h4>
        <p>{{ formData.stepSixContact }}</p>
        <h4>Región</h4>
        <p>{{ formData.stepSixRegion.name }}</p>
        <h4>Comuna</h4>
        <p>{{ formData.stepSixCity.name }}</p>
        <h4>Precio</h4>
        <p>{{ formData.stepSevenPrice }}</p>
        <h4>Nombre y apellido</h4>
        <p>{{ formData.stepEightName }}</p>
        <h4>Banco</h4>
        <p>{{ formData.stepEightBank }}</p>
        <h4>Nº de cuenta</h4>
        <p>{{ formData.stepEightBankNumber }}</p>
        <h4>RUT</h4>
        <p>{{ formData.stepEightRut }}</p>
        <h4>Tipo de cuenta</h4>
        <p>{{ formData.stepEightBankType }}</p>   
        <button class="btn btn-lg btn-primary" @click="submitForm">Enviar Datos</button> 
    </div>   

</template>
<script>
import { onMounted } from 'vue';
import { useFormStore } from '../../../stores/values';
export default {
    setup(_, { emit }) {
    const mainStep = 5;
    const formStore = useFormStore();
    const formData = formStore.formData;

    onMounted(() => {
      emit('constant-emitted', mainStep); 
    });

    return {
      formData,      
    };
  },
  methods: {
    submitForm(){
      axios.post("/api/test/store",
          this.formData,                                                        
      )
      .then(res => {
          console.log(res)
          window.location.href = '/' 
      })
      .catch(error => {
        console.log(error.response.data);                                                  
      });
    }      
  }
}
</script>