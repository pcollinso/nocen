<template>
  <div class="d-inline">
    <div class="input-group">
      <input type="text" class="form-control" v-model.trim="rrr">
      <div class="input-group-append">
        <button :disabled="!rrr.length || busy" @click.stop="confirmPayment()" class="btn btn-sm btn-outline-secondary">
          {{ buttonText }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ApplicationFeeConfirmation',
  props: ['applicant', 'type'],
  data() {
    return {
      rrr: '',
      busy: false
    };
  },
  computed: {
    buttonText() {
      return this.busy ? 'Confirming...' : 'Confirm payment';
    },
    endpoint() {
      if (this.type === 'application') return '/a/confirm-application-fee';
      if (this.type === 'post-utme') return '/a/confirm-result-fee';
      if (this.type === 'acceptance') return '/a/confirm-acceptance-fee';
    }
  },
  methods: {
    confirmPayment() {
      if (this.busy) return;

      this.busy = true;

      axios
        .post(this.endpoint, { rrr: this.rrr })
        .then(({ data: { success, message, payment } }) => {
          this.busy = false;
          alert(message);
          if (success) this.$emit('payment-confirmed', Object.assign(this.applicant, { application_fee: payment }));
        })
        .catch(({ response: { data: { message } } }) => {
          this.busy = false;
          alert(message);
        });
    }
  }
};
</script>

