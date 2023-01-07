<template>
  <navbar_user /> 
  <router-view></router-view>
  <Adminfooter />
</template>

<script setup>
import navbar_user from './navbar_user.vue';
import {useRouter} from 'vue-router';
import {useStore } from 'vuex';
import Adminfooter from './footer.vue';
    const store = useStore (); 
    const router = useRouter();
    function logout() {
        store.dispatch('removeToken');
        router.push({name : 'Login'});
    }

    const showtabs = "allproduct";

</script>

<style>

</style>