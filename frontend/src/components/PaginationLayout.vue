<template>
    <div v-if="totalPages() > 0" class="post__list__navigation">
        <a href="#" v-if="showPreviousLink()" class="button__blue" v-on:click="updatePage(currentPage - 1)">Précédent</a>
        <a href="#" v-if="showNextLink()" class="button__blue" v-on:click="updatePage(currentPage + 1)">Suivant</a>
    </div>
</template>

<script>
export default {
    name: 'PaginationLayout',
    props : {
        cats: Array,
        currentPage: Number,
        pageSize: Number
    },
    methods: {
    updatePage(pageNumber) {
      this.$emit('page:update', pageNumber);
    },
    totalPages() {
      return Math.ceil(this.cats.length / this.pageSize);
    },
    showPreviousLink() {
      return this.currentPage == 0 ? false : true;
    },
    showNextLink() {
      return this.currentPage == (this.totalPages() - 1) ? false : true;
    }
  }
}
</script>

<style>

</style>