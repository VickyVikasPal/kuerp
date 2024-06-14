<template>
    <div class="loginOuter">
        <div class="innerContent">
            <h1 class="text-center mb-5">Login</h1>
            <div class="w-100">
                <form action=""  method="post" @submit.prevent="login" class="form-login">
                    <div class="form-group mb-2" v-if="error">
                        <p>{{ error }}</p>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="font-weight-bold">User Name</label>
                        <input type="text" v-model="form.user_name" name="user_name" id="user_name" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label for="password" class="font-weight-bold">Password</label>
                        <input type="password" v-model="form.password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group my-4 text-center">
                        <button type="submit" class="btn btn-login color-1">
                            {{ "Login" }}
                        </button>
                    </div>
                   <!-- <div class="col-12 text-center">
                        <label>Don't have an account? <router-link :to="{name:'register'}" class="mt-1">Register Now!</router-link></label>
                    </div>!-->
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import store from "@/store";
export default {
    name:'login',
    data() {
        return{
            form:{
                user_name:null,
                password:null,
            },
            error:null,
        }
    },
    methods:{
        
        login(){
            const self = this;
        axios.post('auth/login', self.form).then(function (response) {
                   // console.log(response.data);
                    //self.errormsg = response.data.message
                    if (response.data.two_fa_status == 'Yes') {
                        self.$router.push('/auth/verify-otp');
                    } else {
                       // console.log(store.mutations);
                        store.commit('login', response.data);
                        self.$router.push('/modules/home');
                    }
                }).catch(function () {
                    self.loading = false;
                    let err = localStorage.getItem('Errors');
                    let err_msg = (JSON.parse(err));
                    let err_msg2 = err_msg && err_msg.errors ? err_msg.errors : {};
                    Object.keys(err_msg2 || {}).forEach((key) => {
                        let errorval = err_msg2[key];
                        const input = document.getElementById(key);
                        const errorDiv = document.createElement('span');
                        errorDiv.className = 'error d-block mt-2 error-message';
                        errorDiv.textContent = errorval;
                        input.insertAdjacentHTML('afterend', errorDiv.outerHTML);
                    });
                    localStorage.removeItem('Errors');
                    self.form.password = null;
                  //  self.reloadCaptcha();
                   // self.updateCsrfToken();
                });
        },
        
    }
}
</script>