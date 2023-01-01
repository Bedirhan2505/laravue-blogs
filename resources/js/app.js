import {createApp} from 'vue';
import App from './vue/App.vue';
import router from './vue/routes/index.js';
import '../css/app.css';
import '../../node_modules/bulma/css/bulma.css';

const app = createApp(App);
app.use(router);
app.mount('#app');