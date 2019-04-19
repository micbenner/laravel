import http from '../http';

export default {
    async loggedShow() {
        let response = await http.get('/api/auth/logged');

        return response.data.user;
    }
}