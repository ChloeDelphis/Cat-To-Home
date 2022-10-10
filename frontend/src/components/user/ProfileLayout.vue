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
            <label for="lastname">Nom</label><br />
            <input
              class="input"
              type="text"
              id="lastname"
              name="lastname"
              placeholder="Doe"
              v-model="lastname"
            />
            <p class="inscription__form__fieldset__field__error">
              {{ lastNameError }} {{ nameError }} {{ lastNameLengthError }}
            </p>
            <br />

            <label for="firstname">Prénom</label><br />
            <input
              class="input"
              type="text"
              id="firstname"
              name="firstname"
              placeholder="John"
              v-model="firstname"
            />
            <p class="inscription__form__fieldset__field__error">
              {{ firstNameError }}
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
              {{ nickNameError }}
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
              {{ phoneError }}
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
              {{ emailError }}{{ validEmailError }}
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
              {{ confEmailError }}
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
              {{ passwordError }}
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
              {{ confPasswordError }}
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
      allowContactError: null,
      allowEmail: null,
      allowPhone: null,
      confEmailError: null,
      confPassword: null,
      confPasswordError: null,
      confemail: null,
      email: null,
      emailError: null,
      firstNameError: null,
      firstname: null,
      id: null,
      lastNameError: null,
      lastname: null,
      nameError: null,
      new_password: null,
      nickNameError: null,
      passwordError: null,
      phone: null,
      pseudo: null,
      phoneError: null,
      validEmailError: null,
      lastNameLengthError: null,
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
      this.nameError = null;
      this.lastNameError = null;
      this.firstNameError = null;
      this.nickNameError = null;
      this.phoneError = null;
      this.emailError = null;
      this.confEmailError = null;
      this.passwordError = null;
      this.confPasswordError = null;
      this.validEmailError = null;
      this.allowContactError = null;
      this.lastNameLengthError = null;
      this.errorUpdatePass = null;
      this.updateMessage = null;

      // Validation du contenu du formulaire
      if (!this.lastname) {
        this.lastNameError = "Merci de renseigner votre nom";
      }
      if (this.lastname.length < 2) {
        this.lastNameLengthError = "Le nom ne fait qu'un seul caractère";
      }
      if (!this.firstname) {
        this.firstNameError = "Merci de renseigner votre prénom";
      }
      if (!this.pseudo) {
        this.nickNameError = "Merci de renseigner votre pseudo";
      }
      if (this.firstname.length < 2) {
        this.firstNameError = "Le prénom ne fait qu'un seul caractère";
      }
      if (this.lastname === this.firstname) {
        this.nameError = "Le prénom et le nom ne peuvent pas être identiques";
      }
      if (this.$store.getters.getRole === "owner") {
        if (
          !this.phone &&
          this.allowPhone &&
          !this.validatePhoneNumber(this.phone)
        ) {
          this.phoneError =
            "Merci de renseigner votre numéro de téléphone valide";
        }
      }

      if (!this.email || !this.confemail) {
        this.emailError = "Merci de renseigner et confirmer votre email";
      }
      if (this.email !== this.confemail) {
        this.confEmailError = "Vos adresses email ne sont pas identiques";
      }
      if (!shared.validateEmail(this.email)) {
        this.validEmailError = "Votre adresse email n'est pas valide";
      }
      if (!this.allowEmail && !this.allowPhone) {
        this.allowContactError =
          "Vous devez communiquer votre mail ou votre téléphone";
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
          shared.validatePassword(this.new_password)&&
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