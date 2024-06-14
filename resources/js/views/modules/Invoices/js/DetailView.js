import breadcrumbs from "@/views/modules/Invoices/MenuList.vue";
import lang from "@/views/modules/Invoices/language/en";
import number_word from "@/plugins/number_word.js";
import loader from "@/views/shared/loading/Loading.vue";
export default {
    name: "detail-invoice",
   
    components: {
        breadcrumbs, 
        loader,       
    },
    data() {
        return {
            loading: true,
            deleteProductModal: false,
            invoice: {},
            customer:{},
            productArray:[],
            lang:[],
            invoice_id:"",
            TotalTaxable:0,
            cgstAmt:0,
            sgstAmt:0,
            igstAmt:0,
            gstAmount:0,
            totalRounding:0,
            grandTotal:0,
            grandTotal_W:"",
            totalQty:0,
            payment:{},
            pmtStatus:'#dc3545s',
        }
    },
    mounted() {
        this.getInvoices();
        this.lang = lang;
    },
    methods: {        
        getInvoices() {
            const self = this;
            self.loading = true;
            axios.get('/modules/invoices/' + self.$route.params.id).then(function (response) {
                self.invoice = response.data;
                if(self.invoice.payment_status == 'Received')
                {
                    self.pmtStatus = '#157347';
                }else{
                    self.pmtStatus = '#dc3545';
                }
                localStorage.setItem('PaymentStatus', self.invoice.payment_status);
                self.customer = self.invoice.client_master;
                self.productArray = response.data.invoice_items;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        deleteProduct() {
            const self = this;
            axios.delete('/modules/invoices/' + self.$route.params.id).then(function () {
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data deleted successfully').toString(),
                    type: 'success'
                });
                self.$router.push('/modules/invoices');
            }).catch(function () {
                self.loading = false;
                self.deleteProductModal = false;
            });
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
        startLoader(startLoader){
            const self = this;
            if(startLoader == true)
            {
                self.loading = true;
            }
            else{
                self.loading = false;
            }
        }, 
        UpdatePayment(){            
            this.getInvoices();
        }       
    }
}