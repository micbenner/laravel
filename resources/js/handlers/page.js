export default {
    vars: {
        csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        titleTemplate: document.head.querySelector('meta[name="title-template"]').content,
    },

    addBodyClass(cls) {
        if (document.body.classList)
            document.body.classList.add(cls);
        else
            document.body.className += ' ' + cls;
    },

    removeBodyClass(cls) {
        if (document.body.classList) {
            document.body.classList.remove(cls);
        } else {
            document.body.className = document.body.className.replace(
                new RegExp('(^|\\b)' + cls.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        }
    },

    getMetaContent(name) {
        return document.head.querySelector('meta[name="' + name + '"]').content;
    },

    title(newTitle) {
        document.title = this.vars.titleTemplate.replace('%s', newTitle);
    }
}