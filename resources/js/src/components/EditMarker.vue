<template>
  <div id="marker_form">
    <marker-form is-edit></marker-form>
  </div>
</template>

<script>

  import MarkerForm from './MarkerForm';

  export default{
    name: 'EditMarker',
    components: { MarkerForm }
  }
</script>