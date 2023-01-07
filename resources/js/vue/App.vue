<template>
  <Navbar v-if=" store.getters.getToken == 0 "/>
  <router-view></router-view>
</template>

<script setup>
import Navbar from './components/navbar.vue';

import { useStore } from 'vuex';

const store = useStore();
</script>
<style>

</style>