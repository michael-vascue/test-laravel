import {getLoggedinUser} from './auth';
const user = getLoggedinUser();

export default {
    state: {
        currentUser: user,
        isLoggedin: !!user,
        loading: false,
        auth_error: null,
        reg_error:null,
        registeredUser: null,
        update: null,
    },
    getters: {
        isLoading(state){
        return state.loading;
        },
        isLoggedin(state){
            return state.isLoggedin;
        },
        currentUser(state){
            return state.currentUser;
        },
        authError(state){
            return state.auth_error;    
        },
        regError(state){
            return state.reg_error;
        },
        registeredUser(state){
            return state.registeredUser;
        },
        update(state){
            return state.update;
        }
    },
    mutations: {
        login(state){
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload){
            state.auth_error = null;
            state.isLoggedin = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user , {token: payload.access_token});
            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload){
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state){
            localStorage.removeItem("user");
            state.isLoggedin = false;
            state.currentUser = null;
        },
        registerSuccess(state, payload){
            state.reg_error = null;
            state.registeredUser = payload.user;
        },
        registerFailed(state, payload){
            state.reg_error = payload.error;
        },
        update(state, payload) {
            state.currentUser = payload.data;      
        }
    },
    actions: {
        login(context){
            context.commit("login");
        },
        // update(context){
        //     // state.currentUser.update(context);
        // }

    }
};