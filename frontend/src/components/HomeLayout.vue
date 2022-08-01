<template>
  <main>
    <section class="home home__response__reverse">
      <div class="home__bloc__text">
        <h2 class="home__title">
          Tu cherches à donner ou adopter un chat ? Tu es au bon endroit !
        </h2>
        <p class="home__paragraph">
          Cat To Home est un site web dédié à la sensibilisation au problème de
          l’abandon d’animaux et se veut être une solution complémentaire aux
          refuges pour permettre l’adoption d’un animal et mettant en relation
          des particuliers propriétaires d’animaux et des personnes souhaitant
          en adopter.
        </p>
        <router-link class="button__orange--papate" v-bind:to="{ name: 'cat_add' }" v-if="this.$store.getters.getToken && this.$store.getters.getRole !== 'adopter'">Je donne un chat</router-link>
        <router-link class="button__orange--papate" v-bind:to="{ name: 'cat_add' }" v-if="!this.$store.getters.getToken">Je donne un chat</router-link>
      </div>
      <div class="home__img">
        <img class="cat__one" src="../assets/img/IMG_CAT1.png" alt="" />
      </div>
    </section>

    <!-- Formulaire de recherche -->
    <section class="home home__response bg__orange">
      <div class="home__img">
        <img src="../assets/img/IMG_CAT2.png" alt="Chat tenu par des bras sortant d'un vortex" />
      </div>
      <div class="home__bloc__text">
        <h2 class="home__title">Trouve ton futur compagnon félin !</h2>
        <form class="home__form" action="/cats">
          <label class="home__form__label" for="department">Localisation</label>
          <input @keyup="sendLocation" v-model="location_input" type="text" class="input"
            name="departement" id="department">
          <div id="home__form__list">
            <ItemListLocation v-for="location in locations" :key="location" :name="location"
              @choiceLocation="selectedLocation" />
          </div>
          <label class="home__form__label" for="filter">Trier</label>
          <select v-model="order" class="input" name="filter" id="filter">
            <option value="desc">
              Du plus anciens au plus récent
            </option>
            <option value="asc">Du plus récent au plus anciens</option>
          </select>
          <label class="home__form__label" for="filter">Filtre par age</label>
          <select v-model="age" class="input" name="filter" id="filter">
            <option value="tout_age">Tout âge</option>
            <option value="bebe">Bébé</option>
            <option value="junior">Junior</option>
            <option value="adulte">Adulte</option>
            <option value="senior">Sénior</option>
          </select>
          <router-link class="button__orange--papate"
            v-bind:to="{ name: 'cats', params: { ordre: order, localisation: location_input, age: age } }">
            Je trouve mon chat</router-link>
        </form>
      </div>
    </section>

    <!-- Carrousel -->
    <section>
      <h2 class="home__title home__title__carrousel">
        Il attendent un foyer depuis longtemps...!
      </h2>
      <div class="home">
        <a href=""><img class="arrow" src="../assets/icones/fleche_gauche.png" alt="" /></a>

        <!-- composant cards -->
        <CatCardLayout />

        <a href=""><img class="arrow" src="../assets/icones/fleche_droite.png" alt="" /></a>
      </div>
    </section>

    <section class="home home__response bg__blue">
      <div class="home__img">
        <img src="../assets/img/IMG_CAT3.png" alt="" />
      </div>
      <div class="home__bloc__text">
        <h2 class="home__title home__title__abandonment">
          L’abandon en France
        </h2>
        <p class="home__paragraph">
          Selon des estimations, ce serait chaque année plus de 100 000 animaux
          abandonnés en France, dont 60 000 d’entre eux durant la période
          estivale. L’année 2021 a notamment connu un record d’abandon
          d’animaux, surtout les chats et les nouveaux animaux de compagnie
          (NACs). « Le recueil aurait augmenté de 25 % sur le mois de juin 2021
          par rapport à 2019. En cause, les achats irresponsables et impulsifs
          d’animaux durant les différents confinements, afin de pouvoir sortir
          ou s’occuper. Une fois la vie normale reprise, les animaux sont
          abandonnés car ils ont besoin de trop de temps et de ressources »
          déplore la porte-parole de l’association de défense des droits des
          animaux.
        </p>
      </div>
    </section>

    <section class="home home__response">
      <div class="home__bloc__text">
        <h2 class="home__title">Les limites des refuges</h2>
        <p class="home__paragraph">
          Chaque année la fourrière confie à la SPA en moyenne 46 000 animaux.
          Cela représente 3600 par mois, pour 7000 places au total. Hors la
          règle pour les fourrières régies par les collectivités territoriales,
          c’est que les animaux qu’elles ne peuvent plus confier à des
          associations doivent être euthanasiés.
        </p>
      </div>
      <div class="home__img">
        <img src="../assets/img/IMG_CAT4.png" alt="" />
      </div>
    </section>
  </main>
</template>

<script>
import LocationService from '@/services/taxonomies/LocationService';
import CatCardLayout from '@/components/cat/CatCardLayout';
import ItemListLocation from '@/components/home/ItemListLocation';
export default {
  components: {
    CatCardLayout, ItemListLocation
  },
  name: "HomeLayout",
  data() {
    return {
      location_input: null,
      locations: [],
      order: null,
      age: null
    }
  },
  methods: {
    async sendLocation() {
      this.locations = [];
      document.querySelector('#home__form__list').style.height = '0';

      if (this.location_input != '') {
        const response = await LocationService.findAll();

        document.querySelector('#home__form__list').style.height = '12rem';
        response.forEach(location => {
          if (location.name.toLowerCase().includes(this.location_input.toLowerCase())) {
            this.locations.push(location.name)
          }
        });
        // this.locations = response.data
      }
    },
    selectedLocation(event) {
      const choiceLocation = event.currentTarget.textContent;
      this.location_input = choiceLocation
      this.locations = [];
      document.querySelector('#home__form__list').style.height = '0';
    }
  }
};
</script>

<style lang="scss" scoped>
.home__form {
  #home__form__list {
    overflow-x: auto;
  }

  #home__form__list::-webkit-scrollbar {
    display: none;
  }

  .input {
    margin-bottom: 1rem;
  }
}

</style>