import { getLocalUser } from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        customers: [],
        users: [],
        componentOpen: false
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        customers(state) {
            return state.customers;
        },
        users(state) {
            return state.users;
        },
        componentOpen(state){
            return state.componentOpen;
        }
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        updateCustomers(state, payload) {
            state.customers = payload;
        },
        updateUsers(state, payload) {
            state.users = payload;
        },
        toogleComponent(state){
            if(!state.componentOpen){
                state.componentOpen = true;
            }else{
                state.componentOpen = false;
            }
        }
    },
    actions: {
        toogleComponent(context){
            context.commit("toogleComponent");
        },

        login(context) {
            context.commit("login");
        },
        getCustomers(context) {
            axios.get('/api/customers',{
                headers:{
                    "Authorization": `Bearer ${context.state.currentUser.token}`
                }
            })
            .then((response) => {
                context.commit('updateCustomers', response.data.customers);
            })
        },
        getUsers(context) {
            axios.get('/api/users',{
                headers:{
                    "Authorization": `Bearer ${context.state.currentUser.token}`
                }
            })
            .then((response) => {
                context.commit('updateUsers', response.data.users);
            })
        }
    }
};