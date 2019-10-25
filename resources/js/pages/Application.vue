<template>
  <Page>
    <page-title :title="pageTitle"/>
    <b-tabs content-class="mt-3">
      <b-tab title="Details" active>
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

                <div v-if="secondStep && !secondStepDone">
                  <h4>Application fee not paid or confirmed. <a href="/a/payments">Make/confirm payment</a></h4>
                </div>

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
              <button :disabled="!canPrev" @click.stop="prev()" class="btn btn-secondary">Previous</button>
              <button :disabled="!canNext" @click.stop="next()" class="btn btn-secondary">Next</button>
            </div>
          </div>
        </div>
      </b-tab>
      <b-tab title="Response">
        <div v-if="localApplicant.locked" class="row">
          <div class="col-lg-7 col-sm-12">
            <div class="panel panel-inverse">
              <div v-if="checkPostUtmePayment" class="panel-body">
                <h4>
                  Post-UTME result fee not paid/confirmed. <a href="/a/payments">Make/confirm payment</a>
                </h4>
              </div>
              <div v-else class="panel-body">
                <h4>Your Post UTME score is {{ localApplicant.admission.total_post_utme_score }}</h4>
                <h4>Your admission application has been {{ grantedMsg }}</h4>
                <hr>

                <h4 v-if="checkAcceptancePayment">
                  Acceptance fee not paid/confirmed. <a href="/a/payments">Make/confirm payment</a>
                </h4>
                <a v-else href="/a/biodata" target="_blank" class="btn btn-secondary">
                  Print biodata
                </a>

              </div>
            </div>
          </div>
        </div>
        <div v-else class="row">
          <div class="col-sm-12">
            <h4>Waiting for verdict...</h4>
          </div>
        </div>
      </b-tab>
    </b-tabs>
  </Page>
</template>
<script>
import Page from './Page';
import PageTitle from '../components/header/PageTitle';
import ApplicationBiodata from '../components/application/Biodata';
import PaymentConfirmation from '../components/application/PaymentConfirmation';
import ResultFeeConfirmation from '../components/application/ResultFeeConfirmation';
import AcceptanceFeeConfirmation from '../components/application/AcceptanceFeeConfirmation';
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
    ResultFeeConfirmation,
    AcceptanceFeeConfirmation,
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
    grantedMsg() {
      return ! this.localApplicant.locked ?
        '' :
        (this.localApplicant.admission.admitted ? 'granted' : 'denied');
    },
    checkPostUtmePayment() {
      const { localApplicant: { post_utme_fee, field: { programme: { require_result_check_fee } } } } = this;

      return require_result_check_fee && ! post_utme_fee;
    },
    checkAcceptancePayment() {
      const { localApplicant: { acceptance_fee, field: { programme: { require_acceptance_fee } } } } = this;

      return require_acceptance_fee && ! acceptance_fee;
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
      const { localApplicant: { application_fee, field: { programme: { require_application_fee } } } } = this;

      return ! require_application_fee ? true : !!application_fee && !!application_fee.amount;
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
      return !!this.localApplicant.locked;
    }
  },
  created() {
    if (! this.firstStepDone) return;
    ++this.step;
    if (! this.secondStepDone) return;
    ++this.step;
    if (! this.thirdStepDone) return;
    ++this.step;
    if (! this.fourthStepDone) return;
    ++this.step;
    if (! this.fifthStepDone) return;
    ++this.step;
    if (! this.sixthStepDone) return;
  },
  methods: {
    next() {
      if (this.firstStep) {
        if (! this.localApplicant.locked) this.$refs.biodata.saveBiodata();

        if (this.secondStepDone) ++this.step;
      }

      ++this.step;
    },
    prev() {
      if (this.thirdStep && this.secondStepDone) --this.step;
      if (! this.firstStep) --this.step;
    },
    updateApplicant(obj) {
      this.localApplicant = obj;
    },
    paymentConfirmed(obj) {
      this.updateApplicant(obj);
      this.next();
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
