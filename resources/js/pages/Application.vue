<template>
  <Page>
    <page-title :title="pageTitle"/>
    <div class="row">
      <div class="col-lg-7 col-sm-12">
        <div class="panel panel-inverse">
          <!-- begin panel-body -->
          <div class="panel-body">
            <application-biodata
              v-if="firstStep"
              @update-applicant="updateApplicant"
              ref="biodata"
              :applicant="localApplicant"
              :genders="genders"
              :countries="countries"
              :states="states"
              :religions="religions"
              :lgas="lgas" />

            <h4 v-if="secondStep">Second step</h4>
          </div>
        </div>
        <div class="mt-4">
          <button :disabled="!canPrev" @click.stop="prev()" class="btn btn-secondary">Previous</button>
          <button :disabled="!canNext" @click.stop="next()" class="btn btn-secondary">{{ nextLabel }}</button>
        </div>
      </div>
    </div>
  </Page>
</template>
<script>
import Page from './Page';
import PageTitle from '../components/header/PageTitle';
import ApplicationBiodata from '../components/application/Biodata';

export default {
  name: 'Application',
  components: {
    Page,
    PageTitle,
    ApplicationBiodata
  },
  props: ['applicant', 'genders', 'countries', 'states', 'lgas', 'religions'],
  data() {
    return {
      localApplicant: this.applicant,
      step: 1
    };
  },
  computed: {
    pageTitle() {
      if (this.firstStep) return 'Biodata';
      if (this.secondStep) return 'Step 2';
      return '';
    },
    nextLabel() {
      if (this.step < 2) return 'Next';
      return 'Finish';
    },
    firstStep() {
      return this.step === 1;
    },
    secondStep() {
      return this.step === 2;
    },
    canPrev() {
      return this.step > 1;
    },
    canNext() {
      if (this.firstStep) return this.firstStepDone;

      return false;
    },
    firstStepDone() {
      const {
        localApplicant: {
          surname,
          first_name,
          gender_id,
          nationality_id,
          religion_id,
          state_id,
          lga_id,
          town_id,
          dob
        }
      } = this;

      return (surname || '').length >= 3 &&
        (first_name || '').length >= 3 &&
        gender_id &&
        nationality_id &&
        religion_id &&
        state_id &&
        lga_id &&
        town_id &&
        /^\d{4}-\d{2}-\d{2}$/.test(dob);
    }
  },
  methods: {
    next() {
      if (this.firstStep) this.$refs.biodata.saveBiodata();
      ++this.step;
    },
    prev() {
      --this.step;
    },
    updateApplicant(obj) {
      this.localApplicant = obj;
    }
  }
}
</script>
