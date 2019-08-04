<template>
  <Page>
    <page-title title="Applications"/>
    <button v-if="application.id" class="btn btn-white mb-4" @click.stop="resetApplication()">&times;</button>
    <div class="row">
      <div v-if="application.id" class="col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">{{ application.full_name }}</h4>
          </div>
          <!-- end panel-heading -->
          <!-- begin panel-body -->
          <div class="panel-body">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4 text-left">
                    <button :disabled="!canPrev" @click.stop="prev()" class="btn btn-sm btn-outline-secondary">
                      <i class="fas fa-chevron-left"></i>
                      Previous
                    </button>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4 text-right">
                    <button :disabled="!canNext" @click.stop="next()" class="btn btn-sm btn-outline-secondary">
                      Next
                      <i class="fas fa-chevron-right"></i>
                    </button>
                  </div>
                </div>
                <hr>

                <div v-if="firstStep">
                  <h4>Programme</h4>
                  <div class="form-group row m-b-15">
                    <label class="control-label col-md-3">Programme * :</label>
                    <div class="col-md-9">
                      <select class="form-control" v-model="field.programme_id">
                        <option value="0">Select programme</option>
                        <option :value="p.id" v-for="p in institution.programmes" :key="p.id">{{ p.programme_name }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row m-b-15">
                    <label class="control-label col-md-3">Faculty * :</label>
                    <div class="col-md-9">
                      <select class="form-control" v-model="field.faculty_id">
                        <option value="0">Select faculty</option>
                        <option :value="f.id" v-for="f in faculties" :key="f.id">{{ f.faculty_name }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row m-b-15">
                    <label class="control-label col-md-3">Department * :</label>
                    <div class="col-md-9">
                      <select class="form-control" v-model="field.department_id">
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
                    <label class="control-label col-md-3">Field * :</label>
                    <div class="col-md-9">
                      <select class="form-control" v-model="field.id">
                        <option value="0">Select field</option>
                        <option :value="f.id" v-for="f in fields" :key="f.id">{{ f.field_name }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row m-b-15">
                    <div class="col-sm-9 offset-md-3">
                      <button @click.stop="changeProgramme()">Change programme</button>
                    </div>
                  </div>
                </div>

                <div v-if="secondStep">
                  <h4>Biodata</h4>
                  <div class="form-group">
                    <img class="rounded img" :src="passportSrc" width="200" height="200">
                  </div>
                  <div class="form-group">
                    <label>Surname</label>
                    <input readonly type="text" class="form-control" v-model="application.surname">
                  </div>
                  <div class="form-group">
                    <label>First name</label>
                    <input readonly type="text" class="form-control" v-model="application.first_name">
                  </div>
                  <div class="form-group">
                    <label>Middle name</label>
                    <input readonly type="text" class="form-control" v-model="application.middle_name">
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <input readonly type="text" class="form-control" v-model="application.gender.gender_name">
                  </div>
                  <div class="form-group">
                    <label>Disabled?</label>
                    <input readonly type="text" class="form-control" :value="application.is_disabled ? 'YES' : 'NO' ">
                  </div>
                  <div class="form-group">
                    <label>Religion</label>
                    <input readonly type="text" class="form-control" v-model="application.religion.religion_name">
                  </div>
                  <div class="form-group">
                    <label>Nationality</label>
                    <input readonly type="text" class="form-control" v-model="application.nationality.country">
                  </div>
                  <div class="form-group">
                    <label>State of origin</label>
                    <input readonly type="text" class="form-control" v-model="application.state.state">
                  </div>
                  <div class="form-group">
                    <label>LGA</label>
                    <input readonly type="text" class="form-control" v-model="application.lga.name">
                  </div>
                  <div class="form-group">
                    <label>Town</label>
                    <input readonly type="text" class="form-control" v-model="application.town.town">
                  </div>
                  <div class="form-group">
                    <label>Date of birth</label>
                    <input readonly type="text" class="form-control" v-model="application.dob">
                  </div>
                </div>

                <div v-if="thirdStep">
                  <h4>Next of kins</h4>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Surname</th>
                        <th>First name</th>
                        <th>Middle name</th>
                        <th>Gender</th>
                        <th>Relationship</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(k, idx) in application.next_of_kins" :key="k.id">
                        <td>{{ idx + 1 }}</td>
                        <td>{{ k.surname }}</td>
                        <td>{{ k.first_name }}</td>
                        <td>{{ k.middle_name }}</td>
                        <td>{{ k.gender.gender_name }}</td>
                        <td>{{ k.relationship.relationship }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div v-if="fourthStep">
                  <h4>O Level</h4>
                  <ul class="list-group">
                    <li v-for="r in application.olevel_results" :key="r.id" class="list-group-item">
                      <div class="row">
                        <div class="col-sm-12 col-md-10">
                          <div class="row">
                            <div class="col-sm-12">
                              <p>Year: {{ r.year }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <p>School: {{ r.exam_school }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <p>Exam: {{ r.exam_type.olevel_name }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <p>Exam Reg. #: {{ r.exam_reg }}</p>
                            </div>
                          </div>
                          <div v-for="(s, i) in subs" class="row" :key="i">
                            <div class="col-md-6">
                              <p>{{ subjectName(r[s]) }}</p>
                            </div>
                            <div class="col-md-6">
                              <p>{{ gradeName(r[`gd${++i}`]) }}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>

                <div v-if="fifthStep">
                  <h4>UTME</h4>
                  <ul class="list-group">
                    <li class="list-group-item">
                      <div class="row">
                        <div class="col-sm-12 col-md-10">
                          <div class="row">
                            <div class="col-sm-12">
                              <p>Year: {{ application.utme.year }}</p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12">
                              <p>JAMB Reg. #: {{ application.j_regno }}</p>
                            </div>
                          </div>
                          <div v-for="(s, i) in utmeSubjects" class="row" :key="i">
                            <div class="col-md-6">
                              <p>{{ subjectName(application.utme[s]) }}</p>
                            </div>
                            <div class="col-md-6">
                              <p>{{ application.utme[`score${++i}`] }}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>

                <div v-if="sixthStep">
                  <h4>Grant/deny admission</h4>
                  <div class="form-group">
                    <label>UTME score</label>
                    <input readonly type="text" class="form-control" :value="form.total_utme_score">
                  </div>
                  <div class="form-group">
                    <label>Post-UTME date</label>
                    <flat-pickr :config="dateConfig1" v-model="form.post_utme_on" type="text" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Post-UTME score</label>
                    <input type="text" class="form-control" v-model="form.total_post_utme_score">
                  </div>
                  <div class="form-group">
                    <label>Admission year</label>
                    <input type="number" class="form-control" v-model="form.admission_year">
                  </div>
                  <div class="form-group">
                    <label>Admission date</label>
                    <flat-pickr :config="dateConfig" v-model="form.admitted_on" type="text" class="form-control" />
                  </div>

                  <div class="form-group row m-b-15">
                    <div class="col-sm-9">
                      <button :disabled="!formOk" @click.stop="grantAdmission()" class="btn btn-primary btn-sm">Grant admission</button>
                      <button :disabled="!formOk" @click.stop="denyAdmission()" class="btn btn-danger btn-sm">Deny admission</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
      <div v-else :class="tableColClasses">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Applications</h4>
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
                    <th>Programme</th>
                    <th>Faculty</th>
                    <th>Department</th>
                    <th>Field</th>
                    <th width="1%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(application, i) in localApplications" :key="i">
                    <td class="with-img">{{ ++i }}</td>
                    <td>{{ application.full_name }}</td>
                    <td>{{ application.field.programme.programme_name }}</td>
                    <td>{{ application.field.faculty.faculty_name }}</td>
                    <td>{{ application.field.department.department_name }}</td>
                    <td>{{ application.field.field_name }}</td>
                    <td class="with-btn" nowrap>
                      <button
                        @click.stop.prevent="view(application)"
                        class="btn btn-sm btn-white width-60 m-r-2"
                      >View</button>
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
import flatPickr from 'vue-flatpickr-component';
import Page from './Page';
import PageTitle from '../components/header/PageTitle';

export default {
  name: 'Applications',
  components: {
    Page,
    PageTitle,
    flatPickr
  },
  props: ['applications', 'institution', 'subjects', 'grades'],
  data() {
    return {
      step: 1,
      subs: ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'sub7', 'sub8', 'sub9'],
      application: {},
      field: {},
      dateConfig: { minDate: new Date(), enableTime: false, dateFormat: 'Y-m-d' },
      dateConfig1: { maxDate: new Date(), enableTime: false, dateFormat: 'Y-m-d' },
      form: {
        institution_id: this.institution.id,
        application_id: 0,
        admission_year: new Date().getFullYear(),
        admitted: 0,
        total_utme_score: 0,
        total_post_utme_score: 0,
        post_utme_on: new Date(),
        admitted_on: new Date(),
      },
      localApplications: this.applications
    };
  },
  computed: {
    tableColClasses() {
      return !this.application.id ? 'col-sm-12' : 'col-md-7 col-sm-12';
    },
    utmeSubjects() {
      return this.subs.filter((_, idx) => idx < 4);
    },
    totalUtmeScore() {
      const { utme: { score1, score2, score3, score4 } } = this.application;
      return score1 + score2 + score3 + score4;
    },
    formOk() {
      return !!this.form.total_post_utme_score &&
        !!this.form.post_utme_on;
    },
    canPrev() {
      return this.step > 1;
    },
    canNext() {
      return this.step < 6;
    },
    firstStep() {
      return this.step === 1;
    },
    secondStep() {
      return this.step === 2;
    },
    thirdStep() {
      return this.step === 3;
    },
    fourthStep() {
      return this.step === 4;
    },
    fifthStep() {
      return this.step === 5;
    },
    sixthStep() {
      return this.step === 6;
    },
    passportSrc() {
      return `/storage/passports/${this.application.passport}`;
    },
    faculties() {
      return this.institution.faculties.filter(({ programme_id }) => programme_id === this.field.programme_id);
    },
    departments() {
      return this.institution.departments.filter(({ faculty_id }) => faculty_id === this.field.faculty_id);
    },
    fields() {
      return this.institution.fields.filter(({ department_id }) => department_id === this.field.department_id);
    }
  },
  methods: {
    view(application) {
      this.application = { ...application };
      this.field = application.field;
      this.resetForm();
      this.form.application_id = application.id;
      this.form.total_utme_score = this.totalUtmeScore;
    },
    resetApplication() {
      this.application = {};
      this.field = {};
      this.resetForm();
    },
    resetForm() {
      this.form = {
        institution_id: this.institution.id,
        application_id: 0,
        admission_year: new Date().getFullYear(),
        admitted: 0,
        total_utme_score: 0,
        total_post_utme_score: 0,
        post_utme_on: '',
        admitted_on: '',
      };
    },
    saveAdmission() {
      axios
        .post('/a/save-admission', this.form)
        .then(({ data: { success } }) => {
          if (success) {
            this.localApplications = this.localApplications.filter(a => this.application.id !== a.id);
            this.resetApplication();
          }
        });
    },
    grantAdmission() {
      if (! confirm('Are you sure?')) return;

      this.form.admitted = 1;

      this.saveAdmission();
    },
    denyAdmission() {
      if (! confirm('Are you sure?')) return;

      this.saveAdmission();
    },
    prev() {
      if (this.canPrev) --this.step;
    },
    next() {
      if (this.canNext) ++this.step;
    },
    subjectName(id) {
      const s = this.subjects.find(s => s.id == id);
      return s ? s.subject_name : '--';
    },
    gradeName(id) {
      const g = this.grades.find(s => s.id == id);
      return g ? g.grade_name : '--';
    },
    changeProgramme() {
      if (this.field.id === this.application.field_id) return;

      const idx = this.localApplications.findIndex(a => a.id === this.application.id);

      this.application.field_id = this.field.id;
      this.localApplications[idx].field_id = this.field.id;

      axios.put(`/a/update-applicant/${this.application.id}`, { field_id: this.field.id });
    }
  }
}
</script>
