<template>
  <Page>
    <!-- begin login-cover -->
    <div class="login-cover">
      <div class="login-cover-image" :style="{ backgroundImage: 'url('+ bg.activeImg +')' }"></div>
      <div class="login-cover-bg"></div>
    </div>
    <!-- end login-cover -->
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated fadeIn">
      <div class="login-header">
        <div class="brand">
          <img src="/images/logo.png" height="60">
        </div>
        <div class="icon">
          <i class="fa fa-lock"></i>
        </div>
      </div>
      <!-- begin login-content -->
      <div class="login-content">
        <form @submit.stop.prevent="onSubmit()" class="margin-bottom-0">
          <input type="hidden" name="_token" v-model="form.token">
          <div class="form-group m-b-20">
            <label>Change Password</label>
          </div>
          <div class="form-group m-b-20">
            <input
              type="password"
              name="user_password"
              class="form-control form-control-lg"
              placeholder="Current Password"
              v-model.trim="form.user_password"
              required
            >
          </div>
          <div class="form-group m-b-20">
            <input
              type="password"
              name="new_password"
              class="form-control form-control-lg"
              placeholder="New Password"
              v-model.trim="form.new_password"
              required
            >
          </div>
          <p v-if="!passwordLengthOk">Passwords must have at least 6 characters</p>

          <div class="form-group m-b-20">
            <input
              type="password"
              name="confirm_password"
              class="form-control form-control-lg"
              placeholder="Confirm Password"
              v-model.trim="form.confirm_password"
              required
            >
          </div>
          <p v-if="!passwordsMatch">Confirmation does not match the new password</p>

          <div class="login-buttons">
            <button
              :disabled="!formOk"
              type="submit"
              class="btn btn-primary btn-block btn-lg"
            >Submit</button>
            <a href="/dashboard" class="btn btn-danger btn-block btn-lg">Back To Dashboard</a>
          </div>
          <!--<div class="m-t-20">
						Not a member yet? Click <a href="javascript:;">here</a> to register.
          </div>-->
        </form>
      </div>
      <!-- end login-content -->
    </div>
    <!-- end login -->
    <!-- begin login-bg -->
    <ul class="login-bg-list clearfix">
      <li v-bind:class="{ 'active': bg.bg1.active }">
        <a
          href="javascript:;"
          v-on:click="select('bg1')"
          style="background-image: url(/images/login-bg/login-bg-16.jpg)"
        ></a>
      </li>
      <li v-bind:class="{ 'active': bg.bg2.active }">
        <a
          href="javascript:;"
          v-on:click="select('bg2')"
          style="background-image: url(/images/login-bg/login-bg-17.jpg)"
        ></a>
      </li>
      <li v-bind:class="{ 'active': bg.bg3.active }">
        <a
          href="javascript:;"
          v-on:click="select('bg3')"
          style="background-image: url(/images/login-bg/login-bg-15.jpg)"
        ></a>
      </li>
      <li v-bind:class="{ 'active': bg.bg4.active }">
        <a
          href="javascript:;"
          v-on:click="select('bg4')"
          style="background-image: url(/images/login-bg/login-bg-14.jpg)"
        ></a>
      </li>
      <li v-bind:class="{ 'active': bg.bg5.active }">
        <a
          href="javascript:;"
          v-on:click="select('bg5')"
          style="background-image: url(/images/login-bg/login-bg-13.jpg)"
        ></a>
      </li>
      <li v-bind:class="{ 'active': bg.bg6.active }">
        <a
          href="javascript:;"
          v-on:click="select('bg6')"
          style="background-image: url(/images/login-bg/login-bg-12.jpg)"
        ></a>
      </li>
    </ul>
    <!-- end login-bg -->
  </Page>
</template>

<script>
import Page from './Page';
import FilterMixin from '../mixins/FilterMixin';
import PageOptions from '../components/PageOptions';

export default {
	name: 'ChangePassword',
  mixins: [FilterMixin],
	components: {
		Page
  },
	created() {
		PageOptions.pageEmpty = true;
	},
	beforeRouteLeave (to, from, next) {
		PageOptions.pageEmpty = false;
		next();
	},
	data() {
		return {
      step: 1,
      name: 'Test',
      form: {
        new_password: '',
        user_password: '',
        confirm_password: '',
        type: '',
        token: ''
      },
			bg: {
        activeImg: '/images/login-bg/login-bg-16.jpg',
        bg1: {
            active: true,
            img: '/images/login-bg/login-bg-16.jpg'
        },
        bg2: {
            active: false,
            img: '/images/login-bg/login-bg-17.jpg'
        },
				bg3: {
					active: false,
					img: '/assets/img/login-bg/login-bg-15.jpg'
				},
				bg4: {
					active: false,
					img: '/images/login-bg/login-bg-14.jpg'
				},
				bg5: {
					active: false,
					img: '/images/login-bg/login-bg-13.jpg'
				},
				bg6: {
					active: false,
					img: '/images/login-bg/login-bg-12.jpg'
				}
			}
		}
  },
  computed: {
    passwordLengthOk() {
      return this.form.new_password.length >= 6;
    },
    passwordsMatch() {
      const { confirm_password, new_password } = this.form;
      return confirm_password === new_password;
    },
    formOk() {
      const { user_password, new_password } = this.form;
      return new_password.length >= 6 &&
        this.passwordsMatch &&
        this.passwordLengthOk;
    }
  },
  mounted() {
    this.form.token = document.querySelector('meta[name="csrf-token"]').content;
  },
	methods: {
    onSubmit() {
      axios
        .post('/auth/change-password', this.form)
        .then(({ data: { success, message } }) => {
          if (!success) {
            alert(message);
            return;
          }
          alert(message);
          window.location = '/dashboard';
        })
        .catch(({ response: { data: { message } } }) => alert(message));
      return false;
		},
		select(x) {
			this.bg.bg1.active = false;
			this.bg.bg2.active = false;
			this.bg.bg3.active = false;
			this.bg.bg4.active = false;
			this.bg.bg5.active = false;
			this.bg.bg6.active = false;

			switch (x) {
				case 'bg1':
					this.bg.bg1.active = true;
					this.bg.activeImg = this.bg.bg1.img;
					break;
				case 'bg2':
					this.bg.bg2.active = true;
					this.bg.activeImg = this.bg.bg2.img;
					break;
				case 'bg3':
					this.bg.bg3.active = true;
					this.bg.activeImg = this.bg.bg3.img;
					break;
				case 'bg4':
					this.bg.bg4.active = true;
					this.bg.activeImg = this.bg.bg4.img;
					break;
				case 'bg5':
					this.bg.bg5.active = true;
					this.bg.activeImg = this.bg.bg5.img;
					break;
				case 'bg6':
					this.bg.bg6.active = true;
					this.bg.activeImg = this.bg.bg6.img;
					break;
			}
		}
	}
}
</script>
