import http from '../../http';

export default function ({commit, state}) {
    return new Promise((resolve, reject) => {
        commit('removeLogged');

        http.get('/auth/logout').then(() => {
            resolve();
        });
    });
}