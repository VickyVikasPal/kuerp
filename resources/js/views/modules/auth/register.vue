<template>
   <div class="loginOuter">
        <div class="innerContent">
            <h1 class="text-center mb-5">Register Now</h1>
            <div class="w-100">
                <form action="javascript:void(0)" @submit="register" method="post">
                <div class="form-group mb-2" v-if="Object.keys(validationErrors).length > 0">
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                        </ul>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="name" class="font-weight-bold">Name</label>
                    <input type="text" name="name" v-model="user.name" id="name" placeholder="Enter name" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="email" class="font-weight-bold">Email</label>
                    <input type="text" name="email" v-model="user.email" id="email" placeholder="Enter Email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" name="password" v-model="user.password" id="password" placeholder="Enter Password" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="password_confirmation" class="font-weight-bold">Confirm Password</label>
                    <input type="password_confirmation" name="password_confirmation" v-model="user.password_confirmation" id="password_confirmation" placeholder="Enter Password" class="form-control">
                </div>
                <div class="form-group my-4 text-center">
                    <button type="submit" :disabled="processing" class="btn btn-login color-1">
                        {{ processing ? "Please wait" : "Register" }}
                    </button>
                </div>
                <div class="col-12 text-center">
                    <label>Already have an account? <router-link :to="{name:'login'}" class="mt-1">Login Now!</router-link></label>
                </div>
            </form>
            </div>
           
        </div>
    </div> 
</template>

<script>
import { mapActions } from 'vuex'
export default {
    name:'register',
    data(){
        return {
            user:{
                name:"",
                email:"",
                password:"",
                password_confirmation:""
            },
            validationErrors:{},
            processing:false
        }
    },
    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),
        async register(){
            this.processing = true;
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/register',this.user).then(response=>{
                this.validationErrors = {}
                this.signIn()
            }).catch(({response})=>{
                if(response.status===422){
                    this.validationErrors = response.data.errors
                }else{
                    this.validationErrors = {}
                    alert(response.data.message)
                }
            }).finally(()=>{
                this.processing = false;
            })
        }
    }
}
</script>