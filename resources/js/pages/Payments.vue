<template>
  <Page>
    <page-title title="Payments"/>
    <div>
      <div v-if="checkApplicationFee" class="form-group">
        <label>Application fee</label>
        &emsp;
        <i v-if="applicationFeePaid" class="fa fa-check text-success h3"></i>
        <div class="row" v-else>
          <div class="col-md-1">
            <button class="btn btn-sm btn-outline-secondary">
              Pay
            </button>
          </div>
          <div class="col-md-2">
            <application-fee-confirmation @payment-confirmed="updateApplicant" type="application" />
          </div>
        </div>
        
      </div>

      <div v-if="checkPostUtmeResultPayment" class="form-group">
        <label>Post-UTME result fee</label>
        &emsp;
        <i v-if="postUtmeResultPaid" class="fa fa-check text-success h3"></i>
        <div class="row" v-else>
          <div class="col-md-1">
            <button class="btn btn-sm btn-outline-secondary">
              Pay
            </button>
          </div>
          <div class="col-md-2">
            <application-fee-confirmation @payment-confirmed="updateApplicant" type="post-utme" />
          </div>
        </div>
      </div>

      <div v-if="checkAcceptancePayment" class="form-group">
        <label>Acceptance fee</label>
        &emsp;
        <i v-if="acceptanceFeePaid" class="fa fa-check text-success h3"></i>
        <div class="row" v-else>
          <div class="col-md-1">
            <button class="btn btn-sm btn-outline-secondary">
              Pay
            </button>
          </div>
          <div class="col-md-2">
            <application-fee-confirmation @payment-confirmed="updateApplicant" type="acceptance" />
          </div>
        </div>
      </div>
    </div>
  </Page>
</template>
<script>
import Page from './Page';
import PageTitle from '../components/header/PageTitle';
import ApplicationFeeConfirmation from '../components/application/ApplicationFeeConfirmation';

export default {
  name: 'Payments',
  components: {
    Page,
    PageTitle,
    ApplicationFeeConfirmation,
  },
  props: ['applicant'],
  data() {
    return {
      localApplicant: this.applicant
    };
  },
  computed: {
    checkApplicationFee() {
      const { localApplicant: { field: { programme: { require_application_fee } } } } = this;

      return require_application_fee;
    },
    applicationFeePaid() {
      return !!this.localApplicant.application_fee;
    },
    checkPostUtmeResultPayment() {
      const { localApplicant: { field: { programme: { require_result_check_fee } } } } = this;

      return require_result_check_fee;
    },
    postUtmeResultPaid() {
      return !! this.localApplicant.post_utme_fee;
    },
    checkAcceptancePayment() {
      const { localApplicant: { field: { programme: { require_acceptance_fee } } } } = this;

      return require_acceptance_fee;
    },
    acceptanceFeePaid() {
      return !! this.localApplicant.acceptance_fee;
    }
  },
  methods: {
    updateApplicant(obj) {
      this.localApplicant = obj;
    }
  }
};
</script>