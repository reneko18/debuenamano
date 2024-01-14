<template>
    <div class="tabs">
        <ul class="tabs__header">
            <li
                v-for="(title, index) in tabTitles"
                :key="title"
                :class="{ selected: title === selectedTitle }"
                @click="selectedTitle = title"
            >
                <i :class="tabTitlesIcon[index]"></i>
                {{ title }}
            </li>
        </ul>
        <slot></slot>
    </div>
</template>

<script>
import { ref, provide } from "vue";
export default {
    setup(props, { slots }) {
        const tabs = slots.default();
        const tabTitles = ref(tabs.map((tab) => tab.props.title));
        const tabTitlesIcon = ref(tabs.map((tab) => tab.props.icon));

        // const tabTitles = ref(slots.default().map((tab) => tab.props.title));
        // const tabTitlesIcon = ref(slots.default().map((tab) => tab.props.icon));
        const selectedTitle = ref(tabTitles.value[0]);

        provide("selectedTitle", selectedTitle);
        return {
            selectedTitle,
            tabTitles,
            tabTitlesIcon,
            tabs,
        };
    },
};
</script>

<style scoped>
.tabs__header {
    display: flex;
    list-style: none;
    padding: 0;
    margin-bottom: 0;
    margin-left: 12vw;
}
.tabs__header li {
    font-size: 13px;
    background-color: #c0c6b9;
    color: #fff;
    width: 113px;
    text-align: center;
    padding: 14px 0px;
    margin-right: 10px;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    cursor: pointer;
    transition: 0.4s all ease-out;
}
.tabs__header li.selected {
    background-color: #344026;
    color: #fff;
}
</style>
