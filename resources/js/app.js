import App from './views/App';
import BootstrapVue from 'bootstrap-vue';
import extractMeta from './handlers/extractMeta';
import router from './handlers/router';
import store from './store';
import Page from './handlers/page';
import Vue from 'vue';
import VueProgressBar from 'vue-progressbar';

/*
|--------------------------------------------------------------------------
| Register any Vue add-ons that aren't better suited elsewhere
|--------------------------------------------------------------------------
*/

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
    Promise.all([
        store.getters['auth/getLoginPromise'],
    ])
           .then(() => {
               if (store.getters['auth/isLoggedIn']) {
                   if (meta.auth === false) {
                       next({
                           path: '/'
                       });

                       return;
                   }
               } else {
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

store.dispatch('auth/startLogin');

/*
|--------------------------------------------------------------------------
| Set up the Vue application
|--------------------------------------------------------------------------
*/

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
            this.$Progress.start();
            this.$Progress.increase(10);

            Page.title(this.$route.meta.title);
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
            Page.title(this.$route.meta.title);
            this.$Progress.finish();
        });
    },

    created() {
        this.$Progress.finish();
    },
});