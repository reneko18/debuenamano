<template>
    <div class="vueGallery">
        <div class="activePhoto" :style="{backgroundImage: `url(${'/' + photos[activePhoto].url})`}">
        <button type="button" aria-label="Previous Photo" class="previous" @click="previousPhoto">
            <i class="fas fa-chevron-circle-left"></i>
        </button>
        <button type="button" aria-label="Next Photo" class="next" @click="nextPhoto">
            <i class="fas fa-chevron-circle-right"></i>
        </button>
        </div>
        <div class="thumbnails">
        <div
            v-for="(photo, index) in photos"
            :key="index"
            @click="changePhoto(index)"
            :class="{'active': activePhoto === index}" 
            :style="{backgroundImage: `url(${'/' + photo.url})`}">     
        </div>
        </div>
    </div>
</template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const props = defineProps({
    photos: {
      type: Array,
      required: true
    }
  });
  
  const activePhoto = ref(0);
  
  const changePhoto = (index) => {
    activePhoto.value = index;
  };
  
  const nextPhoto = () => {
    changePhoto(activePhoto.value + 1 < props.photos.length ? activePhoto.value + 1 : 0);
  };
  
  const previousPhoto = () => {
    changePhoto(activePhoto.value - 1 >= 0 ? activePhoto.value - 1 : props.photos.length - 1);
  };
  
  onMounted(() => {
    changePhoto(0);
    document.addEventListener('keydown', (event) => {
      if (event.which === 37) previousPhoto();
      if (event.which === 39) nextPhoto();
    });
  });
  </script>
  
<style scoped>
    .vueGallery .activePhoto {
    width: 80%;
    margin-bottom: 5px;
    padding-bottom: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border: 2px solid #fff;
    position: relative;
    }

    .vueGallery .activePhoto button {
    border: none;
    background-color: transparent;
    font-size: 32px;
    color: #fff;
    opacity: 0.5;
    position: absolute;
    outline: none;
    height: 100%;
    }

    .vueGallery .activePhoto button:hover {
    opacity: 1;
    }

    .vueGallery .activePhoto button.previous {
    padding: 0 1em 0 0.7em;
    left: 0;
    background: -moz-linear-gradient(left, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%);
    background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%);
    background: linear-gradient(to right, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
    }

    .vueGallery .activePhoto button.next {
    padding: 0 0.7em 0 1em;
    right: 0;
    background: -moz-linear-gradient(left, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.5) 100%);
    background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.5) 100%);
    background: linear-gradient(to right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.5) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
    }

    .vueGallery .thumbnails {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    grid-gap: 5px;
    }

    .vueGallery .thumbnails div {
    width: 100%;
    border: 2px solid #fff;
    outline: 2px solid #fff;
    cursor: pointer;
    padding-bottom: 65%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 1;
    }

    .vueGallery .thumbnails div:hover {
    opacity: 0.6;
    }

    .vueGallery .thumbnails div.active {
    outline-color: #000; /* Replace with your brand color */
    opacity: 1;
    }
</style>
  