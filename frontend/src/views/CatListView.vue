<template>
    
    <div>
        <HeaderLayout/>
        <CatsLayout/>
        <FooterLayout/>
    </div>

</template>

<script>
import HeaderLayout from "../components/template/HeaderLayout.vue";
import CatsLayout from "../components/cat/CatsLayout.vue";
import FooterLayout from "../components/template/FooterLayout.vue";

export default {
  name: 'CatListView',
  components: {
    HeaderLayout,
    FooterLayout,
    CatsLayout
  },
}



</script>

