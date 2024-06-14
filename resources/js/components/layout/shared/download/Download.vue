<template>
    <div class="dropdown d-inline-block btn-download">
        <button type="button" class="button" data-bs-toggle="dropdown">
            <i class="fa-solid fa-download"></i>
        </button>
        <ul class="dropdown-menu">
            <li v-for="(items,index) in dataList" :key="index"><a href="#" @click="openPdf(items.action)">{{items.label}}</a></li>
        </ul>
    </div>
</template>
<script>
    export default {
        name: "doemload-pdf",

        data() {
            return {
                dataList: [],
                record:null,
            }
        },
        mounted() {

        },
        methods: {
            loadDownloadView(downloadlist) {
                const self = this;
               let item = JSON.parse(JSON.stringify(downloadlist));
               
                self.dataList = item;
            },
            openPdf(action){
                const self = this;
                self.record = self.$route.params.id;
               // window.open(action+'/'+self.record, 'newwindow', 'width=800,height=500,left=250,top=100,');
               window.open(action+'/'+self.record);
            }
        }
    }
</script>