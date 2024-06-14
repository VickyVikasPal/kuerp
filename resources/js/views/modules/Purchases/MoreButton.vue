<template>
    <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction">
        <span class="more_btn"><i class="fa-solid fa-angle-right"></i></span>
       <router-link :to="`/modules/purchases/edit/${record}`" class="btn btn-secondary btn-sm"  v-if="record_status">Edit</router-link>
       <a href="javascript:void(0)" class="btn btn-secondary btn-sm" @click="updateInventory(record)" v-if="record_status">Post</a>
       <router-link to="" class="btn btn-secondary btn-sm"  v-if="record_status">Delete</router-link>
    </div>
</template>
<script>
export default {
    name:"more-btn",
    props:{
        record:{
            type:String
        },
    },
    data(){
        return{
             isActive:false,
             record_status:false,
        }
    },
 mounted() {
        this.getStatus();           
    },
    methods: {
        openAction() {
            this.isActive = !this.isActive;
            this.getStatus();
        },
        getStatus(){
            const self = this;
            
            let status = localStorage.getItem('purchase_status');
            if(status == "Processed"){
                self.record_status = true;
            }else{
                self.record_status = false;
            }
        },
        updateInventory(record){
            const self = this;
            self.$parent.updateInventory(record);
        }
    },
}
</script>
