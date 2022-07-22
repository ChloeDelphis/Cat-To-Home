# Cat to home

## Présentation

C'est un site qui facilite la mise en relation de propriétaires de chats ou chatons avec des personnes qui souhaitent en adopter.

Il permet ainsi de participer à désengorger les refuges, SPA, ... et éviter la surpopulation et l'euthanasie des animaux dans ces derniers.

Il se veut également une source de sensibilisation sur le thème de l'abandon.

Totalement gratuit, il se pose comme alternative aux services habituels surchargés

## Initialisation du Backend

Après avoir cloné le repo

1. Récupérer les dépendances avec la commande `composer install`
2. Créer une BDD
3. Créer une copie du fichier _.env.example_ à la racine du dossier Backend, le renommer _.env_ et le configurer en fonction de votre BDD
4. Avec WP CLI, faite un `wp db import dump.sql` pour récupérer les tables de la BDD, sinon faite un import manuel
5. Ensuite installer le plugin __JWT-Auth__ pour la gestion des tokens
6. Si l'installation du plugin échoue, vérifier les droits de WP sur les dossiers et fichiers du projet et à la racine du projet exécuter ces lignes

```bash
sudo chgrp -R www-data .
sudo find . -type f -exec chmod 664 {} +
sudo find . -type d -exec chmod 775 {} +
```

## Initialisation de l'intégration
Se placer dans le dossier integration
`npm install`
Pour ouvrir une page : 
se placer dans le dossier html et taper
`npx parcel nomdelapage.html`
