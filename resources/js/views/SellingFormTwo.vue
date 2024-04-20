<template>
    <Toast />
    <section class="container">
        <h1>Formulario de Publicación</h1>
        <p class="bajada-h1">
            Completa el formulario con los detalles de tu artículo. Cuanta más
            información proporciones, mejor será la experiencia de nuestros
            compradores al conocer tu producto.
        </p>
    </section>
    <section class="container">
        <div class="row">
            <div class="col-3 nav-pasos">
                <ul
                    v-for="(item, index) in linkCollection"
                    :key="index"
                    class="main-list"
                >
                    <li
                        class="titulo-pasos"
                        :class="[
                            {
                                active: item.mainTitle.number === receivedConstant,
                                completed: isStepCompleted(item.mainTitle.number),
                            },
                            `item-${index}`,
                        ]"
                        @click="expandItem(index)"
                    >
                        <div
                            class="number-title"
                            @click="
                                clickMainTitle(index, item.mainTitle.firstComp)
                            "
                        >
                            <!-- <span class="number">{{
                                item.mainTitle.number
                            }}</span> -->
                            <span v-if="!isStepCompleted(item.mainTitle.number)" class="number">{{ item.mainTitle.number }}</span>
                            <font-awesome-icon v-else :icon="['fas', 'check']" />
                            <span class="main-title">{{ item.mainTitle.name }}</span>
                        </div>
                        <div class="cont-subtitles" :class="[`item-${index}`]">
                            <!--<div :class="['separator', { expanded: expandedItem === index }]"></div>-->
                            <ul
                                class="titulo-sub-pasos"
                                v-if="activeTitles === index"
                            >
                                <li
                                    v-for="(linkTitle, linkIndex) in item.links
                                        .titles"
                                    :key="linkIndex"
                                    :class="{
                                        active:
                                            currentStep ===
                                            item.links.number[linkIndex],
                                    }"
                                >
                                    <span
                                        @click="
                                            clickMenu(
                                                item.links.number[linkIndex]
                                            )
                                        "
                                        >{{ linkTitle }}</span
                                    >
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <component
                    :is="formSteps[currentStep]"
                    @next-step="nextStep"
                    @constant-emitted="handleMainStep"
                    @active-subtitles="handleSubStep"
                    @close-step="handleCloseStep"
                    :user-id="userId"
                    :product-id="productId"
                    :product-slug="productSlug"
                    :user-bank="userBank"                    
                />
            </div>
        </div>
    </section>
</template>
<script setup>
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';
import { ref,computed } from "vue";
import { useFormStore } from "../stores/valuesTwo";
import StepOnePre from "../components/SellingFormTest/Presentation/StepOne.vue";
import StepTwoPre from "../components/SellingFormTest/Presentation/StepTwo.vue";
import StepThreePre from "../components/SellingFormTest/Presentation/StepThree.vue";
import StepOneStat from "../components/SellingFormTest/Status/StepOne.vue";
import StepTwoStat from "../components/SellingFormTest/Status/StepTwo.vue";
import StepThreeStat from "../components/SellingFormTest/Status/StepThree.vue";
import StepOnePhoto from "../components/SellingFormTest/Photos/StepOne.vue";
import StepOneDP from "../components/SellingFormTest/Delivery/StepOne.vue";
import StepTwoDP from "../components/SellingFormTest/Delivery/StepTwo.vue";
import Summary from "../components/SellingFormTest/Summary/Summary.vue";

const props = defineProps({
    userId: { 
        type: String, 
        default: "" 
    },
    productId: { 
        type: String, 
        default: "" 
    },
    productSlug: { 
        type: String, 
        default: "" 
    },
    userBank: { 
        type: [Object, String], 
        default: null, 
    },
    mainStep: { 
        type: Array, 
        default: () => [],
    },
    activeTitlePro: { 
        type: String, 
        default: "" 
    },
    receivedConstantPro: { 
        type: String, 
        default: "" 
    },
    currentStepPro: { 
        type: String, 
        default: "" 
    },
});

const toast = useToast();

const activeTitles = ref('');
const receivedConstant = ref('');
const currentStep = ref('');
const completedSteps = ref('');

if(props.productId){
    completedSteps.value = props.mainStep;
    activeTitles.value = Number(props.activeTitlePro);
    receivedConstant.value = Number(props.receivedConstantPro);
    currentStep.value = Number(props.currentStepPro);
}else{
    completedSteps.value = [];
    activeTitles.value = 0;
    receivedConstant.value = '';
    currentStep.value = 0;
}

const expandedItem = ref(0);

const formStore = useFormStore();


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
    StepThreeStat,
    StepOnePhoto,
    StepOneDP,
    StepTwoDP,
    Summary,
];

const linkCollection = ref([
    {
        mainTitle: {
            name: "Presentación",
            number: 1,
            firstComp: 0,
        },
        links: {
            titles: ["Artículo", "Marca", "Dimensiones"],
            number: [0, 1, 2],
        },
    },
    {
        mainTitle: {
            name: "Estado",
            number: 2,
            firstComp: 3,
        },
        links: {
            titles: ["Uso", "Observaciones", "Precio"],
            number: [3, 4, 5],
        },
    },
    {
        mainTitle: {
            name: "Fotografías",
            number: 3,
            firstComp: 6,
        },
        links: {
            titles: ["Adjuntar"],
            number: [6],
        },
    },
    {
        mainTitle: {
            name: "Despacho",
            number: 4,
            firstComp: 7,
        },
        links: {
            titles: ["Despacho", "Cuenta depósito"],
            number: [7, 8],
        },
    },
    {
        mainTitle: {
            name: "Resumen",
            number: 5,
            firstComp: 9,
        },
        links: {
            titles: ["Resumen"],
            number: [9],
        },
    },
]);

const clickMenu = (stepNumber) => {
    currentStep.value = stepNumber;
};

const clickMainTitle = (index, linkNumber) => {
    activeTitles.value = index;
    currentStep.value = linkNumber;
};


const handleMainStep = (mainStep) => {
    receivedConstant.value = mainStep;
};

const handleCloseStep = (stepNumber) => {
    completedSteps.value.push(stepNumber);
    toast.add({
            severity: 'success',
            summary: 'Mensaje de éxito',
            detail: 'Etapa guardada con éxito',
            life: 3000
    });  
};

const handleSubStep = (subStep) => {
    activeTitles.value = subStep;
};

const expandItem = (index) => {
    expandedItem.value = index;
};

const isStepCompleted = computed(() => {
    return (stepNumber) => {
        if(props.productId){
            const completedStepsArray = completedSteps.value.toString().split(',');// Split the string into an array
            return completedStepsArray.includes(stepNumber.toString()); // Check if stepNumber exists in the array
        }else{
            return completedSteps.value.includes(stepNumber);
        }
        
    };
});

</script>

<style scoped>
.main-list {
    list-style: none;
    padding: 0;
}
.titulo-pasos {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin: 5px 0;
    cursor: pointer;
}

.titulo-pasos.item-0:before,
.titulo-pasos.item-1:before,
.titulo-pasos.item-2:before,
.titulo-pasos.item-3:before {
    content: "";
    position: absolute;
    border-left: 2px dashed #728c54;
    left: 23px;
    bottom: -8px;
    z-index: 1;
    height: 100%;
    top: 20px;
}

.titulo-pasos.active.item-0:before,
.titulo-pasos.active.item-1:before,
.titulo-pasos.active.item-2:before,
.titulo-pasos.active.item-3:before {
    content: "";
    position: absolute;
    border-left: 2px solid #728c54;
    left: 23px;
    bottom: -8px;
    z-index: 1;
    height: 100%;
    top: 20px;
}

.number-title {
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2;
}

.number-title .number {
    color: #728c54;
    border: 2px solid #728c54;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    text-align: center;
    line-height: 28px;
    background-color: #fff;
    margin-right: 1rem;
}

.number-title .fa-check{
    color: #fff;
    border: 2px solid #728c54;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    text-align: center;
    line-height: 28px;
    background-color: #728c54;
    margin-right: 1rem;
}

.titulo-sub-pasos {
    margin-left: 1rem;
}
.titulo-sub-pasos .active {
    background-color: #d29c37;
    color: #fff;
    display: inline-flex;
}

.item-4 .separator {
    border-left: 2px dashed transparent;
}

.item-4 .separator.expanded {
    height: 100%;
}

.cont-subtitles {
    display: flex;
    flex-direction: row;
}
</style>