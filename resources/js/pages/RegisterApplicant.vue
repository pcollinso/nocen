<template>
  <Page>
    <!-- begin login-cover -->
    <div class="login-cover">
      <!-- <div class="login-cover-image" :style="{ backgroundImage: 'url(/images/login-bg/login-bg-16.jpg)' }"></div> -->
      <div class="login-cover-bg"></div>
    </div>
    <!-- end login-cover -->
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated fadeIn">
      <div class="login-header">
        <div class="brand">
          <img src="/images/logo.png" height="60">
        </div>
      </div>
      <!-- begin login-content -->
      <div class="login-content">
        <form
          ref="form"
          action="/new-applicant"
          @submit.stop.prevent="handleSubmit()"
          method="POST"
          class="margin-bottom-0"
        >
          <input type="hidden" name="_token" v-model="form.token">
          <div class="form-group m-b-20">
            <label>Programme *</label>
            <v-select :options="programmes" label="programme_name" v-model="selectedProgramme" />
          </div>

          <div class="form-group m-b-20">
            <label>Faculty *</label>
            <v-select :options="selectedProgramme.faculties" label="faculty_name" v-model="selectedFaculty" />
          </div>

          <div class="form-group m-b-20">
            <label>Department *</label>
            <v-select :options="selectedFaculty.departments" label="department_name" v-model="selectedDept" />
          </div>

          <div class="form-group m-b-20">
            <label>Field *</label>
            <v-select :options="selectedDept.fields" label="field_name" v-model="selectedField" />
          </div>

          <div class="form-group m-b-20">
            <label>JAMB Reg. number *</label>
            <input
              :disabled="!deptSelected"
              type="text"
              class="form-control form-control-lg"
              placeholder="JAMB Reg. number"
              v-model.trim="form.j_regno"
            >
          </div>

          <div class="form-group m-b-20">
            <label>Email address *</label>
            <input
              :disabled="!deptSelected"
              type="text"
              class="form-control form-control-lg"
              placeholder="Email address"
              v-model.trim="form.email"
            >
          </div>

          <div class="form-group m-b-20">
            <label>Phone number *</label>
            <input
              :disabled="!deptSelected"
              type="text"
              class="form-control form-control-lg"
              placeholder="Phone number"
              v-model.trim="form.phone"
            >
          </div>

          <div class="form-group m-b-20">
            <label>Password *</label>
            <input
              :disabled="!deptSelected"
              type="password"
              class="form-control form-control-lg"
              placeholder="Password"
              v-model.trim="form.user_password"
            >
          </div>

          <div class="form-group m-b-20">
            <label>Confirm password *</label>
            <input
              :disabled="!deptSelected"
              type="password"
              class="form-control form-control-lg"
              placeholder="Confirm password"
              v-model.trim="password"
            >
          </div>

          <div class="form-group m-b-20">
            <div v-if="error" class="alert alert-danger">
              {{ error }}
            </div>
          </div>


          <div class="login-buttons">
            <button :disabled="!formOk" type="submit" class="btn btn-primary btn-block btn-lg">Register as applicant</button>
          </div>
        </form>
      </div>
      <!-- end login-content -->
    </div>
    <!-- end login -->
  </Page>
</template>

<script>
import Page from './Page';
import FilterMixin from '../mixins/FilterMixin';
import PageOptions from '../components/PageOptions';

export default {
	name: 'RegisterApplicant',
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
  props: {
    programmes: {
      type: Array,
      required: true
    }
  },
	data() {
		return {
      error: '',
      form: {
        institution_id: 0,
        field_id: 0,
        phone: '',
        email: '',
        j_regno: '',
        token: '',
        user_password: ''
      },
      selectedProgramme: {},
      selectedFaculty: {},
      selectedDept: {},
      selectedField: {},
      password: ''
		}
  },
  computed: {
    formOk() {
      return !!this.form.institution_id &&
        !!this.form.field_id &&
        !!this.form.j_regno &&
        this.phoneOk &&
        this.emailOk &&
        this.passwordOk;
    },
    passwordOk() {
      return this.form.user_password === this.password && this.password.length >=6;
    },
    deptSelected() {
      return !!this.form.field_id;
    },
    phoneOk() {
      return /^\d{7,11}$/.test(this.form.phone);
    },
    emailOk() {
      return /^\w+\.*\w*@\w+\.\w+/.test(this.form.email);
    }
  },
  watch: {
    selectedField(field) {
      if (!field) return;
      this.form.institution_id = field.institution_id;
      this.form.field_id = field.id;
    }
  },
  mounted() {
    this.form.token = document.querySelector('meta[name="csrf-token"]').content;
  },
	methods: {
		handleSubmit() {
      this.error = '';

      axios
      .post('/new-applicant', this.form)
      .then(({ data: { success, data, message } }) => {
        if (success) window.location = 'login';
      })
      .catch(({ response: { data: { message } } }) => {
        this.error = message;
      });
      return false;
		}
	}
}
</script>
