<template>
<div class="modulo-pasos">
        <div class="row">
                    <div class=" col-lg-7 col-md-12">
                        <h2>Cuéntanos ¿Qué artículo quieres vender?</h2>
                        <p class="bajada-h2">Nombra tu artículo, selecciona una categoría, características que le corresponda y danos una breve descripción.</p>
                    </div>
        </div>
        <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div>
                            <label for="productName" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" id="productName" placeholder="Nombre del artículo" v-model="formData.stepOneName">
                            <!--<p v-if="msg.name">{{ msg.name }}</p>-->
                        </div>
                        <div>                            
                            <label for="productCat1" class="form-label">Categoría*</label>
                            <select id="productCat1" class="form-select" v-model="formData.stepOneCategory">
                              <option selected>Selecciona una categoría</option>
                              <optgroup v-for="category in categories" :label="category.name" :key="category.id">
                                <option v-for="subcategory in category.subcategories" :value="subcategory.id" :key="subcategory.id">{{ subcategory.name }}</option>
                              </optgroup>
                            </select>
                         </div>
                         <div class="position-relative" v-click-outside-element="closeDropdown">
                            <div class="position-relative div-cat">
                              <label for="testCat" class="form-label">Categoría*</label>
                              <input type="text" class="form-control cat-select" :value="formData.testCat" @click="showAndCloseDropdown" readonly>
                              <i class="fa-solid fa-chevron-down" @click="showAndCloseDropdown"></i>
                            </div>          
                            <div id="dropdown-cats">
                              <div class="accordion" id="accordionCategories">
                                  <div v-for="category in categories">                   
                                        <div v-if="category.subcategories == ''" class="cat-sin-hijo">
                                          <input :id="'cat-' + category.id" class="btn-check" :value="category.name" type="radio" name="categoria" v-model="formData.testCat">
                                          <label :for="'cat-' + category.id" class="btn">{{category.name}}</label>     
                                        </div>
                                        <h2 v-else class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="generateDataBsTarget(category.id)">
                                            {{ category.name }}
                                          </button>
                                        </h2>
                                        <div :id="generateID(category.id)" class="accordion-collapse collapse" data-bs-parent="#accordionCategories">
                                          <div class="accordion-body">
                                            <div v-for="subcategory in category.subcategories">
                                              <div v-if="category.id == subcategory.category_id">
                                                  <input :id="'subcat-' + subcategory.id" class="btn-check" :value="subcategory.name" type="radio" name="categoria" v-model="formData.testCat">
                                                  <label :for="'subcat-' + subcategory.id" class="btn">{{subcategory.name}}</label>                                                                                           
                                              </div>
                                            </div>
                                          </div> 
                                        </div>                                    
                                  </div>
                              </div>
                            </div> 
                         </div>                 
                        <div>
                            <label for="productGenre" class="form-label">Género</label>
                            <select id="productGenre" class="form-select" v-model="formData.stepOneGenre">
                              <option selected>Seleccione un género</option>
                              <option value="Niño">Niño</option>
                              <option value="Niña">Niña</option>
                              <option value="Unisex">Unisex</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="age-pro" class="form-label">Edad</label>
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
                            <div class="col-md-1 d-flex flex-column justify-content-center" v-show="showSecondSelect">
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
                                class="form-control" placeholder="Describe el artículo..."
                                v-model="formData.stepOneProductDescription"
                                @input="updateCharacterCount"
                                rows="4"
                                maxlength="280"                            
                                ></textarea>  
                                <span class="character-count-badge">{{ characterCount }}/280</span>    
                            </div>                                        
                        </div>
                    </div>
        </div>   
        
</div>
<div class="d-flex justify-content-end mt-4">
 <button class="btn boton-principal" @click="nextStep">Continuar <font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
</div>



</template>
<script>
import { useFormStore } from '../../../stores/values';
import { onMounted } from 'vue';

export default {
  emits: ['nextStep', 'constant-emitted'],
  data() {
    return {
      characterCount: 0,
      categories: [],
      showSecondSelect: true,
      dropdown: false,
      activeTrigger: false,
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
  methods: {
    updateCharacterCount() {
      // Remove spaces and count characters
      const textWithoutSpaces = this.formData.stepOneProductDescription.replace(/\s/g, '');
      this.characterCount = textWithoutSpaces.length;
    },
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
  },
}
</script>
<style scoped>
  .character-count-badge {
  position: absolute;
  bottom: 8px;
  right: 8px;
  padding: 2px 8px;
  background-color: #f8f9fa;
  border: 1px solid #ced4da;
  border-radius: 4px;
  font-size: 12px;
  line-height: 1;
}
.cat-select{
  cursor: pointer;
}
.div-cat i{
  cursor: pointer;
  position: absolute;
  z-index: 999;
  top: 58%;
  right: 15px;
  font-size: 12px;
}
#dropdown-cats{
    opacity: 0;
    visibility: hidden;
    position: absolute;
    top: 74px;
    left: 0;
    right: 0;
    padding: 0 5px;
    z-index: 999;
    background-color:#fff;
}
#dropdown-cats h2 button{
  padding: 0.6rem 1.25rem;
  background-color: #fff;
}
#dropdown-cats h2 button, .cat-sin-hijo label{
  font-family: 'Inter', sans-serif;
  font-size:14px;
  font-weight: 400;
  color:#1B1F22;
}
.cat-sin-hijo label, #dropdown-cats .accordion-body label{
  font-family: 'Inter', sans-serif;
  width:100%;
  height: auto;
  text-align:left;
  padding: 0.6rem 1.25rem; 
  border-radius:0;
}
#dropdown-cats .accordion-button:focus{
box-shadow: none;
border-color:unset;
background-color:#fff;
}
#dropdown-cats .accordion-button:not(.collapsed){
box-shadow: none;
border-color:unset;
background-color:#728C54;
color: #F9FAFA;
}

#dropdown-cats .btn-check:checked + .btn{
  background-color: #C0C6B9;
  border-color:transparent;
  color:#1B1F22;
}
/*#dropdown-cats .cat-sin-hijo .btn-check:checked + .btn{
  background-color:#728C54;
  color: #F9FAFA;
}*/
#dropdown-cats .accordion-body{
padding:0;
}
#dropdown-cats .accordion-button::after{
    font: var(--fa-font-solid);
    content: '\f078';
    background-image: none;
    line-height: 20px;
    width: 14px;
}
</style>