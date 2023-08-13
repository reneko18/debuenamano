<template>
    <div class="modulo-pasos">
            <div class="row">
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
                            <a href="#" class="d-flex link-w-img">
                                <font-awesome-icon :icon="['fas', 'arrow-right']" />
                                <span>Sitio web para reducir el peso de tus imágenes</span>
                            </a>
                        </div>
            </div>
            <div class="row">
                        <div class="col-lg-5 col-md-12">
                            <div>
                                <h2>Fotografías</h2>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                           
                        </div>
            </div>   
            <button class="btn boton-principal">Continuar <font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
    </div>
    </template>
    <script>
    export default {
        setup() {
            
        },
    }
    </script>
    <style>
        .link-w-img .fa-arrow-right{
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
    </style>
    
    