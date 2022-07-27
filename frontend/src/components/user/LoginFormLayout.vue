<template>
  <main>
    <section class="connexion">
      <img
        class="connexion__img"
        src="../../assets/img/illu_cat_door.png"
        alt="chat devant un portail de voyage spatio-temporel"
      />

      <div v-on:keyup.enter="login" class="connexion__form">
        <h2 class="connexion__form__title">Connexion</h2>

        <fieldset class="connexion__form__fieldset">
          <div class="connexion__form__fieldset__field">
            <label for="email">Adresse e-mail</label><br />
            <input
              v-model="email"
              class="connexion__form__fieldset__field__input input"
              type="text"
            />
          </div>
          <div class="connexion__form__fieldset__field">
            <label for="password">Mot de passe</label><br />
            <input
              v-model="password"
              class="connexion__form__fieldset__field__input input"
              type="password"
            />
          </div>
          <ul class="field__error-list">
            <li>
              {{ passwordError }}
              {{ emailError }}
            </li>
          </ul>
        </fieldset>

        <button
          v-on:click="login"
          class="connexion__form__button button__orange--papate"
        >
          Je me connecte
        </button>
      </div>
    </section>
  </main>
</template>

<script>
import UserService from "@/services/user/UserService";

export default {
  name: "LoginFormLayout",
  data() {
<<<<<<< HEAD
    return {
      passwordError: null,
      emailError: null,
      email: null,
      password: null,
    };
  },
  methods: {
    async login() {
      if (!this.email) {
        this.emailError = "Email / email cannot be empty";
      }
=======
        return {
            passwordError: null,
            emailError: null,
            email: null,
            password: null
        }
    },
    methods: {
        async login() {
            this.passwordError = '';
            this.emailError = '';
            if(!this.email) {
                this.emailError = "Email cannot be empty";
            }
>>>>>>> vue-addcat

      if (!this.password) {
        this.passwordError = "Password cannot be empty";
      }

<<<<<<< HEAD
      if (!this.passwordError && !this.emailError) {
        console.log("LOGIN");
        // Requete Ajax pour connexion utilisateur
        const response = await UserService.login({
          username: this.email,
          password: this.password,
        });
        if (response.success === true) {
          console.log("OK");
          // On execute une mutation pour stocker le token et l'id dans le sessionStorage
          // Et le synchroniser avec le store afin de rendre notre store.token & store.userId reactif
          this.$store.commit("setToken", response.data.token);
          this.$store.commit("setUserId", response.data.id);
          // On fait une redirection
          this.$router.push({ name: "home" });
        } else {
          alert(response.message);
=======
            if(!this.passwordError && !this.emailError) {
                // console.log('LOGIN');
                // Requete Ajax pour connexion utilisateur
                const response = await UserService.login({
                  username: this.email,
                  password: this.password
                })
                if(response.success === true) {
                  // console.log('OK');
                  // On execute une mutation pour stocker le token dans le sessionStorage
                  // Et le synchroniser avec le store afin de rendre notre store.token reactif
                  this.$store.commit('setToken', response.data.token);
                  // On fait une redirection
                  this.$router.push({name: 'home'});
                } else {
                  alert(response.message)
                }
            }
>>>>>>> vue-addcat
        }
      }
    },
  },
};
</script>

<style lang="scss">
</style>