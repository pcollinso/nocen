<template>
  <Page>
    <breadcrumb/>
    <page-title title="Courses"/>
    <div class="row">
      <div class="col-lg-5 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">{{ formTitle }}</h4>
          </div>
          <!-- end panel-heading -->
          <!-- begin panel-body -->
          <div class="panel-body">
            <form @submit.stop.prevent="save()">
              <div class="form-group row m-b-15">
                <label class="control-label col-md-3">Programme * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="course.programme_id">
                    <option value="0">Select programme</option>
                    <option :value="p.id" v-for="p in programmes" :key="p.id">{{ p.programme_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="control-label col-md-3">Faculty * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="course.faculty_id">
                    <option value="0">Select faculty</option>
                    <option :value="f.id" v-for="f in faculties" :key="f.id">{{ f.faculty_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="control-label col-md-3">Department * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="course.department_id">
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
                <label class="control-label col-md-3">Level * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="course.level_id">
                    <option value="0">Select level</option>
                    <option :value="l.id" v-for="l in levels" :key="l.id">{{ l.level_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="control-label col-md-3">Semester * :</label>
                <div class="col-md-9">
                  <select class="form-control" v-model="course.semester_id">
                    <option value="0">Select semester</option>
                    <option :value="s.id" v-for="s in semesters" :key="s.id">{{ s.semester_name }}</option>
                  </select>
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Course name * :</label>
                <div class="col-md-9">
                  <input
                    v-model.trim="course.course_name"
                    type="text"
                    class="form-control m-b-5"
                    placeholder="Course name"
                  >
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Course code * :</label>
                <div class="col-md-9">
                  <input
                    v-model.trim="course.course_code"
                    type="text"
                    class="form-control m-b-5"
                    placeholder="Course code"
                  >
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Unit load * :</label>
                <div class="col-md-9">
                  <input v-model.number="course.unit_load" type="number" class="form-control m-b-5">
                </div>
              </div>
              <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">General :</label>
                <div class="col-md-9">
                  <input
                    v-model.number="course.is_general"
                    type="checkbox"
                    class="form-check-input m-b-5"
                  >
                </div>
              </div>
              <div class="form-group row m-b-15">
                <div class="col-sm-9 offset-md-3">
                  <button
                    :disabled="isDuplicateCourse"
                    type="submit"
                    class="btn btn-primary btn-sm"
                  >{{ buttonText }}</button>
                  <button @click.stop.prevent="clearForm()" class="btn btn-white btn-sm">Clear</button>
                </div>
              </div>
            </form>
            <!-- end table-responsive -->
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-heading -->
          <div class="panel-heading">
            <h4 class="panel-title">Courses</h4>
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
                    <th>Code</th>
                    <th>Unit load</th>
                    <th>Programme</th>
                    <th>Faculty</th>
                    <th>Department</th>
                    <th>Level</th>
                    <th>Semester</th>
                    <th>General</th>
                    <th width="1%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(course, i) in localCourses" :key="i">
                    <td class="with-img">{{ ++i }}</td>
                    <td>{{ course.course_name }}</td>
                    <td>{{ course.course_code }}</td>
                    <td>{{ course.unit_load }}</td>
                    <td>{{ programmeName(course.programme_id) }}</td>
                    <td>{{ facultyName(course.faculty_id) }}</td>
                    <td>{{ departmentName(course.department_id) }}</td>
                    <td>{{ levelName(course.level_id) }}</td>
                    <td>{{ semesterName(course.semester_id) }}</td>
                    <td>{{ course.general ? 'Yes' : 'No' }}</td>
                    <td class="with-btn" nowrap>
                      <button
                        @click.stop.prevent="view(course)"
                        class="btn btn-sm btn-primary width-60 m-r-2"
                      >Edit</button>
                      <button
                        @click.stop.prevent="deleteCourse(course)"
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

const defaultCourse = {
  course_code: '',
  course_name: '',
  institution_id: 0,
  programme_id: 0,
  faculty_id: 0,
  level_id: 0,
  semester_id: 0,
  status: 1,
  is_general: false,
  unit_load: 0.0,
};

export default {
  name: 'Courses',
  components: {
    Page,
    PageTitle,
    Breadcrumb
  },
  props: ['courses', 'programmes', 'faculties', 'departments', 'levels', 'semesters', 'institution'],
  data() {
    return {
      course: {},
      localCourses: this.courses
    };
  },
  computed: {
    buttonText() {
      return this.course.id ? 'Save' : 'Create';
    },
    formTitle() {
      const pre = this.course.id ? 'Update' : 'Add';
      return `${pre} course`;
    },
    isDuplicateCourse() {
      if (! Object.keys(this.course).length) return false;

      // If there's any course that shares duplicate values, return true
      return !!this.courses
        .filter((course) => {
          const { id, programme_id, semester_id, level_id, faculty_id, department_id, course_name, course_code } = course;
          const idsMatch = !!this.course.id ? id !== this.course.id : true;
          return idsMatch &&
            this.course.programme_id === programme_id &&
            this.course.level_id === level_id &&
            this.course.semester_id === semester_id &&
            this.course.faculty_id === faculty_id &&
            this.course.department_id === department_id &&
            this.course.course_name === course_name &&
            this.course.course_code === course_code;
        }).length ;
    }
  },
  created() {
    defaultCourse.institution_id = this.institution.id;
    this.course = { ...defaultCourse };
  },
  methods: {
    programmeName(id) {
      const p = this.programmes.find(p => id === p.id);
      if (p) return p.programme_name;
      return id;
    },
    facultyName(id) {
      const f = this.faculties.find(f => id === f.id);
      if (f) return f.faculty_name;
      return id;
    },
    departmentName(id) {
      const d = this.departments.find(d => id === d.id);
      if (d) return d.department_name;
      return id;
    },
    levelName(id) {
      const l = this.levels.find(l => id === l.id);
      if (l) return l.level_name;
      return id;
    },
    semesterName(id) {
      const s = this.semesters.find(s => id === s.id);
      if (s) return s.semester_name;
      return id;
    },
    clearForm() {
      this.course = { ...defaultCourse };
    },
    save() {
      const copy = { ...this.course };
      copy.course_name = copy.course_name.toUpperCase();
      copy.course_code = copy.course_code.toUpperCase();

      if (copy.id) {

        axios
        .put(`/i/courses/${copy.id}`, copy)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            alert('Course updated');
            this.localCourses = this.localCourses.map((course) => {
              if (data.id === course.id) return data;
              return course;
            });
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data } }) => console.log('error', data));
      } else {
        axios
        .post('/i/courses', copy)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            alert('Course created');
            this.localCourses.push(data);
            this.course = { ...defaultCourse };
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data } }) => console.log('error', data));
      }
    },
    view(course) {
      if (course) {
        this.selectedTitle = `Update ${course.course_name}`;
        this.course = { ...course };
      }
    },
    deleteCourse({ id }) {
      axios
      .delete(`/i/courses/${id}`)
      .then(({ data: { success } }) => {
        if (success) {
          this.localCourses = this.localCourses.filter(course => course.id !== id);
        }
      })
      .catch(({ response: { data } }) => console.log('error', data));
    }
  }
}
</script>
