<template>
   <div>
        
        <div v-if="loading && !carts.length" class="row">
             <div class="col-md-8">
                <article>
                    <div class="cart-product-table-wrap">
                        <div    class="row cart-rows raised mb-4 pb-3 pt-3 mt-3 border border-gray">
                            <div class="col-md-7 col-6">
                                <span  class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading....
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        <div v-if="!loading && carts.length" class="row">
            <div class="col-md-8">
                <article>
                    <form action="/update/cart" method="" class="cart-form">
                        <input type="hidden" value="" name="_token" />
                        <div class="cart-product-table-wrap">
                            <cart-items />
                        </div>
                    </form>
                </article>
            </div>

            <div class="col-md-4">
                <div class="cart-collateralse  border pb-3 pt-3 pl-3 pt-3 pr-3 raised">
                    <div class="cart_totalse">
                        <h3> Summary </h3>
                        <div class="p-3 border-bottom">
                        <span class="bold ">Subtotal</span> 
                        <span class="price-amount amount bold float-right"><span class="currencySymbol">{{  meta.currency }}{{ meta.sub_total | priceFormat}}</span></span>
                        </div>
                        
                        <div class="p-3">
                        <span class="bold">Total</span> 
                            <span class="price-amount amount bold float-right"><span class="currencySymbol">{{  meta.currency }}{{ meta.sub_total | priceFormat}}</span></span>
                        </div>
                        <div class="proceed-to-checkout">
                            <a href="/checkout" class="checkout-button btn btn--lg btn--primary bold full-width">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Paragraph-->
        </div>
        
       
    </div>
</template>
<script>

import  { mapGetters,mapActions } from 'vuex'
import  CartItems from './Items'


export default {
     components: {
        CartItems,
    },
    data(){
        return {
           removeCart: 'Remove',
        }
    },
    computed: {
        ...mapGetters({
            carts: 'carts',
            meta:  'meta',
            loading:'loading'
        })
    },
    
    
}
</script>