<template>
   <div>
      <div v-if="!wishlist.length" class="row">
        <div class="col-9 col-md-12 mt-3">
            <article>
                <form action="#" method="" class="cart-form">
                    <input type="hidden" value="" name="_token" />
                    <div class="cart-product-table-wrap">
                            <div v-for="item in wishlist"  :key="item.id" v-if="item.product_variation" class="row cart-rows mb-4 pb-2">
                                <div class="col-md-3">
                                    <div class="cart-image">
                                        <img :src="item.product_variation.image" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6><a href="#">{{ item.product_name }}</a></h6>
                                    <p class="cart-item-number" v-if="item.product_variation"> Item# {{ item.product_variation.sku }}</p>
                                    
                                    <p><span class="cart-product-price">{{ item.product_variation.currency }}{{  item.product_variation.converted_price }}</span></p>
                                </div>

                                <div class="col-md-2">
                                    
                                    <a @click.prevent="removeFromWishlist(item.id)" href="#"  class="btn btn-transparent "> 
                                        <span class="button-icon"> 
                                            <i class="far fa-trash-alt "></i>
                                        </span>
                                        Remove 
                                    </a> 
                                </div>
                            </div>
                        
                    </div>
                </form>
            </article>
        </div>
       
    
        <!--End Paragraph-->
        
    </div>
    <div class="row" v-if="!wishlist.length">
        <section class="sec-padding-b">
            <div class="container">
                <p class="lead">You don't have any wishlist </p>
                <p class=""><a href="/">Continue shopping >>></a> </p>
            </div>
        </section>
    </div>


    </div>

</template>
<script>

import  { mapGetters,mapActions } from 'vuex'

export default {
   
    computed: {
        ...mapGetters({
            wishlist: 'wishlist',
        })
    },
    mounted(){
        console.log(this.wishlist)
    },
     methods: {
        ...mapActions({
            deleteWishlist: 'deleteWishlist',
        }),
        removeFromWishlist(id){
            this.deleteWishlist({
                id:id
            })
        },
        

    }
    
}
</script>