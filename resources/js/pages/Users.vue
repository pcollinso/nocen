<template>
  <Page>
    <page-title title="Users"/>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-inverse">
          <div class="panel-heading">
            <h4 class="panel-title">Users</h4>
          </div>
          <div class="panel-body">
            <button class="btn btn-sm btn-primary" @click.stop.prevent="view(null)">Add user</button>
            <div class="table-responsive">
              <table class="table table-striped m-b-0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.id">
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
  id: 0,
  institution_id: 0,
  email: '',
  phone: '',
  name: '',
  username: '',
  user_password: ''
};

export default {
  name: 'Users',
  props: {
    institution: {
      type: Object,
      required: true
    },
    usersProp: {
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
      users: this.usersProp,
      user: {},
      selectedTitle: ''
    };
  },
  watch: {
    'user.name'(name) {
      if (!name) return;
      const username = name.toLowerCase().split(' ').join('.');
      const duplicates = this.users.filter((user) => user.username === username);
      if (!duplicates.length || (duplicates.length === 1 && this.user.id === duplicates[0].id)) {
        this.user.username = username;
        return;
      }
      this.user.username = `${username}.${duplicateCount + 1}`;
    }
  },
  methods: {
    view(user) {
      if (user) {
        this.selectedTitle = `Update ${user.name}`;
        this.user = { ...user };
      } else {
        this.selectedTitle = 'Create user';
        this.user = { ...defaultUser };
      }
      $(this.$refs.userModal).modal('show');
    },
    save() {
      const copy = { ...this.user };
      copy.name = copy.name.toUpperCase();
      copy.institution_id = this.institution.id;
      delete copy.roles;

      if (copy.id) {
        axios
        .put(`/i/users/${copy.id}`, copy)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            alert('User updated');
            $(this.$refs.userModal).modal('hide');
            this.users = this.users.map((user) => {
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
        .post('/i/users', copy)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            alert('User created');
            $(this.$refs.userModal).modal('hide');
            this.users.push(data);
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
