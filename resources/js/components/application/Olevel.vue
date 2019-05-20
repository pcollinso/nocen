<template>
  <div>
    <div v-if="canAddResult">

      <div class="form-group">
        <label>Year</label>
        <select v-model="form.year" class="form-control">
          <option :key="y" :value="y" v-for="y in range(1990, currentYear)">{{ y }}</option>
        </select>
      </div>
      <div class="form-group">
        <label>Result type</label>
        <select v-model="form.olevel_id" class="form-control">
          <option :key="o.id" :value="o.id" v-for="o in olevels">{{ o.olevel_name }}</option>
        </select>
      </div>
      <div class="form-group">
        <label>School</label>
        <input type="text" v-model="form.exam_school" class="form-control">
      </div>
      <div class="form-group">
        <label>Exam Reg. #</label>
        <input type="text" v-model="form.exam_reg" class="form-control">
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Subject #1</label>
            <select v-model="form.sub1" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in subjects">{{ o.subject_name }}</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label>Grade #1</label>
            <select v-model="form.gd1" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in grades">{{ o.grade_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Subject #2</label>
            <select v-model="form.sub2" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in subjects">{{ o.subject_name }}</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label>Grade #2</label>
            <select v-model="form.gd2" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in grades">{{ o.grade_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Subject #3</label>
            <select v-model="form.sub3" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in subjects">{{ o.subject_name }}</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label>Grade #3</label>
            <select v-model="form.gd3" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in grades">{{ o.grade_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Subject #4</label>
            <select v-model="form.sub4" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in subjects">{{ o.subject_name }}</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label>Grade #4</label>
            <select v-model="form.gd4" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in grades">{{ o.grade_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Subject #5</label>
            <select v-model="form.sub5" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in subjects">{{ o.subject_name }}</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label>Grade #5</label>
            <select v-model="form.gd5" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in grades">{{ o.grade_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Subject #6</label>
            <select v-model="form.sub6" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in subjects">{{ o.subject_name }}</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label>Grade #6</label>
            <select v-model="form.gd6" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in grades">{{ o.grade_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Subject #7</label>
            <select v-model="form.sub7" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in subjects">{{ o.subject_name }}</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label>Grade #7</label>
            <select v-model="form.gd7" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in grades">{{ o.grade_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Subject #8</label>
            <select v-model="form.sub8" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in subjects">{{ o.subject_name }}</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label>Grade #8</label>
            <select v-model="form.gd8" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in grades">{{ o.grade_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <label>Subject #9</label>
            <select v-model="form.sub9" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in subjects">{{ o.subject_name }}</option>
            </select>
          </div>
          <div class="col-sm-6">
            <label>Grade #9</label>
            <select v-model="form.gd9" class="form-control">
              <option :key="o.id" :value="o.id" v-for="o in grades">{{ o.grade_name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group text-center">
        <button :disabled="!formOk" @click.stop="addResult()">Add result</button>
      </div>
      <hr>
    </div>
    <ul class="list-group">
      <li v-for="(r, idx) in olevelResults" :key="r.id" class="list-group-item">
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
          <div class="col-sm-12 col-md-2">
            <button @click.stop="removeResult(r.id, idx)">&times;</button>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'OLevel',
  props: ['applicant', 'olevels'],
  data() {
    return {
      olevelResults: this.applicant.olevel_results,
      currentYear: new Date().getFullYear(),
      subjects: [],
      grades: [],
      subs: ['sub1', 'sub2', 'sub3', 'sub4', 'sub5', 'sub6', 'sub7', 'sub8', 'sub9'],
      form: {
        year: new Date().getFullYear(),
        exam_school: '',
        olevel_id: 0,
        sub1: null,
        sub2: null,
        sub3: null,
        sub4: null,
        sub5: null,
        sub6: null,
        sub7: null,
        sub8: null,
        sub9: null,
        gd1: null,
        gd2: null,
        gd3: null,
        gd4: null,
        gd5: null,
        gd6: null,
        gd7: null,
        gd8: null,
        gd9: null,
        exam_reg: '',
        application_id: this.applicant.application_id,
        institution_id: this.applicant.institution_id,
      }
    };
  },
  computed: {
    canAddResult() {
      return this.olevelResults.length < 2;
    },
    formOk() {
      return !!this.form.exam_school &&
        !!this.form.exam_reg &&
        !!this.form.olevel_id &&
        this.subs.some(k => this.form[k]) &&
        ['gd1', 'gd2', 'gd3', 'gd4', 'gd5', 'gd6', 'gd7', 'gd8', 'gd9'].some(k => this.form[k]);
    }
  },
  created() {
    this.fetchSubjects();
    this.fetchGrades();
  },
  methods: {
    range(start, end) {
      const _ = Array
        .apply(null, Array(end + 1))
        .map((_, i) => i)
        .filter((i) => i >= start);

      _.sort((a, b) => b - a);
      return _;
    },
    resetForm() {
      const obj = {
        year: new Date().getFullYear(),
        exam_school: '',
        olevel_id: 0,
        sub1: null,
        sub2: null,
        sub3: null,
        sub4: null,
        sub5: null,
        sub6: null,
        sub7: null,
        sub8: null,
        sub9: null,
        gd1: null,
        gd2: null,
        gd3: null,
        gd4: null,
        gd5: null,
        gd6: null,
        gd7: null,
        gd8: null,
        gd9: null,
        exam_reg: ''
      };

      this.form = Object.assign(this.form, obj);
    },
    addResult() {
      this.form.exam_school = this.form.exam_school.toUpperCase().trim();

      axios
        .post(`/a/olevel-results`, this.form)
        .then(({ data: { data } }) => {
          this.olevelResults.push(data);
          this.resetForm();

          this.$emit('olevel', this.olevelResults);
        });
    },
    removeResult(id, index) {
      if (! confirm('Are you sure?')) return;

      axios
        .delete(`/a/olevel-results/${id}`)
        .then(() => {
          this.olevelResults.splice(index, 1);

          this.$emit('olevel', this.olevelResults);
        });
    },
    fetchSubjects() {
      axios
        .get(`/options/subjects`)
        .then(({ data: { data } }) => {
          this.subjects = data;
        });
    },
    fetchGrades() {
      axios
        .get(`/options/olevel-grades`)
        .then(({ data: { data } }) => {
          this.grades = data;
        });
    },
    subjectName(id) {
      const s = this.subjects.find(s => s.id == id);
      return s ? s.subject_name : '--';
    },
    gradeName(id) {
      const g = this.grades.find(s => s.id == id);
      return g ? g.grade_name : '--';
    }
  }
};
</script>

