<template>
  <div class="container mt-5">
    <div class="columns is-vcentered">
      <div class="column">
        <h1>DASHBOARD</h1>
      </div>
    </div>
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

    const showtabs = "allproduct";

</script>

<style>

</style>