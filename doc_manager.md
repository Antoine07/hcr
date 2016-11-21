# Les Classes MANAGER

Toutes classes créées dans **Super Cosmic Racer** ont une classe associée qui est nommée manager. Cette classe manager sert à:
- enregistrer une ou plusieurs nouvelle(s) entité(s)
- supprier une entité
- modifier une entité
- selectionner une ou plusieurs entité(s)

cf: Le sujet [Manipulation de données stockées](https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php/manipulation-de-donnees-stockees) sur Open Classroom

Ci-dessous, comment utiliser nos classes et classes manager:

## La base

Avant toute chose il faut, evidemment, créer une instance de notre manager. Elle se nommera `nom_de_votre_classe_manager`.
Par exemple, si ma classe est `Module`, alors ma classe manager s'appellera `Module_manager` et mon instance `$module_manager`, ainsi, à sa création, j'aurais

```bash
$module_manager = new Module_manager();
```

Jamais, une instance ne sera créée "à la main". C'est le manager qui s'en charge !

## Enregistrer une ou plusieurs nouvelle(s) entité(s)

C'est à dire, créer une instance, et la stocker dans notre base de donné db_hcr. Ce sont les methodes `generate()` et `store()` du manager qui s'en chargent.

**Generate:** Créé une ou plusieurs instance(s) d'une classe, remplis ses parametres, et retourne un tableau contenant les instances ainsi créées.

**Store:** Stocke les instances dans la base de donnée. Elle prend en parametre le tableau d'instances que retourne `generate()`.

```bash
# déclaration du tableau qui contiendra les instances
$list_maclasse = [];

# création d'instance(s) de Maclasse
$list_maclasse = $maclasse_manager->generate();

# stockage dans la base de donnée
$maclasse_manager->store($list_maclasse);
```

## Supprimer une entité

C'est la methode `delete()` qui s'en charge.

**delete:** Supprime une ligne dans la base de donnée. elle prend en parametre, l'instance que l'on veut supprimer (et non son id).

```bash
# Supprime $moninstance de la base de donnée
$maclasse_manager->store($moninstance);
```

## Modifier une entité

Ce sont les différentes methodes `update_quelquechose()` qui s'en chargent.

**update:** Modifie une ligne dans la base de donnée. elle prend en parametre, au minimum, une instance à modifier. En générale un second parametre est nécessaire pour savoir quoi modifier.

```bash
# Modifie $moninstance dans la base de donnée
$maclasse_manager->update($moninstance);
```

Il existe plusieur methodes update en fonction des manager. Et tous les manager n'ont pas les mêmes. Regarder dans les src/game/classe_manager.php pour avoir les info sur les différents update.

## Selectionner une ou plusieurs entité(s)

Ce sont les methodes `get_quelquechose()` qui s'en chargent.

**get:** Recupère une ou plusieur ligne d'une table de la bdd correspondant à une classe; et retourne un tableau contenant une ou plusieurs instance(s) hydratée(s) d'une classe.

Exemple (avec la méthode `get_all()` qui existe chez tous les manager) pour récupérer toutes les entités stockées dans un tableau: 
```bash
# Retourne une liste d'instance à partir d'une table de la bdd
$list_mesdonnees = $maclasse_manager->get_all();
```

Il existe plusieur methodes get en fonction des manager. Et tous les manager n'ont pas les mêmes. Regarder dans les src/game/classe_manager.php pour avoir les info sur les différents get.
