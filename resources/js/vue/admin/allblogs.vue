<template>
  <div class="container is-max-desktop mt-5" v-if="bloglist.length != 0">
    <ul class="card-wrapper" >
      <li class="card" v-for="blog in bloglist" :key="blog.created_at">
            <footer class="card-footer">
              <router-link class="card-footer-item" :to="{name : 'blogdetails' , params : { slug : blog.slug }}">View</router-link>
              <router-link class="card-footer-item" :to="{name : 'blogdetails' , params : { slug : blog.slug }}">Edit</router-link>
              <a @click="deleteModal(blog.id)" class="card-footer-item">Delete</a>
            </footer>
        <img :src="blog.image" alt=''>
        <h3 class="ml-1"> {{ blog.title.substring(0,29) }} ... </h3>
        <p class="ml-2"><br>{{blog.desc.substring(0,250)}} ...</p>
      </li>
    </ul>
  </div>
  <div class="container" v-else>
        <h3>No Records Found</h3>
  </div>
  <vue-final-modal v-model="showModal3" classes="modal-container" content-class="modal-content">
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
import { useRouter } from 'vue-router';
import { VueFinalModal, ModalsContainer} from 'vue-final-modal';
import { onMounted ,ref, reactive } from 'vue';
import axios from 'axios';

const router = useRouter();
const bloglist = ref([]); 
let showModal3 = ref(false);
const blogid = reactive({
    "id" : null,
  });
 // Categori List Load Select Option
 onMounted(async () => {
        await axios.post('/api/blogslist')
        .then((res) => {
            bloglist.value = res.data.data; 
        })
        .catch((err) => {
            console.log(err);
        });
    });
    const modalback = () => {
        showModal3.value = false;
    };
    function back() {
    router.go(-1)
  };
  const deleteModal = (id) => {
      showModal3.value= true;
      blogid.id = id ;
  };
  const modalnext =async () => {
       if(blogid.id != null) {
          await axios.post('/api/blogdelete',blogid)
            .then((res) => {
                if(res.data.success == true){
                  showModal3.value= false;
                  back();
                } else{
                  showModal3.value= true;
                  console.log(res.data.message);
                }
            })
            .catch((err) => {
                console.log(err);
            }); 
        }  
    };
</script>

<style scoped>
.card {
  --card-gradient: rgba(0, 0, 0, 0.8);
  --card-gradient: #5e9ad9, #0c2746;


  background-color: #fff;
  border-radius: 0.5rem;
  box-shadow: 0.05rem 0.1rem 0.3rem -0.03rem rgba(0, 0, 0, 0.45);
  padding-bottom: 1rem;
  background-image: linear-gradient(
    var(--card-gradient),
    white max(9.5rem, 27vh)
  );
  overflow: hidden;
}
img {
    border-radius: 0.5rem 0.5rem 0 0;
    width: 100%;
   
    max-height: max(10rem, 30vh);
    aspect-ratio: 4/3;
   
}

img:hover,
img:focus-within {
    --card-gradient: #24a9d5 max(8.5rem, 20vh);
}
* {
  box-sizing: border-box;
}

body {
  display: grid;
  place-content: center;
  justify-items: center;
  min-height: 100vh;
  margin: 0;
  padding: 1rem;
  line-height: 1.5;
  font-family: -apple-system, BlinkMacSystemFont, avenir next, avenir,
    helvetica neue, helvetica, Ubuntu, roboto, noto, segoe ui, arial, sans-serif;
  color: #444;
  background-color: #e1faf1;
}

.card h3 {
  margin-top: 1rem;
  font-size: 1.25rem;
}

.card a {
  color: white;
}
.card a:hover {
  background: #0c2746;
}
.card-wrapper {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(30ch, 1fr));
  grid-gap: 1.5rem;
  max-width: 100vw;
  width: 120ch;
  padding-left: 1rem;
  padding-right: 1rem;
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