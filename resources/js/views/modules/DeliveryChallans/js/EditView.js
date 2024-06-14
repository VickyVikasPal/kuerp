import breadcrumbs from "@/views/modules/DeliveryChallans/MenuList.vue";
import lang from "@/views/modules/DeliveryChallans/language/en";3
import number_word from "@/plugins/number_word.js";

export default {
    name: "edit-delivery",
    components: {
        breadcrumbs,
    },
    data() {
        return {
            loading: true,
            delivery:{
                client_id:'',
                client_type:'',
                client_name:'',
            },
            dropdownList:[], 
            showDropdown1:false,
            showDropdown2:false,
            lang:[],
            productArray:[],
            delivery_id:"",
            TotalTaxable:0,
            cgstAmt:0,
            sgstAmt:0,
            igstAmt:0,
            gstAmount:0,
            totalRounding:0,
            grandTotal:0,
            grandTotal_W:"",
            totalQty:0,
            qtn:{},
            error_qty:false,
            erro_qty_msg:'',
        }
    },
    mounted() {
        
        this.getProducts();
        this.lang = lang;
    },
    methods: {
        saveProduct() {
            const self = this;
            self.loading = true;
            axios.post('/modules/deliverychallans', self.product).then(function (response) {
                self.loading = false;
                self.$notify({
                    title: self.$i18n.t('Success').toString(),
                    text: self.$i18n.t('Data saved correctly').toString(),
                    type: 'success'
                });
                self.$router.push('/modules/deliverychallans/' + response.data.product.id + '/edit');
            }).catch(function () {
                self.loading = false;
            });
        },
        getProducts() {
            const self = this;
            self.loading = false;
           console.log('dsafdasfdsa');
           axios.get('/modules/deliverychallans/'+self.$route.params.id).then(function(response){
              
              //self.qtn = response.data.client_master;
              self.getCustomer(response.data.client_master.id);
              self.delivery.client_id = response.data.client_master.id;
              self.delivery.client_type = 'clientmasters';
              self.delivery.client_name = response.data.client_master.name;
              self.productArray = response.data.delivery_items;
              
              self.clearComponent('product');
                document.getElementById("discount").value=0;
                document.getElementById("product_qty").value=0;

           })
        },
        getCustomer(customer_id)
        {
            const self = this;
            axios.get('modules/get_customer',{params:{'customer_id':customer_id}}).then(function(response){
                self.qtn = response.data.client;
            })
        },

        //add product in table
        addProduct(){
            const self = this;
            self.error_qty =false;
            self.erro_qty_msg = '';
            let product_id = document.getElementById("product_parent_id").value;
            let client_id = self.delivery.client_id;
            let delivery_id = self.$route.params.id;
           
            let discount = document.getElementById('discount').value;
            let product_qty = document.getElementById('product_qty').value;
           
            let purchase_obj = {'delivery_id':delivery_id, 'product_id':product_id, 'client_id':client_id, 'discount':discount, 'product_qty':product_qty}
        
            //purchase_id
            axios.post('modules/deliverychallans/updateitem', purchase_obj).then(function(response){
                if(response.data.message == 'success'){
                    self.getProducts();
                }else{
                    self.error_qty =true;
                    self.erro_qty_msg = response.data.error_message;
                }                                     
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
        
        openComponent(routeName, moduleName,queryData = null) {

            this.windowRef = window.open(`/popup?module=${routeName}&body=modal&callback=parentMethod&moduleName=${moduleName}`, "", "width=600,height=400,left=200,top=200");
            this.parentCompnent = routeName;
            this.windowRef.addEventListener('beforeunload', this.parentMethod);

        },
        parentMethod() {
            const module_name = this.parentCompnent.slice(0, -1);
            const parent_id = localStorage.getItem('parentid');
            const parent_name = localStorage.getItem('parentname');
            const parent_type = localStorage.getItem('parenttype');

            this.selectElement(module_name, parent_name, parent_id, parent_type);

            if (this.windowRef) {
                this.windowRef.close();
                this.windowRef = null;
                this.$emit('close');
            }

            localStorage.removeItem('parentid');
            localStorage.removeItem('parentname');
            localStorage.removeItem('parenttype');

        },

        queryForKeywords(e, modulesLink) {
            const self = this;
            let searchData = e.target.value;
            let relatedModule = modulesLink + 's';
            self.showDropdown1 = false;
            self.showDropdown2 = false;
            if (searchData.length > 1) {
                axios.post(`modules/searchItem`, { 'data': searchData, 'relatedModule': relatedModule }).then(function (response) {
                    self.dropdownList = response.data;
                    if(modulesLink == 'product'){
                        self.showDropdown2 = true;
                    }
                    if(modulesLink == 'vendormaster'){
                        self.showDropdown1 = true; 
                    }
                   
                });
            } else {
                self.showDropdown = false;
                self.dropdownList = [];

                if (searchData.length == 0) {
                    self.selectElement(modulesLink, '', '', '');
                }

            }
        },

        updateItem(id, name, type) {
            this.showDropdown1 = false;
            this.showDropdown2 = false;
            const module_name = type;
            this.selectElement(module_name, name, id, type);
        },
        clearComponent(modulesLink) {
            const self = this;
            self.dropdownList = [];
            if (self.dropdownList.length == 0) {
                
                self.selectElement(modulesLink, '', '', '');
                self.qtn = {};
            }
        },
        selectElement(moduleName, name = null, id = null, modules = null) {
            const module_name = moduleName;
            const self = this;

            const p_name = moduleName+'_name';
            const p_name_el = document.getElementById(p_name);
            p_name_el.value = name;
            p_name_el.dispatchEvent(new Event('input'));

            const p_id = moduleName+'_parent_id';
            const p_id_el = document.getElementById(p_id);
            p_id_el.value = id;
            p_id_el.dispatchEvent(new Event('input'));

            const p_type = moduleName+'_parent_type';
            const p_type_el = document.getElementById(p_type);
            p_type_el.value = modules;
            p_type_el.dispatchEvent(new Event('input'));
            if(moduleName == 'clientmaster'){
                self.getCustomer(id);
            }
            
        },
        delRecord(id){
            const self = this;
            self.loading = true;
            axios.post('modules/del_delivery', {'del_id':id}).then(function(response){
                if(response.data.message == "success"){
                alert('Item removed successfully!.....');

                self.TotalTaxable = 0;
                self.cgstAmt = 0;
                self.sgstAmt = 0;
                self.igstAmt = 0;

                self.gstAmount = 0;

                self.grandTotal = 0;
                let numberWord = new number_word(self.grandTotal);
            self.grandTotal_W = numberWord.number2text(0);  
            self.totalQty =0; 

                self.getProducts();
                self.getTaxable();
                self.loading = false;
                }else{
                    alert('somthing wrong   !.....');
                    self.loading = false;
                }
            }).catch(function(res){
                console.log('Something went wrong');
                self.loading = false;
            })
        },
        updateDelivery(action)
        {
            const self = this;
            self.delivery_id = self.$route.params.id;
            if(action =='save')
            {
               let saveObj = {
                   'action':action,
                   'delivery_id':self.delivery_id,
                   'total_taxable':self.TotalTaxable,
                   'total_tax':self.gstAmount,
                   'grand_total':self.grandTotal
               }
                axios.post('modules/deliverychallans/updatedelivery',saveObj).then(function(response){
                    self.$router.push('/modules/deliverychallans/'+self.delivery_id+'/detail');
                })
            }

            if(action =='cancel')
            {               
                self.$router.push('/modules/deliverychallans/'+self.delivery_id+'/detail');  
            }
            
                self.clearComponent('product');
                document.getElementById("discount").value=0;
                document.getElementById("product_qty").value=0;
                self.$router.push(`/modules/deliverychallans/${self.delivery_id}/detail`);
        }        
    }
}