<template>
  <!-- begin page-header -->
  <h1 class="page-header">
    {{ title }}
    <small>{{ subtitle }}</small>
  </h1>
  <!-- end page-header -->
</template>
<script>
export default {
  name: 'PageTitle',
  props: ['title', 'subtitle']
}
</script>
