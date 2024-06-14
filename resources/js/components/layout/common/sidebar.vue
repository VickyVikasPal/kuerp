<template>

    <div class="canvas-menu" v-show="sidebarVisible">
        <div @click="close"  class="overlay"></div>
        <div class="sideNav">
            <div class="close-icon"  @click="close">
                <i class="fa-regular fa-circle-xmark"></i>
            </div>
            <div class="listItem">
                <div id="navigation"><i class="fas fa-bars me-2"></i> Navigation</div>
                <ul id="menu" class="Navbar_items">
                    <template v-for="(menuItem, index) in menuList">
                    <li> <router-link :to="menuItem.head_link">
                        <span class="icon"><i :class="menuItem.icons"></i></span>
                        {{menuItem.head_name}}
                        </router-link>
                    </li>
                    </template>
                   <!-- <li> <router-link to="/modules/categorys"> <span class="icon"><i class="fa-solid fa-folder"></i></span> Category</router-link></li>
                    <li> <router-link to="/modules/products"> <span class="icon"><i class="fa-solid fa-folder"></i></span> Product</router-link></li>!-->
                    
                </ul> 
            </div>
        </div>
       
        
    </div>

</template>

<script>
export default {
    name: "sidebar",
   
    props: {
        sidebarVisible: {
            type: Boolean,
            required: true,
        }
    },
    watch: {
        $route(to, from) {
            this.$emit('toggleSidebar', false);
        }
    },
    data() {
        return {
            showMenu: false,
            menuList:[],
        }
    },
    mounted(){
        this.loadSidebar();
    },
    methods: {
        close() {
            this.$emit('toggleSidebar', false);
        },
        beforeToggleSidebar() {
            this.showMenu = true;
        },
        afterToggleSidebar() {
            this.showMenu = false;
        },
        loadSidebar(){
            const self = this;
            axios.get('modules/appList', {params:{'sidebar':true}}).then(function(response){
                //console.log(response);
                self.menuList = response.data;
            })
        }
    }
}
</script>
