
import App from './app/App';
import extractMeta from './handlers/extractMeta';
import router from './handlers/router';
import store from './store/store';
import Page from './handlers/page';
import Vue from 'vue';

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

store.dispatch('logged/startLogin');

new Vue({
    el: '#app',
    router: router,
    store: store,

    components: {
        App,
    },

    template: `<div><app></app></div>`,

    beforeCreate() {
        this.$router.onReady(() => {
            Page.title(this.$route.meta.title);
        });

        this.$router.beforeEach((to, from, next) => {
            this.$router.from = from;
            this.$router.to = to;

            /* vue-progress stuff
            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress;
                this.$Progress.parseMeta(meta);
            }

            this.$Progress.start();
            this.$Progress.increase(10);*/

            next();
        });

        this.$router.afterEach((to, from) => {
            this.$router.to = null;
            Page.title(this.$route.meta.title);
            //this.$Progress.finish();
        });
    },

    created() {
        //this.$Progress.finish();
    },
});
