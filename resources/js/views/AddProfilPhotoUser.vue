<template>
    <div class="modal fade" id="modalImageProfil" tabindex="-1" aria-labelledby="exampleModalLabelCov" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelCov">Agregar una foto de perfil</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body pl-0"> 
                    <div class="panel panel-primary">    
                        <div class="modulo-pasos paso-fotos">
                            <div class="row first-row">
                                <div class="col-lg-7 col-md-12">
                                    <a href="#" class="d-flex">
                                        <svg
                                            version="1.1"
                                            id="down-icon-photo"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            x="0px"
                                            y="0px"
                                            viewBox="0 0 22 17"
                                            xml:space="preserve"
                                        >
                                            <path
                                                class="st0"
                                                d="M20.9,10.9V14c0,0.4-0.2,0.8-0.6,1.1c-0.4,0.3-0.9,0.5-1.5,0.5H3.9c-0.6,0-1.1-0.2-1.5-0.5
                                                        C2,14.8,1.7,14.4,1.7,14v-3.1"
                                            />
                                            <path class="st0" d="M6,7l5.3,3.9L16.7,7" />
                                            <path class="st0" d="M11.3,10.9V1.6" />
                                        </svg>
                                        <span>Tips para tomar buenas fotografías</span>
                                    </a>
                                    <a
                                        href="https://tinypng.com/"
                                        target="_blank"
                                        class="d-flex link-w-img align-items-center"
                                    >
                                        <font-awesome-icon :icon="['fas', 'arrow-right']" />
                                        <span>Sitio web para reducir el peso de tus imágenes</span>
                                    </a>
                                </div>
                            </div>
                            <div class="cont-upload-image">
                                <h2>Fotografías</h2>
                                <div v-bind="getRootProps()" class="dropzone" :class="hasError ? 'error-drop' : ''">
                                    <svg
                                        v-if="!hasError"
                                        version="1.1"
                                        id="icon-upload"
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        x="0px"
                                        y="0px"
                                        viewBox="0 0 29 29"
                                        style="enable-background: new 0 0 29 29"
                                        xml:space="preserve"
                                    >
                                        <path
                                            class="st0"
                                            d="M27.3,18.8v5.6c0,0.7-0.3,1.4-0.8,2c-0.5,0.5-1.2,0.8-2,0.8H5.1c-0.7,0-1.4-0.3-2-0.8c-0.5-0.5-0.8-1.2-0.8-2
                                                        v-5.6"
                                        />
                                        <path class="st0" d="M21.8,9.1l-6.9-6.9L7.9,9.1" />
                                        <path class="st0" d="M14.8,2.2v16.7" />
                                    </svg>
                                    <svg v-else version="1.1" id="icon-error" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 32 29" style="enable-background:new 0 0 32 29;" xml:space="preserve">         
                                        <path class="st0" d="M13.6,3L1.9,22.6c-0.2,0.4-0.4,0.9-0.4,1.4c0,0.5,0.1,1,0.4,1.4c0.2,0.4,0.6,0.8,1,1c0.4,0.2,0.9,0.4,1.4,0.4
                                            h23.4c0.5,0,1-0.1,1.4-0.4c0.4-0.2,0.8-0.6,1-1c0.2-0.4,0.4-0.9,0.4-1.4c0-0.5-0.1-1-0.4-1.4L18.3,3c-0.2-0.4-0.6-0.7-1-1
                                            c-0.4-0.2-0.9-0.4-1.4-0.4S15,1.8,14.6,2.1C14.2,2.3,13.8,2.6,13.6,3z"/>
                                        <path class="st0" d="M15.9,10.1v5.5"/>
                                        <path class="st0" d="M15.9,21.2L15.9,21.2"/>
                                    </svg>
                                    <h3 v-if="isDragActive">Suelta las fotos aquí</h3>
                                    <h3 v-else>Arrastra y suelta tus fotos aquí</h3>
                                    <h4 v-if="!hasError">Archivos soportados JPG, PNG</h4>
                                    <h4>o</h4>
                                    <input v-bind="getInputProps()" />
                                    <button class="btn" @click="openFileInput()">
                                        buscar archivos
                                    </button>
                                    <input
                                        ref="fileInput"
                                        type="file"
                                        style="display: none"
                                        v-bind="getInputProps()"
                                    />
                                    <p v-if="!hasError">Peso máximo 2MB</p>
                                    <p v-else class="error-drop">Sólo se permiten imágenes en formato JPG y/o PNG con un peso máximo de 2MB</p>
                                </div>
                                <div class="cont-images-result" v-if="hasImage">
                                    <span>Archivo</span>
                                    <div class="row-results">
                                        <div class="first">
                                            <img :src="profilImg[0].src" alt="Uploaded Thumbnail" />
                                            <p>{{ profilImg[0].name }}</p>
                                        </div>
                                        <div class="second">
                                            <p>{{ profilImg[0].size }}</p>
                                            <button class="btn" @click="deleteImage(0)">
                                                <font-awesome-icon :icon="['far', 'trash-can']" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>              
                        <a class="btn btn-primary" @click="submitImage()">Adjuntar tu imagen</a>
                    </div> 
                </div>
            </div>
        </div> 
    </div> 
</template>

<script setup>
import { onMounted, ref, computed } from "vue";
import { useDropzone } from "vue3-dropzone";

const props = defineProps({
    userSlug: { 
        type: String, 
        default: "" 
    },
});

const profilImg = ref([]);
const hasError = ref(false);
const isDragActive = ref(false);
const fileInput = ref(null);

const hasImage = computed(() => profilImg.value.length > 0);

const openFileInput = () => {
    if (fileInput.value) {
        fileInput.value.click();
    }
};

function onDrop(acceptedFiles, rejectedFiles) {
    hasError.value = false;

    if (acceptedFiles.length > 0) {
        const file = acceptedFiles[0];
        if (file.size > 2 * 1024 * 1024 || !["image/jpeg", "image/png"].includes(file.type)) {
            hasError.value = true;
        } else {
            const reader = new FileReader();

            reader.onload = () => {
                const image = {
                    src: reader.result,
                    name: file.name,
                    size: `${(file.size / (1024 * 1024)).toFixed(2)} MB`,
                };

                profilImg.value = [image]; 
            };

            reader.readAsDataURL(file);
        }
    }

    console.log("Accepted files:", acceptedFiles);
    console.log("Rejected files:", rejectedFiles);  
    console.log("Error state:", hasError.value);
}

const { getRootProps, getInputProps, ...rest } = useDropzone({
    onDrop,
    onDragEnter: () => (isDragActive.value = true),
    onDragLeave: () => (isDragActive.value = false),
    onDropAccepted: () => (isDragActive.value = false),
    onDropRejected: () => (hasError.value = true),
});

function deleteImage() {
    profilImg.value = []; 
}

const submitImage = async () => {
    try {
        const csrfToken = document.head.querySelector(
            'meta[name="csrf-token"]'
        ).content;
        const response = await axios.post(
            `/api/user/profil-image/${props.userSlug}`,
            { profilImage: profilImg.value },
            {
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            }
        );

        window.location.reload();            
    } catch (error) {
        console.error(error.response.data);
    }
};
</script>

<style scoped>
.paso-fotos .first-row {
    margin-bottom: 2rem;
}
.paso-fotos .first-row a {
    color: #1b1f22;
}
.paso-fotos .first-row a:first-of-type {
    margin-bottom: 0.5rem;
}
.link-w-img .fa-arrow-right {
    width: 100%;
    max-width: 20px;
    margin-right: 1rem;
}
#down-icon-photo {
    width: 100%;
    max-width: 20px;
    margin-right: 1rem;
}
#down-icon-photo .st0 {
    fill: none;
    stroke: #1b1f22;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}
.cont-upload-image {
    background-color: #fff;
    border-radius: 6px;
    padding: 2rem 3rem;
    box-shadow: 0px 2px 4px 0px rgba(10, 13, 8, 0.1);
}
.cont-upload-image h2 {
    font-family: "Quicksand", sans-serif;
    font-size: 14px;
    font-weight: 700;
    line-height: 16px;
}
.cont-upload-image .dropzone {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-items: center;
    padding: 3rem 0;
    border: 1px dashed #c0c6b9;
}
.cont-upload-image .dropzone.error-drop{
    border: 1px dashed #DC3545;
}

#icon-upload, #icon-error {
    width: 25px;
    height: auto;
    margin-bottom: 1rem;
}

#icon-upload .st0 {
    fill: none;
    stroke: #728c54;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-linejoin: round;
}

#icon-error .st0{
    fill: none;
    stroke: #dc3545;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.dropzone {
    margin-bottom: 1rem;
}
.dropzone h3 {
    font-size: 18px;
    font-weight: 700;
    line-height: 16px;
    color: #1b1f22;
}
.dropzone h4 {
    font-family: "Inter", sans-serif;
    font-size: 14px;
    font-weight: 500;
    line-height: 16px;
}
.dropzone p {
    font-family: "Inter", sans-serif;
    font-size: 12px;
    font-weight: 300;
    line-height: 16px;
}

.dropzone p.error-drop{
    color: #DC3545;
    font-weight: 700;
    margin-top:1rem;
}

.dropzone button {
    color: #728c54;
    border: 2px solid #727c54;
    width: 100%;
    max-width: 163px;
    height: 43px;
    font-weight: 700;
    font-size: 15px;
    margin-bottom: 0.5rem;
}
.cont-images-result span {
    font-family: "Inter", sans-serif;
    font-size: 12px;
    font-weight: 400;
    color: #c0c6b9;
}
.cont-images-result .row-results {
    display: flex;
    flex-direction: row;
    margin-bottom: 1rem;
    justify-content: space-between;
}
.cont-images-result .row-results img {
    width: 100%;
    max-width: 80px;
    height: 80px;
    margin-right: 1rem;
    object-fit: cover;
}
.cont-images-result .row-results p {
    margin-bottom: 0;
}
.cont-images-result .row-results .first,
.cont-images-result .row-results .second {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.cont-images-result .row-results .first p {
    font-family: "Inter", sans-serif;
    font-size: 12px;
    font-weight: 400;
    color: #1b1f22;
}
.cont-images-result .row-results .second p {
    font-size: 12px;
    font-weight: 600;
    color: #1b1f22;
    margin-right: 4rem;
}
.cont-images-result .row-results .second .fa-trash-can {
    height: 1.4em;
}
.cont-images-result .row-results .second .fa-trash-can path {
    fill: #728c54;
}
</style>