import App from './app/App';
import Vue from 'vue';

import store from './store';

import extractMeta from './handlers/extractMeta';
import page from './handlers/page';
import router from './handlers/router';

/*
|--------------------------------------------------------------------------
| Register any Vue add-ons that aren't better suited elsewhere
|--------------------------------------------------------------------------
*/

import BootstrapVue from 'bootstrap-vue';
import VueProgressBar from 'vue-progressbar';

Vue.use(BootstrapVue);
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
});

/*
|--------------------------------------------------------------------------
| Register route guards - you may need to adjust extractMeta as well
|--------------------------------------------------------------------------
*/

router.beforeEach((to, from, next) => {
    let meta = extractMeta(to);

    // Once the user is authed
    Promise.all([store.state.logged.loginPromise])
        .then(() => {
            if (store.getters['logged/isLoggedIn']) {
                if (meta.auth === false) {
                    next({
                        path: '/'
                    });

                    return;
                }
            }
            else {
                if (meta.auth === true) {
                    next({
                        name: 'auth.login'
                    });

                    return;
                }
            }

            next();
        });
});

/*
|--------------------------------------------------------------------------
| Fire preload events...
|--------------------------------------------------------------------------
*/

store.dispatch('logged/startLogin');

/*
|--------------------------------------------------------------------------
| Set up the Vue application
|--------------------------------------------------------------------------
*/

new Vue({
    el: '#app',
    router,
    store,

    components: {
        App,
    },

    template: `<div><app></app></div>`,

    beforeCreate() {
        this.$router.onReady(() => {
            this.$Progress.start();
            this.$Progress.increase(10);

            page.title(this.$route.meta.title);
        });

        this.$router.beforeEach((to, from, next) => {
            this.$router.from = from;
            this.$router.to = to;

            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress;
                this.$Progress.parseMeta(meta);
            }

            this.$Progress.start();
            this.$Progress.increase(10);

            next();
        });

        this.$router.afterEach((to, from) => {
            this.$router.to = null;
            page.title(this.$route.meta.title);
            this.$Progress.finish();
        });
    },

    created() {
        this.$Progress.finish();
    },
});
