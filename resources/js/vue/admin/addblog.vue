<template>
<div class="container">
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Blog Details</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">You Can Create a New Blog By Entering Blog Details.</p>
        </div>
        <form content-type="multipart/form-data" @submit.prevent="addblog">
            <div class="border-t border-gray-200">
                <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                     <dt class="text-sm font-medium text-gray-500">Select Category</dt>
                     <select v-model="form.selected" class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0" id="category" name="category">
                        <option disabled value="">Please select one</option>
                        <option v-for="selectcat in selectcategory" :key="selectcat.id" :value="selectcat.id">{{selectcat.name}}</option>
                     </select>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Title</dt>
                    <input type="text" v-model="form.title" name="title" id="title" placeholder="Title" class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <textarea name="Description" v-model="form.desc" rows="4" id="Description" placeholder=" In this field, enter the short description of your blog that appears during the listing." class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"></textarea>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Content</dt>
                    <textarea name="Content" v-model="form.content" rows="4" id="Content" placeholder=" Enter the detailed content of your blog in this field." class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"></textarea>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Cover Photo</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                        <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                        <div class="flex w-0 flex-1 items-center">
                            <PaperClipIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <input type="file" @change="onFileChanged($event)" ref="file" accept="image/*" name="image" id="image" class="ml-2 w-0 flex-1 truncate">
                        </div>
                        </li>
                    </ul>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500"></dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                        <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                        <div class="flex w-0 flex-1 items-center">
                            <button type="submit" class="button is-primary ">Add Blog</button>
                        </div>
                        </li>
                    </ul>
                    </dd>
                </div>
                </dl>
            </div>
        </form>
    </div>
</div>
    
  </template>
  
  <script setup>
  import { PaperClipIcon } from '@heroicons/vue/20/solid';
  import axios from 'axios';
  import { reactive , ref , onMounted } from 'vue';

    const form = reactive({
        title : '',
        desc : '',
        content : '',
        selected : ''
    });
    const selectcategory = ref(null);
    const file = ref([]);
    const onFileChanged = (e) => {
            file.value = e.target.files[0];
            console.log(file);
    };

    const addblog = async (e) => {
        e.preventDefault();
        
        await axios.post('/api/addblog',form,file.value)
        .then((res) => {
            console.log(res.data.data);
        })
        .catch((err) => {
            console.log(err);
        });
    };

    onMounted(async () => {
        await axios.post('/api/listencategory')
        .then((res) => {
            selectcategory.value = res.data.data; 
            console.log(selectcategory.value);
        })
        .catch((err) => {
            console.log(err);
        });
    });
    
  </script>