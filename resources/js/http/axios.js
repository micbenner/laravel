import axios from 'axios';
import page from '../handlers/page';

const instance = axios.create();

instance.interceptors.request.use((config) => {
    config.headers['X-Requested-With'] = 'XMLHttpRequest';
    config.headers['X-CSRF-TOKEN'] = page.vars.csrf;

    return config;
});

export default instance;