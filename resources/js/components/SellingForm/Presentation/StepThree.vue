<template>
  <div class="modulo-pasos">
      <div class="cont-dimen-1">
        <div class="col-lg-8 col-md-12">     
          <h2>01 Medidas y peso aproximado del artículo</h2>
          <p class="bajada-h2">Esto nos ayudará a mostrar las dimensiones precisas en la descripción y garantizar una experiencia de compra sin sorpresas.</p>
        </div>
        <div class="row">
          <div class="col-md-1">
              <label for="height-pro" class="form-label">Alto</label>
              <input type="text" class="form-control" placeholder="0,0" id="height-pro" v-model="formData.stepThreeHeight">
          </div>
          <div class="col-md-1">
              <label for="unh-pro" class="form-label"></label>
              <select id="unh-pro" class="form-select" v-model="formData.stepThreeHeightUnit">
                  <option selected>Seleccione</option>
                  <option value="cm">cm</option>
                  <option value="in">in</option>
              </select>
          </div>
          <div class="col-md-1">
              <label for="width-pro" class="form-label">Ancho</label>
              <input type="text" class="form-control" placeholder="0,0" id="width-pro" v-model="formData.stepThreeWidth">
          </div>
          <div class="col-md-1">
              <label for="unw-pro" class="form-label"></label>
              <select id="unw-pro" class="form-select" v-model="formData.stepThreeWidthUnit">
                  <option selected>Seleccione</option>
                  <option value="cm">cm</option>
                  <option value="in">in</option>
              </select>
          </div>
          <div class="col-md-1">
              <label for="long-pro" class="form-label">Largo</label>
              <input type="text" class="form-control" placeholder="0,0" id="long-pro" v-model="formData.stepThreeLong">
          </div>
          <div class="col-md-1">
              <label for="unl-pro" class="form-label"></label>
              <select id="unl-pro" class="form-select" v-model="formData.stepThreeLongUnit">
                  <option selected>Seleccione</option>
                  <option value="cm">cm</option>
                  <option value="in">in</option>
              </select>
          </div>
          <div class="col-md-1">
              <label for="weight-pro" class="form-label">Peso</label>
              <input type="text" class="form-control" placeholder="0,0" id="weight-pro" v-model="formData.stepThreeWeight">
          </div>
          <div class="col-md-1">
              <label for="unwe-pro" class="form-label"></label>
              <select id="unwe-pro" class="form-select" v-model="formData.stepThreeWeightUnit">
                  <option selected>Seleccione</option>
                  <option value="cm">cm</option>
                  <option value="in">in</option>
              </select>
          </div>
      </div>
    </div>
    <div class="cont-dimen-2">
      <div class="col-lg-8 col-md-12">     
        <h2>02 Medidas y peso artículo embalado</h2>
        <p class="bajada-h2">Basándote en las dimensiones de arriba, ¿Tu artículo embalado para envío sería pequeño o algo más grande?. Te invitamos a elegir el tamaño de embalaje definido por Chilexpress que mejor se adapte a tu artículo</p>
      </div>  
      <div class="row">
          <div class="col">
            <div>
              <input type="radio" class="btn-check" name="dimension" id="peque">
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
              <input type="radio" class="btn-check" name="dimension" id="stand">
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
              <input type="radio" class="btn-check" name="dimension" id="grande">
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
              <input type="radio" class="btn-check" name="dimension" id="extra">
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
      <button class="btn boton-principal" @click="nextStep">Guardar etapa y continuar<font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
  </div>   
</template>
<script>
import { useFormStore } from '../../../stores/values';
import { onMounted } from 'vue';
export default {

    emits: ['next-step','constant-emitted'],
    setup(_, { emit }) {
    const mainStep = 1;
    const formStore = useFormStore();

    const formData = formStore.formData;    

    onMounted(() => {
      emit('constant-emitted', mainStep); 
    });

    const nextStep = () => {
      formStore.setFormData(formData);
      emit('next-step');
    };

    return {
      formData,
      nextStep,
    };
  },
}
</script>
<style scoped>
.cont-dimen-1{
  margin-bottom:4rem;
}
.cont-dimen-2 label{
  width:100%;
  height: auto;
  background-color:#fff;
  border-radius:2px;
  border: 1px dashed #C0C6B9;
  padding: 1.8rem 1rem;
  margin-bottom:1rem;
}
.cont-dimen-2 label:hover{
  background-color:#fff;
  border-radius:2px;
  border: 1px dashed #C0C6B9;
}
.cont-dimen-2 .col-det{
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}
.cont-dimen-2 .size-tit{
  font-size:9px;
  font-weight:700;
  color: #454545;
  text-transform: uppercase;
  line-height:14px;
  margin-bottom:2px;
}
.cont-dimen-2 .size{
  font-family: 'Quicksand', sans-serif;
  font-size: 18px;
  font-weight:700;
  color: #728C54;
  line-height:16px;
}
.cont-dimen-2 .un-tit{
  font-size:14px;
  font-weight:700;
  color:#454545;
  line-height:14px;
  margin-bottom:4px;
}
.cont-dimen-2 .un{
  font-size:14px;
  font-weight: 400;
  color:#1B1F22;
  line-height:14px;
}
.cont-dimen-2 .btn-check:checked + .btn{
  background-color: #728C54;
}
.cont-dimen-2 .btn-check:checked + .btn span{
  color:#fff;
}
</style>