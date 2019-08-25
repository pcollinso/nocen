<template>
  <Page>
    <page-title title="Applications"/>
    <button v-if="application.id" class="btn btn-white mb-4" @click.stop="resetApplication()">&times;</button>
    <div class="row">
      <application-review 
        v-if="application.id" 
        @grant="grantAdmission"
        @deny="denyAdmission"
        :application="application"
        :subjects="subjects"
        :grades="grades"
        :institution="institution" />

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
                    <th>Verdict</th>
                    <th width="1%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(application, i) in localApplications" :key="i">
                    <td class="with-img">{{ i + 1 }}</td>
                    <td>{{ application.full_name }}</td>
                    <td>{{ application.field.programme.programme_name }}</td>
                    <td>{{ application.field.faculty.faculty_name }}</td>
                    <td>{{ application.field.department.department_name }}</td>
                    <td>{{ application.field.field_name }}</td>
                    <td>{{ application.verdict }}</td>
                    <td class="with-btn" nowrap>
                      <button
                        @click.stop.prevent="view(i)"
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
import Page from './Page';
import PageTitle from '../components/header/PageTitle';
import ApplicationReview from '../components/application/ApplicationReview';

export default {
  name: 'Applications',
  components: {
    Page,
    PageTitle,
    ApplicationReview
  },
  props: ['applications', 'institution', 'subjects', 'grades'],
  data() {
    return {
      application: {},
      selectedIndex: -1,
      localApplications: this.applications.map((a) => {
        const verdict = !a.admission ? '...' : (a.admission.admitted == 1 ? 'Granted' : 'Denied');
        return { ...a, verdict };
      })
    };
  },
  computed: {
    tableColClasses() {
      return !this.application.id ? 'col-sm-12' : 'col-md-7 col-sm-12';
    }    
  },
  watch: {
    selectedIndex(i) {
      if (i < 0) {
        this.application = {};
      } else {
        this.application = this.localApplications[i];
      }
    }
  },
  methods: {
    view(index) {
      this.selectedIndex = index;
    },
    saveAdmission(form) {
      axios
        .post('/a/save-admission', form)
        .then(({ data: { success, data } }) => {
          if (success) {
            this.localApplications[selectedIndex].admission = data;
            this.localApplications[selectedIndex].verdict = data.admitted == 1 ? 'Granted' : 'Denied';
            this.selectedIndex = -1;
          }
        });
    },
    grantAdmission({ form, field_id }) {
      if (! confirm('Are you sure?')) return;

      this.localApplications[selectedIndex].field_id = field_id;
      form.admitted = 1;

      this.saveAdmission(form);
    },
    denyAdmission({ form }) {
      if (! confirm('Are you sure?')) return;

      this.saveAdmission(form);
    },
  }
}
</script>
