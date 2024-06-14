<template>
    <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction">
        <span class="more_btn"><i class="fa-solid fa-angle-right"></i></span>
       <!-- <button>Default Button</button>!-->
    </div>
</template>
<script>
export default {
    name:"more-btn",
    data(){
        return{
             isActive:false,
        }
    },

    methods: {
        openAction() {
            this.isActive = !this.isActive;
        },
    },
}
</script>
