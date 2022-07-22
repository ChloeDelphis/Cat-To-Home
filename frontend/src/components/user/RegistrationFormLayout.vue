<template>
  <div>
<body>
    <header class="header">

        <h1>
            <a href="#"><img class="header__logo" src="../assets/logo/Logo.png" alt="logoCatToHome">
            </a>
        </h1>
        <nav class="header__nav">

            <div class="header__nav--mobtab">
                <a href="#">|||</a>
            </div>

            <!-- pour faire apparaître le menu en mode mobile et tablette :
                Ajouter la classe header__nav--small à la div ci-dessous
            Ajouter la classe fixed à l'élément header  -->

            <div class="header__nav--desktop">
                <a class="header__nav__don button__orange--papate" href="#">
                    Je donne un chat</a>
                <a class="header__nav__menu" href="#">À propos</a>
                <a class="header__nav__menu" href="#">Les chats</a>
                <!-- <a class="header__nav__menu" href="#">Inscription</a>
                <a class="header__nav__menu" href="#">Contact</a>
                <a class="header__nav__menu" href="#">Déconnexion</a> -->

                <a class="header__nav__menu" href="#">Connexion</a>
                <a class="header__nav__profile" href="#"><img class="header__nav__profile--icon"
                        src="../assets/icones/profil.png" alt="icône vers profil utilisateur"><span
                        class="header__nav__profile--text">Profil</span></a>
            </div>

        </nav>

    </header>

    <main>

        <section class="inscription">

            <img class="inscription__img" src="../assets/img/illu_cat_laptop.png"
                alt="chat sur un écran d'ordinateur">

            <div class="inscription__form">
                <h2 class="inscription__form__title">Inscription</h2>

                <fieldset class="inscription__form__fieldset">
                    <div class="left">
                        <div class="inscription__form__fieldset__field">
                            <label for="name">Nom *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="surname">Prénom *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="pseudo">Pseudo</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="birth">Date de naissance *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="date">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="email">Adresse e-mail *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                    </div>

                    <div class="right">
                        <div class="inscription__form__fieldset__field">
                            <label for="email">Confirmer adresse e-mail *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="text">
                        </div>
                        <div class="inscription__form__fieldset__field">
                            <label for="password">Mot de passe *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="password">
                        </div>
                        <div class="inscription__form__fieldset__field">

                            <label for="password">Confirmer mot de passe *</label><br>
                            <input class="inscription__form__fieldset__field__input input" type="password">
                        </div>
                        <div class="inscription__form__fieldset__field">

                            <div>
                                <input type="radio" name="status" value="status">
                                <label for="owner">Je souhaite <span>donner</span> un chat</label>
                            </div>


                            <div>
                                <input type="radio" name="status" value="status">

                                <label for="adoptant">Je souhaite <span class="bold">adopter</span> un chat</label>

                            </div>
                        </div>

                        <button class="inscription__form__button button__orange">Je valide mon inscription</button>

                    </div>

                </fieldset>


            </div>




        </section>

    </main>

  </div>
</template>

<script>
export default {};
</script>

<style lang="scss">
@use "../../abstracts/variables/colors";
@use "../../abstracts/variables/font";

.inscription {
  display: flex;
  flex-direction: column;
  align-items: center;

  &__img {
    margin: 3rem 0;
    width: 55%;
  }

  &__form {
    background-color: colors.$color-bg2;
    width: 100%;
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    &__title {
      color: white;
      text-align: center;
      margin-bottom: 4rem;
    }

    &__fieldset {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;

      .left {
        width: 100%;
      }

      .right {
        width: 100%;
        display: flex;
        flex-direction: column;
      }

      &__field {
        margin-bottom: 2rem;
        width: 100%;

        .radio {
          padding: 0 2rem;
        }

        label {
          color: colors.$color-orange;
        }

        span {
          font-weight: 600;
        }

        div {
          margin-top: 2rem;
        }

        &__input {
          width: 100%;
        }
      }
    }

    &__button {
      margin-top: 2rem;
      align-self: center;
    }
  }
}

@media (min-width: 768px) {
  // A partir de 768px (tablette)

  .inscription {
    &__form {
      padding: 4rem;

      .left {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .right {
        align-items: center;
      }

      &__fieldset__field {
        width: 70%;
      }
    }
  }
}

@media (min-width: 1024px) {
  // A partir de 1024 px (laptop)

  .inscription {
    flex-direction: row;

    &__img {
      width: 30%;
      padding: 2rem;
    }

    &__form {
      padding: 5rem 3rem;

      &__fieldset {
        flex-direction: row;
        align-items: flex-start;
        justify-content: space-around;

        .left {
          align-items: flex-start;
        }

        .right {
          align-items: flex-start;
        }

        &__field {
          width: 90%;

          div {
            margin-top: 1.3rem;
          }
        }
      }

      &__button {
        margin-top: 0rem;
        align-self: flex-start;
      }
    }
  }
}

@media (min-width: 1440px) {
  // A partir de 1440px

  .inscription {
    margin-top: 5rem;

    &__img {
      width: 40%;
    }

    &__form {
      padding: 5rem;

      &__fieldset {
        .right {
          // margin-left: 2rem;
        }

        &__field {
          width: 80%;
        }
      }
    }
  }
}

@media (min-width: 1700px) {
  // A partir de 1700px

  .inscription {
    &__img {
      margin: 0 6rem;
      width: 60%;
    }

    &__form {
      padding: 5rem 10rem;

      &__fieldset {
        &__field {
          width: 70%;
        }
      }
    }
  }
}
</style>