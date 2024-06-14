<template>
    <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction">
        <span class="more_btn"><i class="fa-solid fa-angle-right"></i></span>
        <button type="button" class="btn btn-secondary btn-sm"  @click="submit('edit')">Edit</button>
        <button type="button" class="btn btn-secondary btn-sm" @click="submit('delete')">Delete</button>
        <button type="button" class="btn btn-secondary btn-sm" @click="OpenAuditModal()">Audit Log</button>
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
        submit(action){
            const self = this;
            let record = self.$route.params.id;
            if(action=='edit'){
                 self.$router.push('/modules/examples/edit/'+record);

            }
            if(action=='delete'){
               const deleteRecord = {'delete_id':record};
               
               axios.post('api/modules/examples/remove', deleteRecord).then(function () {
                   self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data deleted successfully').toString(),
                    type: 'success'
                });
                    self.$router.push(`/modules/examples`);              
               });
            }
            
        },
        OpenAuditModal(){
            const self = this;
            let record = self.$route.params.id;
            window.open('/examples/auditlog/'+record, 'newwindow', 'width=800,height=500,left=250,top=100,');
        }
    },
}
</script>
