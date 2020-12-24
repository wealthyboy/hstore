
<template>
    <div>
        <div v-if="paymentIsComplete" class="page-contaiter">
            <!--Content-->
            <section class="sec-padding--lg vh--100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="error-page text-center">
                                <h1>Thank you for shopping with us</h1>
                                <p class="large">Your order has been received .</p>
                                <p class="large"></p>
                                <!--<div class="widget">
                                    <form class="search-form">
                                        <input class="search-field input--lg" placeholder="Search.." value="" name="s" type="search">
                                        <button type="submit" class="search-button btn btn--primary btn--lg">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>-->
                                <a href="/" class="btn btn--primary space-t--2">Continue</a>
                                <a href="/orders" class="btn btn--primary space-t--2">View order history</a>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--End Content-->
        </div>
        <div  v-if="!pageIsLoading && !paymentIsComplete" class="container   mt-1">
            <div  class="row d-none justify-content-center">
                <ul class="checkout-progress-bar">
                    <li :class="{'active': !addresses.length}">
                        <span>Shipping Address</span>
                    </li>
                    <li :class="{'active': addresses.length}">
                        <span>Review &amp; Payments</span>
                    </li>
                </ul>
            </div>
            <div  class="row   align-items-start">
                <div class="col-12 col-md-7">
                    <div class="col-md-12 m7 bg--light border border-gray mb-2">
                        <div class="head  border-bottom  pt-3 mb-3">
                            <h3>1. SHIPPING ADDRESS</h3>
                        </div>
                        <ship-address   />
                    </div>

                    <div class="col-md-12 bg--light ">
                    <div class="pt-3 pb-2 ">
                        <span class="float-right">
                            <div class="payment-icons mt-1 d-flex">
                                 <div class="payment-image ms mr-3">
                                    <img src="/img/business.png"  alt="make payment with mastercard">
                                </div>
                                <div class="payment-image mr-3">
                                    <img src="/img/visa-card-ohram.png"  alt="make payment with mastercard">
                                </div>

                                <div class="payment-image">
                                    <img src="/img/Verve.png"  alt="make payment with mastercard">
                                </div>
                            </div>
                           
                        </span>
                        <h3>2. PAYMENT</h3>
                    </div>
                    <div class="row" v-if="addresses.length" id="add-new-address-form" >
                        <div class="form-field-wrapper  col-sm-12 ">
                            <div v-for="cart in carts"  :key="cart.id" class="row cart-rows  mb-2 pt-4 pb-2 border-top border-gray">
                                <div class="col-md-3 col-6">
                                    <div class="cart-image">
                                        <img :src="cart.product_variation.image_tn" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8 col-6">
                                    <div class="tag mb-1 brand-name bold color--gray">{{ cart.brand }}</div>

                                    <div class="mb-1"><a href="#">{{ cart.product_name }}</a></div>
                                    <!--Product Ratting-->
                                    <div class="product-item-prices d-flex"  v-if="cart.product_variation.discounted_price">
                                        <div class="product--price--amount">
                                            <span class="retail--title text-gold">SALE PRICE</span>
                                            <span class="product--price text-danger">{{ meta.currency }}{{ cart.product_variation.discounted_price | priceFormat }}</span>
                                            <span class="retail--title">{{ cart.product_variation.percentage_off }}% off</span>
                                        </div>

                                        <div class="product--price--amount retail ml-5 ">
                                            <span class="retail--title text-gold">PRICE</span>
                                            <span class="product--price retail--price ">{{ meta.currency }}{{ cart.product_variation.price | priceFormat }}</span>
                                            <span class="retail--title"></span>
                                        </div>
                                    </div>

                                        <div class="product-item-prices" v-else>
                                            <div class="product--price--amount">
                                                <span class="retail--title text-gold">PRICE</span>
                                                <span class="product--price">{{ meta.currency }}{{ cart.price | priceFormat}}</span>
                                                <span class="retail--title"></span>
                                            </div>
                                        </div>
                                        <p v-if="cart.variations.length"> {{ cart.variations.toString() }}</p>
                                    </div>
                                    
                                </div>
                                <p class="border-bottom pb-3">
                                    <span  style="font-size: 22px;" class="bold">Subtotal</span> 
                                        <span class="float-right"><span  style="font-size: 22px" class="currencySymbol f-20 bold">{{  meta.currency }}{{ meta.sub_total | priceFormat}}</span>
                                    </span>
                                </p>
                                <div class="border-bottom pb-3">
                                    <span class="bold">Shipping</span> 

                                    <span class="float-right">
                                        <span v-if="shipping_price" class="currencySymbol bold">{{  meta.currency }}{{ shipping_price }}</span>
                                        <span class="" v-else>{{  shippingIsFree }}</span>
                                    </span>
                                </div>

                                <div class="cart-discount  mt-3 col-sm-12">
                                    <h4>Apply Discount Code</h4>
                                    <div class="input-group">
                                        <input type="text" v-model="coupon"  class="form-control" placeholder="Enter discount code" required="">
                                        <div class="input-group-append">
                                            <button  @click.prevent="applyCoupon" class="btn btn-sm btn-primary" type="submit">
                                                <span v-if="submiting" class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>
                                                Apply Coupon
                                            </button>
                                        </div>
                                    </div><!-- End .input-group -->
                                </div>
                        
                                <span v-if="coupon_error"  class="text-capitalize bold ml-3 text-danger">{{coupon_error}}</span >

                                <h4>Choose Delivery Option</h4>
                                <div :class="{'border-danger': delivery_error}" class="border pl-3 mb-1 ">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="1 Bassie Ogamba Street, off Adeniran Ogunsanya , SURULERE (₦200 to be paid at pick up address" v-model="delivery_option" class="custom-control-input" id="pick_up_surulere" name="delivery_option" required>
                                        <label class="custom-control-label" for="pick_up_surulere"> PICK UP OPTION 1  <span class="ml-3 text-info">(1 Bassie Ogamba Street, off Adeniran Ogunsanya , SURULERE (₦200 to be paid at pick up address)   Pick up resumes 4th January 2021</span></label>
                                    </div>
                                    <div class="custom-control custom-radio ">
                                        <input type="radio" value="Plot 14, Gbelegbo street, by TOB Plaza, MAGODO PHASE 1, OLOWORA. Tejumade" v-model="delivery_option" class="custom-control-input" id="pick_up_magodo" name="delivery_option" required>
                                        <label class="custom-control-label" for="pick_up_magodo">  PICK UP OPTION 2  <span class="ml-3  text-info">(Plot 14, Gbelegbo street, by TOB Plaza, MAGODO PHASE 1, OLOWORA. )</span></label>
                                    </div>
                                </div>
                                <div :class="{'border-danger': delivery_error}" class="border pl-3 mb-1">
                                    <div  class="custom-control  mt-1 mb-1 custom-radio mt-1 mb-1">
                                        <input type="radio" value="Stock Pilling" v-model="delivery_option" class="custom-control-input" id="stock_pilling" name="delivery_option" required>
                                        <label class="custom-control-label" for="stock_pilling">Stock Pile  <span class="ml-3  text-info">Free for 1st month after which ₦500 applies every week</span></label>
                                    </div>
                                </div>
                                 
                                <div :class="{'border-danger': delivery_error}" class="border pl-3 mb-1">
                                    <div class="custom-control  custom-radio mt-1 mb-1">
                                        <input type="radio" value="shipping" v-model="delivery_option" class="custom-control-input" id="shipping" name="delivery_option" required>
                                        <label class="custom-control-label" for="shipping">Shipping</label>
                                    </div>
                                </div>

                                
                          
                                <p  class="">
                                    <p  class="form-field-wrapper   col-sm-12">
                                        <form method="POST"  id="checkout-form-2" class="form-group" action="/checkout/confirm">
                                            <div v-if="$root.settings.shipping_is_free == 0 && delivery_option =='shipping' " class="shipping  select-custom">
                                                <label for="shipping_country">SELECT SHIPPING &nbsp;<abbr class="required text-danger" title="required">*</abbr></label>
                                                <select @change="addShippingPrice"  name="shipping_id" id="shipping_price" class="form-control  input--lg" autocomplete="shipping" tabindex="-1" aria-hidden="true">
                                                    <option value="" selected="selected">Choose a shipping</option> 
                                                    <optgroup  v-for="(map, key) in  default_shipping" :key="key" :label="key">
                                                        <option :data-id="shipping.id"  :key="shipping.id" v-for="shipping in map"  :value="shipping.converted_price">{{ shipping.name }}  &nbsp;&nbsp;&nbsp;{{ meta.currency }}{{ shipping.converted_price }}</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <span  v-if="error" class="" role="" >
                                                <strong  class="text-danger">{{ error }}</strong>
                                            </span>

                                            <div class="form-group required-field mt-1">
                                                <label for="contact-message">Delivery Notes</label>
                                                <textarea cols="30" rows="1" v-model="delivery_note" id="contact-message" class="form-control" name="delivery_note"></textarea>
                                            </div>

                                            
                                           
                                            <input type="hidden" :value="csrf.csrf" name="_token" />
                                            <input type="hidden" :value="shipping_id" name="ship_id" />
                                            <input type="hidden" :value="payment_method" name="payment_method" />
                                            
                                        </form>
                                        
                                    </p>
                                
                                    <p>
                                        <span    class="bold fa-2x ml-3">Total</span> 
                                        <template v-if="voucher.length">
                                            <span class="price-amount amount bold float-right mr-3">
                                                <span  class="currencySymbol fa-2x text-danger"><del>{{ meta.currency }}{{  meta.sub_total | priceFormat }}</del></span>
                                            </span>
                                            <span class="price-amount amount bold float-right mr-3">
                                                <span style="" class="currencySymbol fa-2x">{{ meta.currency }}{{ amount ||  meta.sub_total | priceFormat }}</span>
                                                <p class="retail-title fa-1x">{{ voucher[0].percent }}</p>
                                            </span>
                        
                                        </template>
                                        <template v-else>
                                            <span class="price-amount amount bold float-right mr-3">
                                                <span style="" class="currencySymbol fa-2x">{{ meta.currency }}{{ amount ||  meta.sub_total | priceFormat }}
                                                </span>
                                            </span>
                                        </template>
                                    </p>
                            </div>


                            <p class="form-field-wrapper   col-sm-12 mb-3">
                                
                                <template v-if="!meta.isAdmin">
                                    <button @click="payWithPaystack" type="button" :class="{'disabled': payment_is_processing}" class="btn   bold  btn--primary btn-round btn-lg btn-block" name="checkout_place_order" id="p lace_order" value="Place order" data-value="Place Order">
                                        <span v-if="checkingout" class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>
                                        {{ order_text }}
                                    </button>
                                </template >

                                <template  v-if="meta.isAdmin">
                                    <button @click="payAsAdmin" type="button" :class="{'disabled': payment_is_processing}" class="btn   bold  btn--primary btn-round btn-lg btn-block" name="checkout_place_order" id="p lace_order" value="Place order" data-value="Place Order">
                                        <span v-if="checkingout" class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>
                                        {{ order_text }}
                                    </button>
                                </template >
                                
                            </p>
                        </div>
                    </div>

                
                </div>
                <div class="col-5">
                   <div class="col-md-12 d-none d-lg-block  mb-3">
                    <div class="cart-collateralse bg--light  border pb-3 pt-3 pl-3 pt-3 pr-3">
                        <div class="cart_totalse">
                            <div class="head  border-bottom">
                                <h3>SUMMARY</h3>
                            </div>

                            <div v-for="cart in carts"  :key="cart.id" class="row cart-rows  mb-2 pt-4 pb-2 border-top border-gray">
                                <div class="col-md-3 col-6">
                                    <div class="cart-image">
                                        <img :src="cart.product_variation.image_tn" alt="">
                                    </div>
                                </div>
                                <div class="col-md-9 col-6">
                                    <div class="tag mb-1 brand-name bold color--gray">{{ cart.brand }}</div>

                                    <div><a href="#">{{ cart.product_name }}</a></div>
                                    <!--Product Ratting-->
                                    <div class="product-item-prices d-flex"  v-if="cart.product_variation.discounted_price">
                                        <div class="product--price--amount mr-5">
                                            <span class="retail--title text-gold">SALE PRICE</span>
                                            <span class="product--price text-danger">{{ meta.currency }}{{ cart.product_variation.discounted_price | priceFormat }}</span>
                                            <span class="retail--title">{{ cart.product_variation.percentage_off }}% off</span>
                                        </div>

                                        <div class="product--price--amount retail ml-5">
                                            <span class="retail--title text-gold">PRICE</span>
                                            <span class="product--price retail--price ">{{ meta.currency }}{{ cart.product_variation.price | priceFormat }}</span>
                                            <span class="retail--title"></span>
                                        </div>
                                    </div>

                                        <div class="product-item-prices" v-else>
                                            <div class="product--price--amount">
                                                <span class="retail--title text-gold">PRICE</span>
                                                <span class="product--price">{{ meta.currency }}{{ cart.price | priceFormat}}</span>
                                                <span class="retail--title"></span>
                                            </div>
                                        </div>
                                        <p v-if="cart.variations.length"> {{ cart.variations.toString() }}</p>
                                    </div>
                                    
                                </div>
                           
                            <p class="pt-3 pb-1">
                                <span style="font-size: 22px;"  class="bold">Subtotal</span> 
                                <span class="bold float-right"><span class="currencySymbol">{{  meta.currency }}{{ meta.sub_total | priceFormat}}</span></span>
                            </p>
                            <p class="border-top border-bottom pb-3 pt-3">
                            <span class="bold">Shipping</span> 
                                <span class="bold float-right">
                                    <span v-if="shipping_price" class="currencySymbol">{{  meta.currency }}{{ shipping_price }}</span>
                                    <small v-else> {{ shippingIsFree }}</small>
                                </span>
                            </p>
                            
                            <p>
                            <span style="font-size: 28px" class="bold ">Total</span> 
                                <span class="price-amount amount bold float-right"><span style="font-size: 28px" class="currencySymbol">{{ meta.currency }}{{ amount ||  meta.sub_total | priceFormat }}</span></span>
                            </p>
                            <div class="proceed-to-checkout"></div>

                        </div>
                    </div> 
                </div>
                </div>
            </div>
        </div>

        
    </div>

</template>
<script>
import  ShipAddress from './ShipAddress'
import  message from '../message/index'
import  axios from 'axios'
import  { mapGetters,mapActions } from 'vuex'
import  ErrorMessage from '../messages/components/Error'


export default {

    components: {
        ShipAddress,
        message,
        ErrorMessage,
    },
    props:{
       csrf: Object
    },
    data(){
        return {
            coupon: '',
            coupon_code: '',
           locations: [],
           shipping_id: null,
           shipping_price:'',
           email: "jacob.atam@gmail.com", 
           amount: 0,
           delivery_error: false,
           shipping:false,
           delivery_option: null,
           order_text: 'Place Order',
           payment_is_processing: false,
           voucher: [],
           error: null,
           showForm: false,
           scriptLoaded: null,
           submiting:false,
           checkingout:false,
           coupon_error: null,
           token: Window.csrf,
           payment_method: null,
           loading: false,
           pageIsLoading: true,
           delivery_note:null,
           paymentIsComplete:false,
           uemail: null,
        }
    },
    computed: {
      ...mapGetters({
            carts: 'carts',
            meta:  'meta',
            addresses: "addresses",
            default_shipping: "default_shipping",
        }), 
        shippingIsFree(){
          return  this.$root.settings.shipping_is_free == 0 ? 'Shipping is based on your location' : this.meta.currency+'0.00'
        }   

    },
    watch: {
        // whenever delivery_option changes, this function will run
        delivery_option: function (val) {
            this.delivery_error = false
            /**
             * If the delivery option changes 
             */

            if (val != 'shipping'){
                this.shipping_id =null;
                this.shipping_price = 0
            }
            
            if (this.voucher.length  && !this.shipping_price){
                this.shipping_price = 0
                this.amount = this.voucher[0].sub_total
                this.shipping_id =null;
                return
            } else if(this.voucher.length && this.shipping_price){
                this.amount =  parseInt(this.shipping_price) + parseInt(this.voucher[0].sub_total);
                return;
            } else {
                this.amount = this.meta.sub_total
                this.shipping_id =null;
                return
            }
        }
    },
    created() {
        this.scriptLoaded = new Promise((resolve) => {
            this.loadScript(() => {
                resolve()
            })
        })
        this.getCart()
        this.getAddresses({ context: this  }).then(() => {  document.getElementById("full-bg").style.display = 'none'; this.pageIsLoading = false;   })
    },
    methods: {
        ...mapActions({
           getCart: "getCart"
        }),
        loadScript(callback) {
            const script = document.createElement('script')
            script.src = 'https://js.paystack.co/v1/inline.js'
            document.getElementsByTagName('head')[0].appendChild(script)
            if (script.readyState) {  // IE
                script.onreadystatechange = () => {
                    if (script.readyState === 'loaded' || script.readyState === 'complete') {
                        script.onreadystatechange = null
                        callback()
                    }
                }
            } else {  // Others
                script.onload = () => {
                    callback()
                }
            }
        },
        payWithPaystack: function(){
            if(!this.delivery_option){
                this.delivery_error = true
                return
            }
            let context = this
            var cartIds = [];
            this.carts.forEach(function(cart,key){
                cartIds.push(cart.id)
            }) 
            if ( !this.addresses.length ){
                this.error = "You need to save your address before placing your order"
                return false;
            }

            if (this.delivery_option == 'shipping' && this.$root.settings.shipping_is_free == 0   && !this.shipping_price ){
                this.error = "Please select your shipping method"
                return false;
            } 

            let form = document.getElementById('checkout-form-2')
            this.order_text =  'Please wait. We are almost done......'
            this.payment_is_processing =true
            this.payment_method ='card'
            var handler = PaystackPop.setup({
                key: 'pk_live_c4f922bc8d4448065ad7bd3b0a545627fb2a084f',//'pk_live_c4f922bc8d4448065ad7bd3b0a545627fb2a084f',//'pk_test_844112398c9a22ef5ca147e85860de0b55a14e7c',
                email: context.meta.user.email,
                amount: context.amount * 100,
                currency: "NGN",
                first_name: context.meta.user.name,
                metadata: {
                    custom_fields: [
                        {
                           display_name: context.meta.user.name,
                           customer_id: context.meta.user.id,
                           coupon: context.coupon_code,
                           shipping_id: context.shipping_id,
                           shipping_price: context.shipping_price,
                           cart: cartIds,
                           total:context.amount,
                           delivery_option: context.delivery_option,
                           delivery_note: context.delivery_note
                        }
                    ] 
                },
                callback: function(response){
                    if (response.status == 'success'){
                           context.paymentIsComplete =true
                    } else {
                        this.error = "We could not complete your payment"
                        context.order_text =  'Place Order'
                    }

                },
                onClose: function(){
                    context.order_text =  'Place Order'
                    context.checkingout = false
                    context.payment_is_processing =false
                }
            })
            handler.openIframe();
        },
        payAsAdmin: function(){
            if(!this.delivery_option){
                this.delivery_error = true
                return
            }
             
            if ( !this.addresses.length ){
                this.error = "You need to save your address before placing your order"
                return false;
            }

            if (this.delivery_option == 'shipping' && this.$root.settings.shipping_is_free == 0   && !this.shipping_price ){
                this.error = "Please select your shipping method"
                return false;
            }

            this.payment_method ='admin'

            this.order_text =  'Please wait. We are almost done......'
            this.checkout()

        },
        addShippingPrice:  function(evt){
            if (evt.target.value  == ''){
               return;
            }
            this.shipping_id  = evt.target.selectedOptions[0].dataset.id;
            this.shipping_price =  evt.target.value
            //check if a voucher was applied 
            if ( this.voucher.length ){
                this.amount = parseInt( evt.target.value ) + parseInt(this.voucher[0].sub_total);
            } else {
                this.amount = parseInt( evt.target.value ) + parseInt(this.meta.sub_total);
            }
            let obj = {
                sub_total: this.meta.sub_total,
                currency: this.meta.currency,
                user: this.meta.user,
                shipping_id: this.shipping_id,
                isAdmin: this.meta.isAdmin
            }
            Window.CartMeta=obj
            this.updateCartTotal(obj)
        },
        ...mapActions({
            getCart:'getCart',
            applyVoucher: 'applyVoucher',
            updateCartMeta:'updateCartMeta',
            getAddresses: "getAddresses",
        }), 
        applyCoupon: function(){
            if (!this.coupon){
                this.coupon_error = "Enter a coupon code"
                setTimeout(() => {
                   this.error = null
                }, 2000);
                return;
            }
            this.coupon_code = this.coupon
            this.coupon_error = null;
            this.submiting =true
            axios.post('/checkout/coupon',{
                coupon:this.coupon,
            }).then((response) => {
                this.submiting =false
                this.coupon = ''
                this.voucher.push(response.data)
                if (this.shipping_price){
                    this.amount =  parseInt(this.shipping_price) + parseInt(response.data.sub_total);
                } else{
                    this.amount =  parseInt(response.data.sub_total);
                }
            }).catch((error) => { 
                this.submiting =false
                this.coupon_error = error.response.data.error 
                if ( error.response.status){
                    this.submiting =false
                } 
            })
        },
        checkout: function(){
            this.order_text =  'Please wait. We are almost done......'

            axios.post('/checkout/confirm',{
                shipping_id:  this.shipping_id,
                payment_type: 'admin',
                admin: this.meta.isAdmin ? 'admin' : 'online',
                pending:false,
                email:this.uemail
            }).then((response) => {
                console.log(response)
                context.paymentIsComplete =true
            }).catch((error)=>{
                this.order_text = "Place Order"
                this.payment_is_processing = false
                this.checkingout = false
                this.error = "We could not complete your order."
            })
        },
        updateCartTotal: function(obj){
            this.updateCartMeta(obj)
        }
    }
}
</script>

