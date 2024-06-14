<template>
    <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction">
        <span class="more_btn"><i class="fa-solid fa-angle-right"></i></span>
       <router-link :to="'/modules/deliverychallans/edit/'+this.$route.params.id" class="btn btn-secondary btn-sm">Edit</router-link>
       <router-link to="" class="btn btn-secondary btn-sm">Delete</router-link>
       <button @click="copyToInvoice()" class="btn btn-secondary btn-sm">Copy to invoice</button>
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
        copyToInvoice(){
            if (window.confirm("Are you sure you want to proceed?")) {
                // User clicked OK, take action here
                this.createInvoice();
            } else {
                // User clicked Cancel or closed the dialog
            }
        },
        createInvoice(){
            const self = this;
            let deliverys = {'delivery_id':this.$route.params.id};
            axios.post('modules/invoices/deliverytoinvoice',deliverys).then(function(response){
                if(response.data.message !=''){
                    self.$router.push('/modules/invoices/'+response.data.Invoice_id+'/detail');
                }
            }).catch(function(response){

            });
        }
    },
}
</script>
