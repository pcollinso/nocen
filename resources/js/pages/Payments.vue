<template>
  <Page>
    <page-title title="Payments"/>
    <div>
      <div v-if="checkApplicationFee" class="form-group">
        <label>Application fee</label>
        &emsp;
        <div class="d-inline" v-if="applicationFeePaid">
          <i class="fa fa-check text-success h3"></i>
        </div>
        <div class="d-inline" v-else>
          <button class="btn btn-sm btn-outline-secondary">
            Pay
          </button>
          <button class="btn btn-sm btn-outline-secondary">
            Confirm bank payment
          </button>
        </div>
      </div>

      <div v-if="checkPostUtmeResultPayment" class="form-group">
        <label>Post-UTME result fee</label>
        &emsp;
        <div class="d-inline" v-if="postUtmeResultPaid">
          <i class="fa fa-check text-success h3"></i>
        </div>
        <div class="d-inline" v-else>
          <button class="btn btn-sm btn-outline-secondary">
            Pay
          </button>
          <button class="btn btn-sm btn-outline-secondary">
            Confirm bank payment
          </button>
        </div>
      </div>

      <div v-if="checkAcceptancePayment" class="form-group">
        <label>Acceptance fee</label>
        &emsp;
        <div class="d-inline" v-if="acceptanceFeePaid">
          <i class="fa fa-check text-success h3"></i>
        </div>
        <div class="d-inline" v-else>
          <button class="btn btn-sm btn-outline-secondary">
            Pay
          </button>
          <button class="btn btn-sm btn-outline-secondary">
            Confirm bank payment
          </button>
        </div>
      </div>
    </div>
  </Page>
</template>
<script>
import Page from './Page';
import PageTitle from '../components/header/PageTitle';

export default {
  name: 'Payments',
  components: {
    Page,
    PageTitle,
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
  }
};
</script>