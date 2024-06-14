<template>
<main>
    <div class="side_buttons" v-bind:class="{ active: isActive }" v-on:click="openAction()">
        <span class="more_btn"><i class="fa-solid fa-angle-right"></i></span>
        <template v-if="invoiceLock">
            <a href="javascript:void(0)" class="btn btn-secondary btn-sm" @click="dispalyMessage()">Edit</a>
            <a href="javascript:void(0)" class="btn btn-secondary btn-sm" @click="dispalyMessage()">Receive Payment</a>
        </template>
        <template v-else>
            <router-link :to="`/modules/invoices/edit/${this.$route.params.id}`" class="btn btn-secondary btn-sm">Edit</router-link>
            <router-link to="" class="btn btn-secondary btn-sm" @click="updatePayment()">Receive Payment</router-link>
        </template>
    </div>

     <!-- payment modal !-->
   <!-- Modal -->
<div class="modal fade" id="paymentModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{lang.LBL_INV_FOR_PMT}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="card-header mb-2">
          </div>    
              <div class="card-body mb-2">
                <div class="row form-group">
                    <label>{{lang.LBL_INVOICE_DATE}}</label>
                    <input type="text" id="invoice_date" class="form-control" v-model="payment.invoice_date" disabled/>
                </div>
                <div class="row form-group">
                    <label>{{lang.LBL_INVOICE_NO}}</label>
                    <input type="text" id="invoice_number" class="form-control" v-model="payment.invoice_number" disabled/>
                </div>
                <div class="row form-group">
                    <label>{{lang.LBL_TOTAL_INR}}</label>
                    <input type="text" id="invoice_value" class="form-control" v-model="payment.invoice_value" disabled/>
                </div>
                <div class="row form-group">
                    <label>{{lang.LBL_PAYMENT_MODE}}</label>
                    <select id="payment_mode" class="form-control" v-model="payment.payment_mode">
                        <option value="">-- select --</option>
                        <option value="Cash">Cash</option>
                        <option value="Online">Online</option>
                    </select>
                </div>
                <div class="row form-group">
                    <label>{{lang.LBL_PAYMENT_REF_NO}}</label>
                    <input type="text" id="transaction_no" class="form-control" v-model="payment.transaction_no"/>
                </div>
                <div class="row form-group">
                    <label>{{lang.LBL_PAYMENT_REMARKS}}</label>
                    <textarea id="transaction_remark" class="form-control" v-model="payment.transaction_remark" placeholder="Please Enter Remark like (Online payment UPI, Card, INB etc)"></textarea>
                </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="updateInvoicePayment">Save changes</button>
      </div>
    </div>
  </div>
</div>
</main>
</template>
<script>
import lang from "@/views/modules/Invoices/language/en";

export default {
    name:"more-btn",
    data(){
        return{
             isActive:false,
             invoiceLock:false,
             lang:{},
             payment:{
                 'payment_mode':'',
                 'transaction_no':'',
                 'transaction_remark':'',
             },
        }
    },
    mounted() {
        this.lang = lang;
    },
    methods: {
        openAction() {
            this.isActive = !this.isActive;
            this.checkPayment();
        },
        checkPayment(){
            let invData = {'invoice_id':this.$route.params.id};
           // axios.post('/modules/invoices/paymentstatus',invData).then(function(response){
               let payment_status = localStorage.getItem('PaymentStatus');
                if(payment_status == 'Received'){
                    this.invoiceLock = true;
                }else{
                    this.invoiceLock = false;
                }
           
        },
        dispalyMessage(){
            alert("Invoice has been lock! Please contact administrator");
        },
       /* updatePayment(){
            this.$parent.openPaymentWindow();
        }*/
         updatePayment(){
            const self = this;
            let InvoiceData = {'invoice_id':self.$route.params.id};
            $("#paymentModal").modal("show");         
            axios.post('/modules/invoices/paymentstatus',InvoiceData).then(function(response){
                
                let date_str = response.data.date_entered;
                let inputDate = new Date(date_str);
                let day = String(inputDate.getDate()).padStart(2, "0"); // Get the day and pad with leading zeros if needed
                let month = String(inputDate.getMonth() + 1).padStart(2, "0"); // Get the month (months are 0-based in JavaScript) and pad with leading zeros if needed
                let year = inputDate.getFullYear(); // Get the full year

                let formattedDate = `${day}-${month}-${year}`;

                self.payment.invoice_date = formattedDate;
                self.payment.invoice_number = response.data.invoice_no;
                self.payment.invoice_value = response.data.grand_total;

            }).catch(function(error){
                console.log(error);
            });
        },
        updateInvoicePayment(){
            const self = this;
            if(self.payment.payment_mode !='' && self.payment.transaction_no !='' && self.payment.transaction_remark !=''){
                let paymentData = {'invoice_id':self.$route.params.id, 'payments':self.payment};
                axios.post('/modules/payments/updateinvoicepayment', paymentData).then(function(response){
                    if(response.data.payment_id !='')
                    {
                        $("#paymentModal").modal("hide");
                        self.payment.invoice_date = '';
                        self.payment.invoice_number = '';
                        self.payment.invoice_value = '';
                        self.payment.payment_mode = '';
                        self.payment.transaction_no = '';
                        self.payment.transaction_remark = '';

                        alert(response.data.message);
                        self.$parent.UpdatePaymentStatus();
                    }else{
                        alert('Somthing Went Wrong');
                    }
                }).catch(function(error){

                })
            }else{
                alert('Please Enter Payment Details')
            }
        }
    },
}
</script>
