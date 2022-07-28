<template>
  <main class="main">
        <h1>Vous avez oublié votre mot de passe ?</h1>
        <div class="container__inputs">
            <input type="text" v-model="password" class="input" placeholder="nouveau mot de passe">
            <input type="text" v-model="passConfirm" class="input" placeholder="confirmer mot de passe">
            <button @click="setNewPassword" class="button__orange">Valider</button>
        </div>
    </main>
</template>

<script>
export default {
    name: "ReinitPassLayout",
    data() {
        return {
            errors: [],
            password: null,
            passConfirm: null
        }
    },
    methods: {
        setNewPassword() {
            this.errors = [];

            if (!this.password) {
                this.errors.push('Le mot de passe ne doit pas être vide');
            }
            if (!this.passConfirm) {
                console.log('ici');
                this.errors.push('La confirmation du mot de passe ne doit pas être vide');
            }
            if (this.password && this.passConfirm && this.passConfirm !== this.password) {
                this.errors.push('Les mots de passes doivent être identiques');
            }

            if (this.errors.length === 0) {
                console.log('ok');
            }
            
        }
    }
}
</script>

<style scoped lang="scss">
    .main {
        margin-bottom: 13.8rem;

        h1 {
            text-align: center;
            margin: 5rem 0;
        }

        .container__inputs {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            .input {
                margin-bottom: 2rem;
            }
        }
    }

    .footer {
        position: relative;
        bottom: 0;
    }
</style>