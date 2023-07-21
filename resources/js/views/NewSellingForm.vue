<template>
    <section class="container">
        <h1>Formulario de Publicación</h1>
        <p>Completa el formulario con los detalles de tu artículo. Cuanta más información proporciones, mejor será la experiencia de nuestros compradores al conocer tu producto.</p>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <h3>Presentación</h3>
                <li v-for="(link, index) in linksPresentation" @click="clickMenu(index)">
                    {{ link }}
                </li>

            </div>
            <div class="col-8">
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

 
</style>
