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
            <div class="col-9">
                    <!-- <component
                        :is="formSteps[currentStep]" :nextStep="nextStep"  
                        :formValues="values"                  
                    ></component>  -->
                    <!--<component :is="currentStepComponent" @next-step="nextStep" @prev-step="prevStep" @reset-form="resetForm" />   -->      
                    <!--<component :is="formSteps[currentStep]" @next-step="nextStep" @prev-step="prevStep" @reset-form="resetForm" /> -->     
                    <component :is="formSteps[currentStep]" @next-step="nextStep"/>  
            </div>
            
        </div>
    </section>
   
</template>
<script>
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

export default {
  /*components: {
    StepOne,
    StepTwo,
    StepThree,
  },*/
   setup() {
        const formStore = useFormStore();

        // Use a ref to keep track of the current step
        const currentStep = ref(0);
        const formData = formStore.formData;

        const nextStep = () => {
        // Increment the current step and move to the next step component
        currentStep.value++;
        };

        /*const prevStep = () => {
        currentStep.value--;
        };*/

        /*const resetForm = () => {
        currentStep.value = 1;
        };*/
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
            case 1:
            return StepOne;
            case 2:
            return StepTwo;
            case 3:
            return StepThree;
            default:
            return null;
        }
        };*/

        const clickMenu = (index) => {  
            currentStep.value = index;                       
        }

        return {
            //currentStepComponent,
            nextStep,
            clickMenu,
            currentStep,
            linksPresentation,
            formSteps,
        };

   }
}

    






</script>
