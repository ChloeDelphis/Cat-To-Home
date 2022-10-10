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
              <label for="lastname">Nom *</label><br />
              <input
                id="lastname"
                class="inscription__form__fieldset__field__input input"
                type="text"
                v-model="lastName"
              />
              <p class="inscription__form__fieldset__field__error">
                {{ lastNameError }} {{ lastNameLengthError }}
              </p>
            </div>
            <div class="inscription__form__fieldset__field">
              <label for="firstname">Prénom *</label><br />
              <input
                id="firstname"
                class="inscription__form__fieldset__field__input input"
                type="text"
                v-model="firstName"
              />
              <ul class="inscription__form__fieldset__field__error">
                <li v-for="error in firstNameErrors" :key="error">
                  {{ error }}
                </li>
              </ul>
            </div>
            <div class="inscription__form__fieldset__field">
              <label for="pseudo">Pseudo</label><br />
              <input
                id="pseudo"
                class="inscription__form__fieldset__field__input input"
                type="text"
                v-model="pseudo"
              />
            </div>
            <div class="inscription__form__fieldset__field">
              <label for="birth">Date de naissance *</label><br />
              <input
                id="birth"
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
                id="email"
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
              <label for="confemail">Confirmer adresse e-mail *</label><br />
              <input
                id="confemail"
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
                id="password"
                class="inscription__form__fieldset__field__input input"
                type="password"
                v-model="password"
              />
              <p class="inscription__form__fieldset__field__error">
                {{ passwordError }} {{ passwordFormatError }}
              </p>
            </div>
            <div class="inscription__form__fieldset__field">
              <label for="confpassword">Confirmer mot de passe *</label><br />
              <input
                id="confpassword"
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
                <input
                  id="owner"
                  type="radio"
                  name="role"
                  value="owner"
                  v-model="role"
                />
                <label for="owner"
                  >Je souhaite <span>donner</span> un chat</label
                >
              </div>

              <div>
                <input
                  id="adopter"
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
import shared from "@/shared/shared";

export default {
  name: "RegistrationFormLayout",
  data() {
    return {
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
      passwordFormatError: null,

      // Testing area enables inputs auto-filling for testing purposes
      lastName: null,
      firstName: null,
      pseudo: null,
      birth: null,
      email: null,
      confEmail: null,
      password: null,
      confPassword: null,
      role: null,
    };
  },

  methods: {
    async sendForm() {
      // On vide les erreurs
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
      this.passwordFormatError = null;

      // Validation du contenu du formulaire
      if (!this.lastName) {
        this.lastNameError = "Merci de renseigner votre nom";
      }
      if (this.lastName && this.lastName.length < 2) {
        this.lastNameLengthError = "Le nom ne fait qu'un seul caractère";
      }
      if (!this.firstName) {
        this.firstNameErrors.push("Merci de renseigner votre prénom");
      }
      if (this.firstName && this.firstName.length < 2) {
        this.firstNameErrors.push("Le prénom ne fait qu'un seul caractère");
      }
      if (this.lastName === this.firstName) {
        this.firstNameErrors.push(
          "Le prénom et le nom ne peuvent pas être identiques"
        );
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
      if (this.password && !shared.validatePassword(this.password)) {
        this.passwordFormatError =
          "Votre mot de passe doit contenir au moins 12 caractères dont une minuscule, une majuscule et un chiffre";
      }
      if (this.password !== this.confPassword) {
        this.confPasswordError = "Vos mots de passe ne sont pas identiques";
      }
      if (!this.role) {
        this.roleError = "Veuillez choisir votre rôle";
      }
      if (this.email && !shared.validateEmail(this.email)) {
        this.validEmailError = "Votre adresse email n'est pas valide";
      }
      if (this.birth && !this.validateAge(this.birth)) {
        this.validAgeError = "Vous devez être majeur pour vous inscrire";
      }

      // Si on n'a aucune erreur
      if (
        !this.lastNameError &&
        !this.lastNameLengthError &&
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
        let params = {
          lastname: this.lastName,
          firstname: this.firstName,
          email: this.email,
          password: this.password,
          role: this.role,
          meta: {
            birth: this.birth,
            allowEmail: true,
          },
        };

        if (this.pseudo) {
          params = { ...params, nickname: this.pseudo };
        }
        // On envoie la requête vers l'API
        const response = await UserService.register(params);
        // En cas de réussite
        if (response.code === 200) {
          const responseLogin = await UserService.login({
            username: this.email,
            password: this.password,
          });

          if (responseLogin.success === true) {
            // On execute une mutation pour stocker le token dans le sessionStorage
            // Et le synchroniser avec le store afin de rendre notre store.token reactif
            this.$store.commit("setToken", responseLogin.data.token);
            this.$store.commit("setUserId", responseLogin.data.id);

            const getRole = await UserService.find(responseLogin.data.id);
            if (getRole.id) {
              // On crée le user dans le store grace à une action
              this.$store.commit("setRole", getRole.roles[0]);
            }
            // On redirige vers la page d'accueil
            this.$router.push({ name: "home" });
          } else {
            // alert(responseLogin.message);
          }
        } else {
          // alert(response.message);
        }
      } else {
        // alert("Un erreur est survenue");
      }
    },

    validateAge: function (input) {
      // On récupère today et birth en millisecondes
      const today = new Date();
      const birth = new Date(input);
      // On fait la différence
      // Et on traduit le résultat en jours de vie
      const daysLived = Math.floor((today - birth) / (1000 * 60 * 60 * 24));
      // Quand on a 18 ans on a vécu 365 jours X 18 ans
      // Soit 6570 jours
      // On compare les deux nombres de jours
      if (daysLived >= 6570) {
        return true;
      } else {
        return false;
      }
    },
  },
};
</script>

<style lang="scss"></style>
