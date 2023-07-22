<template>
                <h2>Cuéntanos ¿Qué artículo quieres vender?</h2>
                <p class="bajada-h2">Nombra tu artículo, selecciona una categoría, características que le corresponda y danos una breve descripción.</p>
                <div class="row">
                    <div class="col-6">
                        <div>
                            <label for="productName" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" id="productName" placeholder="Nombre del artículo" v-model="formData.name">
                            <!--<p v-if="msg.name">{{ msg.name }}</p>-->
                        </div>
                        <div>
                            <label for="productCat" class="form-label">Categoría*</label>
                            <select id="productCat" class="form-select" aria-label="Default select example">
                                <option selected>Selecciona una categoría</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div>
                            <label for="productGenre" class="form-label">Género</label>
                            <select id="productGenre" class="form-select" aria-label="Default select example">
                                <option selected>Todos los géneros</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="age-pro" class="form-label">Edad</label>
                                <input type="text" class="form-control" placeholder="00" id="age-pro">
                            </div>
                            <div class="col-md-4">
                                <label for="neonat-pro" class="form-label"></label>
                                <select id="neonat-pro" class="form-select" aria-label="Select Genre">
                                    <option selected>Recién nacido</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <span>a</span>
                            </div>
                            <div class="col-md-2">
                                <label for="month-pro" class="form-label"></label>
                                <input type="text" class="form-control" placeholder="00" id="month-pro">
                            </div>
                            <div class="col-md-3">
                                <label for="monthsel-pro" class="form-label"></label>
                                <select id="monthsel-pro" class="form-select" aria-label="Select Month">
                                    <option selected>Meses</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="desc-pro" class="form-label">Breve descripción*</label>
                            <textarea class="form-control" placeholder="Describe el artículo..."></textarea>                           
                        </div>
                    </div>
                </div>
                <!-- <button class="btn btn-primary mt-3" @click="validateStepOne">Continuar</button>-->
                <button class="btn btn-primary" @click="nextStep">Continuar</button>

</template>
<script>
import { useFormStore } from '../../../stores/values';

export default {
/*setup(){
    const formStore = useFormStore();

    const formData = formStore.formData;

    return {
      formData,
    };
},
emits: ['child-data'],
data(){
  return {
    formData:{
        name:'',
    },
    validate: false,
    msg:{
       name:'',
    }
  }
},
props: ['nextStep'],
  methods: {
    nextStepChild() {
      formStore.setFormData(formData);
      this.nextStep();
    },
    validateStepOne(){
        if (_.isEmpty(this.formData.name)){  
            this.validate = false                   
            this.msg.name= 'Por favor rellena este campo'
        }
        else{
            this.msg.name = ''
            this.validate = true 
            this.nextStepChild()
        }
    },
    sendDataToParent() {
      this.$emit('child-data', this.validate);
    },
  },*/
  //Test Code
  setup() {
    const formStore = useFormStore();

    const formData = formStore.formData;

    const nextStep = () => {
      formStore.setFormData(formData);
      // Emit an event to notify the parent component to move to the next step
      // You can use an event bus, Vue's built-in event system, or a global store
      // For simplicity, we'll use a custom event here.
      // Alternatively, you can use Vue's router to handle navigation between steps.
      this.$emit('next-step');
    };

    return {
      formData,
      nextStep,
    };
  },
}
</script>
