<template> 
    <div class="modulo-pasos">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <h2>
                    Una vez que compren tu artículo ¿A que cuenta te depositamos
                    el pago?.
                </h2>
                <p class="bajada-h2">
                    Define el precio de venta de tu articulo considerando la
                    comisión de DBM.
                </p>
            </div>
        </div>

        <div class="row col-md-11 mx-auto bank-form" v-if="useBankDetails">      
            <div class="col">
                <div>
                    <label for="infoPayName" class="form-label"       
                        >Nombre y apellido</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="infoPayName"
                        placeholder="Nombre y Apellido"
                        v-model="formData.stepNineName"
                    />
                </div>
                <div>
                    <label for="infoPayBank" class="form-label">Banco</label>
                    <select
                        id="infoPayBank"
                        class="form-select"
                        v-model="formData.stepNineBank"
                    >
                        <option disabled selected value="">
                            Elige el banco
                        </option>
                        <option value="Banco BICE">Banco BICE</option>
                        <option value="Banco Consorcio">Banco Consorcio</option>
                        <option value="Banco Corpbanca">Banco Corpbanca</option>
                        <option value="Banco Crédito e Inversiones">
                            Banco Crédito e Inversiones
                        </option>
                        <option value="Banco Estado">Banco Estado</option>
                        <option value="Banco Falabella">Banco Falabella</option>
                        <option value="Banco Internacional">
                            Banco Internacional
                        </option>
                        <option value="Banco Paris">Banco Paris</option>
                        <option value="Banco Ripley">Banco Ripley</option>
                        <option value="Banco Santander">Banco Santander</option>
                        <option value="Banco Security">Banco Security</option>
                        <option value="Banco de Chile / Edwards-Citi">
                            Banco de Chile / Edwards-Citi
                        </option>
                        <option value="Banco del Desarrollo">
                            Banco del Desarrollo
                        </option>
                        <option value="Coopeuch">Coopeuch</option>
                        <option value="HSBC Bank">HSBC Bank</option>
                        <option value="Itau">Itau</option>
                        <option value="Rabobank">Rabobank</option>
                        <option value="Tenpo Prepago">Tenpo Prepago</option>
                        <option value="Prepago Los Héroes">
                            Prepago Los Héroes
                        </option>
                        <option value="Scotiabank">Scotiabank</option>
                        <option value="Scotiabank Azul">Scotiabank Azul</option>
                        <option value="Mercado Pago">Mercado Pago</option>
                        <option value="TAPP Caja Los Andes">
                            TAPP Caja Los Andes
                        </option>
                        <option value="Copec Pay">Copec Pay</option>
                        <option value="La Polar Prepago">
                            La Polar Prepago
                        </option>
                        <option value="Global66">Global66</option>
                    </select>
                </div>
                <div>
                    <label for="infoPayAccountNumber" class="form-label"
                        >Nº de cuenta</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="infoPayAccountNumber"
                        placeholder=""
                        v-model="formData.stepNineBankNumber"
                    />
                </div>
            </div>
            <div class="col">
                <div>
                    <label for="infoPayRut" class="form-label">Rut</label>
                    <input
                        type="text"
                        class="form-control"
                        id="infoPayRut"
                        placeholder="Ej: 12.345.678-K"
                        v-model="formData.stepNineRut"
                        @input="formatAndValidateRUT"
                    />
                    <!-- <div v-if="isValidRUT" class="text-success">Valid RUT</div>
                    <div v-else class="text-danger">Invalid RUT</div> -->
                </div>
                <div>
                    <label for="infoPayTypeAccount" class="form-label"
                        >Tipo de cuenta</label
                    >
                    <select
                        id="infoPayTypeAccount"
                        class="form-select"
                        v-model="formData.stepNineBankType"
                    >
                        <option disabled selected value="">
                            Elige el tipo de cuenta
                        </option>
                        <option value="Cuenta Vista">Cuenta Vista</option>
                        <option value="Cuenta Corriente">
                            Cuenta Corriente
                        </option>
                    </select>
                </div>
                <div class="d-flex flex-column justify-content-center sec-bank-default-form">
                    <a class="underline-dbm cursor-pointer" @click="toggleBankDetails">
                        <svg
                            version="1.1"
                            id="cardSellingForm"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px"
                            y="0px"
                            viewBox="0 0 22 16"
                            xml:space="preserve"
                        >
                            <path
                                class="st0"
                                d="M18.5,1H2.8C1.8,1,1,1.8,1,2.8v10.5c0,1,0.8,1.8,1.8,1.8h15.8c1,0,1.8-0.8,1.8-1.8V2.8C20.3,1.8,19.5,1,18.5,1z
                                    "
                            />
                            <path class="st0" d="M1,6.2h19.3" />
                        </svg>
                        <span>Definir como cuenta prederterminada</span>
                    </a>
                </div>
            </div>
        </div>


        <div class="row col-md-11 mx-auto bank-default" v-else> 
            <h3>Te depositaremos a:</h3>           
            <div class="col">                
                <div>
                    <label for="infoPayName" class="form-label"
                        >Nombre y apellido</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="infoPayName"
                        placeholder="Nombre y Apellido"
                        v-model="bankDetails.full_name"
                        readonly
                    />
                </div>
                <div>
                    <label for="infoPayBank" class="form-label">Banco</label>
                    <input
                        id="infoPayBank"
                        class="form-control"
                        v-model="bankDetails.bank"
                        readonly
                    />  
                </div>
                <div>
                    <label for="infoPayAccountNumber" class="form-label"
                        >Nº de cuenta</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="infoPayAccountNumber"
                        placeholder=""
                        v-model="bankDetails.account_number"
                        readonly
                    />
                </div>
            </div>
            <div class="col">
                <div>
                    <label for="infoPayRut" class="form-label">Rut</label>
                    <input
                        type="text"
                        class="form-control"
                        id="infoPayRut"
                        v-model="bankDetails.rut"
                        readonly
                    />
                </div>
                <div>
                    <label for="infoPayTypeAccount" class="form-label"
                        >Tipo de cuenta</label
                    >
                    <input
                        id="infoPayTypeAccount"
                        class="form-control"
                        v-model="bankDetails.account_type"
                        readonly
                    >
                </div>
                <div class="d-flex flex-column justify-content-center sec-bank-default-form">
                    <a class="underline-dbm cursor-pointer" @click="toggleBankDetails">
                        <svg
                            version="1.1"
                            id="cardSellingForm"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px"
                            y="0px"
                            viewBox="0 0 22 16"
                            xml:space="preserve"
                        >
                            <path
                                class="st0"
                                d="M18.5,1H2.8C1.8,1,1,1.8,1,2.8v10.5c0,1,0.8,1.8,1.8,1.8h15.8c1,0,1.8-0.8,1.8-1.8V2.8C20.3,1.8,19.5,1,18.5,1z
                                    "
                            />
                            <path class="st0" d="M1,6.2h19.3" />
                        </svg>
                        <span>definir otra cuenta bancaria</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <button class="btn boton-principal" @click="nextStep">
            Guardar etapa y continuar
            <font-awesome-icon :icon="['fas', 'chevron-right']" />
        </button>
    </div>
</template>
<script>
import { useFormStore } from "../../../stores/values";
import { onMounted } from "vue";
export default {
    data() {
        return {
            // isValidRUT: false,
            bankDetails: [],
            useBankDetails: this.userBank,
        };
    },
    props: ['userId','userBank'],
    emits: ["next-step", "constant-emitted", "active-subtitles"],
    setup(_, { emit }) {
        const mainStep = 4;
        const subValue = 4;
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
    methods: {
        formatAndValidateRUT() {
            // Obtain the value from the formattedRUT
            let rut = this.formData.stepNineRut
                .replace(/[^\dKk]/g, "")
                .toUpperCase();
            const length = rut.length;

            if (length > 1) {
                rut = rut.replace(
                    /^(\d{1,2})(\d{3})(\d{3})(\d{1})$/,
                    "$1.$2.$3-$4"
                );
            } else {
                rut = rut.replace(
                    /^(\d{1,2})(\d{3})(\d{3})(\d{0,1})$/,
                    "$1.$2.$3-$4"
                );
            }

            this.formData.stepNineRut = rut;

            // Now, perform the validation
            const rutDigits = rut.replace(/[^\d]/g, "").slice(0, -1);
            const verificationDigit = rut.slice(-1);

            let sum = 0;
            let multiplier = 2;

            for (let i = rutDigits.length - 1; i >= 0; i--) {
                sum += parseInt(rutDigits.charAt(i), 10) * multiplier;
                multiplier = multiplier === 7 ? 2 : multiplier + 1;
            }

            const expectedVerificationDigit = 11 - (sum % 11);

            // if (expectedVerificationDigit === 11) {
            //     this.isValidRUT = verificationDigit === "0";
            // } else if (expectedVerificationDigit === 10) {
            //     this.isValidRUT = verificationDigit === "K";
            // } else {
            //     this.isValidRUT =
            //         parseInt(verificationDigit, 10) ===
            //         expectedVerificationDigit;
            // }
        },
        fetchBankDetails(){
            axios.get(`/api/user/${this.userId}/getbankdetails`)
            .then(response => {
                this.bankDetails = response.data; 
                if (this.bankDetails) {   
                    this.formData.stepNineName = this.bankDetails.full_name;
                    this.formData.stepNineBank =  this.bankDetails.bank;
                    this.formData.stepNineBankNumber = this.bankDetails.account_number;
                    this.formData.stepNineRut = this.bankDetails.rut;
                    this.formData.stepNineBankType = this.bankDetails.account_type;
                    this.useBankDetails = true;
                }     
            })
            .catch(error => {
                console.error('Error fetching user details:', error);
            });
        },
        toggleBankDetails() {
            this.useBankDetails = !this.useBankDetails;
        },
    },
    mounted() {
        this.fetchBankDetails();
    },
};
</script>
<style>
#cardSellingForm {
    width: 100%;
    max-width: 20px;
    margin-right: 1rem;
}
#cardSellingForm .st0 {
    fill: none;
    stroke: #728c54;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}
</style>
