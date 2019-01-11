<script>
export default {
  name: 'FilterMixin',
  filters: {
    capitalize(value) {
      return !value ? '' : value.toString().charAt(0).toUpperCase() + value.slice(1);
    }
  }
}
</script>
