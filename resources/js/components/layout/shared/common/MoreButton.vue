<template>
    <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction">
        <span class="more_btn"><i class="fa-solid fa-angle-right"></i></span>        
            <button 
            v-for="(btn, index) in moreBtn" 
                type="button"
                :action="btn.id"
                class="btn btn-secondary btn-sm"
                @click="submit(record,`${btn.action}`,`${btn.path}`)" 
                v-bind:key="index"
            >{{btn.label}}</button>         
    </div>
    
</template>
<script>
export default {
    name:'moreButton',    
    data(){
        return{
             isActive:false,
             moreBtn:[],
             record:"",
        }
    },
    methods: {
        submit(record,action,path){
            const self = this;
            if(action=='edit'){
                 self.$router.push('/modules/'+path+'/edit/'+record);
            }
            else if(action=='delete'){
               // console.log(`${record}/${action}/${path}`);
               const deleteRecord = {'delete_id':record};
               
               axios.post('/modules/'+path+'/remove', deleteRecord).then(function () {
                   
                    self.$router.push(`/modules/${path}`);              
               });
            }
            else{
                console.warn("action not defined!....");
            }
            
        },
        openAction() {
            this.isActive = !this.isActive;
        },
        loadGenericBtn(btnlist){
            const self = this;
            self.moreBtn = btnlist;
            self.record = self.$route.params.id;
            //console.log(self.record);
        }
    }
}
</script>