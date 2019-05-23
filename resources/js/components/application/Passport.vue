<template>
  <div>
    <div class="form-group">
      <label>Upload passport</label>
      <input type="file" class="form-control" accept="image/jpeg, image/png" @change="onFileInput">
    </div>
    <div v-if="passportUrl" class="form-group">
      <label>Uploaded passport</label>
      <br>
      <img class="rounded img" :src="passportSrc" width="200" height="200">
    </div>
  </div>
</template>

<script>
export default {
  name: 'Passport',
  props: ['applicant'],
  data() {
    return {
      passportUrl: this.applicant.passport
    };
  },
  computed: {
    passportSrc() {
      return `/storage/passports/${this.passportUrl}`;
    }
  },
  methods: {
    onFileInput(e) {
      const files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;

      if (2 < (files[0].size/1024/1024)) { // Check size in MB
        alert('File is larger than 2MB');
        e.target.value = null;
        return;
      };

      const formData = new FormData();
      formData.append('passport', files[0]);

      e.target.value = null;

      axios({
        method: 'post',
        url: '/a/passport',
        data: formData,
        config: { headers: { 'content-type': `multipart/form-data; boundary=${formData._boundary}` } }
      })
        .then(({ data: { path }}) => {
          this.passportUrl = path;
          this.$emit('passport', path);
        });
    }
  }
}
</script>

