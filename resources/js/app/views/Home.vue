<template>
    <div>
        <div>
            <p>Home component</p>
            <p v-if="logged">
                You are logged in as {{ logged.name }}
            </p>
            <p v-else>
                You are not logged in :(
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            logged() {
                return this.$store.getters['logged/logged'];
            }
        }
    }
</script>