<template>
    <section class="container">
        <h1>Formulario de Publicación</h1>
        <p class="bajada-h1">Completa el formulario con los detalles de tu artículo. Cuanta más información proporciones, mejor será la experiencia de nuestros compradores al conocer tu producto.</p>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-3 nav-pasos">
                <!--<h3 class="titulo-paso-activo">Presentación</h3>
                <li v-for="(link, index) in linksPresentation"  :key="index" :class="{ 'active': currentStep === index }">
                    <span @click="clickMenu(index)">{{ link }}</span>
                </li>
                <h3 class="titulo-paso-activo">Estado</h3>
                <li v-for="(linkStatu, index) in linksStatus" :key="index">
                    <span>{{ linkStatu }}</span>
                </li>
                -->
                <ul class="titulo-paso-activo" v-for="(item, index) in linkCollection" :key="index">
                      <li>{{ item.title }}</li>
                    <ul>
                        <li v-for="(linkTitle, linkIndex) in item.links.titles" :key="linkIndex" :class="{ 'active': currentStep === item.links.number[linkIndex] }">
                            <span @click="clickMenu(item.links.number[linkIndex])">{{ linkTitle }}</span>
                        </li>
                    </ul>
                </ul>
            </div>
            <div class="col-9">
                <component :is="formSteps[currentStep]" @next-step="nextStep"/>  
            </div>
            
        </div>
    </section>
   
</template>
<script>

import { ref } from 'vue';
import { useFormStore } from '../stores/values';

import StepOnePre from '../components/SellingForm/Presentation/StepOne.vue';
import StepTwoPre from '../components/SellingForm/Presentation/StepTwo.vue';
import StepThreePre from '../components/SellingForm/Presentation/StepThree.vue';
import StepOneStat from '../components/SellingForm/Status/StepOne.vue';
import StepTwoStat from '../components/SellingForm/Status/StepTwo.vue';
import StepOnePhoto from '../components/SellingForm/Photos/StepOne.vue';
import StepOneDP from '../components/SellingForm/DeliveryAndPrice/StepOne.vue';
import StepTwoDP from '../components/SellingForm/DeliveryAndPrice/StepTwo.vue';
import StepThreeDP from '../components/SellingForm/DeliveryAndPrice/StepThree.vue';

export default {
   setup() {
        const formStore = useFormStore();

        const currentStep = ref(0);
        const formData = formStore.formData;

        const nextStep = () => {
        currentStep.value++;
        };

        const formSteps = [
            StepOnePre,
            StepTwoPre,
            StepThreePre,
            StepOneStat,
            StepTwoStat,
            StepOnePhoto,
            StepOneDP,
            StepTwoDP,
            StepThreeDP,
        ];

        const linkCollection = ref([
            {
                title: 'Presentación',
                links: {
                    titles: ['Artículo', 'Marca', 'Dimensiones'],
                    number: [0,1,2]
                }
            },
            {
                title: 'Estado',
                links: {
                    titles: ['Uso', 'Observaciones'],
                    number: [3,4]
                }
            },  
            {
                title: 'Fotografías',
                links:{
                    titles:['Adjuntar'],
                    number:[5]
                }
            },
            {
                title: 'Despacho y precio',
                links:{
                    titles:['Despacho','Precio','Cuenta depósito'],
                    number:[6,7,8]
                }
            },
            {
                title:'Resumen',
                links:{
                    titles:['Resumen'],
                    number:[9]
                }
            }
        ]);
        /*const linksPresentation = [
            'Artículo',
            'Marca',
            'Dimensiones'
        ];
        const linksStatus = [
            'Uso',
            'Observaciones',
        ];*/


        const clickMenu = (stepNumber) => {  
            currentStep.value = stepNumber;                       
        }

        return {
            nextStep,
            clickMenu,
            currentStep,
            //linksPresentation,
            //linksStatus,
            linkCollection,
            formSteps,
        };

   }
}

    






</script>
