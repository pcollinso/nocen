<template>
  <Page>
    <page-title title="Course prerequisites"/>
    <div class="row">
      <div class="col-lg-5 col-sm-12">
        <div class="panel panel-inverse">
          <div class="panel-heading">
            <h4 class="panel-title">Add course prerequisite</h4>
          </div>
          <div class="panel-body">
            <form @submit.stop.prevent="create()">
              <div class="form-group row m-b-15">
                <label class="control-label col-md-3">Course * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="coursePrerequisite.course_id">
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
                <label class="control-label col-md-3">Require course id :</label>
                <div class="col-md-9">
                  <input
                    type="number"
                    class="form-control"
                    v-model="coursePrerequisite.require_course_id"
                  >
                </div>
              </div>
              <div class="form-group row m-b-15">
                <div class="col-sm-9 offset-md-3">
                  <button
                    :disabled="duplicateCoursePrerequisite"
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
            <h4 class="panel-title">Course prerequisites</h4>
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
                    <th>Course</th>
                    <th>Require course id</th>
                    <th width="1%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(x, i) in displayedCoursePrerequisites" :key="x.id">
                    <td>{{ ++i }}</td>
                    <td>{{ x.course_name }}</td>
                    <td>{{ x.require_course_id }}</td>
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

const defaultCoursePrerequisite = {
  institution_id: 0,
  course_id: 0,
  require_course_id: 0,
};

export default {
  name: 'CoursePrerequisites',
  components: {
    Page,
    PageTitle
  },
  props: ['institution'],
  data() {
    return {
      coursePrerequisite: {},
      coursePrerequisites: this.institution.course_prerequisites
    };
  },
  computed: {
    displayedCoursePrerequisites() {
      return this.coursePrerequisites
        .map(({ course_id, require_course_id, id }) => {
          const { course_name } = this.institution.courses.find(c => c.id === course_id);
          return { id, course_name, require_course_id };
        });
    },
    duplicateCoursePrerequisite() {
      return !!this.coursePrerequisites
        .filter((x) => {
          const { course_id, require_course_id } = x;
          return this.coursePrerequisite.course_id === course_id &&
            this.coursePrerequisite.require_course_id === require_course_id;
        }).length ;
    }
  },
  created() {
    defaultCoursePrerequisite.institution_id = this.institution.id;
    this.coursePrerequisite = { ...defaultCoursePrerequisite };
  },
  methods: {
    create() {
      axios
        .post('/i/course-prerequisites', this.coursePrerequisite)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            this.coursePrerequisites.push(data);
            this.coursePrerequisite = { ...defaultCoursePrerequisite };
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data } }) => console.log('error', data));
    },
    remove(id) {
      axios
      .delete(`/i/course-prerequisites/${id}`)
      .then(({ data: { success } }) => {
        if (success) {
          this.coursePrerequisites = this.coursePrerequisites.filter(x => x.id !== id);
        }
      })
      .catch(({ response: { data } }) => console.log('error', data));
    }
  }
}
</script>

<style>
</style>
