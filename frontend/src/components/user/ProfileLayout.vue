<template>
  <div>
    <section class="profil__form">
      <img
        id="grey__cat"
        src="../../assets/img/grey-cat-mobile.png"
        alt="illustration de chat gris et blanc"
      />
      <div class="profil__form__container">
        <h2 class="bold">Profil utilisateur</h2>
        <form action="">
          <fieldset class="left">
            <label for="lastname">Nom</label><br />
            <input
              type="text"
              id="lastname"
              name="lastname"
              placeholder="Doe"
              v-model="lastname"
            /><br />

            <label for="firstname">Prénom</label><br />
            <input
              type="text"
              id="firstname"
              name="firstname"
              placeholder="John"
              v-model="firstname"
            /><br />

            <label for="pseudo">Pseudo</label><br />
            <input
              type="text"
              id="pseudo"
              name="pseudo"
              placeholder="jadoreleschaton2022"
              v-model="pseudo"
            /><br />
            <!-- 
            <label for="birth">Date de naissance</label><br />
            <input
              type="text"
              id="birth"
              name="birth"
              placeholder="JJ/MM/AAA"
              v-model="birth"
            /><br /> -->

            <label for="phone">Numéro de télèphone</label><br />
            <input
              type="phone"
              id="phone"
              name="phone"
              placeholder="06 XX XX XX XX"
              v-model="phone"
            /><br />

            <label for="email">Adresse e-mail</label><br />
            <input
              type="email"
              id="email"
              name="email"
              placeholder="johndoe@gmal.bzh"
              v-model="email"
            /><br />
          </fieldset>
          <fieldset class="right">
            <label for="confirmEmail">Confirmer adresse e-mail</label><br />
            <input
              type="email"
              id="confirmEmail"
              name="confirmEmail"
              placeholder="johndoe@gmal.bzh"
              v-model="email"
            /><br />

            <label for="password">Mot de passe</label><br />
            <input type="password" id="password" name="password" /><br />

            <label for="confirmPassword">Confirmer mot de passe</label><br />
            <input
              type="password"
              id="confirmPassword"
              name="confirmpPassword"
            /><br />
            <button type="submit" class="button__orange">
              Modifier mes informations
            </button>
          </fieldset>
        </form>
        <img
          id="ginger__cat"
          src="../../assets/img/purr-cat-17.png"
          alt="illustration de chat sur ses pattes arrières"
        />
      </div>
    </section>

    <!-- A faire apparaître quand le profil est adoptant et favoris > 0 -->
    <ProfileFavoritesLayout />

    <!-- A faire apparaître quand le profil est propriétaire et nb annonces > 0   -->
    <ProfilePublishedSheetsLayout />
  </div>
</template>

<script>
import UserService from "@/services/user/UserService";
import ProfileFavoritesLayout from "./ProfileFavoritesLayout";
import ProfilePublishedSheetsLayout from "./ProfilePublishedSheetsLayout.vue";

export default {
  name: "ProfileLayout",
  components: {
    ProfileFavoritesLayout,
    ProfilePublishedSheetsLayout,
  },
  data() {
    return {
      id: null,
      lastname: null,
      firstname: null,
      pseudo: null,
      birth: null,
      email: null,
      phone: null,
    };
  },
  async mounted() {
    let id = this.$route.params.id;
    console.log(this.$route.params.id);
    const response = await UserService.find(id);
    if (response.code) {
      alert(response.message);
    } else {
      console.log(response);
      this.id = response.id;
      this.lastname = response.last_name;
      this.firstname = response.first_name;
      this.pseudo = response.nickname;
      this.birth = response.meta.birth;
      this.email = response.email;
      this.phone = response.phone;
    }
  },
};
</script>

<style lang="scss">
</style>
