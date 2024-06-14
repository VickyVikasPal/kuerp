<template>
     <div id="wrap">

        <sidebar :sidebarVisible="sidebarVisible" @toggleSidebar="toggleSidebar"></sidebar>

        <navbar  @toggleSidebar="toggleSidebar" :imagePath="ImagePath" ref="navbarMethod"></navbar>

        <div class="inner-wrap">
            <router-view></router-view>
        </div>

        <navfooter></navfooter>

        <button @click="scrollTop" class="back-to-top" v-bind:class="{close: scrollPosition < 200, open: scrollPosition > 200}">
             <i class="fa-solid fa-arrow-up"></i>
        </button>

     </div>
        
   
</template>

<script>
import {mapActions} from 'vuex'
import navbar from '@/components/layout/common/Navbar.vue';
import sidebar from '@/components/layout/common/Sidebar.vue';
import navfooter from '@/components/layout/common/Navfooter.vue';
import { ref } from 'vue';


export default {
    name:"dashboard",
    components:{  navbar,  sidebar,  navfooter, },
    data() {
        return {
            sidebarVisible: false,
            scrollPosition: null,
            ImagePath:'',
        }        
    },
   mounted() {
        window.addEventListener('scroll', this.updateScroll);
        //this.default_Call(); currentURL
    //alert(window.location.host);
        if(window.location.host == 'billings.softdevloper.com')
        {
            this.ImagePath = '/public';
        }else{
            this.ImagePath = '';
        }
        this.checkNavbar();
    },
    methods: {
        toggleSidebar(force = null) {
            if (force !== null) {
                this.sidebarVisible = force;
            } else {
                this.sidebarVisible = !this.sidebarVisible;
            }
        },

        updateScroll() {
            this.scrollPosition = window.scrollY
        },
   
        scrollTop() {
        //   window.scrollTo(0, this.top,);
         $('html, body').animate({scrollTop : 0},700);
        },
        checkNavbar(){
            this.$refs.navbarMethod.setUserNme();
        }
        // default_Call(){
        //     let body_div = document.getElementById("wrap");
        //         body_div.removeAttribute('class','SingleView');
        // }
    }
}
</script>