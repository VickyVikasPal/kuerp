<template>
    <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction">
        <span class="more_btn"><i class="fa-solid fa-angle-right"></i></span>
       <router-link :to="`/modules/quotations/edit/${record}`" class="btn btn-secondary btn-sm"  v-if="record_status">Edit</router-link>
       <router-link to="" class="btn btn-secondary btn-sm">Delete</router-link>
       <router-link to="" class="btn btn-secondary btn-sm" @click="moveToDelivery(record)">Copy to Delivery challan</router-link>
    </div>
</template>
<script>

export default {
    name:"more-btn",
    data(){
        return{
             isActive:false,
             record_status:true,
        }
    },
props:{
        record:{
            type:String
        },
    },
    methods: {
        openAction() {
            this.isActive = !this.isActive;
        },
        moveToDelivery(record = ''){
            const self = this;
            let isMove = confirm("Are You Sure To Move Quotation To Delivery");
            if(isMove == true)
            {
            self.$emit('event', true);
               axios.post('modules/move_to_delivery', {'qtn_id':record}).then(function(response){
               self.$emit('event', false);
                self.$router.push('/modules/deliverychallans/'+response.data.delivery_id+'/detail');
               });

            }
            else{
                console.log("Stay in quotations");
            }
        },
    },
}
</script>
