import Cookies from 'js-cookie';
import http from '../http';

export default {
    namespaced: true,

    state: {
        loginPromise: null,
        user: null,
    },

    actions: {
        logout({commit, state}) {
            commit('removeLogged');

            http.get('/auth/logout');
        },

        startLogin({commit, state}) {
            state.loginPromise = null;
            state.loginPromise = new Promise((resolve, reject) => {
                http.get('/api/auth/logged')
                    .then((response) => {
                        if (response.data) {
                            commit('setLogged', response.data);
                        }

                        resolve();
                    });
            });

            return state.loginPromise;
        },

        /*updatePassword({commit}, payload) {
            return new Promise((resolve, reject) => {
                http.post('/api/auth/logged/password', payload)
                    .then((response) => {
                        resolve();
                    })
                    .catch(error => reject(error));
            });
        },*/
    },

    getters: {
        isLoggedIn(state) {
            return state.user ? true : false;
        },
        logged(state) {
            return state.user;
        }
    },

    mutations: {
        removeLogged(state) {
            state.user = null;
        },
        setLogged(state, loggedShowResponse) {
            state.user = loggedShowResponse.user;
        },
    }
}
