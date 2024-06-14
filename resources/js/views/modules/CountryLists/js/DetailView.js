import lang from "@/views/modules/CountryLists/language/en";

export default {
    name: "edit-countrylists",
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
        this.getExample();
        this.lang = lang;
    },
    methods: {
        saveExample() {
            const self = this;
            self.loading = true;
            axios.put('api/modules/countrylists/' + self.$route.params.id, self.example).then(function () {
                self.loading = false;
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data updated correctly').toString(),
                    type: 'success'
                });
            }).catch(function () {
                self.loading = false;
            });
        },
        getExample() {
            const self = this;
            self.loading = true;
            axios.get('api/modules/countrylists/' + self.$route.params.id).then(function (response) {
                self.example = response.data;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        
    }
}