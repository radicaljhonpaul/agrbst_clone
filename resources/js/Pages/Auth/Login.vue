<template>

  <Head title="Log in" />

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 d-none d-sm-block vh-100" id="login-bg-1">
      </div>
      <div class="col-md-5 align-self-center px-lg-5">
        <div class="p-5">
            <p class="mb-0">Welcome AgriHub Operator! </p>
            <p class="fs-2 fw-bold">Login to your account</p>
            <jet-validation-errors class="mb-3" />

            <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
              {{ status }}
            </div>

            <form @submit.prevent="submit">
              <div class="mb-3">
                <jet-label class="fw-bold" for="email" value="Email/Username" />
                <jet-input class="p-3" style="border-radius:10px;" id="email" placeholder="Please enter email/username" type="email" v-model="form.email" required autofocus />
              </div>

              <!-- <div class="mb-3">
                <jet-label class="fw-bold" for="password" value="Password" />
                <jet-input class="p-3" style="border-radius:10px;" id="password" placeholder="Please enter password"  type="password" v-model="form.password" required autocomplete="current-password" />
              </div> -->
              <div class="login-password">
                <div class="input-group">
                  <input id="loginPassword" type="password" class="form-control p-3" v-model="form.password" placeholder="Please enter your password" required autocomplete="current-password"/>
                  <div class="input-group-addon">
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <div class="custom-control custom-checkbox">
                  <jet-checkbox id="remember_me" name="remember" v-model:checked="form.remember" />

                  <label class="custom-control-label" for="remember_me">
                    &nbsp; Remember Me
                  </label>
                </div>
              </div>

              <div class="d-block">
                <button type="submit" style="width: 100%;" class="btn btn-default text-white px-3 py-3 bg-main-green" :disabled="form.processing">
                    <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    Sign in <i class="bi bi-box-arrow-in-right" ></i>
                </button>
                <!-- <jet-button class="p-3 bg-main-green" style="width: 100%;" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                    <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>

                    Sign in <i class="bi bi-box-arrow-in-right" ></i>
                  </jet-button> -->
              </div>

              <div class="d-block mt-1">
                <Link v-if="canResetPassword" :href="route('password.request')" class="text-muted fw-light me-3">
                  Forgot your password?
                </Link>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import { defineComponent } from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },

  methods: {
    submit() {
      this.form
          .transform(data => ({
            ... data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
            onFinish: () => this.form.reset('password'),
          })
    }
  }
})
</script>
