<!-- Carousel.vue -->
<template>
    <div class="carousel">
        <div class="slide-container">
            <transition name="fade" mode="out-in">
                <div :key="currentSlide" class="slide-ele">
                    <div class="row">
                        <div class="col-md-8">
                            <img
                                :src="slides[currentSlide - 1].image"
                                alt="Slide Image"
                            />
                        </div>
                        <div class="carousel-info-dbm">
                            <div class="col-md-5">
                                <div class="nav-carousel-dbm text-right">
                                    <button @click="prevSlide">
                                        <font-awesome-icon
                                            :icon="['fa', 'angle-left']"
                                        />
                                    </button>
                                    <button @click="nextSlide">
                                        <font-awesome-icon
                                            :icon="['fa', 'angle-right']"
                                        />
                                    </button>
                                </div>
                                <div class="carousel-caption-dbm text-left">
                                    <h2 class="pr-80">
                                        {{ slides[currentSlide - 1].title }}
                                    </h2>
                                    <p class="pb-3">
                                        {{
                                            slides[currentSlide - 1].description
                                        }}
                                    </p>
                                    <a href="#" class="boton-principal"
                                        >Ver todos los artículos
                                        <font-awesome-icon
                                            :icon="['fas', 'chevron-right']"
                                    /></a>
                                    <div class="contador text-right pt-3">
                                        <span>1/5</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const slides = ref([
    {
        title: "Encuentra artículos de calidad para tu bebé",
        image: "images/slider-home/slide-1.png",
        description:
            "Ofrecemos una amplia selección de artículos de segunda mano para bebés, niños y niñas de hasta 5 años. Estos productos son una excelente opción de calidad a precios asequibles desde juguetes hasta muebles y otros accesorios.",
    },
    {
        title: "Simplifica tu experiencia de compra y venta",
        image: "images/slider-home/slide-2.png",
        description:
            "Nos esforzamos por hacer que comprar y vender artículos en nuestra plataforma sea fácil y conveniente. Con solo unos pocos clics, puedes publicar tus artículos, explorar los productos disponibles y comprar de forma segura. ",
    },
    {
        title: "Artículos verificados y de confianza",
        image: "images/slider-home/slide-3.png",
        description:
            "Entendemos la importancia de la seguridad al comprar artículos para tus hijos. Por eso, verificamos la calidad de los productos antes de ser publicados en nuestra plataforma para que decisión de compra sea informada y confiable.",
    },
    {
        title: "Contribuye al cuidado del medio ambiente",
        image: "images/slider-home/slide-4.png",
        description:
            "Comprar artículos de segunda mano no solo te ayuda a ahorrar, también es una forma consciente de cuidar el medio ambiente al reducir el consumo y el desperdicio promoviendo una mentalidad sostenible.",
    },
    {
        title: "Comunidad de padres, madres y cuidadores",
        image: "images/slider-home/slide-5.png",
        description:
            "Al unirte a nuestra plataforma, te unes a una comunidad que comparte tus mismos intereses y preocupaciones. No solo podrás ofrecer y comprar productos, sino también acceder a contenido valioso en torno a la crianza.",
    },
]);

const totalSlides = slides.value.length;
const currentSlide = ref(1);

const nextSlide = () => {
    currentSlide.value = (currentSlide.value % totalSlides) + 1;
};

const prevSlide = () => {
    currentSlide.value =
        ((currentSlide.value - 2 + totalSlides) % totalSlides) + 1;
};
</script>

<style scoped>
/* Add your styles here */
.carousel {
    text-align: center;
}

.slide-container {
}

.slide-ele {
}

img {
    max-width: 100%;
    height: auto;
}

.carousel-info-dbm {
    position: absolute;
    top: 5%;
    left: 50%;
}
.carousel-caption-dbm {
    background: #f9fafa;
    padding: 100px 80px;
}

button {
    margin: 5px;
}

.nav-carousel-dbm {
    margin-bottom: 10px;
}
.nav-carousel-dbm button {
    background: transparent;
    border-radius: 50%;
    width: 35px;
    height: 35px;
}
.nav-carousel-dbm button:hover {
    background: #728c54;
    color: #fff;
}
</style>
