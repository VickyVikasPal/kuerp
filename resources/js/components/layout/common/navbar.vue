<template>

    <header id="header" class="d-flex align-items-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="maintitle d-flex align-items-center">
                        <div class="leftbarIcon" @click="$emit('toggleSidebar')"><span></span><span></span><span></span>
                        </div>
                        <span class="logotext">
                            Billings
                        </span>
                    </div>

      
                    <div class="globlalActionsHolder d-flex align-items-end flex-column">
                        <div class="d-flex align-items-center">
                            <div class="signoutWidget ms-2 dropdown">
                                <img :src="imagePath+'/assets/images/profile-45x45.png'" alt="User avatar" class="dropdown-toggle"
                                    data-bs-toggle="dropdown" />

                                <ul class="dropdown-menu">
                                    <div class="d-flex items-center px-3 py-2 userView">
                                        <img :src="imagePath+'/assets/images/profile-45x45.png'" alt="User avatar" class="me-2" />
                                        <div class="w-40">
                                            <div class="userName">{{user.name}}</div>
                                            <div class="userEmail">{{user.email}}</div>
                                        </div>
                                    </div>
                                    <router-link class="d-block px-4 py-2" role="menuitem" to="/modules/home"
                                        @click.native="dropdownOpen = false">
                                        <span class="icon"> <i class="fa-solid fa-gauge"></i></span>
                                        Dashboard
                                    </router-link>
                                    <router-link class="d-block px-4 py-2" role="menuitem" to="/modules/account"
                                        @click.native="dropdownOpen = false">
                                        <span class="icon"> <i class="fa-solid fa-user"></i></span>
                                       Your Profile
                                    </router-link>
                                    <router-link class="d-block px-4 py-2" role="menuitem" to="/modules/administration"
                                        @click.native="dropdownOpen = false">
                                        <span class="icon"> <i class="fa-solid fa-gear"></i></span>
                                        Admin
                                    </router-link>
                                    <a class="d-block px-4 py-2" href="javascript:void(0)" role="menuitem"
                                    @click="logout">
                                        <span class="icon"> <i class="fa-solid fa-right-from-bracket"></i></span>
                                        Sign out
                                    </a>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

</template>

<script>

    export default {
        name: 'navbar',
        props:{
            imagePath:{
                type:String,
                default:null
            }
        },
        data() {
            return {
                dropdownOpen: false,
                user: [
                    {
                        name: '',
                        userid: '',
                        email:'',
                    }
                ],
            }
        },
        mounted() {
            this.user.name = localStorage.getItem('username');
            this.user.userid = localStorage.getItem('userid');
        },
        methods: {
            async setUserNme(){
                let userData = JSON.parse(localStorage.getItem('user_prefrence'));
               
                this.user.name = userData.first_name+' '+userData.last_name;
                this.user.userid = userData.id;
                this.user.email = userData.email;
            },
            async logout() {
               let token = localStorage.getItem('token');
              
               if(token !='' && typeof token != undefined)
               {
                   
                   await axios.post('/auth/logout').then(({ data }) => {
                    localStorage.clear();
                    // this.signOut()
                    this.$router.push({ name: "login" })
                })
               }else{
                    localStorage.clear();
                    this.$router.push({ name: "login" })
               }
                
            },
           
            closeDropdown() {
                this.dropdownOpen = false;
            },

        }
    }
</script>