import {createApp} from 'vue';
import App from './vue/App.vue';
import router from './vue/routes/index.js';
import '../css/app.css';
import '../../node_modules/bulma/css/bulma.css';
import store from './vue/store/index.js';

const app = createApp(App);
app.use(router);
app.use(store);
app.mount('#app');