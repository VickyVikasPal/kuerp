<template>
    <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction">
        <span class="more_btn"><i class="fa-solid fa-angle-right"></i></span>
       <router-link to="/modules/orders/edit" class="btn btn-secondary btn-sm">Edit</router-link>
       <router-link to="" class="btn btn-secondary btn-sm">Delete</router-link>
       <router-link to="" class="btn btn-secondary btn-sm">Copy to invoice</router-link>
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
