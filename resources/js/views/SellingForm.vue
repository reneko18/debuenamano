<template>
    <section class="container">
        <step-one v-if="receivedData != 1" @child-data="handleChildData"></step-one>
        <step-two v-if="receivedData == 1"></step-two>
        
    </section>
</template>

<script>
import StepOne from '../components/Steps/StepOne.vue';
import StepTwo from '../components/Steps/StepTwo.vue';
export default { 
    components: {
        StepOne, 
        StepTwo, 
    },   
    data(){
        return {
          receivedData: '',
        }
    },
    methods: {
        handleChildData(data) {
            this.receivedData = data;
        },
    }, 
}
</script>

