<template>
      
        <div class="w-100 text-center mt-5">
            <i class="fa-solid fa-triangle-exclamation h1"></i>
            <div class="font-semibold  mt-3">{{ 'Whoops! Looks like you got lost' }}</div>
            <div>{{ 'We couldn\'t find what you were looking for'}}</div>
            <div class="mt-5">
                <router-link
                    active-class=""
                    class="btn btn-primary btn-sm"
                    exact-active-class=""
                    to="/modules/home"
                >
                    {{ 'Go home' }}
                </router-link>
            </div>
        </div>
    
</template>

<script>

export default {
    name: "not-found",
  
   
}
</script>
