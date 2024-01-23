<template>
    <div class="modulo-pasos">
        <div class="cont-dimen-1">
            <div class="col-lg-8 col-md-12">
                <h2>01 Medidas y peso aproximado del artículo</h2>
                <p class="bajada-h2">
                    Esto nos ayudará a mostrar las dimensiones precisas en la
                    descripción y garantizar una experiencia de compra sin
                    sorpresas.
                </p>
            </div>
            <div class="row-main-dim">
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="height-pro" class="form-label">Alto*</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="0,0"
                            id="height-pro"
                            v-model="formData.stepThreeHeight"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unh-pro" class="form-label"></label>
                        <select
                            id="unh-pro"
                            class="form-select"
                            v-model="formData.stepThreeHeightUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="width-pro" class="form-label">Ancho*</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="0,0"
                            id="width-pro"
                            v-model="formData.stepThreeWidth"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unw-pro" class="form-label"></label>
                        <select
                            id="unw-pro"
                            class="form-select"
                            v-model="formData.stepThreeWidthUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="long-pro" class="form-label">Largo*</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="0,0"
                            id="long-pro"
                            v-model="formData.stepThreeLength"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unl-pro" class="form-label"></label>
                        <select
                            id="unl-pro"
                            class="form-select"
                            v-model="formData.stepThreeLengthUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="weight-pro" class="form-label">Peso</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="0,0"
                            id="weight-pro"
                            v-model="formData.stepThreeWeight"
                        />
                    </div>
                    <div class="col-dim position-relative">
                        <label for="unwe-pro" class="form-label"></label>
                        <select
                            id="unwe-pro"
                            class="form-select"
                            v-model="formData.stepThreeWeightUnit"
                        >
                            <option value="g">g</option>
                            <option value="Kg">Kg</option>
                        </select>
                        <!-- Custom Tooltip -->
                        <div class="info-tool">
                            <svg
                                version="1.1"
                                id="info-svg"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                x="0px"
                                y="0px"
                                viewBox="0 0 17 17"
                                style="enable-background: new 0 0 17 17"
                                xml:space="preserve"
                                @mouseenter="showTooltip = true"
                                @mouseleave="showTooltip = false"
                            >
                                <path
                                    class="st0"
                                    d="M8.5,16c4.1,0,7.5-3.4,7.5-7.5C16,4.4,12.6,1,8.5,1C4.4,1,1,4.4,1,8.5C1,12.6,4.4,16,8.5,16z"
                                />
                                <path class="st0" d="M8.5,11.5v-3" />
                                <path class="st0" d="M8.5,5.5L8.5,5.5" />
                            </svg>
                        </div>
                        <div class="custom-tooltip" v-if="showTooltip">
                            <p>
                                El peso del artículo es importante. Si no lo
                                tienes a mano, te sugerimos buscar el dato en el
                                sitio web del proveedor.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cont-dimen-2">
            <div class="col-lg-8 col-md-12">
                <h2>02 Medidas y peso artículo embalado</h2>
                <p class="bajada-h2">
                    Basándote en las dimensiones de arriba, ¿Tu artículo
                    embalado para envío sería pequeño o algo más grande?. Te
                    invitamos a elegir el tamaño de embalaje definido por
                    Chilexpress que mejor se adapte a tu artículo
                </p>
            </div>
            <div class="row">
                <div class="col">
                    <div>
                        <input
                            type="radio"
                            class="btn-check"
                            name="dimension"
                            id="peque"
                            value="Pequeño"
                            v-model="formData.stepThreeBox"
                        />
                        <label class="btn" for="peque">
                            <div class="row">
                                <div class="col col-det">
                                    <span class="size-tit">Tamaño</span>
                                    <span class="size">Pequeño</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Alto</span>
                                    <span class="un">6 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Ancho</span>
                                    <span class="un">10 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Largo</span>
                                    <span class="un">20 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Peso</span>
                                    <span class="un">? kg</span>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            class="btn-check"
                            name="dimension"
                            id="stand"
                            value="Standard"
                            v-model="formData.stepThreeBox"
                        />
                        <label class="btn" for="stand">
                            <div class="row">
                                <div class="col col-det">
                                    <span class="size-tit">Tamaño</span>
                                    <span class="size">Standard</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Alto</span>
                                    <span class="un">70 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Ancho</span>
                                    <span class="un">70 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Largo</span>
                                    <span class="un">70 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Peso</span>
                                    <span class="un">15 kg</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <input
                            type="radio"
                            class="btn-check"
                            name="dimension"
                            id="grande"
                            value="Grande"
                            v-model="formData.stepThreeBox"
                        />
                        <label class="btn" for="grande">
                            <div class="row">
                                <div class="col col-det">
                                    <span class="size-tit">Tamaño</span>
                                    <span class="size">Grande</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Alto</span>
                                    <span class="un">80 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Ancho</span>
                                    <span class="un">80 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Largo</span>
                                    <span class="un">80 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Peso</span>
                                    <span class="un">50 kg</span>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            class="btn-check"
                            name="dimension"
                            id="extra"
                            value="Extra"
                            v-model="formData.stepThreeBox"
                        />
                        <label class="btn" for="extra">
                            <div class="row">
                                <div class="col col-det">
                                    <span class="size-tit">Tamaño</span>
                                    <span class="size">Extra</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Alto</span>
                                    <span class="un">200 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Ancho</span>
                                    <span class="un">100 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Largo</span>
                                    <span class="un">120 cm</span>
                                </div>
                                <div class="col col-det">
                                    <span class="un-tit">Peso</span>
                                    <span class="un">100 kg</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <button class="btn boton-principal" @click="nextStep">
            Guardar etapa y continuar<font-awesome-icon
                :icon="['fas', 'chevron-right']"
            />
        </button>
    </div>
</template>
<script>
import { useFormStore } from "../../../stores/values";
import { onMounted } from "vue";
export default {
    data() {
        return {
            showTooltip: false,
        };
    },
    emits: ["next-step", "constant-emitted", "active-subtitles"],
    setup(_, { emit }) {
        const mainStep = 1;
        const subValue = 1;
        const formStore = useFormStore();

        const formData = formStore.formData;

        onMounted(() => {
            emit("constant-emitted", mainStep);
        });

        const nextStep = () => {
            formStore.setFormData(formData);
            emit("next-step");
            emit("active-subtitles", subValue);
        };

        return {
            formData,
            nextStep,
        };
    },
};
</script>
