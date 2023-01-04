<template>
    
  <router-view></router-view>
  <footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
      <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
      is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
    </p>
  </div>
</footer>
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