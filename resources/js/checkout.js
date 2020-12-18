
require('./bootstrap');

window.Vue = require('vue');
import store from './store'

const CheckoutIndex = require('./components/checkout/CheckoutIndex.vue').default
const Messages =  require('./components/message/index.vue').default
const Addresses =  require('./components/checkout/Address.vue').default


let token = document.head.querySelector('meta[name="csrf-token"]');
Window.token = token.content

Vue.filter('priceFormat',function(value){
    return new Intl.NumberFormat().format(value);
});

const app = new Vue({
    el: '#app',
    store, 
    components:{
        CheckoutIndex,
        Messages,
        Addresses,
       
    }   
});
