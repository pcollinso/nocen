<template>
  <Page>
    <page-title title="Institution admins"/>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-inverse">
          <div class="panel-heading">
            <h4 class="panel-title">Institution admins</h4>
          </div>
          <div class="panel-body">
            <button
              class="btn btn-sm btn-primary"
              @click.stop.prevent="view(null)"
            >Add institution admin</button>
            <div class="table-responsive">
              <table class="table table-striped m-b-0">
                <thead>
                  <tr>
                    <th>Institution</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in localUsers" :key="user.id">
                    <td>{{ institutionName(user) }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.phone }}</td>
                    <td>{{ user.email }}</td>
                    <td class="with-btn" nowrap>
                      <button
                        @click.stop.prevent="view(user)"
                        class="btn btn-sm btn-primary m-r-2"
                      >View/Edit</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div ref="userModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ selectedTitle }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Institution * :</label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" v-model="user.institution_id">
                      <option value="0">Select institution</option>
                      <option
                        :value="i.id"
                        v-for="i in institutions"
                        :key="i.id"
                      >{{ i.institution_name }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Name * :</label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control" v-model.trim="user.name">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Username * :</label>
                  <div class="col-md-6 col-sm-6">
                    <input
                      disabled
                      readonly
                      type="text"
                      class="form-control"
                      :value="user.username"
                    >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Phone :</label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control" v-model.trim="user.phone">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Email * :</label>
                  <div class="col-md-6 col-sm-6">
                    <input type="email" class="form-control" v-model.trim="user.email">
                  </div>
                </div>
                <div v-if="!user.id" class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Password :</label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control" v-model.trim="user.user_password">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button @click.stop.prevent="save()" type="button" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Page>
</template>

<script>
import Page from './Page';
import PageTitle from '../components/header/PageTitle';


const defaultUser = {
  institution_id: 0,
  email: '',
  phone: '',
  name: '',
  username: '',
  user_password: ''
};

export default {
  name: 'InstitutionAdmins',
  props: {
    institutions: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    }
  },
  components: {
    Page,
    PageTitle
  },
  data() {
    return {
      localUsers: this.users,
      user: {},
      selectedTitle: ''
    };
  },
  watch: {
    'user.name'(name) {
      if (!name) return;
      const username = name.toLowerCase().split(' ').join('.');
      const duplicateCount = this.localUsers.filter((user) => user.username === username).length;
      if (!duplicateCount) {
        this.user.username = username;
        return;
      }
      this.user.username = `${username}.${duplicateCount + 1}`;
    }
  },
  methods: {
    institutionName({ institution_id }) {
      const inst = this.institutions.find(({ id }) => id === institution_id);
      if (inst) return inst.institution_name;
      return 'None';
    },
    view(user) {
      if (user) {
        this.selectedTitle = `Update ${user.name}`;
        this.user = { ...user };
      } else {
        this.selectedTitle = 'Create institution admin';
        this.user = { ...defaultUser };
      }
      $(this.$refs.userModal).modal('show');
    },
    save() {
      const copy = { ...this.user };
      copy.name = copy.name.toUpperCase();

      if (copy.id) {
        axios
        .put(`/s/institution-admins/${copy.id}`, copy)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            alert('Institution admin updated');
            $(this.$refs.userModal).modal('hide');
            this.localUsers = this.localUsers.map((user) => {
              if (data.id === user.id) return data;
              return user;
            });
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data } }) => console.log('error', data));
      } else {
        axios
        .post('/s/institution-admins', copy)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            alert('Institution admin created');
            $(this.$refs.userModal).modal('hide');
            this.localUsers.push(data);
            this.user = { ...defaultUser };
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data } }) => console.log('error', data));
      }
    },
  }
}
</script>
