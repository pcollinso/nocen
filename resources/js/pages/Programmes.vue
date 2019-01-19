<template>
  <Page>
    <page-title title="Programmes"/>
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Add programme</h4>
          </div>
          <!-- end panel-heading -->
          <!-- begin panel-body -->
          <div class="panel-body">
            <form @submit.stop.prevent="save()">
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Name</label>
                <div class="col-md-9">
                  <input
                    v-model.trim="form.programme_name"
                    type="text"
                    class="form-control m-b-5"
                    placeholder="Name"
                  >
                </div>
              </div>
              <div class="form-group row m-b-15">
                <div class="col-sm-9 offset-md-3">
                  <button :disabled="!formOk" type="submit" class="btn btn-primary btn-sm">Save</button>
                  <button @click.stop.prevent="clear()" class="btn btn-white btn-sm">Clear</button>
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
            <h4 class="panel-title">Programmes</h4>
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
                  <tr v-for="(programme, i) in programmes" :key="i">
                    <td class="with-img">{{ ++i }}</td>
                    <td>{{ programme.programme_name }}</td>
                    <td class="with-btn" nowrap>
                      <button
                        @click.stop.prevent="edit(programme)"
                        class="btn btn-sm btn-primary width-60 m-r-2"
                      >Edit</button>
                      <button
                        @click.stop.prevent="deleteProgramme(programme)"
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
  name: 'Programmes',
  components: {
    Page,
    PageTitle
  },
  props: {
    institution: {
      required: true,
      type: Object
    }
  },
  data() {
    return {
      form: {
        programme_name: '',
        id: 0,
        institution_id: 0
      },
      programmes: this.institution.programmes
    };
  },
  computed: {
    formOk() {
      return !!this.form.programme_name.length &&
        this.programmes.every(({ programme_name }) => programme_name !== this.form.programme_name);
    }
  },
  created() {
    this.form.institution_id = this.institution.id;
  },
  methods: {
    clear() {
      this.form = Object.assign(this.form, { id: 0, programme_name: '' });
    },
    edit({ id, programme_name }) {
      this.form = Object.assign(this.form, { id, programme_name });
    },
    save() {
      this.form.programme_name = this.form.programme_name.toUpperCase();

      if (this.form.id) {
        axios
        .put(`/i/programmes/${this.form.id}`, this.form)
        .then(({ data: { success, data } }) => {
          if (success) {
            const idx = this.programmes.findIndex(({ id }) => id === this.form.id);
            this.programmes.splice(idx, 1, data);
          }
        })
        .catch(({ response: { data } }) => console.log("error", data));
      } else {
        axios
        .post('/i/programmes', this.form)
        .then(({ data: { success, data } }) => {
          if (success) {
            this.programmes.push(data);
            this.clear();
          }
        })
        .catch(({ response: { data } }) => console.log("error", data));
      }
    },
    deleteProgramme({ id }) {
      axios
      .delete(`/i/programmes/${id}`)
      .then(({ data: { success } }) => {
        if (success) {
          this.programmes = this.programmes.filter(programme => programme.id !== id);
        }
      })
      .catch(({ response: { data } }) => console.log("error", data));
    }
  }
}
</script>
