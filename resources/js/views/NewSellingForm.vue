<template>
    <section class="container">
        <h1>Formulario de Publicación</h1>
        <p class="bajada-h1">Completa el formulario con los detalles de tu artículo. Cuanta más información proporciones, mejor será la experiencia de nuestros compradores al conocer tu producto.</p>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-3 nav-pasos">
                <h3 class="titulo-paso-activo">Presentación</h3>
                
                    <li v-for="(link, index) in linksPresentation" @click="clickMenu(index)">
                        {{ link }}
                    </li>

            </div>
            <div class="col-9 modulo-pasos">
                    <!-- <component
                        :is="formSteps[currentStep]" :nextStep="nextStep"  
                        :formValues="values"                  
                    ></component>  -->
                    <!--<component :is="currentStepComponent" @next-step="nextStep" @prev-step="prevStep" @reset-form="resetForm" />   -->      
                    <component :is="formSteps[currentStep]" @next-step="nextStep" @prev-step="prevStep" @reset-form="resetForm" />        
            </div>
            
        </div>
    </section>
   
</template>
<script setup>
/*import { useFormStore } from '../stores/values';

import StepOne from '../components/SellingForm/Steps/StepOne.vue';
import StepTwo from '../components/SellingForm/Steps/StepTwo.vue';
import StepThree from '../components/SellingForm/Steps/StepThree.vue';
import useForm from '../composables/formValues';

import { ref } from 'vue';

    const formStore = useFormStore();

    const formData = formStore.formData;

    const currentStep = ref(0);
    const formSteps = [
        StepOne,
        StepTwo,
        StepThree,
    ];
    const{
        values
    } = useForm();

    const receivedData = ""

    const linksPresentation = [
        'Artículo',
        'Marca',
        'Dimensiones'
    ];

    const nextStep = () => {
        currentStep.value++;
    }

    const previousStep = () => {
        currentStep.value--;
    }

    const clickMenu = (index) => {  
        currentStep.value = index        
    }*/

import { ref } from 'vue';
import { useFormStore } from '../stores/values';

import StepOne from '../components/SellingForm/Steps/StepOne.vue';
import StepTwo from '../components/SellingForm/Steps/StepTwo.vue';
import StepThree from '../components/SellingForm/Steps/StepThree.vue';


    const formStore = useFormStore();

    // Use a ref to keep track of the current step
    const currentStep = ref(0);
    const formData = formStore.formData;

    const nextStep = () => {
      // Increment the current step and move to the next step component
      currentStep.value++;
    };

    const prevStep = () => {
      // Decrement the current step and move to the previous step component
      currentStep.value--;
    };

    const resetForm = () => {
      // Reset the current step and form data when the form is submitted
      currentStep.value = 1;
    };
    const formSteps = [
        StepOne,
        StepTwo,
        StepThree,
    ];

    const linksPresentation = [
        'Artículo',
        'Marca',
        'Dimensiones'
    ];

    // Map the current step to the corresponding step component
    /*const currentStepComponent = () => {
      switch (currentStep.value) {
        case 0:
          return StepOne;
        case 1:
          return StepTwo;
        case 2:
          return StepThree;
        default:
          return null;
      }
    };*/

    const clickMenu = (index) => {  
        currentStep.value = index        
    }







</script>

<style>
 /* Aquí escribo el estilo de todo y si necesito ver HTML debo entrar a component */

/* TIPOGRAFÍA ****************************************************** */
body { 
    font-family: 'Inter', sans-serif;
    color: #1B1F22;
    background-color: #fff;
}

h1, h2, h3, h4 { font-family: 'Quicksand', sans-serif; }

h1 {
    color: #1B1F22;
    font-size: 36px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
 }

h2{
    color: #1B1F22;
    font-size: 24px;
    font-weight: 700;
    line-height: 30px;
}

 .bajada-h1 {
    font-family: 'Inter', sans-serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: 26px;
    margin-bottom: 54px;
 }

 .bajada-h2{
    color:#1B1F22;
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    font-weight: 300;
    line-height: 22px;
    margin-bottom: 32px;
}

.titulo-paso-activo {
    color: #728C54;
    font-family: 'Quicksand', sans-serif;
    font-size: 22px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    margin-bottom: 16px;
}

/* NAVEGACIÓN ****************************************************** */

.nav-pasos { list-style-type: none; } 

 .nav-pasos li {
    color: #1B1F22;
    font-family: 'Quicksand', sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 18px;
    margin-bottom: 4px;
    padding: 4px 8px;
    display: block;/* No funciona */
    background: #fff;
    border-radius: 8px;
 }

 .nav-pasos li:nth-child(2) {
    color: #fff;
    background: #D29C37;
    display: inline-block; /* No funciona */
 }

 .modulo-pasos{
    border-radius: 6px;
    background: #F8FAF7;
    padding: 40px 20px;
    box-shadow: 0px 2px 4px 0px rgba(10, 13, 8, 0.10);
 }

 /* FORMULARIOS ****************************************************** */

 label {
    font-family: 'Quicksand', sans-serif;
    color:#1B1F22;
    font-size: 14px;
    font-weight: 700;
    line-height: 16px;
 }

.form-select, .form-control {
    margin-bottom: 24px;
    border-radius: 2px;
    border: 1.2px solid #C0C6B9;
    background: #fff;
    padding: 10px;
 }

.form-control::placeholder {
    color: #1B1F22;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
    font-family: 'Inter', sans-serif;
}

.form-control:focus {
    border-color:#728C54!important;
    box-shadow: 0px 1px 2px 0px rgba(39, 48, 29, 0.15);
    background: #fff;
}

.form-select:focus {
    border-color:#728C54!important;
    box-shadow: 0px 1px 2px 0px rgba(39, 48, 29, 0.15);
    background: #fff;
}

/* BOTONES */
.boton-principal {
    color:#D29C37;
    border-radius: 4px;
    border: 2px solid #D29C37;
    font-family: 'Quicksand', sans-serif;
    font-size: 15px;
    line-height: 15px;
    font-weight: 700;
    padding: 16px 32px;
}

.boton-principal:hover {
    background-color:#D29C37;
    color: #F8FAF7;
}
</style>