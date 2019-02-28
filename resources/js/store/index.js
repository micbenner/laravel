import Vue from 'vue';
import Vuex from 'vuex';
import logged from './logged';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        logged,
    },
});
