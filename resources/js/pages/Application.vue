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

            <payment-confirmation v-if="secondStep && !paymentConfirmed" :applicant="localApplicant" />

            <next-of-kin
              v-if="thirdStep"
              @nok="updateNextOfKins"
              :applicant="localApplicant"
              :genders="genders" />

            <olevel
              v-if="fourthStep"
              @olevel="updateOlevel"
              :applicant="localApplicant"
              :olevels="olevels" />

            <utme
              v-if="fifthStep"
              @utme="updateUtme"
              :applicant="localApplicant" />

            <passport
              v-if="sixthStep"
              @passport="updatePassport"
              :applicant="localApplicant" />
          </div>
        </div>
        <div class="mt-4">
          <button v-if="canPrev" @click.stop="prev()" class="btn btn-secondary">Previous</button>
          <button v-if="canNext" @click.stop="next()" class="btn btn-secondary">{{ nextLabel }}</button>
        </div>
      </div>
    </div>
  </Page>
</template>
<script>
import Page from './Page';
import PageTitle from '../components/header/PageTitle';
import ApplicationBiodata from '../components/application/Biodata';
import PaymentConfirmation from '../components/application/PaymentConfirmation';
import NextOfKin from '../components/application/NextOfKin';
import Olevel from '../components/application/Olevel';
import Utme from '../components/application/Utme';
import Passport from '../components/application/Passport';

export default {
  name: 'Application',
  components: {
    Page,
    PageTitle,
    ApplicationBiodata,
    PaymentConfirmation,
    NextOfKin,
    Olevel,
    Utme,
    Passport
  },
  props: ['applicant', 'genders', 'countries', 'states', 'lgas', 'religions', 'olevels'],
  data() {
    return {
      localApplicant: this.applicant,
      step: 1
    };
  },
  computed: {
    pageTitle() {
      if (this.firstStep) return 'Biodata';
      if (this.secondStep) return 'Payment confirmation';
      if (this.thirdStep) return 'Next of kin';
      if (this.fourthStep) return 'O Level';
      if (this.fifthStep) return 'UTME';
      if (this.sixthStep) return 'Passport';
    },
    nextLabel() {
      if (this.step < 6) return 'Next';
      return 'Finish';
    },
    firstStep() {
      return this.step === 1;
    },
    secondStep() {
      return this.step === 2;
    },
    thirdStep() {
      return this.step === 3;
    },
    fourthStep() {
      return this.step === 4;
    },
    fifthStep() {
      return this.step === 5;
    },
    sixthStep() {
      return this.step === 6;
    },
    canPrev() {
      return this.step > 1;
    },
    canNext() {
      if (this.firstStep) return this.firstStepDone;
      if (this.secondStep) return this.secondStepDone;
      if (this.thirdStep) return this.thirdStepDone;
      if (this.fourthStep) return this.fourthStepDone;
      if (this.fifthStep) return this.fifthStepDone;

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
    },
    secondStepDone() {
      return true; // TODO: Implement
    },
    thirdStepDone() {
      return !!this.localApplicant.next_of_kins.length;
    },
    fourthStepDone() {
      return !!this.localApplicant.olevel_results.length;
    },
    fifthStepDone() {
      return !!this.localApplicant.utme;
    },
    sixthStepDone() {
      return !!this.localApplicant.passport;
    },
    paymentConfirmed() {
      return true; // TODO: Implement
    }
  },
  created() {
    if (this.firstStepDone) ++this.step;
    if (this.secondStepDone) ++this.step;
    if (this.thirdStepDone) ++this.step;
    if (this.fourthStepDone) ++this.step;
    if (this.fifthStepDone) ++this.step;
  },
  methods: {
    next() {
      if (this.firstStep) {
        this.$refs.biodata.saveBiodata();

        if (this.paymentConfirmed) ++this.step;
      }

      ++this.step;
    },
    prev() {
      if (this.thirdStep && this.paymentConfirmed) --this.step;
      --this.step;
    },
    updateApplicant(obj) {
      this.localApplicant = obj;
    },
    updateNextOfKins(kins) {
      this.localApplicant.next_of_kins = kins;
    },
    updateOlevel(res) {
      this.localApplicant.olevel_results = res;
    },
    updateUtme(res) {
      this.localApplicant.utme = res;
    },
    updatePassport(url) {
      this.localApplicant.passport = url;
    }
  }
};
</script>
