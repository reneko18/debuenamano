<template>
  <div class="tabs">
    <ul class="tabs__header">
        <li
        v-for="title in tabTitles"
        :key="title"
        :class="{ selected: title == selectedTitle }"
        @click="selectedTitle = title"
        >
        {{ title }}
        </li>
    </ul>
    <slot></slot>
  </div>
</template>

<script>
  import { ref, provide } from 'vue'
  export default {
    setup(props,{ slots }){
        const tabTitles = ref(slots.default().map((tab) => tab.props.title))
        const selectedTitle = ref(tabTitles.value[0])

        provide('selectedTitle', selectedTitle)
        return{
            selectedTitle,
            tabTitles
        }
    }
  }
</script>

<style scoped>
    .tabs__header{
        display: flex;
        list-style: none;
        padding:0;
        margin-bottom: 0;
        margin-left: 12vw;
        
    }
    .tabs__header li{
        font-size: 13px;
        background-color: #AAC0E4;
        color: #fff;
        width: 113px;
        text-align: center;
        padding: 14px 0px;
        margin-right:10px;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        cursor: pointer;
        transition: .4s all ease-out;
    }
    .tabs__header li.selected{
        background-color: #335C9E;
        color: #fff;
    }
</style>
