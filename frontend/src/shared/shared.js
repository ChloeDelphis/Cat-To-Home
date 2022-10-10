export default{
    validatePassword: function (input) {
        // On veut que la chaîne de caractères contienne :
        // Au moins un chiffre (digit)
        // Au moins une lettre en minuscule et une en majuscule
        // On veut que sa taille complète soit de 12 caractères minimum et on autorise les caractères spéciaux
        // TODO rendre les caractères spéciaux obligatoires
        // Caractères max 20 ou 251
        const validRegex =
          /^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]{12,}$/;
  
        if (input.match(validRegex)) {
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

}