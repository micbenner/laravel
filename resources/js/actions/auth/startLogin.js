import {AuthApi} from '../../api';

export default function ({commit}) {
    commit('setLoginPromise', new Promise((resolve) => {
        AuthApi.loggedShow()
               .then((logged) => {
                   commit('setLoggedUser', logged);

                   resolve();
               });
    }));
}