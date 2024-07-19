<template>
    <div class="container row p-5">
        <div class="col-6">
            <div class="mb-3">
                <label for="title" class="form-label">Titulo del post</label>
                <input type="text" class="form-control" id="title" v-model="title">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Categoria del post</label>
                <select type="text" class="form-select" id="category" v-model="category">
                    <option disabled selected value="">Seleccione una categoria</option>
                    <option :value="postcategory.id" v-for="postcategory in postscategories">{{ postcategory.name }}</option>
                </select>
            </div>
            <div class="mb-3">
                
                <label for="author" class="form-label">Autor post</label>
                <select type="text" class="form-select" id="author" v-model="author">
                    <option disabled selected value="">Seleccione un  autor</option>
                    <option :value="author.id" v-for="author in authors">{{ author.firstname }} {{ author.lastname }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Contenido del post</label>
                <Editor v-model="editorValue" editorStyle="height: 320px" />
            </div>
            <a class="btn boton-principal" @click="createPost">Crear post</a>
        </div>
        <div class="col-6 admin-img">
            <label for="main-img" class="form-label">Agregar imagen principal del post</label>
            <div class="modulo-pasos paso-fotos">
                <div class="cont-upload-image">
                    <h2>Fotografías</h2>
                    <div v-bind="getRootProps()" class="dropzone">
                        <svg
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
                        <h3 v-if="isDragActive">Suelta las fotos aquí</h3>
                        <h3 v-else>Arrastra y suelta tus fotos aquí</h3>
                        <h4>Archivos soportados JPG, PNG</h4>
                        <h4>o</h4>
                        <input v-bind="getInputProps()" />
                        <button class="btn" @click="openFileInput">
                            buscar archivos
                        </button>
                        <input
                            ref="fileInput"
                            type="file"
                            style="display: none"
                            v-bind="getInputProps()"
                        />
                        <p>Peso máximo 2MB</p>
                    </div>
                    <div class="cont-images-result">
                        <span v-show="mainImg != ''">Archivos</span>
                        <div
                            class="row-results"
                            v-for="(image, index) in mainImg"
                            :key="index"
                        >
                            <div class="first">
                                <img :src="image.src" alt="Uploaded Thumbnail" />
                                <p>{{ image.name }}</p>
                            </div>
                            <div class="second">
                                <p>{{ image.size }}</p>
                                <button class="btn" @click="deleteImage(index)">
                                    <font-awesome-icon :icon="['far', 'trash-can']" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Toast />
</template>
<script setup>
import { ref, onMounted } from 'vue';
import Editor from 'primevue/editor';
import { useToast } from "primevue/usetoast";
import { useDropzone } from "vue3-dropzone";

const toast = useToast();

const postscategories = ref([]);
const authors = ref([]);
const editorValue = ref('');
const title = ref('');
const category = ref('');
const author = ref('');

//Main Photo
const mainImg = ref([]);
const isDragActive = ref(false);
const fileInput = ref(null);

const fetchPostCategories = async () => {
    try {
        const response = await axios.get('/api/postscategories');
        postscategories.value = response.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

const fetchAuthors = async () => {
    try {
        const response = await axios.get('/api/authors');
        authors.value = response.data;
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

//Main Image Methods
const openFileInput = () => {
    if (fileInput.value) {
        fileInput.value.click();
    }
};

function onDrop(acceptedFiles, rejectedFiles) {
    Promise.all(
        acceptedFiles.map((file) => {
            return new Promise((resolve) => {
                const reader = new FileReader();

                reader.onload = () => {
                    const image = {
                        src: reader.result,
                        name: file.name,
                        size: `${(file.size / (1024 * 1024)).toFixed(2)} MB`,
                    };

                    mainImg.value.push(image);
                    resolve();
                };

                reader.readAsDataURL(file);
            });
        })
    ).then(() => {
        console.log("All files processed:",mainImg.value);
    });

    console.log(acceptedFiles);
    console.log(rejectedFiles);
}

const { getRootProps, getInputProps, ...rest } = useDropzone({
    onDrop,
    onDragEnter: () => (isDragActive.value = true),
    onDragLeave: () => (isDragActive.value = false),
    onDropAccepted: () => (isDragActive.value = false),
});

function deleteImage(index) {
    mainImg.value.splice(index, 1);
}


const uploadImage = async (file) => {
  const formData = new FormData();
  formData.append('image', file);
  const response = await axios.post('/api/upload-image', formData, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  });
  return response.data.url;
};


const createPost = async () => {
  try {
    const parser = new DOMParser();
    const doc = parser.parseFromString(editorValue.value, 'text/html');
    const images = doc.querySelectorAll('img');
    const imageUploadPromises = [];

    // Upload images embedded in the editor content
    images.forEach(image => {
      const file = dataURLtoFile(image.src);
      imageUploadPromises.push(uploadImage(file).then(url => {
        image.src = url;
      }));
    });

    await Promise.all(imageUploadPromises);

    const updatedContent = doc.body.innerHTML;

    // Extract main image data
    const mainImage = mainImg.value[0]; // Assuming mainImg is an array with one item
    const mainImageBase64 = mainImage.src; // Assuming src is the base64 data

    const response = await axios.post('/api/posts/store', {
      title: title.value,
      category_id: category.value,
      author_id: author.value,
      content: updatedContent,
      post_category_id: category.value,
      main_img: mainImageBase64,
    });
    toast.add({
        severity: 'success',
        summary: 'Success',
        detail: 'El post ha sido creado con éxito',
        life: 3000,
    });
    console.log("Post created successfully:", response.data);
  } catch (error) {
    console.error("Error creating post:", error);
  }
};

const dataURLtoFile = (dataurl) => {
  const arr = dataurl.split(',');
  const mime = arr[0].match(/:(.*?);/)[1];
  const bstr = atob(arr[1]);
  let n = bstr.length;
  const u8arr = new Uint8Array(n);
  while(n--){
    u8arr[n] = bstr.charCodeAt(n);
  }
  return new File([u8arr], 'image.png', {type:mime});
};

onMounted(() => {
    fetchPostCategories();
    fetchAuthors();
});
</script>

<style scoped>
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
#icon-upload {
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