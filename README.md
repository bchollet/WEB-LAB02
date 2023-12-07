# Ma liste de tâche trop funky

Ceci est un projet réalisé dans le cadre du cours WEB de la HEIG-VD. Il a pour but de familiariser son créateur (moi huhuhu), aux pages web dynamiques en utilisant PHP.

Ce projet consiste donc en une TODO list. Il est possible d'y ajouter des tâches, de les associé à une catégorie, de définir leur état (Réalisée ou non) ainsi que de leur assigner une date d'échéances. 

Le projet propose des opération CRUD. Il est donc possible de créer, lire mettre à jour ou supprimer toutes notes du programme.

# Installation locale

Assurez-vous d'avoir docker d'installer. Rendez vous dans le dossier .devcontainer puis lancez la commande:

```bash
docker-compose up -d
```

Voud devez initialiser la DB en lançant le script se trouvant dans todo-project/sql/V1.sql

Pour se connecter à la DB, voici les informations importnantes:

- adresse: localhost
- port: 3306
- database: mariadb
- username: mariadb
- password: mariadb

Depuis le dev container rendez vous à la racine du projet:


```bash
cd /workspaces/WEB-LAB02/todo-project
```

puis de lancer le serveur php avec la commande:

```bash
php -S localhost:8080
```

Le projet est maintenant accessible à l'adresse [http://localhost:8080/index.php](http://localhost:8080/index.php)
