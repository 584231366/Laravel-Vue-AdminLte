window.Vue = require('vue');
window.Vuex = require('vuex');
Vue.use(Vuex);
window.store =new Vuex.Store({
  state: {
    user: null,
    token: null
  },
  mutations: {
  	initVuex (state){
  		var localstate = localStorage.getItem('state')
  		if(localstate){
  			localstate = JSON.parse(localstate)
  			for(var i in localstate){
  				state[i] = localstate[i]
  			}
        window.axios.defaults.headers.Authorization = state.token.token_type + " " + state.token.access_token;
  		}
  	},
    clearState (state) {
      localStorage.removeItem('state')
    },
    setUser (state,user) {
        state.user = user
        localStorage.setItem('state', JSON.stringify(state))
    },
    setToken (state,token) {
        state.token = token
        localStorage.setItem('state', JSON.stringify(state))
    }
  }
})