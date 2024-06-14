<template>
    <router-link
    :class="customClass"
    :btntype="btntype"
    :to="to"
    >
    {{label}}
</router-link>
</template>

<script>
export default {
    name: "CancelButton",
    props: {
      /*   mobile: {
            type: Boolean,
            default: false,
        }, */
        to: {
            type: String,
            required: true,
        },
         label: {
            type: String,
            required: true,
        }, 
        btntype: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            customClass:'',
        }
    },
    methods:{
        changeClass(){
            this.getClass();
        },
        getClass(){
            console.log("dsfdsfd");
            if(this.customClass ==''){
                this.customClass='btn btn-danger btn-sm'
            }else{
                this.customClass=''
            }
        }
    }
}
</script>