<template>
  <div>
    <div id="out-of-stock-modal" class="modal fade" role="dialog">
      <div class="modal-dialog" style="">
        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <div class="modal-title text-center">
              <img
                width="200"
                height="200"
                :src="'/images/logo/' + $root.settings.store_logo"
              />
            </div>
            <span class="bold text-large "
              ><button
                type="button"
                class="close"
                id="login_modal"
                data-dismiss="modal"
              >
                <i class="fas fa-times"></i></button
            ></span>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <img
                  src="https://hautesignatures.com/images/products/ITkHtCoG7dH9ia2bN2xOIYaEQ7vShed6uKga6Kkk.png"
                  alt=""
                />
              </div>
              <div class="col-md-6">
                <div class="newsletter-content">
                  <div>
                    <h3 class="newsletter-popup-title">ITEM IS OUT OF STOCK</h3>
                    <p class="newsletter-popup-slogen">
                      Get notified when this item is available.
                      {{ product_variation }}
                    </p>
                    <form class="form-group">
                      <div class="form-field-wrapper">
                        <input
                          name="email"
                          v-model="form.email"
                          class="form-control"
                          id="newsletter-email"
                          title="Email"
                          placeholder="Enter Your Email..."
                          value=""
                          type="email"
                          required
                        />
                      </div>
                      <div class="form-field-wrapper mt-1">
                        <input
                          class="btn btn-lg btn-primary btn-block"
                          value="Get Notified"
                          type="submit"
                        />
                      </div>
                    </form>
                    <p class="newsletter-popup-info"></p>
                    <div class="newsletter-popup-footer">
                      <a href="javascript:void(0)" class="newsletter-close-text"
                        >No Thanks</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- End .newsletter-popup -->
          </div>
        </div>
      </div>
      <!--modal-content-->
    </div>
    <!--modal-dialog-->
  </div>

  <!--loginModal-->
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import ErrorMessage from "../messages/components/Error";

export default {
  props: ["product_variation"],
  data() {
    return {
      form: {
        email: null,
      },
      loading: false,
      message: null,
      error: null,
      errorsBag: [],
    };
  },
  computed: {
    ...mapGetters({
      errors: "errors",
    }),
  },
  components: {
    ErrorMessage,
  },
  mounted() {
    console.log(this.product_variation);
  },
  methods: {
    signUp() {
      this.loading = true;
      return axios
        .post("/newsletter/signup", {
          email: this.form.email,
        })
        .then((response) => {
          this.loading = false;
          this.message = response.data.message;
        })
        .catch((error) => {
          this.loading = false;
          this.error = "There was an error";
        });
    },
  },
};
</script>
