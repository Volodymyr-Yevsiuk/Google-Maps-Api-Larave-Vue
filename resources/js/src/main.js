import Vue from 'vue'
import App from './App.vue'
import VueRouter  from 'vue-router'
import router from './router/route.js'

import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBjR-olNjXwUPM5WcuZYCgcOBxF61sNByU'
    },
    installComponents: false
})

Vue.use(VueRouter)

Vue.component('gmap', VueGoogleMaps.Map);
Vue.component('gmap-marker', VueGoogleMaps.Marker);
Vue.component('gmap-info-window', VueGoogleMaps.InfoWindow);

new Vue({
    render: h => h(App),
    router
  }).$mount('#app')
  