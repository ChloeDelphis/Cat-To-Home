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
        <div class="form">
          <fieldset class="left">
            <label for="lastname">Nom</label><br />
            <input
              type="text"
              id="lastname"
              name="lastname"
              vue
              placeholder="Doe"
              v-model="lastname"
            />
            <!-- <p class="inscription__form__fieldset__field__error">
              {{ lastNameError }}
            </p> -->
            <br />

            <label for="firstname">Prénom</label><br />
            <input
              type="text"
              id="firstname"
              name="firstname"
              placeholder="John"
              v-model="firstname"
            />
            <!-- <p class="inscription__form__fieldset__field__error">
              {{ firstNameError }}
            </p> -->
            <br />

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
            />
            <!-- <p class="inscription__form__fieldset__field__error">
              {{ phoneError }}
            </p> -->
            <br />

            <label for="email">Adresse e-mail</label><br />
            <input
              type="email"
              id="email"
              name="email"
              placeholder="johndoe@gmal.bzh"
              v-model="email"
            />
            <!-- <p class="inscription__form__fieldset__field__error">
              {{ emailError }}{{ validEmailError }}
            </p> -->
            <br />
          </fieldset>
          <fieldset class="right">
            <label for="confirmEmail">Confirmer adresse e-mail</label><br />
            <input
              type="email"
              id="confirmEmail"
              name="confirmEmail"
              placeholder="johndoe@gmal.bzh"
              v-model="confemail"
            />
            <!-- <p class="inscription__form__fieldset__field__error">
              {{ confEmailError }}
            </p> -->
            <br />

            <label for="new_password">Mot de passe</label><br />
            <input
              type="password"
              id="new_password"
              name="new_password"
              v-model="new_password"
            />
            <!-- <p class="inscription__form__fieldset__field__error">
              {{ passwordError }}
            </p> -->
            <br />

            <label for="confirmPassword">Confirmer mot de passe</label><br />
            <input
              type="password"
              id="confirmPassword"
              name="confirmpPassword"
              v-model="confPassword"
            />
            <!-- <p class="inscription__form__fieldset__field__error">
              {{ confPasswordError }}
            </p> -->
            <br />

            <div
              id="checkbox"
              v-if="
                this.$store.getters.getToken &&
                this.$store.getters.getRole !== 'adopter'
              "
            >
              <label>Je souhaite être contacté par mon : </label>
              <input class="box" type="checkbox" v-model="allowEmail" />
              <label class="box_response" for="mail">email </label>
              <input class="box" type="checkbox" v-model="allowPhone" />
              <label class="box_response" for="phone">téléphone</label>
              <br />
              <label> {{ checked }}</label>
              <br />
            </div>

            <button @click="submit" type="submit" class="button__orange">
              Modifier mes informations
            </button>
          </fieldset>
        </div>
        <img
          id="ginger__cat"
          src="../../assets/img/purr-cat-17.png"
          alt="illustration de chat sur ses pattes arrières"
        />
      </div>
    </section>

    <!-- A faire apparaître quand le profil est adoptant et favoris > 0 -->
    <ProfileFavoritesLayout v-if="this.$store.getters.getToken && this.$store.getters.getRole !== 'owner'" />

    <!-- A faire apparaître quand le profil est propriétaire et nb annonces > 0   -->
    <ProfilePublishedSheetsLayout v-if="this.$store.getters.getToken && this.$store.getters.getRole !== 'adopter'"/>
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
      new_password: null,
      confPassword: null,
      allowPhone: false,
      allowEmail: true,
      cheked: [],
    };
  },
  async mounted() {
    let id = this.$route.params.id;
    // console.log(this.$route.params.id);
    const response = await UserService.find(id);
    if (response.code) {
      // alert(response.message);
    } else {
      // console.log(response);
      this.id = response.id;
      this.lastname = response.last_name;
      this.firstname = response.first_name;
      this.pseudo = response.nickname;
      this.birth = response.meta.birth;
      this.email = response.email;
      this.phone = response.phone;
    }
  },
  methods: {
    async submit() {
      {
        let id = this.$route.params.id;
        let params = {
          last_name: this.lastname,
          first_name: this.firstname,
          nickname: this.pseudo,
          phone: this.phone,
          email: this.email,
          password: this.new_password,
          meta: {
            allowPhone: this.allowPhone,
            allowEmail: this.allowEmail,
          },
        };
        const response = await UserService.update(id, params);
        console.log(response);
        if (response.id) {
          // On écrase le token avec un nouveau token

          // On supprime le token
          this.$store.commit("deleteToken");
          this.$route.redirectedFrom = this.$route.path;
          this.$router.push({ name: "login" });
        } else {
          alert("ça marche pas !!!");
        }
      }
    },
    validateEmail: function (input) {
      const validRegex =
        /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

      if (input.match(validRegex)) {
        return true;
      } else {
        return false;
      }
    },
  },
};
</script>

<style lang="scss">
.box {
  height: 2rem;
  width: 2rem;
  margin-left: 3rem;
}
.box_response {
  margin-left: 0.5rem;
}
</style>

<!-- Il faut mettre un if allowEmail & allowPhone = false return erreur et pas de validation de la modification -->
<!-- Il faut mettre un if numéro de télèphone non renseigné (et format téléphonique reconnu) alors return message d'erreur   -->
<!-- Il faut intégrer toutes les erreurs proposé par chloé ci dessus -->
<!-- Il faut faire apparaitre la checkbox ainsi que les élément téléphone etc uniquement sur le rôle Owner, voir la méthode d'antoine et la mettre en place -->

<!-- 

// On vide les erreurs
      this.nameError = null;
      this.lastNameError = null;
      this.firstNameError = null;
      this.phoneError = null;
      this.emailError = null;
      this.confEmailError = null;
      this.passwordError = null;
      this.confPasswordError = null;
      this.validEmailError = null;

      // Validation du contenu du formulaire
      if (!this.lastname) {
        this.lastNameError = "Merci de renseigner votre nom";
      }
      if (!this.firstname) {
        this.firstNameError = "Merci de renseigner votre prénom";
      }
      if (this.lastName === this.firstname) {
        this.nameError = "Le prénom et le nom ne peuvent pas être identiques";
      }
      if (!this.phone) {
        this.phoneError = "Merci de renseigner votre numéro de télèphone ";
      }
      if (!this.email || !this.confemail) {
        this.emailError = "Merci de renseigner et confirmer votre email";
      }
      if (this.email !== this.confemail) {
        this.confEmailError = "Vos adresses email ne sont pas identiques";
      }
      if (!this.new_password) {
        this.passwordError =
          "Merci de renseigner et confirmer votre mot de passe";
      }
      if (this.new_password !== this.confPassword) {
        this.confPasswordError = "Vos mots de passe ne sont pas identiques";
      }

      if (!this.validateEmail(this.email)) {
        this.validEmailError = "Votre adresse email n'est pas valide";
      }
      // Si on n'a aucune erreur
      if (
        !this.nameError &&
        !this.lastNameError &&
        !this.firstNameError &&
        !this.phoneError &&
        !this.emailError &&
        !this.confEmailError &&
        !this.passwordError &&
        !this.confPasswordError &&
        !this.validEmailError
      )  -->