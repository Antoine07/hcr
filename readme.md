# Hyper Cosmic Racer

Voici les conventions pour travailler dans l'application. Attention, il y a des nouveaux dossiers. Vous pouvez créer des classes mais, que dans les dossiers: models et game. Ce n'est du reste pas obligatoire.

# Installation et remarques importantes

- Cloner le dépôt en local, puis faites un composer install

- Créez une branche dev permamente en local. Faites des branches features_nom_de_la_feature merger ses branches dans la branche dev puis mettez le code de la branche dev sur Github dans la branche dev. Voici les procédures:

```bash

git clone git@github.com:Antoine07/hcr.git
# ou git clone https://github.com/Antoine07/hcr.git

# récupérer l'ensemble des branches sur le dépôts GitHub
git pull --all

# vérifiez les branches que vous avez récupéré
git branch -a

# création de la branche dev en local, ce n'est pas automatique il faut le faire à la main...
git checkout remotes/origin/dev
git checkout -b dev 

# vérifiez maintenant que votre branche est créez avec un simple 
git branch

#supposons maintenant que vous créez une branche feature_module, voici la procédure pour travailler et pusher sur GitHub
git checkout -b feature_module

# fin du développement sur cette branche, il est temps de merger celle-ci dans votre branch dev

# retour sur la branche dev
git checkout dev

# vous récupérez les dernières modifications sur la branche distante, toujours le faire avant de merger votre feature.
git pull --all

# vous mergez votre feature dans dev
git merge feature_module

# puis vous pushez sur la branche dev
git push -u origin dev

# suppression de la branche feature
git branch -d feature_module
# git branch -D feature_module forcera sa suppression...

```

## Autoload
La commande suivante permet de mettre à jour l'autoloader de composer au cas où il ne trouve pas vos classes:

- composer dumpautoload 

## Travailler avec des fonctions
- dans le dossier src/ se trouve maintenant les dossiers controllers, models et game, ainsi que le fichier utils.php
- Nous avons mis Composer en place, les fichiers que vous ajoutez doivent être ajoutés au composer.json pour l'autoloader des fichiers, voir l'exemple qui suit:

```json

"autoload": {
		"files": [
			"src/utils.php", "src/controllers/login_action.php"  <-- ajoutez ici vos futurs fichiers
		],
		"psr-4": {
            "": "src/"   <-- ceci concerne les classes c'est différent
        }
	},

```

### Travailler avec des classes
- Vous n'ajouterez des classes que dans le dossier game ou models, attention cependant à les mettre dans un espace de nom pour Composer, sinon cela ne marchera pas, voici un exemple, attention les espaces de nom sont à mettre en premier dans le fichier sans rien avant. Les fichiers de classe sont à écrire avec une majuscule et il se nome du nom de la classe, voir les exemple ci-dessous:

Ci-dessous dans le dossier game la classe Module, dans le fichier Module.php

```php
<?php namespace game;

class Module{

}

```

Ci-dessous dans le dossier models la classe Model, dans le fichier Model.php


```php
<?php namespace models;

class Model{
	
}

```
Voyons maintenant l'utilisation de ces classes dans un contrôleur, par exemple login_controller.php, un contrôleur fictif:
```php
function login_action()
{
	
	$title = "Hyper Cosmic Racer";

	// vous devez préciser l'espace de nom (namespace) de la classe avec un antislash, Composer fera tout seul le require (autoloading)
	$module = new game\Module;

	echo '<pre>';
	print_r($module);
	echo '</pre>';

	$model = new models\Model;

	echo '<pre>';
	print_r($model);
	echo '</pre>';

	include '../views/login.php' ;
}

```
## Conventions pour les URLs
- Vous devez utiliser la fonction url du fichier utils.php qui se trouve dans le dossier src. Cela nous évitera de mettre partout dans nos urls "/index.php", pour arriver sur le frontController.

## Les contrôleurs
- Créez vos contrôleurs dans le dossier controllers dans src/
- Le nom de vos fichiers contrôleurs doivent être prefixés par un nom explicite, correspondant à un groupe d'actions cohérentes, par exemple module_controller.php, ensemble des actions de la gestion de votre "module":

```php
<?php 

function dashboard_module_action()
{
	// ...
}

function add_module_action()
{
	// ...
}


```
*N'oubliez pas d'ajouter alors dans composer.json le nom du fichier module_controller.php pour l'autoloader de Composer*

## Les modèles
- Si c'est une classe voir les remarques ci-dessus (travailler avec une classe)
- Si c'est un fichier, préfixé le nom de celui-ci par le nom de la resource: post_model.php par exemple

## Les vues
- Vous avez un dossier views avec un master.php, travaillez avec ob_start() et des vues composites.

## Le FrontController
- Dans le dossier web se trouve votre index.php. Ecrivez toutes les routes connectées à vos contrôleurs dans ce fichier.

## Assets
- Dans le dossier web, vous avez un dossier assets. Placez les assets dans ce dossier.

## Variables d'environnement
- Vous utiliserez DotEnv, variable d'environnement, déjà en place dans la structure de l'application donnée ici. 

## Base de données
- Un dossier database se trouve à la racine de l'application
- Un fichier migrations.sql dans lequel vous placerez le code SQL pour créer les tables.
- Un fichier seeders.sql dans lequel vous placerez les données d'exemple, INSERT INTO