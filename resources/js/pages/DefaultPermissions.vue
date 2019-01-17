<template>
  <Page>
    <page-title title="Roles"/>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Manage role permissions</h4>
          </div>
          <!-- end panel-heading -->
          <!-- begin panel-body -->
          <div class="panel-body">
            <div class="form-group row m-b-15">
              <label class="col-form-label col-md-3">Role</label>
              <div class="col-md-9">
                <select class="form-control" v-model="form.role">
                  <option :value="role" v-for="role in localRoles" :key="role.id">{{ role.name }}</option>
                </select>
              </div>
            </div>
            <div class="form-group row m-b-15">
              <label class="col-form-label col-md-3">Assigned permissions</label>
              <div class="col-md-9">
                <vue-multiselect
                  v-model="form.permissions"
                  :options="localPermissions"
                  :multiple="true"
                  :close-on-select="false"
                  label="name"
                  track-by="name"
                />
              </div>
            </div>
            <div class="form-group row m-b-15">
              <div class="col-sm-9 offset-md-3">
                <button
                  @click.stop.prevent="assign()"
                  class="btn btn-primary btn-sm"
                >Update role permissions</button>
              </div>
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
  name: 'DefaultPermissions',
  components: {
    Page,
    PageTitle
  },
  props: {
    roles: {
      required: true,
      type: Array
    },
    permissions: {
      required: true,
      type: Array
    }
  },
  data() {
    return {
      form: {
        role: null,
        permissions: []
      },
      localRoles: this.roles,
      localPermissions: this.permissions
    };
  },
  watch: {
    'form.role'(role) {
      this.form.permissions = !role ? [] : role.permissions;
    }
  },
  methods: {
    assign() {
      if (!this.form.role) return;
      if (!confirm('Are you sure?')) return;

      axios
      .post('/s/roles/assign-permissions', this.form)
      .then(({ data: { success, data } }) => {
        if (success) {
          alert('Role permissions updated');
          this.localRoles = this.localRoles.map((role) => {
            if (this.form.role.id !== role.id) return role;
            role.permissions = data.permissions;
            return role;
          });
          this.form.role = data;
        }
      })
      .catch(({ response: { data } }) => console.log('error', data));
    }
  }
}
</script>
