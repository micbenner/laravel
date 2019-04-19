import actions from '../actions/auth';

export default {
    namespaced: true,

    actions,

    state: {
        loginPromise: null,
        user: null,
    },

    getters: {
        isLoggedIn(state) {
            return state.user ? true : false;
        },
        getLoginPromise(state) {
            return state.loginPromise;
        },
        getLogged(state) {
            return state.user;
        }
    },

    mutations: {
        removeLogged(state) {
            state.user = null;
        },
        setLoggedUser(state, user) {
            state.user = user;
        },
        setLoginPromise(state, promise) {
            state.loginPromise = promise;
        },
    }
}