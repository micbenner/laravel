<template>
    <div>
        <page-navbar-main :user="logged">
            <div>
                <p>Home component</p>
                <p v-if="logged">
                    You are logged in as {{ logged.name }}
                </p>
                <p v-else>
                    You are not logged in :(
                </p>
            </div>
        </page-navbar-main>
    </div>
</template>

<script>
    import PageNavbarMain from '../components/Page/PageNavbarMain';

    export default {
        components: {
            PageNavbarMain,
        },

        computed: {
            logged() {
                return this.$store.getters['auth/getLogged'];
            }
        }
    }
</script>