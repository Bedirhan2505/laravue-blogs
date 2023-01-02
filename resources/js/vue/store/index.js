import { createStore } from 'vuex';

const store = createStore({
    state: {
      token : localStorage.getItem('token') || 0
    },
    mutations: {
        update_token(state,payload){
            state.token = payload;
        }
    },
    getters: {
        getToken: function(state){
            return state.token;
        }
    },
    actions : {
        setToken(context, payload){
            localStorage.setItem('token',payload);
            context.commit('update_token',payload);
        },
        removeToken(context){
            localStorage.removeItem('token');
            context.commit('update_token', 0);
        }
    }
  });

  export default store;