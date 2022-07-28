<template>
  <main>
    <section class="connexion">
      <img class="connexion__img" src="../../assets/img/illu_cat_door.png"
        alt="chat devant un portail de voyage spatio-temporel" />

      <div v-on:keyup.enter="login" class="connexion__form">
        <h2 class="connexion__form__title">Connexion</h2>

        <fieldset class="connexion__form__fieldset">
          <div class="connexion__form__fieldset__field">
            <label for="email">Adresse e-mail</label><br />
            <input v-model="email" class="connexion__form__fieldset__field__input input" type="text" />
          </div>
          <div class="connexion__form__fieldset__field">
            <label for="password">Mot de passe</label><br />
            <input v-model="password" class="connexion__form__fieldset__field__input input" type="password" />
          </div>
          <div>
            <button @click="ShowFormChangePass" class="btn--reinit__pass">Réinitialiser son mot de passe</button>
          </div>
          <div class="form__reinit__pass">
            <input v-model="emailReinitPass" class="connexion__form__fieldset__field__input input" type="email" placeholder="email" />
            <button @click="sendMail" class="button__orange">Valider</button>
          </div>
          <ul class="field__error-list">
            <li>
              {{ passwordError }}
              {{ emailError }}
            </li>
          </ul>
        </fieldset>

        <button v-on:click="login" class="connexion__form__button button__orange--papate">
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
    return {
      passwordError: null,
      emailError: null,
      email: null,
      password: null,
      emailReinitPass: null
    }
  },
  methods: {
    async login() {
      this.passwordError = '';
      this.emailError = '';
      if (!this.email) {
        this.emailError = "Email cannot be empty";
      }

      if (!this.password) {
        this.passwordError = "Password cannot be empty";
      }

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
        }
      }
    },
    ShowFormChangePass() {
      const formReInitPass = document.querySelector('.form__reinit__pass');
      formReInitPass.classList.toggle('form__reinit__pass--show');
    },
    async sendMail() {
      const response = await UserService.send({
        "email": this.emailReinitPass
      });
      console.log(response);
    }
  },
};
</script>

<style lang="scss" scoped>
.btn--reinit__pass {
  border: none;
  background-color: #E3B8AA;
  font-size: 1.6rem;
  cursor: pointer;
}

.btn--reinit__pass:hover {
  text-decoration: underline;
  opacity: 0.7;
}

.form__reinit__pass {
  display: none;
}

.form__reinit__pass--show {
  display: flex;
  gap: 2rem;
  margin-top: 1rem;
}
</style>