<template>
  <div>
    <div class="form-group">
      <label>Surname *</label>
      <input type="text" class="form-control" v-model="form.surname">
    </div>
    <div class="form-group">
      <label>First name *</label>
      <input type="text" class="form-control" v-model="form.first_name">
    </div>
    <div class="form-group">
      <label>Middle name</label>
      <input type="text" class="form-control" v-model="form.middle_name">
    </div>
    <div class="form-group">
      <label>Gender *</label>
      <select v-model="form.gender_id" class="form-control">
        <option v-for="g in genders" :key="g.id" :value="g.id">{{ g.gender_name }}</option>
      </select>
    </div>
    <div class="form-group">
      <label>Relationship *</label>
      <v-select v-model="relationship" :options="relationships" label="relationship" />
    </div>
    <div class="form-group">
      <button @click.stop="addKin()" :disabled="!formOk">Add next of kin</button>
    </div>
    <hr>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Surname</th>
          <th>First name</th>
          <th>Middle name</th>
          <th>Gender</th>
          <th>Relationship</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(k, idx) in kins" :key="k.id">
          <td>{{ idx + 1 }}</td>
          <td>{{ k.surname }}</td>
          <td>{{ k.first_name }}</td>
          <td>{{ k.middle_name }}</td>
          <td>{{ k.gender.gender_name }}</td>
          <td>{{ k.relationship.relationship }}</td>
          <td>
            <button @click.stop="removeKin(k.id, idx)">&times;</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'NextOfKin',
  props: ['applicant', 'genders'],
  data() {
    return {
      kins: this.applicant.next_of_kins,
      relationships: [],
      relationship: null,
      form: {
        surname: this.applicant.surname,
        first_name: '',
        middle_name: '',
        relationship_id: 0,
        gender_id: 0,
        institution_id: this.applicant.institution_id,
      }
    };
  },
  computed: {
    formOk() {
      return !!this.form.surname &&
        !!this.form.first_name &&
        !!this.form.gender_id &&
        !!this.form.relationship_id;
    }
  },
  watch: {
    relationship(val) {
      if (val) this.form.relationship_id = val.id;
    }
  },
  created() {
    this.fetchRelationships();
  },
  methods: {
    addKin() {
      this.form.surname = this.form.surname.trim().toUpperCase();
      this.form.first_name = this.form.first_name.trim().toUpperCase();
      this.form.middle_name = this.form.middle_name.trim().toUpperCase();

      axios
        .post(`/a/next-of-kins`, this.form)
        .then(({ data: { data } }) => {
          this.kins.push(data);
          this.form.gender_id = 0;
          this.form.relationship_id = 0;
          this.form.surname = this.applicant.surname;
          this.form.first_name = '';
          this.form.middle_name = '';

          this.$emit('nok', this.kins);
        });
    },
    removeKin(id, index) {
      if (! confirm('Are you sure?')) return;

      axios
        .delete(`/a/next-of-kins/${id}`)
        .then(() => {
          this.kins.splice(index, 1);

          this.$emit('nok', this.kins);
        });
    },
    fetchRelationships() {
      axios
        .get(`/options/relationships`)
        .then(({ data: { data } }) => {
          this.relationships = data;
        });
    }
  }
}
</script>
