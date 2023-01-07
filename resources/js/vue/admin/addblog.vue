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
                     <select required v-model="form.selected" class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0" id="category" name="category">
                        <option disabled value="general">Please select one</option>
                        <option v-for="selectcat in selectcategory" :key="selectcat.id" :value="selectcat.id">{{selectcat.name}}</option>
                     </select>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Title</dt>
                    <input type="text" v-model="form.title" required name="title" id="title" placeholder="Title" class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <textarea name="Description" required v-model="form.desc" rows="4" id="Description" placeholder=" In this field, enter the short description of your blog that appears during the listing." class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"></textarea>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Content</dt>
                    <textarea name="Content" required v-model="form.content" rows="4" id="Content" placeholder=" Enter the detailed content of your blog in this field." class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"></textarea>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Cover Photo</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                        <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                        <div class="flex w-0 flex-1 items-center">
                            <PaperClipIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                            <input type="file" required @change="onFileChanged($event)" accept="image/*" name="image" id="image" class="ml-2 w-0 flex-1 truncate">
                            
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
    <vue-final-modal v-model="showModal" classes="modal-container" content-class="modal-content">
        <button class="modal__close" @click="modalnext">X</button>
        <span class="modal__title">Add Blog Successfuly</span>
        <div class="modal__content">
        <p>
            Congratulations ! You can get higher rankings by adding more articles.
        </p>
        <div class="modal__action">
        <button @click="modalnext">OK !</button>
      </div>
      </div>
    </vue-final-modal>
  </template>
  
  <script setup>
  import { PaperClipIcon } from '@heroicons/vue/20/solid';
  import axios from 'axios';
  import { useimageupload } from '../composables/useimageupload.js';
  import { reactive , ref , onMounted } from 'vue';
  import { VueFinalModal, ModalsContainer} from 'vue-final-modal';
  import {useRouter} from 'vue-router';
    let {imageUrl,  imagefile, onFileChanged}= useimageupload();
    const router = useRouter();
    const form = reactive({
        title : '',
        desc : '',
        content : '',
        selected : ''
    });
    let showModal = ref(false);
    // Categori Selected Process
    const selectcategory = ref(null);
    
    // Blog inserted process
    const addblog = async () => {
        let data = new FormData();
        data.append('image',imagefile.value);
        data.append('title',form.title);
        data.append('desc',form.desc);
        data.append('content',form.content);
        data.append('selected',form.selected);

        await axios.post('/api/addblog',data)
        .then((res) => {
            showModal.value = true;
        })
        .catch((err) => {
            console.log(err);
        });
    };
    const modalnext = () => {
        showModal.value = false;
        router.go(router.currentRoute);
    };
    // Categori List Load Select Option
    onMounted(async () => {
        await axios.post('/api/listencategory')
        .then((res) => {
            selectcategory.value = res.data.data; 
        })
        .catch((err) => {
            console.log(err);
        });
    });
    
  </script>
  <style scoped>
  ::v-deep .modal-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  ::v-deep .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    max-height: 90%;
    margin: 0 1rem;
    padding: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.25rem;
    background: #fff;
  }
  .modal__title {
    margin: 0 2rem 0.5rem 0;
    font-size: 1.5rem;
    font-weight: 700;
  }
  .modal__content {
    flex-grow: 1;
    overflow-y: auto;
  }
  .modal__action {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
    padding: 1rem 0 0;
  }
  .modal__close {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
  }
  .dark-mode div::v-deep .modal-content {
    border-color: #2d3748;
    background-color: #1a202c;
  }
  </style>