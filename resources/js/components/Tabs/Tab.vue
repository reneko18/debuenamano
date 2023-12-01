<template>
    <div class="tab-content" v-show="title == selectedTitle">
        <slot></slot>
    </div>
</template>

<script>
import { inject } from "vue";
export default {
    props: ["title"],
    setup() {
        const selectedTitle = inject("selectedTitle");

        return {
            selectedTitle,
        };
    },
};
</script>

<style scoped>
.tab-content {
    min-height: 271px;
    padding: 20px;
    border-radius: 6px;
    background: #f9fafa;
}
</style>
