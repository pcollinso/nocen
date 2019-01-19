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
        <form
          ref="form"
          action="/login"
          @submit.prevent="checkForm()"
          method="POST"
          class="margin-bottom-0"
        >
          <input type="hidden" name="_token" v-model="form.token">
          <div v-show="firstStep" class="form-group m-b-20">
            <input
              type="text"
              name="login"
              class="form-control form-control-lg"
              placeholder="Provide Login"
              v-model.trim="form.login"
              required
            >
          </div>

          <div v-if="secondStep" class="form-group m-b-20">
            <label>Welcome {{ name }} ({{ form.type | capitalize }})</label>
          </div>
          <div v-if="secondStep" class="form-group m-b-20">
            <input
              type="password"
              name="password"
              class="form-control form-control-lg"
              placeholder="Password"
              v-model.trim="form.password"
              required
            >
          </div>
          <div v-if="secondStep" class="checkbox checkbox-css m-b-20">
            <input type="checkbox" name="remember_me" id="remember_checkbox">
            <label for="remember_checkbox">Remember Me</label>
          </div>

          <div class="login-buttons">
            <button type="submit" class="btn btn-primary btn-block btn-lg">{{ buttonText }}</button>
            <a v-if="secondStep" href="/login" class="btn btn-danger btn-block btn-lg">Cancel</a>
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
	name: 'Login',
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
        login: 'umejiofor.anthony',
        password: 'Children12@',
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
    buttonText() {
      return this.step === 1 ? 'Check' : 'Submit';
    },
    firstStep() {
      return this.step === 1;
    },
    secondStep() {
      return this.step === 2;
    }
  },
  mounted() {
    this.form.token = document.querySelector('meta[name="csrf-token"]').content;
  },
	methods: {
		checkForm() {
      if (this.secondStep) {
        this.$refs.form.submit();
        return true;
      }

      axios
      .post('/auth/check-user', this.form)
      .then(({ data: { success, data } }) => {
        if (!success) {
          alert('Could not find user');
          return;
        }

        if (data.verification_no) {
          this.form.type = 'staff';
        } else if (data.regno) {
          this.form.type = 'student';
        } else {
          this.form.type = 'user';
        }
        this.name = data.full_name;

        this.step = 2;
      })
      .catch(({ response: { data } }) => console.log("error", data));
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
