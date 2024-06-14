 import lang from "@/views/modules/Administration/language/en";
import breadcrumbs from "@/views/modules/Administration/MenuList.vue";
//import alert from "@/views/shared/notify/Alert.vue";

export default {
    name: "unique",
    
    components: {
        breadcrumbs,
        //alert,
    },
    data() {
        return {
            lang:[],
            defaultpath:null,
            page: 1,
            search: '',
            sort: {
                order: 'asc',
                column: 'date_entered',
            },
            perPage: 10,
            listData:[],
            pagination: {
                currentPage: 0,
                perPage: 0,
                total: 0,
                totalPages: 0
            },
            sequences:{
                id:null,
                name:null,
                sequence_type:null,
                period:null,
                seq_no:null,
                field_name:null,
                prefix:null,
                date_field:null,
                branch_id:null
            },
            branch_list:[]
        }
     },
    mounted() {
        this.lang = lang;
        this.loadSequence();
        this.loadBranch();
    },
    methods: {
        changePage(page) {
            const self = this;
            if ((page > 0) && (page <= self.pagination.totalPages) && (page !== self.page)) {
                self.page = page;
                self.loadSequence();
            }
        },
        changeSort() {
            const self = this;
            if (self.sort.order === 'asc') {
                self.sort.order = 'desc';
            } else if (self.sort.order === 'desc') {
                self.sort.order = 'asc';
            }
            self.loadSequence();
        },
        loadSequence(){
            const self = this;
            let branch_id = null;
            branch_id = self.sequences.branch_id;
            
            axios.get('modules/sequences', {
                params: {
                    page: self.page,
                    sort: self.sort,
                    search: branch_id,
                    perPage: self.perPage,
                }
            }).then(function (response) {
                self.listData = response.data.items;
               // console.log(self.productList);
                self.pagination = response.data.pagination;
                if (self.pagination.totalPages < self.pagination.currentPage) {
                    self.page = self.pagination.totalPages;
                    self.loadSequence();
                } else {
                    console.log("error");
                }
            }).catch(function () {
                console.log("error");
            });
        },
        loadBranch(){
            //branch_list
            const self = this;
            axios.post('modules/branchs/getBranch',{'getBranch':true}).then(function(response){
                self.branch_list = response.data;
                
            }).catch(function(){
                console.log();
            })
        },
        saveSequence(){
            const self = this;
            if(self.sequences.id == null && self.sequences.name != null && self.sequences.sequence_type != null && self.sequences.period != null &&self.sequences.seq_no != null &&self.sequences.field_name != null &&self.sequences.date_field != null){
            axios.post('modules/sequences/saveSequence', self.sequences).then(function(response){
                //console.log(response);
               
                self.sequences.id = null;
                self.sequences.name = null;
                self.sequences.sequence_type = null;
                self.sequences.period = null;
                self.sequences.seq_no = null;
                self.sequences.field_name = null;
                self.sequences.prefix = null;
                self.sequences.date_field = null;
                self.loadSequence();
            }).catch(function () {
                console.log("Error in form submition");
            });
        }else if(self.sequences.id != null){
            axios.post('modules/sequences/updateSequence', self.sequences).then(function(response){
                //console.log(response);
               
                self.sequences.id = null;
                self.sequences.name = null;
                self.sequences.sequence_type = null;
                self.sequences.period = null;
                self.sequences.seq_no = null;
                self.sequences.field_name = null;
                self.sequences.prefix = null;
                self.sequences.date_field = null;
                self.loadSequence();
            }).catch(function () {
                console.log("Error in form submition");
            });
        }else{
            console.log("Error in form submition");
        }
        },
        editSequence(record){
            const self = this;
            axios.post('modules/sequences/getSequence', {'record':record}).then(function(response){
                self.sequences.id = response.data.id;
                self.sequences.name = response.data.name,
                self.sequences.sequence_type = response.data.sequence_type,
                self.sequences.period = response.data.period,
                self.sequences.seq_no = response.data.seq_no,
                self.sequences.field_name = response.data.field_name,
                self.sequences.prefix = response.data.prefix,
                self.sequences.date_field = response.data.date_field
            });
        },
        removeSequence(record){
            const self = this;
            axios.post('modules/sequences/remove', {'delete_id':record}).then(function(response){
                self.loadSequence();
            }).catch(function(){
                console.log('Error in remove function');
            })
        },
        clear(){
                const self = this;
                self.$refs.sequenceForm.reset(); // This will clear that form
                self.sequences.id = null;
                self.sequences.name = null;
                self.sequences.sequence_type = null;
                self.sequences.period = null;
                self.sequences.seq_no = null;
                self.sequences.field_name = null;
                self.sequences.prefix = null;
                self.sequences.date_field = null;
        }
    },
}