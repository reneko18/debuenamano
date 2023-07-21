import { reactive } from "vue";

export default function useForm(){
    const values = reactive({
        name:'',
    });

    return{
        values,
    }
}