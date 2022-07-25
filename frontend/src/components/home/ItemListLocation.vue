<template>
  <p @click="choiceLocation" class="input">{{code}} - {{name}}</p>
</template>

<script>
export default {
    name: 'ItemListLocation',
    props: {
        code: String,
        name: String
    },
    methods: {
        choiceLocation(event) {
            this.$emit('choiceLocation', event);
        }
    }

}
</script>

<style>

.home__form__list .input {
    
    position: relative;
    bottom: 2px;
    border-bottom: 1px solid #E3B8AA;
    cursor: pointer;
}

.home__form__list .input:hover {
    opacity: 0.7;
}
</style>