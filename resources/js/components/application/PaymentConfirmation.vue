<template>
  <div>
    <div class="form-group">
      <label>Confirmation code</label>
      <input type="text" class="form-control" v-model="code">
    </div>
    <div class="form-group">
      <button :disabled="!code.length" @click.stop="confirmPayment()" class="btn btn-secondary">Confirm payment</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PaymentConfirmation',
  props: ['applicant'],
  data() {
    return {
      localApplicant: this.applicant,
      code: '',
    };
  },
  methods: {
    confirmPayment() {
      axios
        .post(`/a/${this.localApplicant.id}/confirm-application-fee`)
        .then(({ data: { data } }) => {
          console.log(data);
          // this.localApplicant = data;
          // this.$emit('update-applicant', data);
        });
    }
  }
};
</script>

