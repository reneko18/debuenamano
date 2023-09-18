<template>
<div class="modulo-resumen">

      <div class=" col-lg-7 col-md-12">
        <h2>Resumen de la publicación de tu artículo en venta</h2>
        <p class="bajada-h2">Verifica que los datos y la información que nos has proporcionado sea la correcta antes de enviarnos la publicación.</p>
      </div>
      <div class="row">
        <div class="col-6">
          <div>
              <label for="productName" class="form-label">Nombre*</label>
              <input type="text" class="form-control" id="productName" placeholder="Nombre del artículo" v-model="formData.stepOneName">
              <!--<p v-if="msg.name">{{ msg.name }}</p>-->
          </div>          
          <div class="position-relative" v-click-outside-element="closeDropdown">
              <div class="position-relative div-cat">
                <label for="testCat" class="form-label">Categoría*</label>
                <input id="testCat" type="text" class="form-control cat-select" :value="formData.stepOneCategory" @click="showAndCloseDropdown" readonly>
                <i class="fa-solid fa-chevron-down" @click="showAndCloseDropdown"></i>
              </div>          
              <div id="dropdown-cats">
                  <div class="accordion" id="accordionCategories">
                      <div v-for="category in categories">                   
                            <div v-if="category.subcategories == ''" class="cat-sin-hijo">
                              <input :id="'cat-' + category.id" class="btn-check" :value="category.name" type="radio" name="categoria" v-model="formData.stepOneCategory">
                              <label :for="'cat-' + category.id" class="btn">{{category.name}}</label>     
                            </div>
                            <h2 v-else class="accordion-header">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="generateDataBsTarget(category.id)">{{ category.name }}</button>
                            </h2>
                            <div :id="generateID(category.id)" class="accordion-collapse collapse" data-bs-parent="#accordionCategories">
                                <div class="accordion-body">
                                    <div v-for="subcategory in category.subcategories">
                                        <div v-if="category.id == subcategory.category_id">
                                            <input :id="'subcat-' + subcategory.id" class="btn-check" :value="subcategory.name" type="radio" name="categoria" v-model="formData.stepOneCategory">
                                            <label :for="'subcat-' + subcategory.id" class="btn">{{subcategory.name}}</label>                                                                                           
                                        </div>
                                    </div>
                                </div> 
                            </div>                                    
                        </div>
                  </div>
              </div> 
          </div>
          <div class="cont-genre">
              <label for="productGenre" class="form-label">Género</label>
              <select id="productGenre" class="form-select" v-model="formData.stepOneGenre">
                <option selected>Seleccione un género</option>
                <option value="Niño">Niño</option>
                <option value="Niña">Niña</option>
                <option value="Unisex">Unisex</option>
              </select>
          </div>  
        </div>
        <div class="col-6">
          <div class="row">
                <div class="col-md-2"> 
                    <label for="age-pro" class="form-label rango-edad">Rango de edad*</label>
                    <input type="text" class="form-control" placeholder="00" id="age-pro" v-model="formData.stepOneAgeIni">
                </div>
                <div class="col-md-4">
                    <label for="neonat-pro" class="form-label"></label>
                    <select id="neonat-pro" class="form-select" v-model="formData.stepOneAgeDateIni">
                      <option selected>Seleccione</option>
                      <option value="Recién nacido">Recién nacido</option>
                      <option value="Semanas">Semanas</option>
                      <option value="Meses">Meses</option>
                      <option value="Años">Años</option>
                    </select>
                </div>
                <div class="col-md-1 col-a flex-column justify-content-center" v-show="showSecondSelect">
                    <span>a</span>
                </div>
                <div class="col-md-2" v-show="showSecondSelect">
                    <label for="month-pro" class="form-label"></label>
                    <input type="text" class="form-control" placeholder="00" id="month-pro" v-model="formData.stepOneAgeFin">
                </div>
                <div class="col-md-3" v-show="showSecondSelect">
                    <label for="monthsel-pro" class="form-label"></label>
                    <select id="monthsel-pro" class="form-select" v-model="formData.stepOneAgeDateFin">
                      <option selected>Seleccione</option>
                      <option value="Semanas">Semanas</option>
                      <option value="Meses">Meses</option>
                      <option value="Años">Años</option>
                    </select>
                </div>
          </div>
          <div>
              <label for="desc-pro" class="form-label">Breve descripción*</label>
              <div class="position-relative">
                  <textarea 
                      id="desc-pro"
                      class="form-control" placeholder="Describe el artículo..."
                      v-model="formData.stepOneProductDescription"
                      @input="updateCharacterCount"
                      :style="{ height: textareaHeight + 'px' }"
                      rows="4"
                      maxlength="280"                            
                  ></textarea>  
                  <span class="character-count-badge">{{ characterCount }}/280 caracteres</span>    
              </div>                                        
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-7">
          <div>
            <label for="brandName" class="form-label">Marca*</label>
            <input type="text" class="form-control" id="brandName" placeholder="Ingresa el nombre de la marca" v-model="formData.stepTwoBrand">
          </div>
        </div>
        <div class="col-5">
          <div>
            <label for="modelName" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelName" placeholder="Ingresa el modelo del artículo" v-model="formData.stepTwoModel">
          </div>
        </div>
      </div>
      <div class="cont-dimen-1 resumen">
        <div class="row-main-dim">
              <div class="row-child-dim">
                <div class="col-dim">
                    <label for="height-pro" class="form-label">Alto*</label>
                    <input type="text" class="form-control" placeholder="0,0" id="height-pro" v-model="formData.stepThreeHeight">
                </div>
                <div class="col-dim">
                    <label for="unh-pro" class="form-label"></label>
                    <select id="unh-pro" class="form-select" v-model="formData.stepThreeHeightUnit">
                        <option selected>Seleccione</option>
                        <option value="cm">cm</option>
                        <option value="in">in</option>
                    </select>
                </div>
              </div>
              <div class="row-child-dim">
                <div class="col-dim">
                    <label for="width-pro" class="form-label">Ancho*</label>
                    <input type="text" class="form-control" placeholder="0,0" id="width-pro" v-model="formData.stepThreeWidth">
                </div>
                <div class="col-dim">
                    <label for="unw-pro" class="form-label"></label>
                    <select id="unw-pro" class="form-select" v-model="formData.stepThreeWidthUnit">
                        <option selected>Seleccione</option>
                        <option value="cm">cm</option>
                        <option value="in">in</option>
                    </select>
                </div>
              </div>
              <div class="row-child-dim">
                <div class="col-dim">
                    <label for="long-pro" class="form-label">Largo*</label>
                    <input type="text" class="form-control" placeholder="0,0" id="long-pro" v-model="formData.stepThreeLong">
                </div>
                <div class="col-dim">
                    <label for="unl-pro" class="form-label"></label>
                    <select id="unl-pro" class="form-select" v-model="formData.stepThreeLongUnit">
                        <option selected>Seleccione</option>
                        <option value="cm">cm</option>
                        <option value="in">in</option>
                    </select>
                </div>
              </div>
              <div class="row-child-dim">
                <div class="col-dim">
                    <label for="weight-pro" class="form-label">Peso</label>
                    <input type="text" class="form-control" placeholder="0,0" id="weight-pro" v-model="formData.stepThreeWeight">
                </div>
                <div class="col-dim position-relative">
                    <label for="unwe-pro" class="form-label"></label>
                    <select id="unwe-pro" class="form-select" v-model="formData.stepThreeWeightUnit">
                        <option selected>Seleccione</option>
                        <option value="g">g</option>
                        <option value="Kg">Kg</option>
                    </select>       
                </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div>
              <label for="statusItem" class="form-label">Estado</label>
              <select id="statusItem" class="form-select" v-model="formData.stepFourState">
                  <option selected>Seleccione un estado</option>
                  <option value="Usado en buen estado">Usado en buen estado</option>
                  <option value="Sin uso">Sin uso</option>
              </select>  
          </div>
        </div>
        <div class="col-6">
          <div class="row">
              <div class="col-md-3">
                  <label for="usageItem" class="form-label">Tiempo de uso</label>
                  <input type="text" class="form-control" placeholder="00" id="usageItem" v-model="formData.stepFourUsageTime">
              </div>
               <div class="col-md-4">
                  <label for="usageItem-pro" class="form-label"></label>
                  <select id="usageItem-pro" class="form-select" v-model="formData.stepFourUsageUnit">
                      <option selected>Seleccione un estado</option>
                      <option value="Dias">Dias</option>
                      <option value="Meses">Meses</option>
                      <option value="Años">Años</option>
                  </select> 
              </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="position-relative">
              <label for="obser-pro" class="form-label">Observación</label>
              <textarea 
                  id="obser-pro" 
                  class="form-control" 
                  placeholder="Que observaciones presenta el artículo..." 
                  v-model="formData.stepFiveDetails"
                  @input="updateCharacterCountObs"
                  rows="4"
                  maxlength="280"   
              ></textarea>
              <span class="character-count-badge">{{ characterCountObs }}/280 caracteres</span>                           
          </div>
        </div>
        <div class="col-6">
          <div class="position-relative">
              <label for="reco-pro" class="form-label">Recomendaciones</label>
              <textarea 
                  id="reco-pro" 
                  class="form-control" 
                  placeholder="Que recomendación darías para el correcto uso del artículo..." 
                  v-model="formData.stepFiveAdvice"
                  @input="updateCharacterCountReco"
                  rows="4"
                  maxlength="280"  
              ></textarea> 
              <span class="character-count-badge">{{ characterCountReco }}/280 caracteres</span>                          
          </div>
        </div>
      </div>

        <p>{{ formData.stepFiveAdvice }}</p>
        <h2 class="mt-5">Etapa 3</h2>
        <h4>Fotografías</h4>
        <h2 class="mt-5">Etapa 4</h2>
        <h4>Dirección</h4>
        <p>{{ formData.stepSixAddress }}</p>
        <h4>Contacto nombre + fono</h4>
        <p>{{ formData.stepSixContact }}</p>
        <h4>Región</h4>
        <p>{{ formData.stepSixRegion.name }}</p>
        <h4>Comuna</h4>
        <p>{{ formData.stepSixCity.name }}</p>
        <h4>Precio</h4>
        <p>{{ formData.stepSevenPrice }}</p>
        <h4>Nombre y apellido</h4>
        <p>{{ formData.stepEightName }}</p>
        <h4>Banco</h4>
        <p>{{ formData.stepEightBank }}</p>
        <h4>Nº de cuenta</h4>
        <p>{{ formData.stepEightBankNumber }}</p>
        <h4>RUT</h4>
        <p>{{ formData.stepEightRut }}</p>
        <h4>Tipo de cuenta</h4>
        <p>{{ formData.stepEightBankType }}</p>   
        <button class="btn btn-lg btn-primary" @click="submitForm">Enviar Datos</button> 
</div>

</template>
<script>
import { computed,onMounted } from 'vue';
import { useFormStore } from '../../../stores/values';
export default {
    data() {
      return {
        categories: [],
        showSecondSelect: true,
        dropdown: false,
        activeTrigger: false,
        textareaHeight: 100,
      };
    },
    setup(_, { emit }) {
    const mainStep = 5;
    const formStore = useFormStore();
    const formData = formStore.formData;
    const characterCount = computed(() => formStore.characterCount);
    const characterCountObs = computed(() => formStore.characterCountObs);
    const characterCountReco = computed(() => formStore.characterCountReco);

    onMounted(() => {
      emit('constant-emitted', mainStep); 
    });
    const updateCharacterCount = () => {
      const textWithoutSpaces = formData.stepOneProductDescription.replace(/\s/g, '');
      const newCharacterCount = textWithoutSpaces.length;
      formStore.setCharacterCount(newCharacterCount);
    };
    const updateCharacterCountObs = () => {
        const textWithoutSpacesObs = formData.stepFiveDetails.replace(/\s/g, '');
        const newCharacterCountObs = textWithoutSpacesObs.length;
        formStore.setCharacterCountObs(newCharacterCountObs);
    };

    const updateCharacterCountReco = () => {
        const textWithoutSpacesReco = formData.stepFiveAdvice.replace(/\s/g, '');
        const newCharacterCountReco = textWithoutSpacesReco.length;
        formStore.setCharacterCountReco(newCharacterCountReco);
    };

    return {
      characterCount,
      characterCountObs,
      characterCountReco,
      formData,
      updateCharacterCount,
      updateCharacterCountObs,
      updateCharacterCountReco,    
    };
  },
  watch: {
        'formData.stepOneAgeDateIni': function(newValue, oldValue) {
            if (newValue === 'Recién nacido') {
                this.showSecondSelect = false; // Hide the second select
            } else {
                this.showSecondSelect = true; // Show the second select
            }
        }
  },
  updated() {
    this.updateTextareaHeight();
  },
  created() {
    // Make an Axios GET request to your API
    axios.get('/api/categories')
      .then(response => {
        this.categories = response.data.categories;
        console.log(this.categories);
      })
      .catch(error => {
        console.error('Error fetching categories:', error);
      });
  },
  methods: {
    generateDataBsTarget(categoryId) {
      // Generate the dynamic data-bs-target value
      return `#panel-${categoryId}`;
    },
    generateID(id){
      return `panel-${id}`;
    },
    showAndCloseDropdown(){
            if(this.dropdown == false){
                this.dropdown = true;
                this.activeTrigger = true;
                TweenMax.fromTo(
                "#dropdown-cats",
                0.55,
                {
                    autoAlpha: 0,
                    y: -10
                },
                {
                    autoAlpha: 1,
                    y: 0,
                    ease: Power2.easeOut
                }
                );
            }else{
              this.dropdown = false;
              this.activeTrigger = false;
              TweenMax.to(
              "#dropdown-cats",
              0.2,
              {
                autoAlpha: 0,
                y: -10,
                ease: Power2.easeOut
              });
            }
    },
    closeDropdown(){
            this.dropdown = false;
            this.activeTrigger = false;
            TweenMax.to(
            "#dropdown-cats",
            0.2,
            {
                autoAlpha: 0,
                y: -10,
                ease: Power2.easeOut
            });
    }, 
    updateTextareaHeight() {
            const catHeight = document.querySelector('.cat-select').offsetHeight + 24;
            const genreHeight = document.querySelector('.cont-genre').offsetHeight;
            const leftHeight = catHeight + genreHeight;

            // Update the textareaHeight data property to match the left column height
            this.textareaHeight = leftHeight;
    },
    submitForm(){
      axios.post("/api/test/store",
          this.formData,                                                        
      )
      .then(res => {
          console.log(res)
          window.location.href = '/' 
      })
      .catch(error => {
        console.log(error.response.data);                                                  
      });
    }      
  }
}
</script>