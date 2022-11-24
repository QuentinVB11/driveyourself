# Conventions

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#laravel">Laravel</a>
      <ul>
        <li><a href="#database">Database</a></li>
        <li><a href="#model">Model</a></li>
        <li><a href="#test">Test</a></li>
        <li><a href="#route">Route</a></li>
        <li><a href="#view">View</a></li>
        <li><a href="#controller">Controller</a></li>
      </ul>
    </li>
    <li><a href="#git">Git</a></li>
    <li>
      <a href="#examples">Examples</a>
      <ul>
        <li><a href="#database-1">Database</a></li>
        <li><a href="#model-1">Model</a></li>
        <li><a href="#test-1">Test</a></li>
        <li><a href="#route-1">Route</a></li>
        <li><a href="#view-1">View</a></li>
        <li><a href="#controller-1">Controller</a></li>
      </ul>
    </li>
  </ol>
</details>

Liste de conventions pour le projet. 

À savoir que tout les noms des entitées du projet (variable, classe, route, méthode…) suivront un nommage anglophone.

Les conventions seront décritent de la sorte:

```bash
* <ENTITY_NAME>
	* <CONSTRAINT_SUBJECT>: <CONSTRAINT_SYNTAX>[or <CONSTRAINT_SYNTAX>...]
		* <SUB_CONSTRAINT_SYNTAX> -> <SUB_CONSTRAINT_RULES>
```

*où* 

- **<ENTITY_NAME>** représente le nom de l’entité sur laquelle des conventions sont placées (database, model, controller…)
- **<CONSTRAINT_SUBJECT>** représente le sujet de la contrainte, ce sur quoi porte la contrainte.
- **<CONSTRAINT_SYNTAX>** représente la syntaxe de la contrainte, la forme que doit prendre le sujet dans son contexte. Celle-ci peut être multiple, alors chainé par des **or** (alternatives).
- **<SUB_CONTRAINT_SYNTAX>** représente un sous-ensemble de la syntaxe générale.
- **<SUB_CONTRAINT_RULES>** représente la régle syntaxique imposée pour le sous-ensemble en question.

Dans une description de syntaxe, ce qui se trouve entre `[]` est optionnel et ce qui se trouve entre `<>` décrit une sous-contrainte, substituable par une chaîne de caractère conforme aux règles décrites. De plus, si vous aperçevez une sous-contrainte suivie de `...` cela signifie que cette sous-contrainte peut être chainée.

## Laravel

### Database

[l[ink to examples](#database-1)]

---

- **table name**: `<table_name>` **(**1**)** **or** `<table1>_<table2>` **(**2**)**
    - **<table_name>** **(**1**)** → plural + snake case
    - **\<table1\>** **(**2**)** → singular + alphabetically sorted (for join tables)
    - **\<table2\>** **(**2**)** → singular + alphabetically sorted (for join tables)
- **migration name**: `create_<table_name>_table`
    - **<table_name>** → plural + snake case
- **seeder name**: `<table_name>Seeder`
    - **<table_name>** → singular + capitalized + camel case
- **factory name**: `<table_name>Factory`
    - **<table_name>** → singular + capitalized + camel case
- **foreign key**: `<foreign_key>_id`
    - **<foreign_key>** → parent model + singular + snake case
- **primary key**:  `id`

### Model

[[link to examples](#model-1)]

---

- **model name**: `<linked_table_name>`
    - **<linked_table_name>** → singular + camel case + capitalized
- **method name**: `<prefix><purpose_name>[And<prefix><purpose_name>...]`
    - **\<prefix\>** → camel case
        - prefix could be either **get, insert, delete** or **update**
        - **get prefix**: method to retrieve data \(R\)
        - **insert prefix**: method to insert data \(C\)
        - **delete prefix**: method to delete data (D)
        - **update prefix**: method to update data (U)
    - **<purpose_name>** → singular **or** plural + camel case
    - Could be chained with `and` separator

### Test

[[link to examples](#test-1)]

---

- **feature/unit test name**: `<entity_name><entity_type>Test`
    - **<entity_name>** → singular + camel case
    - **<entity_type>** → singular + camel case

### Route

[[link to examples](#route-1)]

---

- **route name**: `<linked_controller_name>[.<purpose_name>...]`
    - **<linked_controller_name>** → singular + no suffix + snake case
    - **<purpose_name>** → singular **or** plural + dot notation case

### View

[[link to examples](#view-1)]

---

- **view name**: `<view_name>`
    - **<view_name>** → singular + dot notation case

### Controller

[[link to examples](#controller-1)]

---

- **controller name**: `<linked_view_name>Controller`
    - **<linked_view_name>** → singular + capitalized + camel case
- **method name**: `index<purpose_name>` **(**1**)** **or** `<prefix><purpose_name>[And<prefix><purpose_name>]` **(**2**)**
    - **<purpose_name>** **(**1**)** → singular + camel case (for method producing html)
    - **\<prefix\>** **(**2**)** → same as model **method name**
    - **<purpose_name>** **(**2**)** → same as model **method name**

<aside>
⚠️ Pour les données qui transite du client au serveur et vice-versa, le nom de chacun des attributs contenus dans le corps de la requête derva correspondre aux noms des attributs correspondant dans les tables de la db.
</aside>

## Git

Pour **Git** on part sur des bases que l’on connaît:

1. On part de `develop` en créant une branche pour sa tâche

```bash
git branch <task_branch>
git [checkout|switch] <task_branch>

## or simply ##

git switch -c <task_branch>

## or ##

git checkout -b <task_branch>
```

2. Une branche pour sa tâche aura la forme `issue_<task_name>`
3. Une fois que l’on finis sa tâche (tous les tests sont passées 😋) on merge sois-même sa branche dans `develop`.

```bash
git [checkout|switch] develop
git merge <task_branch>
```

4. Une fois le sprint terminée, on merge `develop` dans `release`

```bash
git [checkout|switch] release
git merge develop
```

5. Si le client est:
    1. bien content 
        1. on merge `release`  dans `main`
        2. on crée un tag et on le push
        ```bash
        git [checkout|switch] main
        git merge release
        git tag -a vX.X -m "Release version X.X"
        ```
    2. pas content 
        1. on repart du point 1
        2. on garde notre sang froid

*De manière générale*

- On fetch toujours `develop` avant de bosser
- Si on a du nouveau, on merge sa branche de développement dans `develop` pour se mettre à jour et on règle ses conflits sois-même.

```bash
git fetch origin develop
```

- Si on a du nouveau, on synchronise ce qu’on vient de fetch avec la branche locale correspondante

```bash
git merge develop origin/develop
```

- On merge sa branche de développement dans `develop` pour se mettre à jour et on règle ses conflits sois-même

```bash
git merge <current_task_branch> develop
```

# Examples

Cas d’utilisations pour chaque convention.

<h2 id="database-example">Database</h2>

[[backlink](#database)]

- **table name**: `<table_name>` **or** `<table1>_<table2>`
    - **<table_name>** → plural + snake case
        - Je désire créer une table pour représenter une session de sport. J’aimerais la nommer `SportSession`.
            1. Je la met au pluriel, cela donne `SportSessions`.
            2. Je la transforme en snake case, cela donne `sport_sessions`.
    - **\<table1\>_ \<table2\>** → singular + alphabetically sorted
        - Je désire permettre à mes clients de choisir leurs articles parmis un stock commun. Je dispose d’une table `clients` et d’une autre `products`.
            1. Je met au singulier, cela donne `client` et `product`.
            2. Je trie mes tables par ordre alphabétique, donc je prend d’abord `client` et puis `product`.
            3. Je fusionne en séparant les noms par un underscore, cela done `client_product`.
- **migration name**: `create_<table_name>_table`
    - **<table_name>** → plural + snake case
        - Je désire créer une migration pour la table `sport_sessions`. Celle-ci est déjà au pluriel et en snake case (par convention), donc je substitue simplement, cela donne `create_sport_sessions_table`. Depuis le terminal, je peux taper la commande suivante pour permettre à la commande **artisan** `make:migration` de transformer mon argument en snake case:
        
        ```bash
        php artisan make:migration createSportSessionsTable
        ```
- **seeder name**: `<table_name>Seeder`
    - **<table_name>** → singular + capitalized + camel case
        - Je désire créer un seeder pour la table `golden_products`.
            1. Je met au singulier, cela donne `golden_product`.
            2. Je capitalise, cela donne `Golden_product`.
            3. Je transforme en camel case, cela donne `GoldenProduct`.
            4. Je rajoute le bon suffix, cela donne `GoldenProductSeeder`.
- **factory name**: `<table_name>Factory`
    - **<table_name>** → singular + capitalized + camel case
        - Je désire créer une factory pour la table `super_dogs`.
            1. Je met au singulier, cela donne `super_dog`.
            2. Je capitalise, cela donne `Super_dog`.
            3. Je transforme en camel case, cela donne `SuperDog`.
            4. Je rajoute le bon suffix, cela donne `SuperDogFactory`.
- **foreign key**: `<foreign_key>_id`
    - **<foreign_key>** → parent model + singular + snake case
        - Je désire créer des posts que mes utilisateurs peuvent commenter. Je dispose d’une table `posts` et d’une table `comments` que j’aimerais relier. 
        Un post possède une quantité indéfinie de commentaire et un commentaire n’est associé qu’à un seul post (relation **one to many**).
            1. J’identifie la table parent dans la relation (celle référencée), ici c’est `posts`.
            2. Je met au singulier, cela donne `post`.
            3. je rajoute le bon suffix, cela donne `post_id`.
- **primary key**: `id`
   
    Toutes les tables auront systématique un id technique en guise de clé primaire nommé `id`. Toutes les contraintes d’unicités sur une table feront donc guise de clé secondaire (contrainte **unique**).
    
    Si je possède la table `students` suivante où chaque étudiant aura un `name` unique
    
    ```bash
    students
    - id
    - name (unique)
    - surname
    - age
    ```
    
    Alors `id` sera la **primary key** et `name` sera la clé secondaire et aura donc une contrainte **unique**.
    

<h2 id="model-example">Model</h2>

[[backlink](#model)]

- **model name**: `<linked_table_name>`
    - **<linked_table_name>** → singular + capitalized + camel case
        - Je dispose d’une table `pool_scores` dans ma database.
            1. Je met au singulier, cela donne `pool_score`.
            2. Je capitalise, cela donne `Pool_score`. 
            3. Je transforme en camel case, cela donne `PoolScore`.
- **method name**: `<prefix><purpose_name>[And<prefix><purpose_name>...]`
    - **\<prefix\>** → camel case
    - **<purpose_name>** → singular **or** plural + camel case
        - **get prefix**
            - Je désire créer une méthode pour récupérer les informations d’un étudiant d’id donnée, celle-ci pourrait s’appeler `getStudentInfos` où `get` serait le **<prefix>** et `studentInfos` serait le **<purpose_name>**, le tout en camel case et le **<purpose_name>**  au pluriel (plusieurs informations).
            - Je désire créer une méthode pour récupérer le nom d’un étudiant d’id donnée, celle-ci pourrait s’appeler `getStudentName` où `get` serait le **<prefix>** et `studentName` serait le **<purpose_name>**, le tout en camel case et le **<purpose_name>**  au singulier.
        - **insert prefix**
            - Je désire créer une méthode pour insérer un nouveau parcours de conduite, celle-ci pourrait s’appeler `insertPath` où `insert` serait le **<prefix>** et `path` serait le **<purpose_name>**, le tout en camel case et le **<purpose_name>**  au singulier.
        - **delete prefix**
            - Je désire créer une méthode pour supprimer une liste de cours d’ids données, celle-ci pourrait s’appeler `deleteCourses` où `delete` serait le **<prefix>** et `courses` serait le **<purpose_name>**, le tout en camel case et le **<purpose_name>**  au pluriel (plusieurs cours).
        - **update prefix**
            - Je désire créer une méthode pour mettre à jour le solde d’un client, celle-ci pourrait s’appeler `updateClientBalance` où `update` serait le **<prefix>** et `clientBalance` serait le **<purpose_name>**, le tout en camel case et le **<purpose_name>**  au singulier.
        - **chained prefix (get | insert | delete | update)**
            - Je désire créer une méthode pour insérer un nouveau produit et mettre à jour mon stock, celle-ci pourrait s’appeler `insertProductAndUpdateStock` où `insert` et `update` seraient les **<prefix>** et où `product` et `stock` serait les **<purpose_name>**, le tout en camel case et les **<purpose_name>** aux singuliers.

<h2 id="test-example">Test</h2>

[[backlink](#test)]

- **feature/unit test name**: `<entity_name><entity_type>Test`
    - **<entity_name>** → singular + camel case
    - **<entity_type>** → singular + camel case
        - Je désire créer un test pour mon contrôleur d’étudiants.
            1. L’entité que je désire tester est `student`.
            2. Le type de mon entité est `controller`.
            3. Mon **<entity_name>** est donc `student` et mon **<entity_type>** est `controller`.
            4. Mon test portera donc le nom de `StudentControllerTest`, le tout au singulier et en camel case.
        - Je désire créer un test pour ma table d’animaux.
            1. L’entité que je désire tester est `animal`.
            2. Le type de mon entité est `database`.
            3. Mon **<entity_name>** est donc `animal` et mon **<entity_type>** est `database`.
            4. Mon test portera le nom de `AnimalDatabaseTest`, le tout au singulier et en camel case.
        - Je désire créer un test pour mon modèle de session.
            1. L’entité que je désire tester est `session`.
            2. Le type de mon entité est `model`.
            3. Mon **<entity_name>** est donc `session` et mon **<entity_type>** est `model`.
            4. Mon test portera le nom de `SessionModelTest`, le tout au singulier et en camel case.

<h2 id="route-example">Route</h2>

[[backlink](#route)]

- **route name**: `<linked_controller_name>[.<purpose_name>...]`
    - **<linked_controller_name>** → singular + no suffix + snake case
    - **<purpose_name>** → singular **or** plural + dot notation case
        - Je désire créer une route pour afficher la page principale et je dispose du contrôleur `HomeController` et d’une méthode `index`. Ici le **<linked_controller_name>** est `HomeController`.
            1. J’enlève le suffixe du nom, cela donne `Home`.
            2. Je transforme en snake case, cela donne `home`.
            3. j’identifie la méthode impliquée et je détermine celle que fait pour nommer ma route, cela pourrait donner `home.show` par exemple.
        - Je désire créer une route pour supprimer un étudiant et je dispose du contrôleur `StudentController` et d’une méthode `deleteStudent`. Ici le **<linked_controller_name>** est `StudentController`.
            1. J’enlève le préfixe du nom du contrôleur, cela donne `Student`.
            2. Je transforme en snake case, cela donne `student`.
            3. j’identifie la méthode impliquée et je détermine celle que fait pour nommer ma route, cela pourrait donner `student.delete` par exemple.
        - Je désire créer une route pour mettre à jour le panier de mon client et je dispose du contrôleur `CustomerController` et d’une méthode `updateCustomerCart`. Ici le **<linked_controller_name>** est `CustomerController`.
            1. J’enlève le préfixe du nom du contrôleur, cela donne `Customer`.
            2. Je transforme en snake case, cela donne `customer`.
            3. j’identifie la méthode impliquée et je détermine celle que fait pour nommer ma route, cela pourrait donner `customer.update.cart` par exemple.

<h2 id="view-example">View</h2>

[[backlink](#view)]

- **view name**: `<view_name>`
    - **<view_name>** → singular + dot notation case
        - Je désire créer une vue pour les parcours de conduite. Je la nomme au singulier en dot notation, cela pourrait donner `driving.path`.
        - Je désire créer une page d’accueil. Je la nomme au singulier en dot notation, cela pourrait donner `app.home`.
        - Je désire créer une page de contact. Je la nomme au singulier en dot notation, cela pourrait donner `contact`.

<h2 id="controller-example">Controller</h2>

[[backlink](#controller)]

- **controller name**: `<linked_view_name>Controller`
    - **<linked_view_name>** → singular + capitalized + camel case
        - Je désire créer un contrôleur pour mes commandes et je dispose d’une vue `order`.
            1. Je capitalise, cela donne `Order`.
            2. Je transforme en camel case, cela donne `Order`.
            3. Je rajoute le bon suffixe, cela donne `OrderController`.
        - Je désire créer un contrôleur pour mes produits alimentaires et je dispose d’une vue `product.food`.
            1. Je capitalise, cela donne `Product.food`.
            2. Je transforme en camel case, cela donne `ProductFood`.
            3. Je rajoute le bon suffixe, cela donne `ProductFoodController`.
- **method name**: `index<purpose_name>` **or** `<prefix><purpose_name>[And<prefix><purpose_name>]`
    - **<purpose_name>** → singular + camel case (for method producing text/html)
        - Je désire créer une méthode pour obtenir le code html d’une table de scores sur un match de tennis. Le **<purpose_name>** pourrait être `tennisScoreTable`, au singulier et en camel case. Le nom serait donc `indexTennisScoreTable`.
        - Je désire créer une méthode pour obtenir le résultat de mon calcul au format texte. Le **<purpose_name>** pourrait être `computationResult`, au singulier et en camel case. Le nom serait donc `indexComputationResult`.
        - **cas particulier**: Je désire créer une méthode pour afficher tout le contenu de ma page d’accueil et je me retrouve dans le contrôleur associé à cette vue, disons `HomeController`. Dans ce cas-ci, le **<purpose_name>** est optionnel. Je pourrais donc nommer ma méthode `index`.
    - **\<prefix\>** → same as model **method name**
    - **<purpose_name>** → same as model **method name**
