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
            <button class="btn btn-sm btn-outline-secondary" @click="payApplicationFee()">
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
            <button class="btn btn-sm btn-outline-secondary" @click="payPostUtmeFee()">
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
            <button class="btn btn-sm btn-outline-secondary" @click="payAcceptanceFee()">
              Pay
            </button>
          </div>
          <div class="col-md-2">
            <application-fee-confirmation @payment-confirmed="updateApplicant" type="acceptance" />
          </div>
        </div>
      </div>

      <div ref="modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Make payment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div v-if="payment" class="modal-body">
              <p>
                RRR: {{ payment.rrr }}<br>
                Order ID: {{ payment.order_id }}<br>
                You can pay in the bank using the above details <br>
                Or click on the button below to pay here.
              </p>
              <form method="POST" action="https://login.remita.net/remita/ecomm/finalize.reg">
                <input type="hidden" name="merchantId" :value="localApplicant.institution.terminal_id">
                <input type="hidden" name="rrr" :value="payment.rrr">
                <input type="hidden" name="responseurl" :value="responseUrl">
                <input type="hidden" name="hash" :value="hash">
                <div class="form-group">
                  <input type="submit" value="Proceed" class="btn btn-secondary">
                </div>
              </form>
            </div>
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
  props: ['applicant', 'responseUrl'],
  data() {
    return {
      localApplicant: this.applicant,
      payment: null,
      fee: '',
      hash: '',
      rrrGenerated: false,
      busy: false
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
    },
    payAcceptanceFee() {
      this.fee = 'ACCEPTANCE_FEE';
      this.generateRrr('ACCEPTANCE_FEE');
    },
    payApplicationFee() {
      this.fee = 'APPLICATION_FEE';
      this.generateRrr('APPLICATION_FEE');
    },
    payPostUtmeFee() {
      this.fee = 'POST_UTME_RESULT_CHECK_FEE';
      this.generateRrr('POST_UTME_RESULT_CHECK_FEE');
    },
    generateRrr(fee) {
      if (this.busy) return;

      this.busy = true;
      this.rrrGenerated = false;
      this.payment = null;

      axios
        .post('/a/generate-rrr', { fee })
        .then(({ data: { success, message, payment } }) => {
          this.busy = false;
          if (success) {
            this.rrrGenerated = true;
            this.payment = payment;
            this.getHash(payment.rrr);
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data: { message } } }) => {
          this.busy = false;
          alert(message);
        });
    },
    getHash(rrr) {
      axios
        .post('/a/generate-rrr-hash', { rrr })
        .then(({ data: { hash } }) => {
          this.hash = hash;
        })
    }
  }
};
</script>