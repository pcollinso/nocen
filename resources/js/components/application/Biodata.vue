<template>
  <div>
    <div class="form-group">
      <label>Surname *</label>
      <input type="text" class="form-control" v-model="localApplicant.surname">
    </div>
    <div class="form-group">
      <label>First name *</label>
      <input type="text" class="form-control" v-model="localApplicant.first_name">
    </div>
    <div class="form-group">
      <label>Middle name</label>
      <input type="text" class="form-control" v-model="localApplicant.middle_name">
    </div>
    <div class="form-group">
      <label>Gender *</label>
      <select v-model="localApplicant.gender_id" class="form-control">
        <option v-for="g in genders" :key="g.id" :value="g.id">{{ g.gender_name }}</option>
      </select>
    </div>
    <div class="form-check">
      <input type="checkbox" v-model="localApplicant.is_disabled" class="form-check-input">
      <label>Are you disabled?</label>
    </div>
    <div class="form-group">
      <label>Religion *</label>
      <select v-model="localApplicant.religion_id" class="form-control">
        <option v-for="r in religions" :key="r.id" :value="r.id">{{ r.religion_name }}</option>
      </select>
    </div>
    <div class="form-group">
      <label>Nationality *</label>
      <v-select v-model="country" :options="countries" label="country" />
    </div>
    <div class="form-group">
      <label>State of origin *</label>
      <v-select v-model="state" :options="filteredStates" label="state" />
    </div>
    <div class="form-group">
      <label>LGA *</label>
      <v-select v-model="lga" :options="filteredLgas" label="name" />
    </div>
    <div class="form-group">
      <label>Town *</label>
      <v-select v-model="town" :options="filteredTowns" label="town" />
    </div>
    <div class="form-group">
      <label>Date of birth *</label>
      <flat-pickr :config="dateConfig" v-model="localApplicant.dob" type="text" class="form-control" />
    </div>
  </div>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';

export default {
  name: 'ApplicationBiodata',
  components: {
    flatPickr
  },
  props: ['applicant', 'genders', 'countries', 'states', 'lgas', 'religions'],
  data() {
    return {
      localApplicant: this.applicant,
      dateConfig: { maxDate: new Date(), enableTime: false, dateFormat: 'Y-m-d' },
      country: {},
      state: {},
      lga: {},
      town: {},
      towns: []
    };
  },
  computed: {
    filteredStates() {
      return this.country.id ?
        this.states.filter(({ country_id }) => country_id == this.country.id) :
        this.states;
    },
    filteredLgas() {
      return !this.state.id ? this.lgas : this.lgas.filter(({ state_id }) => state_id == this.state.id);
    },
    filteredTowns() {
      return !this.lga.id ? this.towns : this.towns.filter(({ lga_id }) => lga_id == this.lga.id);
    }
  },
  watch: {
    country(c) {
      if (c.id) this.localApplicant.nationality_id = c.id;
    },
    state(s) {
      if (s.id) {
        this.localApplicant.state_id = s.id;
        this.fetchTowns();
      }
    },
    lga(l) {
      if (l.id) this.localApplicant.lga_id = l.id;
    },
    town(t) {
      if (t.id) this.localApplicant.town_id = t.id;
    }
  },
  created() {
    this.country = this.countries.find(({ id }) => id === this.localApplicant.nationality_id) || {};
    this.state = this.states.find(({ id }) => id === this.localApplicant.state_id) || {};
    this.lga = this.lgas.find(({ id }) => id === this.localApplicant.lga_id) || {};

    if (this.state.id) this.fetchTowns();
  },
  methods: {
    fetchTowns() {
      this.towns = [];

      axios
        .get(`/options/towns/${this.state.id}`)
        .then(({ data: { towns } }) => {
          this.towns = towns;
          if (!!this.localApplicant.town_id) this.town = towns.find(({ id }) => id === this.localApplicant.town_id);
        });
    },
    saveBiodata() {
      this.localApplicant.surname = this.localApplicant.surname.trim().toUpperCase();
      this.localApplicant.first_name = this.localApplicant.first_name.trim().toUpperCase();
      this.localApplicant.middle_name = (this.localApplicant.middle_name || '').trim().toUpperCase();

      const copy = {
        surname: this.localApplicant.surname.trim().toUpperCase(),
        first_name: this.localApplicant.first_name.trim().toUpperCase(),
        middle_name: (this.localApplicant.middle_name || '').trim().toUpperCase(),
        nationality_id: this.localApplicant.nationality_id,
        state_id: this.localApplicant.state_id,
        lga_id: this.localApplicant.lga_id,
        town_id: this.localApplicant.town_id,
        gender_id: this.localApplicant.gender_id,
        religion_id: this.localApplicant.religion_id,
        is_disabled: this.localApplicant.is_disabled,
      }

      axios
        .put(`/a/update-applicant/${this.localApplicant.id}`, copy)
        .then(({ data: { data } }) => {
          console.log(data);
          this.localApplicant = data;
          this.$emit('update-applicant', data);
        });
    }
  }
};
</script>

