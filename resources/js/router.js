import {createRouter, createWebHistory} from 'vue-router';
import store from '@/store'
import routes from '@/views/routes.js'
import VueBodyClass from 'vue-body-class';


const router = createRouter({
    history: createWebHistory(),
    routes,
});

const vueBodyClass = new VueBodyClass(routes);

// Router auth middleware

router.beforeResolve(async (to, from, next) => {
    vueBodyClass.guard(to, next);
    
    if (to.meta.middleware || to.meta.controller || to.path) {
      
      if (!localStorage.getItem('token') && to.meta.middleware.includes('auth')) {
        window.location.href = "/auth/login";
      } else if (localStorage.getItem('token') && to.meta.middleware.includes('guest')) {
        router.push('/modules/home');
      } else if (!window.app.register && to.meta.middleware.includes('register')) {
        router.push('/auth/login');
      } else if (localStorage.getItem('token') && to.meta.middleware.includes('auth')) {
        localStorage.removeItem('Errors');
        try {
          const response = await axios.post('/auth/check', { controller: to.meta.controller, path: to.path });
          if (response.data.permission) {
            if (!localStorage.getItem('token')) {
              router.push('/auth/login');
            } else {
              //  console.log(to);
              response.data.access ? router.push(to.fullPath) : to.meta.controller ? router.push('/modules/home') : router.push('/auth/login');
            }
          } else {
            router.push('/modules/404');
          }
        } catch (error) {
          console.error(error);
          router.push('/modules/404'); // Handle the error case
        }
      } else {
        router.push('/auth/login');
      }
    } else {
      next(); // If no middleware is defined, continue with the navigation
    }
  });
  

export default router;
