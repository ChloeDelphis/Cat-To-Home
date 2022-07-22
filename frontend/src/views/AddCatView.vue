<template>
    <div>
        <headerLayout />
        <main>
            <h2 class="adoption__title">Créé la fiche adoption de ton chat</h2>
        </main>
        <FooterLayout />
    </div>
</template>

<script>
import HeaderLayout from '@/components/HeaderLayout';
import FooterLayout from '@/components/FooterLayout';

export default {
    name: 'NewRecipeView',
    components: {
        HeaderLayout,
        FooterLayout,
    }
}
</script>

<style scoped>
</style>
