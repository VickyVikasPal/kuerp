import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from '@/store/auth'

const store = createStore({
    state: {
        user: false,
        permissions: {},
        settings: false,
    },
    mutations: {
        setSettings(state, data) {
            state.settings = data;
        },
        login(state, response) {
            state.user = response.user;
            state.permissions = response.user.role.permissions;
            localStorage.setItem('token', response.token);
            localStorage.setItem('user_prefrence', JSON.stringify(response.user));
            window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.token;
        },
        logout(state) {
            axios.post('api/auth/logout').then(function () {
                state.user = false;
            });
            delete window.axios.defaults.headers.common.Authorization;
            localStorage.removeItem('token');
            localStorage.removeItem('user_prefrence');
        },
        setUser(state) {
            if (localStorage.getItem('token')) {
                axios.get('api/auth/user').then(function (response) {
                    state.user = response.data;
                    state.permissions = response.data.role.permissions;
                });
            }
        },
        updateUser(state, response) {
            state.user = response;
            state.permissions = response.role.permissions;
        },
    }
});

export default store;

