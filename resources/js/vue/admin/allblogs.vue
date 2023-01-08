<template>
  <div class="container is-max-desktop mt-5">
    <ul class="card-wrapper">
      <li class="card" v-for="blog in bloglist" :key="blog.created_at">
            <footer class="card-footer">
              <router-link class="card-footer-item" :to="{name : 'blogdetails' , params : { slug : blog.slug }}">View</router-link>
              <router-link class="card-footer-item" :to="{name : 'blogdetails' , params : { slug : blog.slug }}">Edit</router-link>
              <router-link class="card-footer-item" :to="{name : 'blogdetails' , params : { slug : blog.slug }}">Delete</router-link>
            </footer>
        <img :src="blog.image" alt=''>
        <h3 class="ml-1"> {{ blog.title }} </h3>
        <p class="ml-2"><br>{{blog.desc}}</p>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { onMounted ,ref } from 'vue';
import axios from 'axios';
const bloglist = ref([]); 
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
</style>