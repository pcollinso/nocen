<template>
  <div>
    <div v-if="canAddResult">

      <div class="form-group">
        <label>Year</label>
        <select v-model="form.year" class="form-control">
          <option :key="y" :value="y" v-for="y in range(currentYear - 2, currentYear)">{{ y }}</option>
        </select>
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
            <label>Score #1</label>
            <input type="number" v-model="form.score1" class="form-control">
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
            <label>Score #2</label>
            <input type="number" v-model="form.score2" class="form-control">
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
            <label>Score #3</label>
            <input type="number" v-model="form.score3" class="form-control">
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
            <label>Score #4</label>
            <input type="number" v-model="form.score4" class="form-control">
          </div>
        </div>
      </div>
      <div class="form-group text-center">
        <button :disabled="!formOk" @click.stop="addResult()">Add result</button>
      </div>
      <hr>
    </div>
    <ul class="list-group">
      <li v-if="utme" class="list-group-item">
        <div class="row">
          <div class="col-sm-12 col-md-10">
            <div class="row">
              <div class="col-sm-12">
                <p>Year: {{ utme.year }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <p>JAMB Reg. #: {{ applicant.j_regno }}</p>
              </div>
            </div>
            <div v-for="(s, i) in subs" class="row" :key="i">
              <div class="col-md-6">
                <p>{{ subjectName(utme[s]) }}</p>
              </div>
              <div class="col-md-6">
                <p>{{ utme[`score${++i}`] }}</p>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-2">
            <button @click.stop="removeResult(utme.id)">&times;</button>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'Utme',
  props: ['applicant'],
  data() {
    return {
      utme: this.applicant.utme,
      currentYear: new Date().getFullYear(),
      subjects: [],
      subs: ['sub1', 'sub2', 'sub3', 'sub4'],
      form: {
        year: new Date().getFullYear(),
        sub1: null,
        sub2: null,
        sub3: null,
        sub4: null,
        score1: null,
        score2: null,
        score3: null,
        score4: null,
        application_id: this.applicant.id,
        institution_id: this.applicant.institution_id,
      }
    };
  },
  computed: {
    canAddResult() {
      return !this.utme;
    },
    formOk() {
      return !!this.form.year &&
        this.subs.every(k => this.form[k]) &&
        ['score1', 'score2', 'score3', 'score4'].every(k => this.form[k]);
    }
  },
  created() {
    this.fetchSubjects();
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
        sub1: null,
        sub2: null,
        sub3: null,
        sub4: null,
        score1: null,
        score2: null,
        score3: null,
        score4: null,
      };

      this.form = Object.assign(this.form, obj);
    },
    addResult() {
      axios
        .post(`/a/utme-result`, this.form)
        .then(({ data: { data } }) => {
          this.utme = data;
          this.resetForm();

          this.$emit('utme', this.utme);
        });
    },
    removeResult(id) {
      if (! confirm('Are you sure?')) return;

      axios
        .delete(`/a/utme-result/${id}`)
        .then(() => {
          this.utme = null;

          this.$emit('utme', this.utme);
        });
    },
    fetchSubjects() {
      axios
        .get(`/options/subjects`)
        .then(({ data: { data } }) => {
          this.subjects = data;
        });
    },
    subjectName(id) {
      const s = this.subjects.find(s => s.id == id);
      return s ? s.subject_name : '--';
    }
  }
};
</script>

