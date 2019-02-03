/**
 * OVERVIEW:
 *
 * This class handles errors caught by axios. When Http error codes are returned
 * they can be automatically handled here. It should be self explanatory to add
 * your own below.
 */

import router from '../handlers/router';

export default {
    /**
     * Handle an http error
     *
     * @param code
     */
    http(code) {
        switch (code) {
            case 401:
                // Always push
                router.push({
                    name: 'auth.login'
                });

                return;
            case 404:
                this._executeNewRoute('error.notfound');

                return;
            case 405:
            case 500:
                this._executeNewRoute('error.server');

                return;
            default:
                return false;
        }
    },

    _executeNewRoute(name) {
        // If we are going to a route, then we will continue that. This usually happens
        // after an error in a navigation guard.
        if (router.to) {
            router.push({
                name: name,
                params: [router.to.path],
            });

            return;
        }

        // Elsewise we will simply replace the current route
        router.replace({
            name: name,
            params: [router.currentRoute.path],
        });
    },
}