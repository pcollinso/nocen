<template>
  <Page>
    <page-title title="Faculties"/>
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Add faculty</h4>
          </div>
          <!-- end panel-heading -->
          <!-- begin panel-body -->
          <div class="panel-body">
            <form @submit.stop.prevent="save()">
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Programme</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="form.programme_id">
                    <option value="0">Select programme</option>
                    <option :value="p.id" v-for="p in programmes" :key="p.id">{{ p.programme_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Name</label>
                <div class="col-md-9">
                  <input v-model.trim="form.faculty_name" type="text" class="form-control m-b-5">
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Code</label>
                <div class="col-md-9">
                  <input v-model.trim="form.faculty_code" type="text" class="form-control m-b-5">
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Abbrv</label>
                <div class="col-md-9">
                  <input v-model.trim="form.faculty_abbrv" type="text" class="form-control m-b-5">
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
            <h4 class="panel-title">Faculties</h4>
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
                    <th>Programme</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Abbrv</th>
                    <th width="1%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(f, i) in faculties" :key="f.id">
                    <td class="with-img">{{ ++i }}</td>
                    <td>{{ programmeName(f.programme_id) }}</td>
                    <td>{{ f.faculty_name }}</td>
                    <td>{{ f.faculty_code }}</td>
                    <td>{{ f.faculty_abbrv }}</td>
                    <td class="with-btn" nowrap>
                      <button
                        @click.stop.prevent="edit(f)"
                        class="btn btn-sm btn-primary width-60 m-r-2"
                      >Edit</button>
                      <button
                        @click.stop.prevent="deleteFaculty(f)"
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
  name: 'Faculties',
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
        faculty_name: '',
        faculty_code: '',
        faculty_abbrv: '',
        id: 0,
        institution_id: 0,
        programme_id: 0,
      },
      programmes: this.institution.programmes,
      faculties: this.institution.faculties,
    };
  },
  computed: {
    formOk() {
      return !!this.form.faculty_name &&
        !!this.form.faculty_code &&
        !!this.form.faculty_abbrv &&
        this.programmes.some(({ id }) => id === this.form.programme_id) &&
        this.faculties.every(({ faculty_name, faculty_code, faculty_abbrv }) =>
          faculty_name !== this.form.faculty_name ||
          faculty_code !== this.form.faculty_code ||
          faculty_abbrv !== this.form.faculty_abbrv);
    }
  },
  created() {
    this.form.institution_id = this.institution.id;
  },
  methods: {
    programmeName(id) {
      const p = this.programmes.find(p => p.id === id);
      return p ? p.programme_name : 'None';
    },
    clear() {
      this.form = Object.assign(this.form, {
        id: 0,
        programme_id: 0,
        faculty_name: '',
        faculty_code: '',
        faculty_abbrv: ''
      });
    },
    edit({ id, faculty_name, faculty_code, faculty_abbrv, programme_id }) {
      this.form = Object.assign(this.form, { id, faculty_name, faculty_code, faculty_abbrv, programme_id });
    },
    save() {
      this.form.faculty_name = this.form.faculty_name.toUpperCase();
      this.form.faculty_code = this.form.faculty_code.toUpperCase();
      this.form.faculty_abbrv = this.form.faculty_abbrv.toUpperCase();

      if (this.form.id) {
        axios
        .put(`/i/faculties/${this.form.id}`, this.form)
        .then(({ data: { success, data } }) => {
          if (success) {
            const idx = this.faculties.findIndex(({ id }) => id === this.form.id);
            this.faculties.splice(idx, 1, data);
          }
        })
        .catch(({ response: { data } }) => console.log("error", data));
      } else {
        axios
        .post('/i/faculties', this.form)
        .then(({ data: { success, data } }) => {
          if (success) {
            this.faculties.push(data);
            this.clear();
          }
        })
        .catch(({ response: { data } }) => console.log("error", data));
      }
    },
    deleteFaculty({ id }) {
      axios
      .delete(`/i/faculties/${id}`)
      .then(({ data: { success } }) => {
        if (success) {
          this.faculties = this.faculties.filter(f => f.id !== id);
        }
      })
      .catch(({ response: { data } }) => console.log("error", data));
    }
  }
}
</script>
