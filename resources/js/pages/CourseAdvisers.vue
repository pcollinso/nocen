<template>
  <Page>
    <page-title title="Course advisers"/>
    <div class="row">
      <div class="col-lg-5 col-sm-12">
        <div class="panel panel-inverse">
          <div class="panel-heading">
            <h4 class="panel-title">Add course adviser</h4>
          </div>
          <div class="panel-body">
            <form @submit.stop.prevent="create()">
              <div class="form-group row m-b-15">
                <label class="control-label col-md-3">Department * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="courseAdviser.department_id">
                    <option value="0">Select department</option>
                    <option
                      :value="x.id"
                      v-for="x in institution.departments"
                      :key="x.id"
                    >{{ x.department_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="control-label col-md-3">Level * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="courseAdviser.level_id">
                    <option value="0">Select level</option>
                    <option :value="x.id" v-for="x in levels" :key="x.id">{{ x.level_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="control-label col-md-3">Staff * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="courseAdviser.staff_id">
                    <option value="0">Select staff</option>
                    <option
                      :value="x.id"
                      v-for="x in institution.staff"
                      :key="x.id"
                    >{{ x.full_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <div class="col-sm-9 offset-md-3">
                  <button
                    :disabled="duplicateCourseAdviser"
                    type="submit"
                    class="btn btn-primary btn-sm"
                  >Create</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Course advisers</h4>
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
                    <th>Department</th>
                    <th>Level</th>
                    <th>Staff code</th>
                    <th>Name</th>
                    <th width="1%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(x, i) in displayedCourseAdvisers" :key="x.id">
                    <td>{{ ++i }}</td>
                    <td>{{ x.department_name }}</td>
                    <td>{{ x.level_name }}</td>
                    <td>{{ x.verification_no }}</td>
                    <td>{{ x.full_name }}</td>
                    <td class="with-btn" nowrap>
                      <button
                        @click.stop.prevent="remove(x.id)"
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

const defaultCourseAdviser = {
  institution_id: 0,
  level_id: 0,
  staff_id: 0,
  department_id: 0,
  status: 1,
};

export default {
  name: 'CourseAdvisers',
  components: {
    Page,
    PageTitle
  },
  props: ['institution', 'levels'],
  data() {
    return {
      courseAdviser: {},
      courseAdvisers: this.institution.course_advisers
    };
  },
  computed: {
    displayedCourseAdvisers() {
      return this.courseAdvisers
        .map(({ department_id, staff_id, level_id, id }) => {
          const { department_name } = this.institution.departments.find(d => d.id === department_id);
          const { level_name } = this.levels.find(l => l.id === level_id);
          const { full_name, verification_no } = this.institution.staff.find(s => s.id === staff_id);
          return { id, department_name, level_name, full_name, verification_no };
        });
    },
    duplicateCourseAdviser() {
      return !!this.courseAdvisers
        .filter((x) => {
          const { department_id, staff_id, level_id } = x;
          return this.courseAdviser.department_id === department_id &&
            this.courseAdviser.staff_id === staff_id &&
            this.courseAdviser.level_id === level_id;
        }).length ;
    }
  },
  created() {
    defaultCourseAdviser.institution_id = this.institution.id;
    this.courseAdviser = { ...defaultCourseAdviser };
  },
  methods: {
    create() {
      axios
        .post('/i/course-advisers', this.courseAdviser)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            this.courseAdvisers.push(data);
            this.courseAdviser = { ...defaultCourseAdviser };
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data } }) => console.log('error', data));
    },
    remove(id) {
      axios
      .delete(`/i/course-advisers/${id}`)
      .then(({ data: { success } }) => {
        if (success) {
          this.courseAdvisers = this.courseAdvisers.filter(x => x.id !== id);
        }
      })
      .catch(({ response: { data } }) => console.log('error', data));
    }
  }
}
</script>
