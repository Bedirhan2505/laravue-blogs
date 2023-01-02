<template>
        <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <router-link :to="{name : 'Home'}" class="navbar-item">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </router-link>
        </div>

        <div id="navbarBasicExample" class="navbar-menu is-active">
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                    <router-link :to="{name : 'Register'}" class="bd-tw-button button" v-if=" store.getters.getToken == 0">
                        <strong>Register</strong>
                    </router-link>
                    <router-link :to="{name : 'Login'}" class="bd-tw-button button" v-if=" store.getters.getToken == 0">
                        <strong>Login</strong>
                    </router-link>
                    </div>
                </div>
            </div>
        </div>
        </nav>
</template>

<script setup>
import {useStore} from 'vuex';
    const store = useStore();
</script>

<style scoped>

</style>