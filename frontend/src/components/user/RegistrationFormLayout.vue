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
                {{ lastNameError }} {{ lastNameLengthError }}
              </p>
            </div>
            <div class="inscription__form__fieldset__field">
              <label>Prénom *</label><br />
              <input
                class="inscription__form__fieldset__field__input input"
                type="text"
                v-model="firstName"
              />
              <ul class="inscription__form__fieldset__field__error">
                <li v-for="error in firstNameErrors" :key="error">{{error}} </li>
                
              </ul>
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
                {{ birthError }} {{ validAgeError }}
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
                {{ passwordError }} {{ passwordFormatError }}
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
      // nameError: null,
      lastNameError: null,
      firstNameErrors: [],
      birthError: null,
      validAgeError: null,
      emailError: null,
      validEmailError: null,
      confEmailError: null,
      passwordError: null,
      confPasswordError: null,
      roleError: null,
      lastNameLengthError: null,
      // firstNameLengthError: null,
      passwordFormatError: null,

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
      // this.nameError = null;
      this.lastNameError = null;
      this.firstNameErrors = [];
      this.birthError = null;
      this.validAgeError = null;
      this.emailError = null;
      this.validEmailError = null;
      this.confEmailError = null;
      this.passwordError = null;
      this.confPasswordError = null;
      this.roleError = null;
      this.lastNameLengthError = null;
      // this.firstNameLengthError = null;
      this.passwordFormatError = null;

      // Validation du contenu du formulaire
      if (!this.lastName) {
        this.lastNameError = "Merci de renseigner votre nom";
      }
      if (this.lastName.length < 2) {
        this.lastNameLengthError = "Le nom ne fait qu'un seul caractère";
      }
      if (!this.firstName) {
        this.firstNameErrors.push ("Merci de renseigner votre prénom");
      }
      if (this.firstName.length < 2) {
        this.firstNameErrors.push ("Le prénom ne fait qu'un seul caractère");
      }
      if (this.lastName === this.firstName) {
        this.firstNameErrors.push ("Le prénom et le nom ne peuvent pas être identiques");
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
      if (!this.validatePassword(this.password)){
        this.passwordFormatError = "Votre mot de passe doit contenir au moins 8 caractères dont une minuscule, une majuscule et un chiffre"
      }
      if (this.password !== this.confPassword) {
        this.confPasswordError = "Vos mots de passe ne sont pas identiques";
      }
      if (!this.role) {
        this.roleError = "Veuillez choisir votre rôle";
      }
      if (!this.validateEmail(this.email)) {
        this.validEmailError = "Votre adresse email n'est pas valide";
      }
      if (!this.validateAge(this.birth)) {
        this.validAgeError = "Vous devez être majeur pour vous inscrire";
      }

      // Si on n'a aucune erreur
      if (
        // !this.nameError &&
        !this.lastNameError &&
        !this.lastNameLengthError &&
        // !this.firstNameError &&
        // !this.firstNameLengthError &&
        this.firstNameErrors.length === 0 &&
        !this.birthError &&
        !this.emailError &&
        !this.confEmailError &&
        !this.passwordError &&
        !this.confPasswordError &&
        !this.roleError &&
        !this.validEmailError &&
        !this.validAgeError &&
        !this.passwordFormatError
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

    validateAge: function (input) {
      // On récupère today et birth en millisecondes
      const today = new Date();
      const birth = new Date(input);
      // On fait la différence
      // Et on traduit le résultat en jours de vie
      const daysLived = Math.floor((today - birth) / (1000 * 60 * 60 * 24));
      console.log(daysLived);
      // Quand on a 18 ans on a vécu 365 jours X 18 ans
      // Soit 6570 jours
      // On compare les deux nombres de jours
      if (daysLived >= 6570) {
        return true;
      } else {
        return false;
      }
    },

    validatePassword: function (input) {
      // On veut que la chaîne de caractères contienne :
      // Au moins un chiffre (digit)
      // Au moins une lettre en minuscule et une en majuscule
      // On veut que sa taille complète soit de 8 caractères minimum et on autorise les caractères spéciaux
      const validRegex = /^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]{8,}$/;

      if (input.match(validRegex)){
        return true;
      } else {
        return false;
      }
    },

    validateEmail: function (input) {
      const validRegex =
      // On veut que la chaîne de caractères ait un format
      // avec un @ entouré par des chaînes de caractères
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