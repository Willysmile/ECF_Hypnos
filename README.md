# ECF_Hypnos

## Projet Hypnos // ECF Studi 2022

### Description

Dépot Github du projet Hypnos réalisé dans le cadre d’une évaluation en cours de formation (ECF) Studi.

Dans le dossier Annexes du dépot se trouvent les documents demandés:

- Manuel d’utilisation
- Document technique
- Charte graphique

---

Ce projet est réalisé via Symfony 6.0.6

Il est important d’avoir un environnemnt correctement configuré :

https://symfony.com/doc/current/setup.html

#### Récuperation du projet pour installation en local

- Cloner le dépot :

    `git clone https://github.com/Willysmile/ECF_Hypnos.git`


- Dupliquer le fichier .env en .env.local :

    `cp .env .env.local`


- Adapter le fichier .env.local afin de le rendre compatible avec votre environnement de développement (ligne 29 à 31, configuration de la base de donnée)


- Installer les dépendances Javascript :

    `npm install`


- Installer les dépendances PHP :

    `composer.phar install`


- (Facultatif) Si la base de donnée est configurée mais pas crée :

    `php bin/console doctrine:database:create`


  - Executer les migrations :
  
     `php bin/console doctrine:migrations:migrate`


- Créer le compte admin (Attention à remplacer l’email et le mot de passe dans la requete suivante) :

    Pour Hasher le password à intégrer dans la requete: `symfony console security:hash-password`

    `INSERT INTO admin (id, email, roles, password, firstname, lastname) VALUES (NULL, 'admin@ecf.fr', '["ROLE_ADMIN"]', '$2y$13$2Q9xkLDArzCRzTx18abBo.FxuZObLDEPfOn9/XdR0N.GMILf57nh2', 'Administrateur', 'Principal');`

- Lancer le projet : 
  
   `symfony serve`
  

#### Deploiement sur Heroku

- Créér un compte sur heroku.com


- Installer la Heroku CLI :


    - Ubuntu : sudo snap install --classic heroku

    - Mac Os : brew tap heroku/brew && brew install heroku

    - Windows : Télécharger le fichier sur Heroku.com

- Initialiser votre projet avec Git


- Créér une nouvelle application:


    `Heroku heroku create`

 -Créer le fichier Procfile :

        echo 'web: heroku-php-apache2 public/' > Procfile
        git add Procfile
        git commit -m "Heroku Procfile"


- Configurer l’environnement de production d’Heroku :

    `heroku config:set APP_ENV=prod`


- Lancer le déploiememnt :

    `git push heroku main`

En cas de soucis de déploiement, retrouvez la procédure de déploiement complète sur [heroku.com](https://devcenter.heroku.com/articles/deploying-symfony4)