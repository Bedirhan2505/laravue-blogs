<template>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8">
        <div>
          <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
          <h2 class="mt-4 text-center text-3xl font-bold tracking-tight text-gray-900">Password Reminder Page</h2>
          <p class="mt-2 text-center text-sm text-gray-600">
            <span class="font-medium text-indigo-600 hover:text-indigo-500">Your password will be sent to your defined e-mail address.</span>
          </p>
        </div>
        <form class="mt-8 space-y-6" @submit.prevent="forgotpassword">
          <div class="-space-y-px rounded-md shadow-sm">
            <div class="mb-2">
              <label for="email-address" class="sr-only">Email address</label>
              <input id="email-address" v-model="form.email"  type="email"  required="" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address" />
            </div>
          </div>
          <div class="-space-y-px rounded-md shadow-sm">
            <div class="mb-2">
              <label for="Name_Surname" class="sr-only">Name Surname</label>
              <input id="Name_Surname" v-model="form.name"  type="text"  required="" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Name Surname" />
            </div>
          </div>
          <div>
            <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
              </span>
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { LockClosedIcon } from '@heroicons/vue/20/solid';
  import { reactive} from 'vue';
  import axios from 'axios';
  import { useCookies } from "vue3-cookies";
  import {useRouter} from 'vue-router';

  let form = reactive({
    email : '',
    name : ''
  });
  const { cookies } = useCookies();
  const  router  = useRouter();
  const forgotpassword = async () => {
    await axios.post('/api/resetpassword',form)
    .then((res)=>{
      if(res.data.success){
          if(cookies.set(res.data.data[1],res.data.data[0])){
            router.push({ name : 'respasstwostep'});
          }else {
            console.log("Cookies not created !!");
          }  
      }else {
        console.log(res.data.message);
      }
    });
  };
  </script>