import lang from "@/views/modules/statelists/language/en";



export default {
    name: "new-example",
   
    components: {
   
    },
    data() {
        return {
            loading: true,
            example: {},
            lang:[],
        }
    },
    mounted() {
        this.lang = lang;
    },
    methods: {
        saveExample() {
            const self = this;
            self.loading = true;
            axios.post('api/modules/statelists', self.example).then(function (response) {
                self.loading = false;
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data saved correctly').toString(),
                    type: 'success'
                });
                self.$router.push('/modules/statelists/' + response.data.example.id + '/edit');
            }).catch(function () {
                self.loading = false;
            });
        },
    }
}