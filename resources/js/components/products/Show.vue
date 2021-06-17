<template>
  <div class="">
    <div class="product-single-container product-single-default">
      <div class="row">
        <div class="col-md-1 product-single-gallery d-none d-lg-block">
          <div
            class="prod-thumbnail carousel-custom-dots owl-dots"
            id="carousel-custom-dots"
          >
            <div class="owl-dot">
              <img
                class="animated"
                @click.prevent="currentSlide(product.image_to_show)"
                :src="image_tn"
              />
            </div>
            <div
              @click.prevent="currentSlide(image.image)"
              v-for="image in images"
              :key="image.id"
              class="owl-dot"
            >
              <img :src="image.image_tn" :alt="image.image_tn" />
            </div>
          </div>
        </div>
        <div class="col-md-6 product-single-gallery">
          <div class="product-slider-container">
            <div class="product-single-carousel owl-carousel owl-theme">
              <div class="product-item">
                <img
                  class="product-single-image"
                  :data-zoom-image="image"
                  :src="image"
                />
              </div>
              <div v-for="image in images" :key="image.id" class="product-item">
                <img
                  class="product-single-image"
                  :data-zoom-image="image.image"
                  :src="image.image"
                  v-if="image.image !== ''"
                  :alt="image.image_tn"
                />
              </div>
            </div>
          </div>
        </div>
        <!-- End .product-single-gallery -->
        <div class="d-none d-xs-block d-block d-lg-none d-sm-block d-md-none">
          <div
            class="prod-thumbnail d-flex carousel-custom-dots owl-dots"
            id="carousel-custom-dots"
          >
            <div class="owl-dot">
              <img
                class="animated"
                @click.prevent="currentSlide(product.image_to_show)"
                :src="image_tn"
              />
            </div>
            <div
              @click.prevent="currentSlide(image.image)"
              v-for="image in images"
              :key="image.id"
              class="owl-dot"
            >
              <img :src="image.image_tn" :alt="image.image_tn" />
            </div>
          </div>
        </div>

        <div class="col-md-5 product-single-details">
          <div class="p">
            <div v-if="product.brand" class="tag brand-name bold">
              {{ product.brand_name }}
            </div>

            <p class="product-title bold">{{ name }}</p>

            <div
              class="product-item-prices d-flex mt-2"
              v-if="discounted_price"
            >
              <div class="product--price--amount">
                <span class="retail--title text-gold">SALE PRICE</span>
                <span class="product--price text-danger"
                  >{{ product.currency
                  }}{{ discounted_price | priceFormat }}</span
                >
                <span class="retail--title">{{ percentage_off }}% off</span>
              </div>
              <div class="product--price--amount retail">
                <span class="retail--title text-gold">PRICE</span>
                <span class="product--price retail--price text-gold"
                  >{{ product.currency }}{{ price | priceFormat }}</span
                >
                <span class="retail--title"></span>
              </div>
            </div>

            <div class="product-item-prices mt-2" v-else>
              <div class="product--price--amount">
                <span class="retail--title text-gold">PRICE</span>
                <span class="product--price"
                  >{{ product.currency }}{{ price | priceFormat }}</span
                >
                <span class="retail--title"></span>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="mt-2">
            <!--Product Variations Form-->
            <form class="row">
              <div
                v-if="Object.keys(attributes).length !== 0"
                v-for="(map, key) in attributes"
                :key="key"
                class="col-12 mt-2 attrs"
              >
                <label class="d-block">
                  Select {{ key }}:
                  <span v-if="key == 'Colors'">{{ color }}</span></label
                >
                <div :id="'productV-' + key" class="d-flex flex-wrap mb-1 mt-1">
                  <div
                    @click="getAttribute($event, key)"
                    :data-name="key"
                    @mouseenter="showColor(children)"
                    @mouseleave="removeColor"
                    :class="[
                      index == product.active_color.color_code
                        ? 'active-attribute'
                        : '',
                      activeObject,
                    ]"
                    v-if="key == 'Colors'"
                    :data-value="children"
                    v-for="(children, index) in map"
                    :key="children"
                    :style="{'background-color': index}"
                    class="mr-2  product-variation-circle first-attribute"
                  ></div>
                  <template v-if="attributesData.length">
                    <div
                      @click="getAttribute($event, key)"
                      :data-name="key"
                      v-if="key != 'Colors'"
                      :class="[
                        index == 0 ? ' active-other-attribute' : 'border',
                      ]"
                      :data-value="children"
                      :id="children"
                      v-for="(children, index) in attributesData"
                      :key="children"
                      class="mr-1 product-variation-box position-relative border pr-3 pl-3 o-a bold pt-1 other-attribute"
                    >
                      {{ children }}
                    </div>
                  </template>
                  <template v-else>
                    <div
                      @click="getAttribute($event, key)"
                      :data-name="key"
                      :class="[index == 0 ? 'active-other-attribute' : '']"
                      v-if="key != 'Colors'"
                      :data-value="children"
                      :data-amount="quantity"
                      v-for="(children, index) in map"
                      :key="children"
                      :id="children"
                      class="mr-1 product-variation-box pr-3 pl-3 pt-1 border bold other-attribute"
                    >
                      {{ children }}
                    </div>
                  </template>
                </div>
              </div>
            </form>

            <div class="row no-gutters mb-2">
              <div v-if="cartError" class="text-danger text-center bold col-12">
                {{ cartError }}
              </div>
              <div class="col-2">
                <div
                  v-if="quantity >= 1"
                  id="quantity_1234"
                  class="select-custom"
                >
                  <select
                    id="add-to-cart-quantity"
                    name="qty"
                    class="form-control"
                  >
                    <option v-for="x in parseInt(quantity)">{{ x }}</option>
                  </select>
                </div>
                <div v-else id="quantity_1234" class="">
                  <select
                    id="add-to-cart-quantity"
                    name="qty"
                    class="form-control"
                  >
                    <option value=""></option>
                  </select>
                </div>
              </div>

              <div class="col-9">
                <button
                  @click.prevent="addToCart"
                  :class="canAddToCart"
                  type="button"
                  name="add-to-cart"
                  value="add_to_cart"
                  class="bold pt-4 pb-4 btn btn--primary btn-lg btn-block"
                >
                  {{ cartText }}
                  <span
                    style="margin-left: 8px; float: right"
                    v-if="loading"
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                  ></span>
                  <i
                    style="margin-left: 8px; float: right"
                    v-if="!loading"
                    class="icon-shopping-cart text-left"
                  ></i>
                </button>
              </div>
              <div v-if="$root.loggedIn" class="col-1">
                <a
                  v-if="!wishlistText"
                  @click.prevent="addToWishList"
                  href="#"
                  class="mt-4"
                  title="Add to Wishlist"
                >
                  <span class="fa-stack" style="vertical-align: top">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fas fa-heart fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
                <span
                  style=""
                  v-if="wishlistText"
                  class="spinner-border spinner-border-sm"
                  role="status"
                  aria-hidden="true"
                ></span>
              </div>
              <div v-else class="col-1 mt-1">
                <a
                  data-toggle="modal"
                  data-target="#login-modal"
                  @click.prevent="addToWishList"
                  href="#"
                  class="mt-4"
                  title="Add to Wishlist"
                >
                  <span class="fa-stack" style="vertical-align: top">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fas fa-heart fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </div>

              <div
                v-if="Object.keys(attributes).includes('Sizes')"
                class="col-12 text-center"
              >
                <a class="bold" target="_blank" href="/product/size/guide">
                  <svg id="iconLoaded-ruler">
                    <use xlink:href="#sizeGuide">
                      <symbol id="sizeGuide">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M16.125 1L23 7.875 7.875 23 1 16.125 16.125 1zm0 2.75l4.125 4.125L7.875 20.25 3.75 16.125l2.75-2.75 2.75 2.75 1.375-1.375L7.875 12l1.375-1.375 2.75 2.75L13.375 12l-2.75-2.75L12 7.875l2.75 2.75 1.375-1.375-2.75-2.75 2.75-2.75z"
                          ></path>
                        </svg>
                      </symbol>
                    </use>
                  </svg>
                  Size Guide
                </a>
              </div>
            </div>
          </div>
          <!-- End .product-filters-container -->

          <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item pl-2">
                <a
                  class="nav-link active"
                  id="product-tab-desc"
                  data-toggle="tab"
                  href="#product-desc-content"
                  role="tab"
                  aria-controls="product-desc-content"
                  aria-selected="true"
                  >Description</a
                >
              </li>
            </ul>
            <div class="tab-content bg--gray">
              <div
                class="tab-pane fade show active pl-2"
                id="product-desc-content"
                role="tabpanel"
                aria-labelledby="product-tab-desc"
              >
                <div
                  v-html="product.product.description"
                  class="product-desc-content pl-2 pb-2 color--primary"
                ></div>
                <!-- End .product-desc-content -->
              </div>
              <!-- End .tab-pane -->
            </div>
            <!-- End .tab-content -->
          </div>
          <!-- End .product-single-tabs -->
        </div>
        <!-- End .product-single-details -->
      </div>
      <!-- End .row -->
    </div>
    <!-- End .product-single-container -->
    <login-modal />
    <register-modal />
  </div>
</template>
<script>
import Images from "./Images.vue";
import LoginModal from "../auth/LoginModal.vue";
import RegisterModal from "../auth/RegisterModal.vue";
import {mapGetters, mapActions} from "vuex";
import Pagination from "../pagination/Pagination.vue";

export default {
  name: "Show",
  props: {
    product: Object,
    attributes: Object,
    inventory: Array,
    stock: Array,
  },
  components: {
    Images,
    LoginModal,
    Pagination,
    RegisterModal,
  },
  data() {
    return {
      allowSizeGuide: false,
      name: null,
      attributesData: [],
      color: "",
      isActive: false,
      canNotAddToCart: false,
      image: "",
      cText: "Add To Cart",
      images: [],
      variant_images: [],
      noRating: false,
      user: Window.auth,
      file: null,
      quantity: null,
      useUrl: false,
      price: null,
      discounted_price: null,
      percentage_off: "",
      product_variation_id: "",
      product_variation: [],
      prodAttributes: null,
      category: "",
      cartSideBarOpen: false,
      loading: false,
      is_loggeIn: false,
      is_wishlist: null,
      testn: "x",
      image_m: "",
      image_tn: null,
      profile_photo: null,
      errorsBag: [],
      otherAttrPresent: false,
      fadeIn: false,
      product_slug: this.product.slug,
      wishlistText: false,
      cartError: null,
      form: {
        description: null,
        rating: null,
        product_id: this.product.id,
        image: null,
      },
      submiting: false,
      styleObject: {
        "background-color": "red",
      },
    };
  },
  computed: {
    ...mapGetters({
      cart: "cart",
      loggedIn: "loggedIn",
      wishlist: "wishlist",
      reviews: "reviews",
      meta: "reviewsMeta",
      errors: "errors",
    }),
    activeObject: function() {
      return {
        "active-attributes": this.isActive,
      };
    },
    cartText: function() {
      return this.cText;
    },
    canAddToCart: function() {
      return [this.canNotAddToCart ? "disabled" : ""];
    },
    loggedIn: function() {
      return [this.user ? true : false];
    },
  },

  mounted() {
    this.productReviews();
    this.image = this.product.image_to_show;
    this.image_tn = this.product.image_to_show_tn;
    this.images = this.product.images;
    this.product_variation_id = this.product.id;
    this.percentage_off = this.product.default_percentage_off;
    this.quantity = this.product.quantity;
    this.cText =
      this.product.quantity < 1 ? "Item is sold out" : " Add To Cart";
    this.price = this.product.converted_price;
    this.discounted_price = this.product.default_discounted_price;
    this.is_wishlist = this.product.is_wishlist;
    this.name = this.product.name;
  },
  methods: {
    getStarRating(e, rating) {
      this.form.rating = rating;
      this.noRating = false;
      let ratings = document.querySelectorAll(".rating");
      ratings.forEach((elm) => {
        elm.classList.remove("active");
      });
      e.target.classList.add("active");
    },
    productReviews() {
      return axios
        .get("/reviews/" + this.product_slug)
        .then((response) => {
          this.loading = false;
          this.$store.commit("setReviews", response.data.data);
          this.$store.commit("setReviewsMeta", response.data.meta);
        })
        .catch((error) => {
          this.loading = false;
        });
    },

    currentSlide: function(image) {
      this.fadeIn = !this.fadeIn;
      this.image = image;
      setTimeout(() => {
        this.fadeIn = !this.fadeIn;
      }, 1000); // Will alert once, after a second.
    },

    getAttribute: function(evt, key) {
      this.cartError = null;
      let active_attribute = null,
        variation,
        first_attribute,
        active_other_attribute,
        other_attribute,
        f = false,
        af = false,
        cA;
      let inventory = this.inventory;
      let stock = this.stock;
      first_attribute = document.querySelectorAll(".first-attribute");
      other_attribute = document.querySelectorAll(".other-attribute");
      /**
       * Toggle active statte
       */

      if (evt.target.classList.contains("first-attribute")) {
        first_attribute.forEach(function(elm, key) {
          elm.classList.remove("active-attribute");
        });
        af = true;
        evt.target.classList.add("active-attribute");
      }

      /**
       * Toggle active statte for other attributes
       */
      if (evt.target.classList.contains("other-attribute")) {
        other_attribute.forEach(function(elm, key) {
          elm.classList.remove("active-other-attribute");
        });
        f = true;
        evt.target.classList.add("active-other-attribute");
      }

      try {
        if (typeof inventory[0].length === "undefined") {
          let v = inventory[0][evt.target.dataset.value];
          for (let i in v) {
            if (i !== evt.target.dataset.name) {
              this.attributesData = Object.keys(v[i]);
            }
          }
        }

        const styles = {
          pointerEvents: "none",
          textDecoration: "line-through",
          backgroundColor: "#999",
          color: "#fff",
          backgroundImage: "url(/img/outofstock.svg)",
          backgroundPosition: "center",
          backgroundRepeat: "no-repeat",
        };

        active_attribute = document.querySelector(".active-attribute");
        active_other_attribute = document.querySelector(
          ".active-other-attribute"
        );
        if (active_attribute && this.attributesData.length != 0) {
          variation =
            active_attribute.dataset.value + "_" + this.attributesData[0];
        }
        if (active_attribute && this.attributesData.length == 0) {
          variation = active_attribute.dataset.value;
        }

        if (!active_attribute && active_other_attribute !== null) {
          variation = active_other_attribute.dataset.value;
        }

        if (
          active_attribute &&
          other_attribute.length !== 0 &&
          key != "Colors"
        ) {
          variation =
            active_attribute.dataset.value + "_" + evt.target.dataset.value;
        }

        this.attributesData.forEach((element) => {
          try {
            if (element) {
              document.getElementById(element).removeAttribute("style");
            }
            let st = stock[0][active_attribute.dataset.value + "_" + element];
            if (st.quantity === 0) {
              Object.assign(document.getElementById(element).style, styles);
            } else {
            }
          } catch (error) {}
        });

        let vTs = stock[0][variation];
        this.name = vTs.name ?? this.name;

        if (key == "Colors") {
          this.image = vTs.image;
          this.image_m = vTs.image_m;
          this.images = vTs.images;
        }
        this.quantity = vTs.quantity;

        this.price = vTs.converted_price;
        this.percentage_off = vTs.percentage_off;
        this.discounted_price =
          vTs.discounted_price || vTs.default_discounted_price;
        this.product_variation_id = vTs.id;
        this.canNotAddToCart = false;
        this.cText = this.quantity >= 1 ? "Add To Cart" : "Item is sold out";
      } catch (error) {
        console.log(error);
        this.canNotAddToCart = true;
        this.cText = "Sold Out";
        this.quantity = 0;
      }
    },

    selectProductAttributes: function() {
      let values = [];
      let attributes = document.querySelectorAll("select.vs");
      attributes.forEach(function(elm, key) {
        values.push(elm.value);
      });
      return values;
    },
    formatError(error) {
      return Array.isArray(error) ? error[0] : error;
    },
    removeError(e) {
      let input = document.querySelectorAll(".rating_required");
      if (typeof input !== "undefined") {
        this.clearErrors({context: this, input: input});
      }
    },
    vInput(e) {
      let input = document.querySelectorAll(".rating_required");
      if (typeof input !== "undefined") {
        this.checkInput({context: this, input: e});
      }
    },
    showColor(color) {
      this.color = color;
    },
    removeColor(color) {
      this.color = "";
    },
    ...mapActions({
      addProductToCart: "addProductToCart",
      addProductToWishList: "addProductToWishList",
      createReviews: "createReviews",
      validateForm: "validateForm",
      clearErrors: "clearErrors",
      checkInput: "checkInput",
      getReviews: "getReviews",
    }),
    addToCart: function() {
      let qty = document.getElementById("add-to-cart-quantity").value;
      //if (!this.otherAttrPresent) { this.cartError = 'Please select a size'; return;}

      if (qty === "") {
        return;
      }
      this.cText = "Adding....";
      this.loading = true;
      this.addProductToCart({
        product_variation_id: this.product_variation_id,
        quantity: qty,
      })
        .then(() => {
          this.cText = "Add To Cart";
          this.loading = false;
        })
        .catch((error) => {
          this.cText = "Add To Cart";
          this.loading = false;
        });
    },
    addToWishList: function() {
      this.wishlistText = true;
      this.addProductToWishList({
        product_variation_id: this.product_variation_id,
      }).then((response) => {
        this.wishlistText = false;
        if (
          this.wishlist.some(
            (wishlist) =>
              wishlist.product_variation.id === this.product_variation_id
          )
        ) {
          this.is_wishlist = true;
          return;
        }
        this.is_wishlist = false;
      });
    },
    submit() {
      let input = document.querySelectorAll(".rating_required");
      this.validateForm({context: this, input: input});
      if (Object.keys(this.errors).length !== 0) {
        if (!this.form.rating) {
          this.noRating = true;
        }
        return false;
      }
      this.submiting = true;
      let form = new FormData();
      form.append("image", this.file);
      form.append("description", this.form.description);
      form.append("rating", this.form.rating);
      form.append("product_id", this.form.product_id);
      this.createReviews({context: this, form});
    },
  },
};
</script>
