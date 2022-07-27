<template>
  <main>
    <section class="inscription">
      <img
        class="inscription__img"
        src="../../assets/img/illu_cat_laptop.png"
        alt="chat sur un écran d'ordinateur"
      />

      <div class="inscription__form">
        <h2 class="inscription__form__title">Inscription</h2>

        <fieldset class="inscription__form__fieldset">
          <div class="left">
            <div class="inscription__form__fieldset__field">
              <label>Nom *</label><br />
              <input
                class="inscription__form__fieldset__field__input input"
                type="text"
                v-model="lastName"
              />
              <p class="inscription__form__fieldset__field__error">
                {{ lastNameError }}
              </p>
            </div>
            <div class="inscription__form__fieldset__field">
              <label>Prénom *</label><br />
              <input
                class="inscription__form__fieldset__field__input input"
                type="text"
                v-model="firstName"
              />
              <p class="inscription__form__fieldset__field__error">
                {{ firstNameError }} {{ nameError }}
              </p>
            </div>
            <div class="inscription__form__fieldset__field">
              <label for="pseudo">Pseudo</label><br />
              <input
                class="inscription__form__fieldset__field__input input"
                type="text"
                v-model="pseudo"
              />
            </div>
            <div class="inscription__form__fieldset__field">
              <label for="birth">Date de naissance *</label><br />
              <input
                class="inscription__form__fieldset__field__input input"
                type="date"
                v-model="birth"
              />
              <p class="inscription__form__fieldset__field__error">
                {{ birthError }}
              </p>
            </div>
            <div class="inscription__form__fieldset__field">
              <label for="email">Adresse e-mail *</label><br />
              <input
                class="inscription__form__fieldset__field__input input"
                type="text"
                v-model="email"
              />
              <p class="inscription__form__fieldset__field__error">
                {{ emailError }}{{ validEmailError }}
              </p>
            </div>
          </div>

          <div class="right">
            <div class="inscription__form__fieldset__field">
              <label for="email">Confirmer adresse e-mail *</label><br />
              <input
                class="inscription__form__fieldset__field__input input"
                type="text"
                v-model="confEmail"
              />
              <p class="inscription__form__fieldset__field__error">
                {{ confEmailError }}
              </p>
            </div>
            <div class="inscription__form__fieldset__field">
              <label for="password">Mot de passe *</label><br />
              <input
                class="inscription__form__fieldset__field__input input"
                type="password"
                v-model="password"
              />
              <p class="inscription__form__fieldset__field__error">
                {{ passwordError }}
              </p>
            </div>
            <div class="inscription__form__fieldset__field">
              <label for="password">Confirmer mot de passe *</label><br />
              <input
                class="inscription__form__fieldset__field__input input"
                type="password"
                v-model="confPassword"
              />
              <p class="inscription__form__fieldset__field__error">
                {{ confPasswordError }}
              </p>
            </div>
            <div class="inscription__form__fieldset__field">
              <div>
                <input type="radio" name="role" value="owner" v-model="role" />
                <label for="owner"
                  >Je souhaite <span>donner</span> un chat</label
                >
              </div>

              <div>
                <input
                  type="radio"
                  name="role"
                  value="adopter"
                  v-model="role"
                />

                <label for="adopter"
                  >Je souhaite <span class="bold">adopter</span> un chat</label
                >
              </div>
              <p class="inscription__form__fieldset__field__error">
                {{ roleError }}
              </p>
            </div>

            <button
              v-on:click="sendForm"
              class="inscription__form__button button__orange"
            >
              Je valide mon inscription
            </button>
            <div class="inscription__form__fieldset__mention">
              * Champs obligatoires
            </div>
          </div>
        </fieldset>
      </div>
    </section>
  </main>
</template>

<script>
import UserService from "@/services/user/UserService";

export default {
  name: "RegistrationFormLayout",
  data() {
    return {
      nameError: null,
      lastNameError: null,
      firstNameError: null,
      birthError: null,
      emailError: null,
      confEmailError: null,
      passwordError: null,
      confPasswordError: null,
      roleError: null,
      validEmailError : null,
      lastName: "titi",
      firstName: "t",
      pseudo: "titi",
      birth: "2020-07-05",
      email: "titi@y.com",
      confEmail: "titi@y.com",
      password: "titi",
      confPassword: "",
      role: "owner",
    };
  },

  methods: {
    async sendForm() {
      // On vide les erreurs
      this.nameError = null;
      this.lastNameError = null;
      this.firstNameError = null;
      this.birthError = null;
      this.emailError = null;
      this.confEmailError = null;
      this.passwordError = null;
      this.confPasswordError = null;
      this.roleError = null;
      this.validEmailError = null;

      // Validation du contenu du formulaire
      if (!this.lastName) {
        this.lastNameError = "Merci de renseigner votre nom";
      }
      if (!this.firstName) {
        this.firstNameError = "Merci de renseigner votre prénom";
      }
      if (this.lastName === this.firstName) {
        this.nameError = "Le prénom et le nom ne peuvent pas être identiques";
      }
      if (!this.birth) {
        this.birthError = "Merci de renseigner votre date de naissance";
      }
      if (!this.email || !this.confEmail) {
        this.emailError = "Merci de renseigner et confirmer votre email";
      }
      if (this.email !== this.confEmail) {
        this.confEmailError = "Vos adresses email ne sont pas identiques";
      }
      if (!this.password) {
        this.passwordError =
          "Merci de renseigner et confirmer votre mot de passe";
      }
      if (this.password !== this.confPassword) {
        this.confPasswordError = "Vos mots de passe ne sont pas identiques";
      }
      if (!this.role) {
        this.roleError = "Veuillez choisir votre rôle";
      }
      if (!this.validateEmail(this.email)){
        this.validEmailError = "Votre adresse email n'est pas valide";
      }

      //! Ajouter une vérification : âge > 18 ans

      // Si on n'a aucune erreur
      if (
        !this.nameError &&
        !this.lastNameError &&
        !this.firstNameError &&
        !this.birthError &&
        !this.emailError &&
        !this.confEmailError &&
        !this.passwordError &&
        !this.confPasswordError &&
        !this.roleError &&
        !this.validEmailError
      ) {
        // On envoie la requête vers l'API
        // console.log("envoi requête inscription");
        const response = await UserService.register({
          lastname: this.lastName,
          firstname: this.firstName,
          pseudo: this.pseudo,
          birth: this.birth,
          email: this.email,
          password: this.password,
          role: this.role,
        });
        // En cas de réussite
        if (response.code === 200) {
          alert("Vous êtes inscrit !");

          // On connecte l'utilisateur avec ses nouveaux identifiants

          // Requete Ajax pour connexion utilisateur
          const response = await UserService.login({
            username: this.email,
            password: this.password,
          });

          if (response.success === true) {
            console.log("Connexion ok");

            // On remet le formulaire à zéro
            (this.lastname = null),
              (this.firstname = null),
              (this.pseudo = null),
              (this.birth = null),
              (this.email = null),
              (this.confEmail = null),
              (this.password = null),
              (this.confPassword = null),
              (this.role = null),
              // On execute une mutation pour stocker le token dans le sessionStorage
              // Et le synchroniser avec le store afin de rendre notre store.token reactif
              this.$store.commit("setToken", response.data.token);

            // On redirige vers la page d'accueil
            this.$router.push({ name: "home" });
          } else {
            alert(response.message);
          }
        } else {
          alert(response.message);
        }
        console.log(response);
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
</style>