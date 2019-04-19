<template>
    <div>
        <!-- <navbar :user="user"></navbar> -->

        <main role="main" class="container">
            <slot></slot>
        </main>
    </div>
</template>

<script>
    //import Navbar from '../Navbar/Navbar';

    export default {
        /*components: {
            Navbar,
        },*/

        props: [
            'user',
        ],
    }
</script>

<style scoped>

</style>