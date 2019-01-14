<template>
  <Page>
    <!-- begin breadcrumb -->
    <breadcrumb/>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <page-title title="Roles"/>
    <!-- end page-header -->
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Add role</h4>
          </div>
          <!-- end panel-heading -->
          <!-- begin panel-body -->
          <div class="panel-body">
            <form @submit.stop.prevent="createRole()">
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Name</label>
                <div class="col-md-9">
                  <input
                    v-model.trim="form.name"
                    type="text"
                    class="form-control m-b-5"
                    placeholder="Name"
                  >
                </div>
              </div>
              <div class="form-group row m-b-15">
                <div class="col-sm-9 offset-md-3">
                  <button
                    :disabled="!formOk"
                    type="submit"
                    class="btn btn-primary btn-sm"
                  >Create role</button>
                </div>
              </div>
            </form>
            <!-- end table-responsive -->
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Roles</h4>
          </div>
          <!-- end panel-heading -->
          <!-- begin panel-body -->
          <div class="panel-body">
            <!-- begin table-responsive -->
            <div class="table-responsive">
              <table class="table table-striped m-b-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th width="1%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(role, i) in localRoles" :key="i">
                    <td class="with-img">{{ ++i }}</td>
                    <td>{{ role.name }}</td>
                    <td class="with-btn" nowrap>
                      <a href="#" class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                      <button
                        @click.stop.prevent="deleteRole(role)"
                        class="btn btn-sm btn-white width-60"
                      >Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- end table-responsive -->
          </div>
        </div>
      </div>
    </div>
  </Page>
</template>
<script>
import Page from './Page';
import PageTitle from '../components/header/PageTitle';
import Breadcrumb from '../components/header/Breadcrumb';

export default {
  name: 'Roles',
  components: {
    Page,
    PageTitle,
    Breadcrumb
  },
  props: {
    roles: {
      required: true,
      type: Array
    }
  },
  data() {
    return {
      form: {
        name: ''
      },
      localRoles: this.roles
    };
  },
  computed: {
    formOk() {
      return !!this.form.name.length && this.localRoles.every(({ name }) => name !== this.form.name);
    }
  },
  methods: {
    createRole() {
      axios
      .post('/s/roles', this.form)
      .then(({ data: { success, data } }) => {
        if (success) {
          this.localRoles.push(data);
        }
      })
      .catch(({ response: { data } }) => console.log("error", data));
    },
    deleteRole({ id }) {
      axios
      .delete(`/s/roles/${id}`)
      .then(({ data: { success } }) => {
        if (success) {
          this.localRoles = this.localRoles.filter(role => role.id !== id);
        }
      })
      .catch(({ response: { data } }) => console.log("error", data));
    }
  }
}
</script>
