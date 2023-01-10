<template>
  <div class="container is-desktop mt-5">
    <div class="card" v-for="blog in bloglist" :key="blog.id">
      <div class="card-menu">
        <div class="card-footer">
        <a @click="back" class="card-footer-item">Back</a>
        <a @click="deleteModal(blog.id)" class="card-footer-item">Delete</a>
        </div>
      </div>
      <div class="card-image">
        <figure class="image is-3by1">
          <img :src="blog.image" alt="Placeholder image">
        </figure>
      </div>
      <div class="card-content">
        <div class="media">
          <div class="media-content">
            <p class="title is-4">{{blog.title}}</p>
            <p class="subtitle is-6">@{{blog.author}}</p>
          </div>
        </div>

        <div class="content">
          {{ blog.content }}
          <br>
          <time datetime="2016-1-1">{{blog.created_at}}</time>
        </div>
      </div>
    </div>
  </div>
  <vue-final-modal v-model="showModal2" classes="modal-container" content-class="modal-content">
        <button class="modal__close" @click="modalback">X</button>
        <span class="modal__title">Delete Blog Confirm</span>
        <div class="modal__content">
        <p>
          Are you sure you want to delete this article ? This action will not be reversible.
        </p>
        <div class="modal__action">
        <button class="button is-danger" @click="modalnext">OK !</button> 
        <button class="button is-primary ml-2" @click="modalback"> Cancel</button>
      </div>
      </div>
    </vue-final-modal>
</template>

<script setup>
import axios from 'axios';
import {ref, reactive, onMounted} from 'vue';
import { useRoute , useRouter } from 'vue-router';
import { VueFinalModal, ModalsContainer} from 'vue-final-modal';

  const route = useRoute();
  const router = useRouter();
  const slug = reactive({
    "slug" : route.params.slug,
  });
  let bloglist = ref([]);
  let showModal2 = ref(false);
  const blogid = reactive({
    "id" : null,
  });

  const modalnext =async () => {
       if(blogid.id != null) {
          await axios.post('/api/blogdelete',blogid)
            .then((res) => {
                if(res.data.success == true){
                  showModal2.value= false;
                  back();
                } else{
                  showModal2.value= true;
                  console.log(res.data.message);
                }
            })
            .catch((err) => {
                console.log(err);
            }); 
        }  
    };
  const modalback = () => {
        showModal2.value = false;
    };

  const deleteModal = (id) => {
      showModal2.value= true;
      blogid.id = id ;
  };

  function back() {
    router.go(-1)
  };


  onMounted(async () => {
        await axios.post('/api/blogsdetails',slug)
        .then((res) => {
            if(res.data.success == true){
              bloglist.value = res.data.data;
              console.log(bloglist.value);
            } else{
              router.go(-1);
              console.log(res.data.message);
            }
        })
        .catch((err) => {
            console.log(err);
        });
    });
</script>

<style scoped>
.card a {
  background: #001936;
  color: white;
}
.card a:hover {
  background: #0c2746;
}
.card-menu{
  max-width: 300px;
  z-index: 1;
  position: absolute;
  right: 0px;
}
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