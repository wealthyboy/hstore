<template>
      <div :class="rowClass" class="col-6">
        <div class="product-default inner-quickview inner-icon">
            <figure>
                <a :href="product.link">
                    <img :src="product.image_to_show_m" :alt="product.product_name" />
                </a>
                <div class="label-group">
                    <div  v-if="product.default_percentage_off" class="product-label label-sale">-{{ product.default_percentage_off }}%</div>
                </div>
                <div class="btn-icon-group">
                    <button  v-if="!$root.loggedIn" data-toggle="modal" data-target="#login-modal"  :style=" [wishlistIsActive ? wishA : '']"  class="btn-icon btn-add-cart" @click="addToWishList(product.default_variation_id)"><i :style=" [wishlistIsActive ? wishA : '']"  class="icon-heart"></i></button>
                    <button   v-if="$root.loggedIn"  :style=" [wishlistIsActive ? wishA : '']"  class="btn-icon btn-add-cart" @click="addToWishList(product.default_variation_id)"><i :style=" [wishlistIsActive ? wishA : '']"  class="icon-heart"></i></button>
                </div>
            </figure>
            <div class="product-details text-center">
                <div class="mx-auto">
                    <div v-if="product.brand_name" class="product-brand bold">
                        {{ product.brand_name }}
                    </div>
                    <div class="">
                        <a :href="product.link">{{ product.product_name }}</a>
                    </div>
                </div>
                <div class="price-box mx-auto mt-1">
                    <template v-if="product.default_discounted_price">
                        <span class="old-price">{{ product.currency }}{{ product.converted_price | priceFormat  }}</span>
                        <span class="product-price">{{ product.currency }}{{ product.default_discounted_price | priceFormat }}</span>
                    </template>
                    <template v-else>
                        <span class="product-price">{{ product.currency }}{{ product.converted_price | priceFormat }}</span>
                    </template>
                </div><!-- End .price-box -->
            </div><!-- End .product-details -->
        </div>
        <login-modal />

    </div><!-- End .col-sm-4 -->
   
</template>

<script>
import  { mapGetters,mapActions } from 'vuex'
import  LoginModal from '../auth/LoginModal.vue'


export default {
    props:{
        product:Object,
        category:Object,
        user: Object,
    }, 
    components:{
       LoginModal
    },
    data(){
        return {
            product_variation_id: '',
            is_wishlist: this.product.item_is_wishlist,
            wishA: {
                background: '#222',
                color: '#ffffff'
            },
        }
    },
    computed: {
        ...mapGetters({
            loggedIn:'loggedIn',
            wishlist:'wishlist',
        }),
        rowClass: function () {
           return Object.keys(this.category)[0] == 'no_attributes' ? 'col-lg-3 col-md-3' : 'col-lg-4 col-md-4'
        },
        wishlistIsActive: function(){
            if (this.wishlist.length){
                if(this.wishlist.some(wishlist => wishlist.product_variation.id === this.product.default_variation_id)){
                   return '#222';
                }
            }
            
            return false;
        }
    },
   
    methods: {
        ...mapActions({
            addProductToWishList: 'addProductToWishList'
        }),
        addToWishList: function(product_variation_id){
            this.addProductToWishList({
                product_variation_id:product_variation_id,
            }).then((response)=>{
                if(this.wishlist.some(wishlist => wishlist.product_variation.id === product_variation_id)){
                    $("#addCartModal").modal('show') 
                } 
                
            })
        },
        


    },
    
}
</script>