<template>
        <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
            <router-link :to="{name : 'Home'}" class="navbar-item">Home</router-link>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                    <router-link :to="{name : 'Register'}" class="button is-primary">
                        <strong>Register</strong>
                    </router-link>
                    <router-link :to="{name : 'Login'}" class="button is-light">
                        Login
                    </router-link>
                    </div>
                </div>
            </div>
        </div>
        </nav>
</template>

<script>
import router from '../routes';

export default {
    components: { router }
}
</script>

<style>

</style>