<template>
  <main class="cat__list">
    <section class="title">
      <img
        src="../../assets/img/purr-shopping.png"
        alt="Un chat dans un caddie"
      />
      <h2>Trouve ton futur compagnon félin !</h2>
    </section>

    <!-- FORMULAIRE DE FILTRE DE RECHERCHE -->

    <section class="research">
      <div class="search__cat__form">
        <div>
          <label for="department">Localisation</label>
          <input
            @keyup="sendLocation"
            v-model="location_input"
            type="text"
            class="input"
            name="departement"
            id="department"
          />
          <div id="home__form__list">
            <ItemListLocation
              v-for="location in locations"
              :key="location"
              :name="location"
              @choiceLocation="selectedLocation"
            />
          </div>
        </div>
        <div>
          <label for="filter">Filtre de recherche</label>
          <select v-model="order" name="filter" id="filter" class="input">
            <option value="desc" selected>
              Du plus anciens au plus récent
            </option>
            <option value="asc">Du plus récent au plus anciens</option>
          </select>
        </div>
        <div>
          <label class="home__form__label" for="filter">Filtre par age</label>
          <select v-model="age" class="input" name="filter" id="filter">
            <option value="tout_age">Tout âge</option>
            <option value="bebe">Bébé</option>
            <option value="junior">Junior</option>
            <option value="adulte">Adulte</option>
            <option value="senior">Sénior</option>
          </select>
        </div>
        <button @click="searchCats" class="button__orange--papate">
          Je trouve mon chat
        </button>
      </div>
    </section>

    <!-- LISTE DES CHATS -->

    <section class="post__list">
      <div class="post__list__container">
        <CatCardLayout
          v-bind:id="cat.id"
          v-bind:localisation="cat._embedded['wp:term'][2][0].name"
          v-bind:name="cat.title.rendered"
          v-bind:picture="cat._embedded['wp:featuredmedia'][0].source_url"
          v-for="cat in cats"
          v-bind:key="cat.title"
        />
      </div>

      <div class="post__list__navigation">
        <a class="button__blue" href="">Précédent</a>
        <a class="button__blue" href="">Suivant</a>
      </div>
    </section>
  </main>
</template>

<script>
import LocationService from "@/services/taxonomies/LocationService";
import ItemListLocation from "@/components/home/ItemListLocation";
import CatCardLayout from "@/components/cat/CatCardLayout";
import CatService from "@/services/cat/CatService";

export default {
  name: "CatsLayout",
  components: {
    CatCardLayout,
    ItemListLocation,
  },
  async mounted() {
    this.searchCats();
  },
  methods: {
    // Récupere la liste des départements en fonction de se qu'il est tapé dans l'input
    async sendLocation() {
      this.locations = [];
      document.querySelector("#home__form__list").style.height = "0";

      if (this.location_input != "") {
        const response = await LocationService.findAll();
        if (response.length != 0) {
          document.querySelector("#home__form__list").style.height = "12rem";
          response.forEach((location) => {
            if (
              location.name
                .toLowerCase()
                .includes(this.location_input.toLowerCase())
            ) {
              this.locations.push(location.name);
            }
          });
        }
      }
    },
    // Récupere le département selectionné par l'utilisateur et l'ajoute à l'input
    selectedLocation(event) {
      const choiceLocation = event.currentTarget.textContent;
      console.log(choiceLocation);
      this.location_input = choiceLocation;
      this.location_selected = choiceLocation;
      document.querySelector("#home__form__list").style.height = "0";
    },
    // Permet de lancer la recherche en fonction des filtres selectionnés
    async searchCats() {
      this.cats = [];
      this.cats =
        this.order === "asc"
          ? (this.cats = await CatService.findAllByOrder(this.order))
          : (this.cats = await CatService.findAll());
      this.location_selected = this.location_input;
      this.cats = this.catsList();
    },
    // filtre le tableau cats en fonction des filtres sélectionnés
    catsList() {
      return this.cats.filter((cat) => {
        if (this.location_selected === "" && this.age === "") {
          return true;
        } else if (this.age == "tout_age" && this.location_selected === "") {
          return true;
        } else {
          if (this.location_selected !== "" && this.age !== "") {
            if (this.age == "tout_age") {
              if (
                cat._embedded["wp:term"][2][0].name === this.location_selected
              ) {
                return true;
              }
            } else if (
              cat._embedded["wp:term"][2][0].name === this.location_selected &&
              cat.meta.age === this.age
            ) {
              return true;
            }
          } else if (this.location_selected !== "" && this.age === "") {
            if (
              cat._embedded["wp:term"][2][0].name === this.location_selected
            ) {
              return true;
            }
          } else if (this.age !== "" && this.location_selected === "") {
            if (cat.meta.age === this.age) {
              return true;
            }
          } else {
            return false;
          }
        }
      });
    },
  },
  data() {
    return {
      cats: [],
      location_input: this.$route.params.location || "",
      locations: [],
      location_selected: this.$route.params.location || "",
      order: this.$route.params.order || "",
      age: this.$route.params.age || "",
    };
  },
};
</script>

<style lang="scss" scoped>
.research {
  #home__form__list {
    width: auto;
    position: relative;
    z-index: 999;
    bottom: 22px;
    overflow: scroll;
  }

  #home__form__list::-webkit-scrollbar {
    display: none;
  }

  .search__cat__form div {
    margin-right: 1rem;
  }
}
</style>