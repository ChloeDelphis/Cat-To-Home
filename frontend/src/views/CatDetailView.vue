<template>
    <header-layout />
    <cat-layout />
    <footer-layout />
</template>

<script>
import HeaderLayout from '@/components/template/HeaderLayout.vue'
import CatLayout from '@/components/cat/CatLayout.vue'
import FooterLayout from '@/components/template/FooterLayout.vue'
    

    export default {
        name: "CatDetailView",
        components: {
                HeaderLayout,
                CatLayout,
                FooterLayout
        }
    }


</script>

<style scoped>

</style>
