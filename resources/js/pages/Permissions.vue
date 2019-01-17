<template>
  <Page>
    <page-title title="Permissions"/>
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Add permission</h4>
          </div>
          <!-- end panel-heading -->
          <!-- begin panel-body -->
          <div class="panel-body">
            <form @submit.stop.prevent="createPermission()">
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
                  >Create permission</button>
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
            <h4 class="panel-title">Permissions</h4>
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
                  <tr v-for="(perm, i) in localPermissions" :key="i">
                    <td class="with-img">{{ ++i }}</td>
                    <td>{{ perm.name }}</td>
                    <td class="with-btn" nowrap>
                      <a href="#" class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                      <button
                        @click.stop.prevent="deletePermission(perm)"
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

export default {
  name: 'Permissions',
  components: {
    Page,
    PageTitle
  },
  props: {
    permissions: {
      required: true,
      type: Array
    }
  },
  data() {
    return {
      form: {
        name: ''
      },
      localPermissions: this.permissions
    };
  },
  computed: {
    formOk() {
      return !!this.form.name.length && this.localPermissions.every(({ name }) => name !== this.form.name);
    }
  },
  methods: {
    createPermission() {
      axios
      .post('/s/permissions', this.form)
      .then(({ data: { success, data } }) => {
        if (success) {
          this.localPermissions.push(data);
        }
      })
      .catch(({ response: { data } }) => console.log("error", data));
    },
    deletePermission({ id }) {
      axios
      .delete(`/s/permissions/${id}`)
      .then(({ data: { success } }) => {
        if (success) {
          this.localPermissions = this.localPermissions.filter(perm => perm.id !== id);
        }
      })
      .catch(({ response: { data } }) => console.log("error", data));
    }
  }
}
</script>
