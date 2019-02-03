/**
 * OVERVIEW:
 *
 * The main Http class. Include this class from your components and stores. It simply serves
 * as a small wrapper around axios used to catch errors and direct them to the error handler.
 */

import axios from './axios.js';
import errorHandler from './error.js';

export default {
    get(url, config) {
        return new Promise((resolve, reject) => {
            return axios.get(url, config)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    this._handleError(error, reject);
                });
        });
    },

    post(url, data, config) {
        return new Promise((resolve, reject) => {
            return axios.post(url, data, config)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    this._handleError(error, reject);
                });
        });
    },

    delete(url, config) {
        return new Promise((resolve, reject) => {
            return axios.delete(url, config)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    this._handleError(error, reject);
                });
        });
    },

    _handleError(error, reject) {
        // Try and handle the error with the errorHandler.
        // If we get anything other than false we will assume that
        // we have.
        if (error.response && errorHandler.http(error.response.status) !== false) {
            return;
        }

        // Elsewise reject the error to the parent Promise to handle.
        // This will mean the user can handle the error as they see fit.
        reject(error);
    }
}