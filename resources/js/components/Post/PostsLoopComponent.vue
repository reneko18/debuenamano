<template>
    <div class="container mx-auto"> 
        <div>
            <p>{{ currentPageResults }} de {{ totalResults }} resultados</p>
        </div>
        <div class="row">
            <div class="col">
                <label for="cat-blog" class="mb-3">Categoría</label>
                <select
                    id="cat-blog"
                    class="form-select"
                    aria-label="Default select example"
                    v-model="selected.postcategories"
                >
                    <option :value="[]">Todas las categorias</option>
                    <option :value="pcat.id" v-for="pcat in postscats">
                        {{ pcat.name }}
                    </option>
                </select>
            </div>
            <div class="col">
                <label for="aut-blog" class="mb-3">Autores</label>
                <select
                    id="aut-blog"
                    class="form-select"
                    v-model="selected.authors"
                >
                    <option :value="[]">Todos los autores</option>
                    <option :value="aut.id" v-for="aut in authors">
                        {{ aut.firstname }} {{ aut.lastname }}
                    </option>
                </select>
            </div>
            <div class="col">
                <label for="order-blog" class="mb-3">Ordenar por</label>
                <select
                    id="order-blog"
                    class="form-select"
                    v-model="selected.order"
                >
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row row-post-loop container mx-auto" id="blog">
        <div class="col col-post" v-for="post in posts.data">
            <div class="card">
                <div class="card-header-blog">
                    <a :href="'/entradas/' + post.slug" class="link-post-archive">
                        <img :src="post.main_img" class="card-img-blog" alt="" />
                    </a>
                </div>
                <div class="card-body">
                    <div class="meta-content d-flex justify-content-between">
                        <div class="author">
                            <!-- disponer enlace hacia archive según autor -->
                            <!--<img :src="post.author.authorimage.url" alt="">-->
                            <span
                                >{{ post.author.firstname }}
                                {{ post.author.lastname }}</span
                            >
                        </div>
                        <span class="date">{{ formatDate(post.created_at) }}</span>
                    </div>
                    <a :href="'/entradas/' + post.slug" class="link-post-archive"> 
                        <h2 class="card-title">{{ post.title }}</h2>
                    </a>
                    <p>{{ truncatedContent(post.content) }}</p>

                    <!-- disponer enlace hacia archive según nombre de categoría -->
                    <span class="cat-meta" v-for="cats in post.postcategories">
                        {{ cats.name }}
                    </span>
                </div>
            </div>
        </div>
            <Bootstrap5Pagination
                :data="posts"   
                @pagination-change-page="loadPosts"
            />
    </div>
</template>
<script setup>
import { ref, reactive, onMounted, watch } from 'vue';
import axios from 'axios';
import { format } from 'date-fns';
import { es } from 'date-fns/locale';

// State
const posts = ref([]);
const postscats = ref([]);
const authors = ref([]);
const selected = reactive({
  authors: [],
  postcategories: [],
  order: 'desc', // Default order
});

// Data results
const currentPageResults = ref(""); 
const totalResults = ref(null); 

// Methods
const loadPosts = async (page = 1) => {
  try {
    const response = await axios.get('/api/posts?page=' + page, {
      params: selected,
    });
    posts.value = response.data;
    if(response.data.to === null){
        currentPageResults.value = 0
    } else {
        currentPageResults.value = response.data.to;
    }    
    if (totalResults.value === null) {
      totalResults.value = response.data.total;
    }
  } catch (error) {
    console.log(error);
  }
};

const loadPostsCats = async () => {
  try {
    const response = await axios.get('/api/postscategories', {
      params: _.omit(selected, 'postcategories'),
    });
    postscats.value = response.data;
  } catch (error) {
    console.log(error);
  }
};

const loadAuthors = async () => {
  try {
    const response = await axios.get('/api/authors', {
      params: _.omit(selected, 'authors'),
    });
    authors.value = response.data;
  } catch (error) {
    console.log(error);
  }
};

const truncatedContent = (content) => {
  const maxLength = 200;

  // Function to strip HTML tags using a regular expression
  const stripHtmlTags = (html) => {
    return html.replace(/<\/?[^>]+(>|$)/g, "");
  };

  // Strip HTML tags
  const plainTextContent = stripHtmlTags(content);

  // Truncate the plain text content
  return plainTextContent.length <= maxLength ? plainTextContent : plainTextContent.slice(0, maxLength - 3) + '...';
};


const formatDate = (date) => {
  return format(new Date(date), "d 'de' MMMM yyyy", { locale: es });
};

// Lifecycle hooks
onMounted(() => {
  loadPosts();
  loadPostsCats();
  loadAuthors();
});

// Watchers
watch(
  () => selected,
  () => {
    loadPosts();
    loadPostsCats();
    loadAuthors();
  },
  { deep: true }
);
</script>

<style scoped>
.col-post {
    flex: 0 1 calc(33.33333% - 9px);
}
</style>
