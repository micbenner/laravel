import store from '../store';

export function loadPromises(promiseArrayResolver) {
    return (to, from, next) => {
        let promiseArray = promiseArrayResolver(store, to, from);

        Promise.all(promiseArray)
            .then(() => {
                next();
            });
    }
}
