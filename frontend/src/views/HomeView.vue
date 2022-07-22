<template>
<header-layout>

<HomeLayout>

<footer-layout>
</template>

<script>
import HeaderLayout from "@/components/template/HeaderLayout"; 
import HomeLayout from '../components/supports/HomeLayout.vue';
import FooterLayout from '../components/template/FooterLayout.vue';



export default{
    name: "HomeView", 
    components: {
        HeaderLayout, 
        HomeLayout,
        FooterLayout,
    }
};

</script>

<style scoped>

</style>
