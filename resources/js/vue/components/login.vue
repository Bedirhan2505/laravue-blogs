<template>
  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
        <h2 class="mt-4 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          Or
          <router-link :to="{name : 'Register'}" class="font-medium text-indigo-600 hover:text-indigo-500">start your 14-day free trial register now</router-link>
        </p>
      </div>
      <form @submit.prevent="sign" class="mt-8 space-y-6">
        <input type="hidden" name="remember" value="true" />
        <div class="-space-y-px rounded-md shadow-sm">
          <div class="mb-2">
            <label for="email" class="sr-only">Email address</label>
            <input id="email" v-model="form.email" type="email"  required="" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address" />
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <input id="password" v-model="form.password" type="password"  required="" class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Password" />
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="text-sm">
            <router-link :to="{name : 'ForgotPassword'}" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</router-link>
          </div>
        </div>

        <div>
          <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
            </span>
            Sign in
          </button>
        </div>
      </form>
      <p class="text-danger">{{ error }}</p>
    </div>
  </div>
</template>

<script setup>
import { toast } from 'vue3-toastify';
import '../../../../node_modules/vue3-toastify/dist/index.css';
import { LockClosedIcon } from '@heroicons/vue/20/solid';
import { reactive, ref } from 'vue';
import {useRouter} from 'vue-router';
import {useStore } from 'vuex';
import axios from 'axios';
  let form = reactive({
    email : '',
    password : ''
  });
  const store = useStore ();
  let error = ref('');
  const router = useRouter();
  const sign = async () => {
    await axios.post('/api/login',form)
    .then((res)=>{
      if(res.data.success){         
          toast.success("Login successful you are redirected to dashboard",{
          autoClose: 3000,
          position: toast.POSITION.TOP_RIGHT,
        });
        store.dispatch('setToken',res.data.data.token);
        setTimeout(() => {
          router.push({name : 'dashboard'});
        },3000);
        
      }else {
        toast.warn("Login Failed Please Try Again...",{
          autoClose: 4000,
          position: toast.POSITION.TOP_RIGHT,
        });
        error.value = res.data.message;
      }
    });
  };
</script>