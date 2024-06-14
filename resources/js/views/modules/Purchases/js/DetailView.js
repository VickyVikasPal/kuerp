import breadcrumbs from "@/views/modules/Purchases/MenuList.vue";
import lang from "@/views/modules/Purchases/language/en";
import number_word from "@/plugins/number_word.js";
export default {
    name: "detail-purchases",
   
    components: {
        breadcrumbs,
        
    },
    data() {
        return {
            loading: true,
            product:{},
            dropdownList:[], 
            showDropdown1:false,
            showDropdown2:false,
            lang:[],
            productArray:[],
            purchase_id:"",
            TotalTaxable:0,
            cgstAmt:0,
            sgstAmt:0,
            igstAmt:0,
            gstAmount:0,
            totalRounding:0,
            grandTotal:0,
            grandTotal_W:"",
            totalQty:0,
        }
    },
    mounted() {
        this.getProduct();
        this.lang = lang;
    },
    methods: {
       
        getProduct() {
            const self = this;
            self.loading = true;
            axios.get('modules/purchases/' + self.$route.params.id).then(function (response) {
                self.product = response.data;
                localStorage.setItem('purchase_status', self.product.status);
                self.getItem(self.product.id);
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        deleteProduct() {
            const self = this;
            axios.delete('modules/purchases/' + self.$route.params.id).then(function () {
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data deleted successfully').toString(),
                    type: 'success'
                });
                self.$router.push('/modules/purchases');
            }).catch(function () {
                self.loading = false;
                self.deleteProductModal = false;
            });
        },
        getItem(purchase_id){
            const self = this;
            axios.get('modules/getpurchase_items', {params:{'purchase_id':purchase_id}}).then(function(response){
                // console.log(response);
                 self.purchase_id = response.data.purchase_id;
                 self.productArray=response.data.item_data;
                        
             })
        },
        getRate(tax=0){
            if(tax > 0)
            {
                this.getTaxable();
                return parseInt(tax)/2;
            }
        },
        getTaxable(){
            const self = this;
            let total_taxable = 0;
            let total_cgst = 0;
            let total_sgst = 0;
            let total_igst = 0;
            let total_gst = 0;
            let total_rounding = 0;
            let grand_total = 0;
            let total_Qty = 0;
           
            for(let i = 0; i < self.productArray.length; i++)
            {
                total_taxable += self.productArray[i].taxable_value;
                total_cgst += self.productArray[i].cgst;
                total_sgst += self.productArray[i].sgst;
                total_igst += self.productArray[i].igst;
                total_Qty += parseInt(self.productArray[i].qty);
                grand_total += self.productArray[i].total_amount;
            }
            self.TotalTaxable = parseFloat(total_taxable).toFixed(2);
            self.cgstAmt = parseFloat(total_cgst).toFixed(2);
            self.sgstAmt = parseFloat(total_sgst).toFixed(2);
            self.igstAmt = parseFloat(total_igst).toFixed(2);

            self.gstAmount = parseFloat(parseFloat(self.cgstAmt)+parseFloat(self.sgstAmt)+parseFloat(self.igstAmt)).toFixed(2);

            self.grandTotal = parseFloat(grand_total).toFixed(2);
            let numberWord = new number_word(self.grandTotal);
           self.grandTotal_W = numberWord.number2text(self.grandTotal);  
           self.totalQty = total_Qty;        
        },
    }
}