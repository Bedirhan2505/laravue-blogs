<template>
  <div>
    <h1>DASHBOARD</h1>
    <button @click="logout" class="button is-danger mt-4 ml-4">Logout</button>
  </div>
</template>

<script setup>

import {useRouter} from 'vue-router';

    const router = useRouter();
    function logout() {
        localStorage.removeItem('token');
        router.push({name : 'Login'});
    }
</script>

<style>

</style>