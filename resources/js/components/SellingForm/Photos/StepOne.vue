<template>
    <div class="modulo-pasos paso-fotos">
            <div class="row first-row">
                        <div class=" col-lg-7 col-md-12">
                            <h2>Adjunta hasta 5 fotografías del artículo</h2>
                            <p class="bajada-h2">Nosotros definiremos la foto de portada para tu producto, sin embargo, necesitamos hasta 5 fotografías de tu artículo.</p>
                            <a href="#" class="d-flex">
                                <svg version="1.1" id="down-icon-photo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 22 17"  xml:space="preserve">
                                <path class="st0" d="M20.9,10.9V14c0,0.4-0.2,0.8-0.6,1.1c-0.4,0.3-0.9,0.5-1.5,0.5H3.9c-0.6,0-1.1-0.2-1.5-0.5
                                    C2,14.8,1.7,14.4,1.7,14v-3.1"/>
                                <path class="st0" d="M6,7l5.3,3.9L16.7,7"/>
                                <path class="st0" d="M11.3,10.9V1.6"/>
                                </svg>
                                <span>Tips para tomar buenas fotografías</span>
                            </a>
                            <a href="https://tinypng.com/" target="_blank" class="d-flex link-w-img align-items-center">
                                <font-awesome-icon :icon="['fas', 'arrow-right']" />
                                <span>Sitio web para reducir el peso de tus imágenes</span>
                            </a>
                        </div>
            </div>
            <div class="cont-upload-image">             
                        <h2>Fotografías</h2>                               
                        <div v-bind="getRootProps()" class="dropzone">
                            <svg version="1.1" id="icon-upload" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 29 29" style="enable-background:new 0 0 29 29;" xml:space="preserve">
                                <path class="st0" d="M27.3,18.8v5.6c0,0.7-0.3,1.4-0.8,2c-0.5,0.5-1.2,0.8-2,0.8H5.1c-0.7,0-1.4-0.3-2-0.8c-0.5-0.5-0.8-1.2-0.8-2
                                    v-5.6"/>
                                <path class="st0" d="M21.8,9.1l-6.9-6.9L7.9,9.1"/>
                                <path class="st0" d="M14.8,2.2v16.7"/>
                            </svg>
                            <h3 v-if="isDragActive">Suelta las fotos aquí</h3>
                            <h3 v-else>Arrastra y suelta tus fotos aquí</h3>
                            <h4>Archivos soportados JPG, PNG</h4>
                            <h4>o</h4>
                            <input v-bind="getInputProps()" />                                    
                            <button @click="open">buscar archivos</button>
                            <p>Peso máximo 2MB</p>
                        </div>
                        <div class="cont-images-result">
                            <span v-show="uploadedImages != ''">Archivos</span>
                            <div class="row-results" v-for="(image, index) in uploadedImages" :key="index">
                                <div class="first">
                                        <img :src="image.src" alt="Uploaded Thumbnail" />
                                        <p>{{ image.name }}</p>
                                </div>
                                <div class="second">
                                    <p>{{ image.size }}</p>
                                    <button @click="deleteImage(index)">
                                        <font-awesome-icon :icon="['far', 'trash-can']" />
                                    </button>
                                </div>
                            </div>                                       
                        </div>         
            </div>  

            
    </div>
    <div class="d-flex justify-content-end mt-4">
      <button class="btn boton-principal" @click="nextStep">Guardar etapa y continuar <font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
    </div>
</template>
<script>
import { onMounted,ref } from 'vue';
import { useDropzone } from "vue3-dropzone";
export default {
    name: "UseDropzoneDemo",
    setup(_, { emit }) {
    const mainStep = 3;
    onMounted(() => {
      emit('constant-emitted', mainStep); 
    });

    const isDragActive = ref(false); // Add ref for isDragActive
    /*const uploadedImage = ref(null);
    const uploadedImageName = ref(null);
    const uploadedImageSize = ref(null);*/
    const uploadedImages = ref([]);

    function onDrop(acceptedFiles, rejectedFiles) {
        for (const file of acceptedFiles) {
        const image = {
            src: URL.createObjectURL(file),
            name: file.name,
            size: `${(file.size / (1024 * 1024)).toFixed(2)} MB`,
        };
        uploadedImages.value.push(image); // Use .value to modify ref
        }
        console.log(acceptedFiles);
        console.log(rejectedFiles);
    }

    const { getRootProps, getInputProps, ...rest } = useDropzone({ onDrop, onDragEnter: () => (isDragActive.value = true), onDragLeave: () => (isDragActive.value = false), onDropAccepted: () => (isDragActive.value = false) });

    function deleteImage(index) {
      uploadedImages.value.splice(index, 1);
    }

    return {
      isDragActive,
      getRootProps,
      getInputProps,
      uploadedImages,
      deleteImage,
      ...rest,
    };
  },
}
</script>
<style scoped>
.paso-fotos .first-row{
    margin-bottom: 2rem;
}
.paso-fotos .first-row a{
    color: #1B1F22;
}
.paso-fotos .first-row a:first-of-type{
    margin-bottom: .5rem;
}
.link-w-img .fa-arrow-right{
    width: 100%;
    max-width: 20px;
    margin-right: 1rem;
}
#down-icon-photo{
    width: 100%;
    max-width:20px;
    margin-right: 1rem;
}
#down-icon-photo .st0{
    fill:none;
    stroke:#1B1F22;
    stroke-width:2;
    stroke-linecap:round;
    stroke-linejoin:round;
}
.cont-upload-image{
    background-color:#fff;
    border-radius:6px;
    padding: 2rem 3rem;
    box-shadow: 0px 2px 4px 0px rgba(10,13,8,.1);
}
.cont-upload-image h2{
    font-family: 'Quicksand', sans-serif;
    font-size: 14px;
    font-weight: 700;
    line-height:16px;
}
.cont-upload-image .dropzone{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-items: center;
    padding: 3rem 0;
    border: 1px dashed #C0C6B9;
}
#icon-upload{
    width:25px;
    height:auto;
    margin-bottom:1rem;
}
#icon-upload .st0{
    fill:none;
    stroke:#728C54;
    stroke-width:3;
    stroke-linecap:round;
    stroke-linejoin:round;
}
.dropzone{
    margin-bottom:1rem;
}
.dropzone h3{
    font-size:18px;
    font-weight:700;
    line-height: 16px;
    color: #1B1F22;
}
.dropzone h4{
    font-family: 'Inter', sans-serif;
    font-size:14px;
    font-weight:500;
    line-height: 16px;
}
.dropzone p{
    font-family: 'Inter', sans-serif;
    font-size:12px;
    font-weight:300;
    line-height: 16px;
}
.dropzone button{
    color: #728C54;
    border: 2px solid #727C54;
    width: 100%;
    max-width: 163px;
    height: 43px;
    font-weight: 700;
    font-size: 15px;
    margin-bottom: .5rem;
}
.cont-images-result span{
    font-family: 'Inter', sans-serif;
    font-size:12px;
    font-weight:400;
    color: #C0C6B9;
}
.cont-images-result .row-results{
    display: flex;
    flex-direction: row;
    margin-bottom:1rem;
    justify-content: space-between;
}
.cont-images-result .row-results img{
    width:100%;
    max-width:80px;
    height:80px;
    margin-right:1rem;
    object-fit: fill;
}
.cont-images-result .row-results p{
    margin-bottom:0;
}
.cont-images-result .row-results .first, .cont-images-result .row-results .second{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.cont-images-result .row-results .first p{
    font-family: 'Inter', sans-serif;
    font-size:12px;
    font-weight:400;
    color: #1B1F22;
}
.cont-images-result .row-results .second p{
    font-size:12px;
    font-weight:600;
    color:#1B1F22;
    margin-right:4rem;
}
.cont-images-result .row-results .second .fa-trash-can{
    height: 1.4em;
}
.cont-images-result .row-results .second .fa-trash-can path{
    fill:#728C54;
}
</style>
    
    