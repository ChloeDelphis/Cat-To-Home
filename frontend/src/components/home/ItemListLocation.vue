<template>
  <p @click="choiceLocation" class="input__departement__select">{{name}}</p>

</template>

<script>
export default {
    name: 'ItemListLocation',
    props: {
        name: String
    },
    methods: {
        // Renvoie l'info que l'élément a été ciblé à son composent parent 
        choiceLocation(event) {
            this.$emit('choiceLocation', event);
        }
    }

}
</script>

<style lang="scss" scoped>

#home__form__list {
    bottom: 0px;
    border-bottom: 1px solid #E3B8AA;
    cursor: pointer;
    .input__departement__select {
        padding: 0.5rem;
        color: #586FCD;
    }
}


#home__form__list .input:hover {
    opacity: 0.7;
}
</style>