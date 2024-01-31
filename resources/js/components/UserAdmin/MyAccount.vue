<template>
    <div class="col-10 mx-auto mb-5">
        <div>
            <h2>Información personal</h2>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="name" 
                        v-model="userInfo.name" 
                        :readonly="userInfo.name !== null"
                    />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="lastname" class="form-label">Apellidos</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="lastname" 
                        v-model="userInfo.lastname" 
                        :readonly="userInfo.lastname !== null"
                    />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="birthdate" class="form-label"
                        >Fecha de nacimiento</label
                    >
                    <Calendar 
                        v-model="userBirthdate" 
                        showIcon iconDisplay="input" 
                        placeholder="DD/MM/AAAA" 
                        inputId="birthdate" 
                        dateFormat="dd/mm/yy"
                        :readonly="userInfo.birthdate !== null"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="number" class="form-label"
                        >Nº de contacto</label
                    >
                    <input type="text" class="form-control" id="number" v-model="userPhone"/>
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        v-model="userInfo.email" 
                        :readonly="userInfo.email !== null"
                    />
                </div>
            </div>
        </div>
        <div>
            <a class="btn boton-principal" @click="savePersonalInfo">
                Editar información personal
            </a>
        </div>
    </div>
    <div class="col-10 mx-auto mb-5">
        <div>
            <h2>Cambio de contraseña</h2>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="password" class="form-label"
                        >Actual contraseña
                    </label>
                    <div class="input-group">
                        <input 
                            :type="showCurrentPassword === false ? 'password' : 'text'" 
                            class="form-control password-user-admin" 
                            id="password" 
                            v-model="currentPassword"
                        />
                        <button
                            class="btn btn-outline-secondary"
                            @click="togglePassword('currentPassword')"
                        >
                            <font-awesome-icon :icon="showCurrentPassword === false ? ['far', 'eye'] : ['far', 'eye-slash']" />   
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="password-confirm" class="form-label"
                        >Ingresa tu nueva contraseña
                    </label>
                    <div class="input-group">
                        <input
                            :type="showNewPassword === false ? 'password' : 'text'" 
                            class="form-control password-user-admin"
                            id="password-confirm"
                            v-model="newPassword"
                        />
                        <button
                            class="btn btn-outline-secondary"
                            @click="togglePassword('newPassword')"
                        >
                        <font-awesome-icon :icon="showNewPassword === false ? ['far', 'eye'] : ['far', 'eye-slash']" />  
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <span>*Debe contener mínimo 8 carácteres</span>
            </div>
        </div>
        <div v-if="errorMessagePass" class="invalid-dbm mb-5">
                {{ errorMessagePass }}
        </div>
        <div>
            <a class="btn boton-principal" @click="changePassword">Cambiar contraseña</a>
        </div>
    </div>
    <div class="col-10 mx-auto mb-5">
        <div>
            <h2>Cuenta de depósito</h2>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="namebank" class="form-label"
                        >Nombre y apellido</label
                    >
                    <input 
                        type="text" 
                        class="form-control" 
                        id="namebank" 
                        placeholder="Nombre y Apellido"
                        v-model="formBank.fullName"
                    />
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="rut" class="form-label">Rut</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="rut" 
                        placeholder="Ej: 12.345.678-K"
                        v-model="formBank.rut"
                        :readonly="formBank.rut !== null"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="bank" class="form-label">Banco</label>
                    <select 
                        type="text" 
                        class="form-select" 
                        id="bank" 
                        v-model="formBank.bank" 
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
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="accounttype" class="form-label"
                        >Tipo de cuenta</label
                    >
                    <select
                        type="text" 
                        class="form-select" 
                        id="accounttype" 
                        v-model="formBank.accountType" 
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
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="accountnumber" class="form-label"
                        >Nº de cuenta</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="accountnumber"
                        v-model="formBank.accountNumber"
                    />
                </div>
            </div>
        </div>
        <div>
            <a class="btn boton-principal" @click="saveBankDetails">
                Cambiar cuenta de depósito
            </a>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import Calendar from 'primevue/calendar';
const props = defineProps({
    userId: { type: Number, default: "" },
    userSlug: { type: String, default: "" },
});

const userInfo = ref('');
const userBirthdate = ref('');
const userPhone = ref('');
const currentPassword = ref('');
const newPassword = ref('');
const showCurrentPassword = ref(false);
const showNewPassword = ref(false);
const errorMessagePass = ref('');

const formBank = ref({
    fullName: '',
    rut:'',
    bank: '',
    accountType: '',
    accountNumber: '',
})


const changePassword = () => {
  // Check if the passwords are the same and meet the criteria
  if (arePasswordsValid()) {
    updatePassword();
  } else {
    errorMessagePass.value = "Las contraseñas deben ser idénticas";
  }
};

const togglePassword = (passwordType) => {
  if (passwordType === 'currentPassword') {
    showCurrentPassword.value = !showCurrentPassword.value;
  } else if (passwordType === 'newPassword') {
    showNewPassword.value = !showNewPassword.value;
  }
};

const arePasswordsValid = () => {
  // Check if both passwords are at least 8 characters long and are the same
  return newPassword.value.length >= 8 && newPassword.value === currentPassword.value;
};

const fetchData = async (user_id) => {
    try {
        const response = await axios.get(`/api/user/${user_id}`);
        userInfo.value = response.data;
         // Check if userInfo.birthdate is not null
        if (userInfo.value.birthdate !== null) {           
            userBirthdate.value = userInfo.value.birthdate;
        }
        if (userInfo.value.phone !== null) {           
            userPhone.value = userInfo.value.phone;
        }
        if (userInfo.value.bank_detail.fullName !== null){
            formBank.value.fullName = userInfo.value.bank_detail.full_name;
        }
        if (userInfo.value.bank_detail.rut !== null){
            formBank.value.rut = userInfo.value.bank_detail.rut;
        }
        if (userInfo.value.bank_detail.account_number !== null){
            formBank.value.accountNumber = userInfo.value.bank_detail.account_number;
        }
        if (userInfo.value.bank_detail.account_type !== null){
            formBank.value.accountType = userInfo.value.bank_detail.account_type;
        }
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};


const formatDate = (dateString) => {
    const dateObject = new Date(dateString);
    const day = dateObject.getDate().toString().padStart(2, '0');
    const month = (dateObject.getMonth() + 1).toString().padStart(2, '0');
    const year = dateObject.getFullYear();
    return `${day}/${month}/${year}`;
};


const fetchDataAsync = async () => {
    await fetchData(props.userId);
};

const savePersonalInfo = async() => {
    try {
        const response = await axios.put(
            `/api/user/${props.userSlug}/updatepersinfo`, 
            {
                phone: userPhone.value,
                birthdate: formatDate(userBirthdate.value),
            }
        );  
        console.log("Product updated successfully:", response.data);
    } catch (error) {
        console.error("Error updating product:", error);
    }
}

const updatePassword = async() => {
    try {
        const response = await axios.put(
            `/api/user/${props.userSlug}/updatepass`, 
            {
                password: newPassword.value,
            }
        );  
        console.log("Product updated successfully:", response.data);
    } catch (error) {
        console.error("Error updating product:", error);
    }
}

const saveBankDetails = async() => {
    try {      
        const response = await axios.put(
            `/api/user/${props.userSlug}/bankdetails`, 
            {
                full_name: formBank.value.fullName,
                bank: formBank.value.bank,
                account_number: formBank.value.accountNumber,
                rut: formBank.value.rut,
                account_type: formBank.value.accountType,
            }
        );  
        console.log("Product updated successfully:", response.data);
    } catch (error) {
        console.error("Error updating product:", error);
    }
}


onMounted(() => {
    fetchDataAsync();
});
</script>
<style scoped>
    .password-user-admin{
        margin-bottom: 0;
    }
</style>
