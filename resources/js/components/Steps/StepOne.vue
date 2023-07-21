<template>
        <span v-if="step">Listo para el siguiente paso</span>
          <div class="d-flex justify-content-end mb-5">
            <button @click="nextStep == 1 ? goStepTwo() : restStepOne()" class="btn btn-step" :class="step ? 'active' : ''"><span>Pasar a la siguiente fase</span><font-awesome-icon :icon="['fas', 'chevron-right']" /></button>   
          </div>
          <div>
            <tabs>
                <tab title="Artículo">
                    <div>
                        <h2>Cuéntanos ¿Qué artículo quieres vender?</h2>
                        <p>Nombra tu artículo, selecciona una categoría, características que le corresponda y danos una breve descripción.</p>
                    </div>
                    <div class="form">
                        <div class="row">
                              <div class="col-md-6">
                                <div class="position-relative">
                                  <label for="name-pro" class="form-label">Nombre</label>
                                  <input type="text" class="form-control" :class="[form.productName ? 'is-valid' : '', msg.productName ? 'is-invalid' : '']" id="name-pro" v-model="formData.name">
                                    <div class="invalid-tooltip" v-if="msg.productName">
                                        {{ msg.productName }}
                                    </div>                                                       
                                </div>
                                <div>
                                  <label for="cat-pro" class="form-label">Categoría</label>
                                  <select id="cat-pro" class="form-select" aria-label="Select Category" v-model="form.productCat">
                                    <option selected>Selecciona una categoría</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="gen-pro" class="form-label">Género</label>
                                        <select id="gen-pro" class="form-select" aria-label="Select Genre" v-model="form.productGenre">
                                            <option selected>Todos los géneros</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="age-pro" class="form-label">Edad</label>
                                        <input type="text" class="form-control" placeholder="00" id="age-pro">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="neonat-pro" class="form-label"></label>
                                        <select id="neonat-pro" class="form-select" aria-label="Select Genre">
                                            <option selected>Recién nacido</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div>
                                    <label class="form-label" for="floatingTextarea">Breve descripción</label>
                                    <textarea class="form-control" placeholder="Describe el artículo..." id="floatingTextarea" v-model="form.productDesc"></textarea>                                    
                                </div>
                              </div>
                        </div>
                    </div>
                </tab>
                <tab title="Marca">
                    <div>
                        <h2>Si es posible, indícanos la marca y el modelo de tu artículo</h2>
                        <p>Al proporcionar información específica aumentas las posibilidades de que una persona encuentre rápidamente tu producto.</p>
                    </div>
                    <div class="form">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="brand-pro" class="form-label">Marca</label>
                                <input type="text" class="form-control" placeholder="Ingresa el nombre de la marca" id="brand-pro">
                            </div>
                            <div class="col-md-6">
                                <label for="model-pro" class="form-label">Modelo</label>
                                <input type="text" class="form-control" placeholder="Ingresa el modelo del artículo" id="model-pro">
                            </div>
                        </div>
                    </div>
                </tab>
                <tab title="Dimensiones">
                    <div>
                        <h2>Medidas y peso aproximado del artículo</h2>
                        <p>Esta información es importante tanto para los posibles compradores como para el courier.</p>
                    </div>
                    <div class="form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="height-pro" class="form-label">Alto</label>
                                        <input type="text" class="form-control" placeholder="00" id="height-pro">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="height-unity-pro" class="form-label"></label>
                                        <select id="height-unity-pro" class="form-select" aria-label="Select Unity">
                                                <option selected>cm</option>
                                            <option value="1">cm</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="width-pro" class="form-label">Ancho</label>
                                        <input type="text" class="form-control" placeholder="00" id="width-pro">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="width-unity-pro" class="form-label"></label>
                                        <select id="width-unity-pro" class="form-select" aria-label="Select Unity">
                                                <option selected>cm</option>
                                            <option value="1">cm</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="large-pro" class="form-label">Largo</label>
                                        <input type="text" class="form-control" placeholder="00" id="large-pro">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="large-unity-pro" class="form-label"></label>
                                        <select id="large-unity-pro" class="form-select" aria-label="Select Unity">
                                                <option selected>cm</option>
                                            <option value="1">cm</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="weight-pro" class="form-label">Largo</label>
                                        <input type="text" class="form-control" placeholder="00" id="weight-pro">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="weight-unity-pro" class="form-label"></label>
                                        <select id="weight-unity-pro" class="form-select" aria-label="Select Unity">
                                                <option selected>cm</option>
                                            <option value="1">cm</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tab>
            </tabs>         
          </div>
</template>

<script>
import Tab from '../Tabs/Tab.vue';
import Tabs from '../Tabs/Tabs.vue';
import _ from 'lodash';

export default { 
    components: {
        Tab,
        Tabs
    },
    emits: ['child-data'],
    data(){
        return{
           step:'',
           nextStep: '',
           msg: [],
           form:{
             productName:'',
             productCat:'',
             productGenre:'',
             productDesc:'',
           }
        }
    },
    watch:{
        'form.productName'(value){           
            this.form.productName = value;
            this.validateProductName(value);  
        },
    },
    methods:{
        validateProductName(value){
            if(_.isEmpty(value)){  
                this.msg['productName'] = 'Por favor rellene este campo'; 
                this.step = '';  
                this.nextStep = '';            
                return false
            }else{
                this.msg['productName'] = '';
                this.step = 1;
                this.nextStep = 1; 
            }
        },
        goStepTwo(){
            this.sendDataToParent();
        },  
        restStepOne(){
            return false;
        } , 
        sendDataToParent() {
            this.$emit('child-data', this.nextStep);
        },
    }
}
</script>


<style scoped>
  .tab-content h2, .tab-content p{
    color: #fff;
  }
  .tab-content h2{
    font-size: 24px;
    line-height: 30px;
    font-weight: 700;
  }
  .form{
    background-color:#fff;
    border-radius: 6px;
  }
  .btn-step{
    display: flex;
    align-items: center;
    color: #AAC0E4;
    border: 2px solid #AAC0E4;
    cursor: not-allowed;
  }
  .btn-step.active{
    color: #4273C2;
    border: 2px solid #4273C2;
    cursor: pointer;
  }
</style>
