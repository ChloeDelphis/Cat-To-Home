<template>
  <div>
    <section class="profil__form">
      <img
        id="grey__cat"
        src="../../assets/img/grey-cat-mobile.png"
        alt="illustration de chat gris et blanc"
      />
      <div class="profil__form__container">
        <p class="validation__message">{{ updateMessage }}</p>
        <h2 class="bold">Profil utilisateur</h2>
        <div class="form">
          <fieldset class="left">
            <label for="lastName">Nom</label><br />
            <input
              class="input"
              type="text"
              id="lastName"
              name="lastName"
              placeholder="Doe"
              v-model="lastName"
            />
            <p class="inscription__form__fieldset__field__error">
              {{ errors.lastName }} {{ errors.lastNameLength }}
            </p>
            <br />

            <label for="firstName">Prénom</label><br />
            <input
              class="input"
              type="text"
              id="firstName"
              name="firstName"
              placeholder="John"
              v-model="firstName"
            />
            <p class="inscription__form__fieldset__field__error">
              {{ errors.firstName }}
            </p>
            <br />

            <label for="pseudo">Pseudo</label><br />
            <input
              class="input"
              type="text"
              id="pseudo"
              name="pseudo"
              placeholder="jadoreleschaton2022"
              v-model="pseudo"
            />
            <p class="inscription__form__fieldset__field__error">
            
            </p>
            <br />

            <label
              v-if="
                this.$store.getters.getToken &&
                this.$store.getters.getRole !== 'adopter'
              "
              for="phone"
              >Numéro de téléphone</label
            >

            <br
              v-if="
                this.$store.getters.getToken &&
                this.$store.getters.getRole !== 'adopter'
              "
            />
            <input
              v-if="
                this.$store.getters.getToken &&
                this.$store.getters.getRole !== 'adopter'
              "
              class="input"
              type="phone"
              id="phone"
              name="phone"
              placeholder="06 XX XX XX XX"
              v-model="phone"
            />
            <p class="inscription__form__fieldset__field__error">
              {{ errors.phoneFormat }}
            </p>
            <br
              v-if="
                this.$store.getters.getToken &&
                this.$store.getters.getRole !== 'adopter'
              "
            />

            <label for="email">Adresse e-mail</label><br />
            <input
              class="input"
              type="email"
              id="email"
              name="email"
              placeholder="johndoe@gmal.bzh"
              v-model="email"
            />
            <p class="inscription__form__fieldset__field__error">
              {{ errors.email }}{{ errors.validEmail }}
            </p>
            <br />
          </fieldset>
          <fieldset class="right">
            <label for="confirmEmail">Confirmer adresse e-mail</label><br />
            <input
              class="input"
              type="email"
              id="confirmEmail"
              name="confirmEmail"
              placeholder="johndoe@gmal.bzh"
              v-model="confemail"
            />
            <p class="inscription__form__fieldset__field__error">
              {{ errors.confEmail }}
            </p>
            <br />

            <label for="new_password">Mot de passe</label><br />
            <input
              class="input"
              type="password"
              id="new_password"
              name="new_password"
              v-model="new_password"
            />
            <p class="inscription__form__fieldset__field__error">
              {{ errors.password }} {{ errors.passwordFormat }}
            </p>
            <br />

            <label for="confirmPassword">Confirmer mot de passe</label><br />
            <input
              class="input"
              type="password"
              id="confirmPassword"
              name="confirmpPassword"
              v-model="confPassword"
            />
            <p class="inscription__form__fieldset__field__error">
              {{ errors.confPassword }}
            </p>
            <br />

            <div
              id="checkbox"
              v-if="
                this.$store.getters.getToken &&
                this.$store.getters.getRole !== 'adopter'
              "
            >
              <label>Je souhaite être contacté par mon : </label>
              <input
                class="box"
                id="checkmail"
                type="checkbox"
                v-model="allowEmail"
              />
              <label class="box_response" for="checkmail">email </label>
              <input
                class="box"
                id="checkphone"
                type="checkbox"
                v-model="allowPhone"
              />
              <label class="box_response" for="checkphone">téléphone</label>
              <p class="inscription__form__fieldset__field__error">
                {{ allowContactError }}
              </p>
              <br />
            </div>

            <button v-on:click="submit" class="button__orange">
              Modifier mes informations
            </button>
            <span id="deleteAccountBtn" @click="confirmDeleteUser"
              >Supprimer mon compte</span
            >
            <p class="inscription__form__fieldset__field__error">
              {{ errorUpdatePass }}
            </p>
          </fieldset>
        </div>
        <img
          id="ginger__cat"
          src="../../assets/img/purr-cat-17.png"
          alt="illustration de chat sur ses pattes arrières"
        />
      </div>
    </section>

    <!-- A faire apparaître quand le profil est adoptant -->
    <ProfileFavoritesLayout
      v-if="
        this.$store.getters.getToken && this.$store.getters.getRole !== 'owner'
      "
    />

    <!-- A faire apparaître quand le profil est propriétaire et nb annonces > 0   -->
    <ProfilePublishedCatsLayout
      v-if="
        this.$store.getters.getToken &&
        this.$store.getters.getRole !== 'adopter'
      "
    />
  </div>
</template>

<script>
import UserService from "@/services/user/UserService";
import ProfileFavoritesLayout from "./ProfileFavoritesLayout";
import ProfilePublishedCatsLayout from "./ProfilePublishedCatsLayout.vue";
import shared from "@/shared/shared";

export default {
  name: "ProfileLayout",
  components: {
    ProfileFavoritesLayout,
    ProfilePublishedCatsLayout,
  },

  data() {
    return {
      id: null,
      firstName: null,
      lastName: null,
      pseudo: null,
      phone: null,
      email: null,
      confEmail: null,
      newPassword: null,
      confPassword: null,
      allowEmail: null,
      allowPhone: null,

      errors: {},

      // lastNameError: null,
      // allowContactError: null,
      // nameError: null,
      // nickNameError: null,
      // passwordError: null,
      // firstNameError: null,
      // confEmailError: null,
      // phoneError: null,
      // confPasswordError: null,
      // validEmailError: null,
      // lastNameLengthError: null,
      // emailError: null,
      errorUpdatePass: null,
      updateMessage: null,
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
      this.phone = response.meta.phone;
      this.email = response.email;
      this.confemail = response.email;
      this.allowEmail = response.meta.allowEmail;
      this.allowPhone = response.meta.allowPhone;
    }
  },
  methods: {
    async submit() {
      // On vide les erreurs
      // this.nameError = null;
      // this.lastNameError = null;
      // this.firstNameError = null;
      // this.nickNameError = null;
      // this.phoneError = null;
      // this.emailError = null;
      // this.confEmailError = null;
      // this.passwordError = null;
      // this.confPasswordError = null;
      // this.validEmailError = null;
      // this.allowContactError = null;
      // this.lastNameLengthError = null;
      // this.errorUpdatePass = null;
      // this.updateMessage = null;

      // On vide l'objet des erreurs
      this.errors = {};

      // Validation du contenu du formulaire
      if (!this.lastName) {
        this.errors = {
          ...this.errors,
          lastName: "Merci de renseigner votre nom",
        };
      }
      if (this.lastName && this.lastName.length < 2) {
        this.errors = {
          ...this.errors,
          lastNameLength: "Le nom ne fait qu'un seul caractère",
        };
      }
      if (!this.firstName) {
        this.errors = {
          ...this.errors,
          firstName: "Merci de renseigner votre prénom",
        };
      }
      if (this.firstName && this.firstName.length < 2) {
        this.errors = {
          ...this.errors,
          firstName: "Le prénom ne fait qu'un seul caractère",
        };
      }
      if (this.lastName === this.firstName) {
        this.errors = {
          ...this.errors,
          firstName: "Le prénom et le nom ne peuvent pas être identiques",
        };
      }
            if (!this.email || !this.confEmail) {
        this.errors = {
          ...this.errors,
          email: "Merci de renseigner et confirmer votre email",
        };
      }
      if (this.email !== this.confEmail) {
        this.errors = {
          ...this.errors,
          conf: "Vos adresses email ne sont pas identiques",
        };
      }
      if (this.email && !shared.validateEmail(this.email)) {
        this.errors = {
          ...this.errors,
          validEmail: "Votre adresse email n'est pas valide",
        };
      }
      if (!this.password) {
        this.errors = {
          ...this.errors,
          password: "Merci de renseigner et confirmer votre mot de passe",
        };
      }
      if (this.password && !shared.validatePassword(this.password)) {
        this.errors = {
          ...this.errors,
          passwordFormat:
            "Votre mot de passe doit contenir au moins 12 caractères dont une minuscule, une majuscule et un chiffre",
        };
      }
      if (this.password !== this.confPassword) {
        this.errors = {
          ...this.errors,
          confPassword: "Vos mots de passe ne sont pas identiques",
        };
      }

      if (this.$store.getters.getRole === "owner") {
        if (
          !this.phone &&
          this.allowPhone &&
          !this.validatePhoneNumber(this.phone)
        ) {
          this.errors = {
          ...this.errors,
          contactChoiceConsistency: "Vous avez indiqué préférer être contacté par téléphone mais vous n'avez pas indiqué votre numéro",
        };
        }
      }

      if (!this.allowEmail && !this.allowPhone) {
        this.errors = {
          ...this.errors,
          contact: "Merci d'indiquer si vous préférez être contacté par e-mail ou pas téléphone",
        };
      }

      // Si on n'a aucune erreur
      if (Object.keys(this.errors).length === 0){

        // On prépare les paramètres de la requête si et seulement si les résultats sont différents



      }

      const verifData = await UserService.find(this.id);
      if (verifData.id) {
        let params = {};
        if (
          !this.lastNameError &&
          !this.lastNameLengthError &&
          !this.nameError &&
          verifData.last_name !== this.lastname
        ) {
          params["last_name"] = this.lastname;
        }
        if (
          !this.firstError &&
          !this.nameError &&
          verifData.first_name !== this.firstname
        ) {
          params["first_name"] = this.firstname;
        }
        if (!this.nickNameError && verifData.nickname !== this.pseudo) {
          params["nickname"] = this.pseudo;
        }
        if (!this.phoneError && verifData.meta.phone !== this.phone) {
          params["meta"] = { phone: this.phone };
        }
        if (
          !this.emailError &&
          !this.confEmailError &&
          !this.validEmailError &&
          verifData.email !== this.email
        ) {
          params["email"] = this.email;
        }
        if (
          !this.allowContactError &&
          verifData.meta.allowPhone !== this.allowPhone
        ) {
          params["meta"] = { allowPhone: this.allowPhone };
        }
        if (
          !this.allowContactError &&
          verifData.meta.allowEmail !== this.allowEmail
        ) {
          params["meta"] = { allowEmail: this.allowEmail };
        }
        console.log(params);
        if (Object.keys(params).length !== 0) {
          const response = await UserService.update(this.id, params);
          if (response.id) {
            this.updateMessage = "Profil mis à jour";
            this.$router.push({ name: "profile", params: { id: this.id } });
          } else {
            this.errorUpdatePass =
              "Modification impossible, veuillez contacter l'administrateur par le biais de l'onglet contact";
          }
        }

        if (
          this.new_password !== null &&
          this.confPassword !== null &&
          shared.validatePassword(this.new_password) &&
          this.new_password === this.confPassword
        ) {
          // si pas d'erreur pour le mot de passe on le modifie
          if (!this.confPasswordError && !this.passwordError) {
            // On prépare le tableau avec le remplacement du password
            let params = {
              password: this.new_password,
            };

            // On envoie la requête à l'API
            const response = await UserService.update(this.id, params);
            if (response.id) {
              // On supprime le token
              this.$store.dispatch("deleteUser");
              this.$router.push({ name: "login" });
            } else {
              this.errorUpdatePass =
                "Erreur dans la modification du mot de passe, veuillez contacter l'administrateur par le biais de l'onglet contact";
            }
          }
        } else {
          if (this.new_password !== this.confPassword) {
            this.new_password = null;
            this.confPassword = null;
            this.confPasswordError = "Le mot de passe ne correspond pas";
          }
          if (
            this.new_password &&
            !this.new_password.match(
              /^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]{8,}$/
            )
          ) {
            this.confPasswordError =
              "Votre mot de passe doit contenir au moins 12 caractères dont une minuscule, une majuscule et un chiffre";
          }
        }
      }
    },

    validatePhoneNumber: function (input) {
      const validRegex = /^([0-9]{2}[- ]?){5}$/;

      if (input.match(validRegex)) {
        return true;
      } else {
        return false;
      }
    },

    confirmDeleteUser: function () {
      const answer = window.confirm(
        "Êtes-vous sur de vouloir supprimer votre compte utilisateur ? Cette action est irréversible."
      );
      if (answer) {
        this.deleteUser();
      }
    },

    async deleteUser() {
      const response = await UserService.delete(this.id, {
        reassign: "",
        force: "true",
      });

      if (response.deleted) {
        console.log(response.deleted);
        this.$store.dispatch("deleteUser");
        this.$router.push({ name: "home" });
      } else {
        alert(response.message);
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
  margin-left: 1rem;
}
.profil__form__container {
  .validation__message {
    margin-top: 0;
    margin-bottom: 2rem;
  }

  #deleteAccountBtn {
    color: red;
    text-align: center;
    font-style: italic;
    margin-bottom: 3rem;
    cursor: pointer;
  }
}
</style>