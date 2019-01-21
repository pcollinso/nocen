<template>
  <Page>
    <page-title title="Fields"/>
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Add field</h4>
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
                <label class="col-form-label col-md-3">Faculty</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="form.faculty_id">
                    <option value="0">Select faculty</option>
                    <option :value="f.id" v-for="f in faculties" :key="f.id">{{ f.faculty_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Department</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="form.department_id">
                    <option value="0">Select department</option>
                    <option
                      :value="d.id"
                      v-for="d in departments"
                      :key="d.id"
                    >{{ d.department_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Name</label>
                <div class="col-md-9">
                  <input v-model.trim="form.field_name" type="text" class="form-control m-b-5">
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Code</label>
                <div class="col-md-9">
                  <input v-model.trim="form.field_code" type="text" class="form-control m-b-5">
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Abbrv</label>
                <div class="col-md-9">
                  <input v-model.trim="form.field_abbrv" type="text" class="form-control m-b-5">
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
            <h4 class="panel-title">Fields</h4>
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
                    <th>Faculty</th>
                    <th>Department</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Abbrv</th>
                    <th width="1%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(f, i) in fields" :key="f.id">
                    <td class="with-img">{{ ++i }}</td>
                    <td>{{ programmeName(f.programme_id) }}</td>
                    <td>{{ facultyName(f.faculty_id) }}</td>
                    <td>{{ departmentName(f.department_id) }}</td>
                    <td>{{ f.field_name }}</td>
                    <td>{{ f.field_code }}</td>
                    <td>{{ f.field_abbrv }}</td>
                    <td class="with-btn" nowrap>
                      <button
                        @click.stop.prevent="edit(f)"
                        class="btn btn-sm btn-primary width-60 m-r-2"
                      >Edit</button>
                      <button
                        @click.stop.prevent="deleteField(f)"
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
  name: 'Fields',
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
        field_name: '',
        field_code: '',
        field_abbrv: '',
        id: 0,
        institution_id: 0,
        programme_id: 0,
        faculty_id: 0,
        department_id: 0,
      },
      programmes: this.institution.programmes,
      fields: this.institution.fields,
    };
  },
  computed: {
    faculties() {
      return this.institution.faculties
        .filter(({ programme_id }) => programme_id === this.form.programme_id);
    },
    departments() {
      return this.institution.departments
        .filter(({ faculty_id }) => faculty_id === this.form.faculty_id);
    },
    formOk() {
      return !!this.form.field_name &&
        !!this.form.field_code &&
        !!this.form.field_abbrv &&
        this.programmes.some(({ id }) => id === this.form.programme_id) &&
        this.faculties.some(({ id }) => id === this.form.faculty_id) &&
        this.departments.some(({ id }) => id === this.form.department_id) &&
        this.fields.every(({ field_name, field_code, field_abbrv }) =>
          field_name !== this.form.field_name ||
          field_code !== this.form.field_code ||
          field_abbrv !== this.form.field_abbrv);
    }
  },
  created() {
    this.form.institution_id = this.institution.id;
  },
  methods: {
    programmeName(id) {
      const p = this.institution.programmes.find(p => p.id === id);
      return p ? p.programme_name : 'None';
    },
    facultyName(id) {
      const f = this.institution.faculties.find(f => f.id === id);
      return f ? f.faculty_name : 'None';
    },
    departmentName(id) {
      const d = this.departments.find(d => d.id === id);
      return d ? d.department_name : 'None';
    },
    clear() {
      this.form = Object.assign(this.form, {
        id: 0,
        programme_id: 0,
        department_id: 0,
        faculty_id: 0,
        field_name: '',
        field_code: '',
        field_abbrv: ''
      });
    },
    edit({ id, field_name, field_code, field_abbrv, programme_id, faculty_id, department_id }) {
      this.form = Object.assign(this.form, {
        id,
        field_name,
        field_code,
        field_abbrv,
        programme_id,
        faculty_id,
        department_id
      });
    },
    save() {
      this.form.field_name = this.form.field_name.toUpperCase();
      this.form.field_code = this.form.field_code.toUpperCase();
      this.form.field_abbrv = this.form.field_abbrv.toUpperCase();

      if (this.form.id) {
        axios
        .put(`/i/fields/${this.form.id}`, this.form)
        .then(({ data: { success, data } }) => {
          if (success) {
            const idx = this.fields.findIndex(({ id }) => id === this.form.id);
            this.fields.splice(idx, 1, data);
          }
        })
        .catch(({ response: { data } }) => console.log("error", data));
      } else {
        axios
        .post('/i/fields', this.form)
        .then(({ data: { success, data } }) => {
          if (success) {
            this.fields.push(data);
            this.clear();
          }
        })
        .catch(({ response: { data } }) => console.log("error", data));
      }
    },
    deleteField({ id }) {
      axios
      .delete(`/i/fields/${id}`)
      .then(({ data: { success } }) => {
        if (success) {
          this.fields = this.fields.filter(f => f.id !== id);
        }
      })
      .catch(({ response: { data } }) => console.log("error", data));
    }
  }
}
</script>
