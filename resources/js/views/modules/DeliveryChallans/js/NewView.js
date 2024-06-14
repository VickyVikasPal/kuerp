import breadcrumbs from "@/views/modules/DeliveryChallans/MenuList.vue";
import lang from "@/views/modules/DeliveryChallans/language/en";
import number_word from "@/plugins/number_word.js";

export default {
    name: "new-deliveryChallans",
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
            grandTotalValue:{
                beforTax:0,
                totalCgst:0,
                totalSgst:0,
                totalIgst:0,
                totalGst:0,
                grandTot:0,
                totQty:0
            },
            quotation_id:"",
            TotalTaxable:0,
            cgstAmt:0,
            sgstAmt:0,
            igstAmt:0,
            gstAmount:0,
            totalRounding:0,
            grandTotal:0,
            grandTotal_W:"",
            totalQty:0,
            rounding:0,
            qtn:{},
        }
    },
    mounted() {
        this.checkPermisson();
        this.lang = lang;
    },
    methods: {
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
            if (searchData.length > 0) {
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
        checkPermisson() {
            const self = this;
            self.loading = false;
        },
        getCustomer(customer_id)
        {
            const self = this;
            axios.get('modules/getcustomers',{params:{'customer_id':customer_id}}).then(function(response){
                self.qtn = response.data.client;
            })
        },
        //add product in table
        addProduct(){
            const self = this;
            let product_id = document.getElementById("product_parent_id").value;
           
            let discount = document.getElementById('discount').value;
            let product_qty = document.getElementById('product_qty').value;
         
            let client_id = self.delivery.client_id;
            let user_prefrences = JSON.parse(localStorage.getItem('user_prefrence'));
            //quotation_obj
            if(client_id !=""){
            axios.get('modules/getproductdata', {params:{'product_id':product_id}}).then(function(response){
               // console.log(response);
               let product_id = document.getElementById("product_parent_id").value;
               let product_name = response.data.product.name;
               let product_hsn = response.data.product.hsn_sac_code;
               let product_sp = response.data.product.taxable_price;
               let product_qty = document.getElementById('product_qty').value;
               let total_value_inr = parseFloat(response.data.product.taxable_price * product_qty).toFixed(2);
               let discount = document.getElementById('discount').value;
               let total_discount = parseFloat((total_value_inr*discount)/100).toFixed(2);
               let discount_amt = total_discount;
               let taxable_value = parseFloat(total_value_inr - total_discount).toFixed(2);

               let igst = 0;
               let cgst = 0;
               let sgst = 0;
               let tax = 0;
               let igstRate = response.data.product.tax_type;
               let cgstRate = response.data.product.tax_type/2;
               let sgstRate = response.data.product.tax_type/2;

               let user_prefrences = JSON.parse(localStorage.getItem('user_prefrence'));
                let user_state = user_prefrences.address_state;
                let client_state = self.qtn.state;

               if(user_state.toUpperCase  == client_state.toUpperCase)
               {
                   let tax_value = parseFloat(taxable_value * parseInt(response.data.product.tax_type)).toFixed(2);

                    tax = parseFloat(tax_value/100).toFixed(2);
                    cgst = parseFloat(tax/2).toFixed(2);
                    sgst = parseFloat(tax/2).toFixed(2);
               }else{
                    let tax_value = parseFloat(taxable_value * parseInt(response.data.product.tax_type)).toFixed(2);

                     igst = parseFloat(tax_value/100).toFixed(2);
               }
               let total_inr = Math.round(parseFloat(taxable_value) + parseFloat(igst) + parseFloat(tax));

               self.grandTotalValue.beforTax = parseFloat(self.grandTotalValue.beforTax+taxable_value).toFixed(2);

               let products = {'id':product_id, 'name':product_name, 'hsn_code':product_hsn, 'qty':product_qty, 'unit_price':product_sp, 'total_value':total_value_inr, 'discount':discount, 'discount_amount':discount_amt, 'taxable_value':taxable_value, 'cgstRate':cgstRate, 'cgst':cgst, 'sgstRate':sgstRate, 'sgst':sgst, 'igstRate':igstRate, 'igst':igst, 'total_amount':total_inr};
               
               self.productArray.push(products);                            
               
                    self.clearComponent('product');
                   // document.getElementById("discount").value=0;
                    const discount_el = document.getElementById("discount");
                    discount_el.value = 0;
                    discount_el.dispatchEvent(new Event('input'));
                    //document.getElementById("product_qty").value=0; 
                    const product_qty_el = document.getElementById("product_qty");
                    product_qty_el.value = 0;
                    product_qty_el.dispatchEvent(new Event('input')); 
                    
                    self.getCustomer(client_id);
                    //self.getTaxable();
                    self.getTaxable(taxable_value, cgst, sgst, igst, total_inr, product_qty);
                                     
                })
            }else{
                alert("Please Select Customer To Create Quotation");
            }
        },
        
        getCustomer(customer_id)
        {
            const self = this;
            axios.get('modules/getcustomers',{params:{'customer_id':customer_id}}).then(function(response){
                self.qtn = response.data.client;

                self.delivery.client_id = response.data.client.id;
                self.delivery.client_type = 'clientmasters';
                self.delivery.client_name = response.data.client.name;
                
            })
        },
       
        getTaxable(total_taxable, total_cgst, total_sgst, total_igst, grand_total, product_qty){
            const self = this;
            
            self.TotalTaxable = parseFloat(parseFloat(self.TotalTaxable) + parseFloat(total_taxable)).toFixed(2);
            self.cgstAmt = parseFloat(parseFloat(self.cgstAmt) + parseFloat(total_cgst)).toFixed(2);
            self.sgstAmt = parseFloat(parseFloat(self.sgstAmt) + parseFloat(total_sgst)).toFixed(2);
            self.igstAmt = parseFloat(parseFloat(self.igstAmt) + parseFloat(total_igst)).toFixed(2);

            self.gstAmount = parseFloat(parseFloat(parseFloat(self.cgstAmt)+parseFloat(self.sgstAmt)+parseFloat(self.igstAmt))).toFixed(2);

            self.grandTotal = parseFloat(parseFloat(self.grandTotal) +  parseFloat(grand_total)).toFixed(2);
            let numberWord = new number_word(self.grandTotal);
           self.grandTotal_W = numberWord.number2text(self.grandTotal);  
           self.totalQty = parseInt(parseInt(self.totalQty) + parseInt(product_qty));
           
        },

        delRecord(id){
            const self = this;
            self.loading = true;
            axios.post('modules/del_quotation', {'del_id':id}).then(function(response){
                if(response.data.message == "success"){
                alert('Item removed successfully!.....');
                
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
        saveDelivery(actionType){
            const self = this;
            if(actionType == 'save'){
                let formData = {
                    'client_id':self.delivery.client_id,
                    'taxable':self.TotalTaxable,
                    'totalTax':self.gstAmount,
                    'grandTotal':self.grandTotal,
                };
                axios.post('modules/deliverychallans', {'formData': formData, 'itemData':self.productArray}).then(function(response){
                   if(response.data.error_message == ''){
                    self.$router.push('/modules/deliverychallans');
                   }
                }).catch(function(e){
                    console.log(e);
                    console.log(error);
                })
            }
        },
    }
}