<template>
  <div>
    <div class="form-group">
      <label>Result fee confirmation code</label>
      <input type="text" class="form-control" v-model.trim="confirmation_no">
    </div>
    <div class="form-group">
      <button :disabled="!confirmation_no.length || busy" @click.stop="confirmPayment()" class="btn btn-secondary">
        {{ buttonText }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ResultFeeConfirmation',
  props: ['applicant'],
  data() {
    return {
      confirmation_no: '',
      busy: false
    };
  },
  computed: {
    buttonText() {
      return this.busy ? 'Confirming...' : 'Confirm payment';
    }
  },
  methods: {
    confirmPayment() {
      if (this.busy) return;

      this.busy = true;

      axios
        .post(`/a/confirm-result-fee`, { confirmation_no: this.confirmation_no })
        .then(({ data: { success, message, payment } }) => {
          this.busy = false;
          alert(message);
          if (success) this.$emit('payment-confirmed', Object.assign(this.applicant, { post_utme_fee: payment }));
        })
        .catch(({ response: { data: { message } } }) => {
          this.busy = false;
          alert(message);
        });
    }
  }
};
</script>

