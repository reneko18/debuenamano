<template>
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
                                active:
                                    item.mainTitle.number === receivedConstant,
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
                            <span class="number">{{
                                item.mainTitle.number
                            }}</span>
                            <span class="main-title">{{
                                item.mainTitle.name
                            }}</span>
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
                />
            </div>
        </div>
    </section>
</template>
<script>
import { ref } from "vue";
import { useFormStore } from "../stores/values";

import StepOnePre from "../components/SellingForm/Presentation/StepOne.vue";
import StepTwoPre from "../components/SellingForm/Presentation/StepTwo.vue";
import StepThreePre from "../components/SellingForm/Presentation/StepThree.vue";
import StepOneStat from "../components/SellingForm/Status/StepOne.vue";
import StepTwoStat from "../components/SellingForm/Status/StepTwo.vue";
import StepThreeStat from "../components/SellingForm/Status/StepThree.vue";
import StepOnePhoto from "../components/SellingForm/Photos/StepOne.vue";
import StepOneDP from "../components/SellingForm/Delivery/StepOne.vue";
import StepTwoDP from "../components/SellingForm/Delivery/StepTwo.vue";
import Summary from "../components/SellingForm/Summary/Summary.vue";

export default {
    data() {
        return {
            receivedConstant: "",
            expandedItem: 0,
        };
    },
    setup() {
        const activeTitles = ref(0);

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
                    firstComp: 6,
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

        return {
            nextStep,
            clickMenu,
            clickMainTitle,
            activeTitles,
            currentStep,
            linkCollection,
            formSteps,
        };
    },
    methods: {
        handleMainStep(mainStep) {
            this.receivedConstant = mainStep;
        },
        handleSubStep(subStep) {
            this.activeTitles = subStep;
        },
        expandItem(index) {
            this.expandedItem = index;
        },
    },
};
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

.titulo-sub-pasos {
    margin-left: 1rem;
}
.titulo-sub-pasos .active {
    background-color: #d29c37;
    color: #fff;
    display: inline-flex;
}
/*.separator {
  flex-grow: 1;
  width: 2px;
  border-left: 2px dashed #728C54;
  margin-top: 10px;
}*/

/*.separator.expanded {
  height: 100px;
}*/

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
