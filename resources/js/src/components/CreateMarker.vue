<template>
  <div id="marker_form">
    <marker-form :is-edit="false"></marker-form>
  </div>
</template>

<script>

  import MarkerForm from './MarkerForm';

  export default {
    name: 'CreateMarker',
    components: { MarkerForm }
  }
</script>