export default function (to) {
    // Start by grabbing the matched routes (the parent routes),
    // these will be where we extract the meta element from
    let routes = to.matched;

    let matchedMeta = {};

    routes.forEach(({meta}) => {
        matchedMeta.auth = meta.auth !== undefined ? meta.auth: matchedMeta.auth;
    });

    return matchedMeta;
}