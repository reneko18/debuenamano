<template>
    <div class="container mx-auto">
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
                    id="oder-blog"
                    class="form-select"
                    aria-label="Default select example"
                >
                    <option value="">Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row row-post-loop container mx-auto">
        <div class="col col-post" v-for="post in posts">
            <div class="card">
                <div class="card-header">
                    <a :href="'/entradas/' + post.slug" class="link-post-archive">
                        <img :src="post.main_img" class="card-img" alt="" />
                    </a>
                </div>
                <div class="card-body">
                    <div class="meta-content">
                        <div class="author">
                            <!--<img :src="post.author.authorimage.url" alt="">-->
                            <span
                                >{{ post.author.firstname }}
                                {{ post.author.lastname }}</span
                            >
                        </div>
                        <span class="date">{{ formatDate(post.date) }}</span>
                    </div>
                    <a :href="'/entradas/' + post.slug" class="link-post-archive"> 
                        <h2 class="card-title">{{ post.title }}</h2>
                    </a>
                    <p>{{ truncatedContent(post.content) }}</p>

                    <span class="cat-meta" v-for="cats in post.postcategories">
                        {{ cats.name }}
                    </span>
                </div>
            </div>
        </div>
        <template>
            <Bootstrap5Pagination
                :data="posts"
                @pagination-change-page="loadPosts"
            />
        </template>
    </div>
</template>
<script>
import moment from "moment";
import "moment/locale/es";

export default {
    data: function () {
        return {
            posts: [],
            postscats: [],
            authors: [],
            selected: {
                authors: [],
                postcategories: [],
            },
        };
    },
    mounted() {
        this.loadPosts();
        this.loadPostsCats();
        this.loadAuthors();
    },
    watch: {
        selected: {
            handler: function () {
                this.loadPosts();
                this.loadPostsCats();
                this.loadAuthors();
            },
            deep: true,
        },
    },
    methods: {
        loadPosts: function (page = 1) {
            axios
                .get('/api/posts?page=' + page, {
                    params: this.selected,
                })
                .then((response) => {
                    this.posts = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        loadPostsCats() {
            axios
                .get("/api/postscategories", {
                    params: _.omit(this.selected, "postcategories"),
                })
                .then((response) => {
                    this.postscats = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        loadAuthors() {
            axios
                .get("/api/authors", {
                    params: _.omit(this.selected, "authors"),
                })
                .then((response) => {
                    this.authors = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        truncatedContent(content) {
            const maxLength = 200;
            if (content.length <= maxLength) {
                return content;
            } else {
                return content.slice(0, maxLength - 3) + "...";
            }
        },
        formatDate(date) {
            moment.locale("es");
            return moment(date).format("D [de] MMMM YYYY");
        },
    },
};
</script>

<style scoped>
.col-post {
    flex: 0 1 calc(33.33333% - 9px);
}
</style>
