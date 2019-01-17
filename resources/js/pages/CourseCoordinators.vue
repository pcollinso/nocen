<template>
  <Page>
    <breadcrumb/>
    <page-title title="Course coordinators"/>
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Add course coordinator</h4>
          </div>
          <!-- end panel-heading -->
          <!-- begin panel-body -->
          <div class="panel-body">
            <form @submit.stop.prevent="create()">
              <div class="form-group row m-b-15">
                <label class="control-label col-md-3">Staff * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="courseCoordinator.staff_id">
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
                <label class="control-label col-md-3">Course * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="courseCoordinator.course_id">
                    <option value="0">Select course</option>
                    <option
                      :value="x.id"
                      v-for="x in institution.courses"
                      :key="x.id"
                    >{{ x.course_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <div class="col-sm-9 offset-md-3">
                  <button
                    :disabled="duplicateCourseCoordinator"
                    type="submit"
                    class="btn btn-primary btn-sm"
                  >Create</button>
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
            <h4 class="panel-title">Course coordinators</h4>
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
                    <th>Staff code</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th width="1%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(x, i) in displayedCoursecoordinators" :key="x.id">
                    <td>{{ ++i }}</td>
                    <td>{{ x.verification_no }}</td>
                    <td>{{ x.full_name }}</td>
                    <td>{{ x.course_name }}</td>
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
import Breadcrumb from '../components/header/Breadcrumb';

const defaultCourseCoordinator = {
  institution_id: 0,
  course_id: 0,
  staff_id: 0,
  status: 1,
};

export default {
  name: 'CourseCoordinators',
  components: {
    Page,
    PageTitle,
    Breadcrumb
  },
  props: ['institution'],
  data() {
    return {
      courseCoordinator: {},
      localCourseCoordinators: this.institution.course_coordinators,
      staff: this.institution.staff,
      courses: this.institution.courses
    };
  },
  computed: {
    displayedCoursecoordinators() {
      return this.localCourseCoordinators
        .map(({ course_id, staff_id, id }) => {
          const { course_name } = this.courses.find(c => c.id === course_id);
          const { full_name, verification_no } = this.staff.find(s => s.id === staff_id);
          return { id, course_name, full_name, verification_no };
        });
    },
    duplicateCourseCoordinator() {
      return !!this.localCourseCoordinators
        .filter((cc) => {
          const { institution_id, course_id, staff_id } = cc;
          return this.courseCoordinator.course_id === course_id &&
            this.courseCoordinator.staff_id === staff_id;
        }).length ;
    }
  },
  created() {
    defaultCourseCoordinator.institution_id = this.institution.id;
    this.courseCoordinator = { ...defaultCourseCoordinator };
  },
  methods: {
    create() {
      axios
        .post('/i/course-coordinators', this.courseCoordinator)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            this.localCourseCoordinators.push(data);
            this.courseCoordinator = { ...defaultCourseCoordinator };
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data } }) => console.log('error', data));
    },
    remove(id) {
      axios
      .delete(`/i/course-coordinators/${id}`)
      .then(({ data: { success } }) => {
        if (success) {
          this.localCourseCoordinators = this.localCourseCoordinators.filter(cc => cc.id !== id);
        }
      })
      .catch(({ response: { data } }) => console.log('error', data));
    }
  }
}
</script>
