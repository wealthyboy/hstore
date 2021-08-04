<template>
  <div>
    <div id="out-of-stock-modal" class="modal fade" role="dialog">
      <div class="modal-dialog" style="">
        <!-- Modal content-->
        <div class="modal-content ">
          <div class="modal-header">
            <div class="modal-title">
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
            <div
              class="newsletter-popup mfp-hide bg-img"
              id="newsletter-popup-form"
              style="background: #f1f1f1 no-repeat center/cover url(/images/newsletter/newsletter_popup_bg.jpg)"
            >
              <div class="newsletter-popup-content">
                <img src="" class="logo-newsletter" alt=" Logo" />
                <h2>BE THE FIRST TO KNOW</h2>
                <p class="mb-2">
                  Subscribe to the hautesignatures newsletter to receive timely
                  updates.
                </p>

                <sign-up />

                <div class="newsletter-subscribe">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" />
                      Don't show this popup again
                    </label>
                  </div>
                </div>
              </div>
              <!-- End .newsletter-popup-content -->
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
import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      email: "",
      password: "",
      loading: false,
    };
  },
  components: {},
  computed: {
    ...mapGetters({
      errors: "errors",
    }),
  },
  methods: {
    ...mapActions({
      login: "login",
    }),

    closeLogin() {
      document.getElementById("login_modal").click();
    },
    authenticate: function() {
      this.loading = true;
      this.login({
        email: this.email,
        password: this.password,
      }).catch((error) => {
        this.loading = false;
        this.errors = error.response.data.error || error.response.data.errors;
      });
    },
  },
};
</script>
