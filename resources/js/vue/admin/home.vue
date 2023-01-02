<template>
  <div>
    <h1>DASHBOARD</h1>
    <button @click="logout" class="button is-danger mt-4 ml-4">Logout</button>
  </div>
</template>

<script setup>

import {useRouter} from 'vue-router';
import {useStore } from 'vuex';

    const store = useStore (); 
    const router = useRouter();
    function logout() {
        store.dispatch('removeToken');
        router.push({name : 'Login'});
    }
</script>

<style>

</style>