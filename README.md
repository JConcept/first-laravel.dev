# Apprentissage de Laravel
Dans le cadre de la CondingSchool de la [Molengeek](molengeek.com), nous apprenons à utiliser Laravel.
Vous y retrouverez mon évolution sur ce super Framework step by step.

## Cours d'initiation Coding School
D'abords on crée le projet laravel :
``` GIT BASH
laravel new first-laravel.dev
```

### Faire un virtualhost
#### Windows
Dossier ``first-laravel.dev`` dans le www de Wamp.

##### Modifier le fichier dans windows
Ensuite accéder à ``C:\Windows\System32\drivers\etc`` et modifier le fichier ``hosts`` de windows.
```HOST WINDOWS
127.0.0.1       first-laravel.dev
::1             first-laravel.dev
```
__/!\ Ne pas oublier d'avoir lancé en administrateur le bloc note ou votre éditeur.__

##### Modifier le fichier dans apache
``C:\wamp64\bin\apache\apache2.4.23\conf\extra`` et ensuite le fichier ``httpd-vhosts.conf``
```APACHE CONF
<VirtualHost *:80>
	ServerName first-laravel.dev
	DocumentRoot c:/wamp64/www/first-laravel.dev/public
	ServerAlias www.first-laravel.dev
	<Directory  "c:/wamp64/www/first-laravel.dev">
		Allow from All
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>
	UseCanonicalName on
</VirtualHost>
```

/!\ S'assurer que le ``.env`` du dossier laravel est bien créé, aussi non copier le .env.example et ensuite lancer pour générer une clé :
``` GIT BASH
php artisan key:generate
```

#### Ubuntu
cf : https://github.com/JConcept/Web-Server-Config
>   "Créer le dossier de votre premier site."

### Introduction à Laravel

#### Arboressence de fichiers :
-   app -> modèle
-   config -> réglages SGBD
-   database/migrations -> création de tables en mysql
-   public -> ce qui doit être directement téléchargé par le client (ce qui n'est pas généré)
-   resources -> équivalent au fichier source
    -    /lang -> fichiers de traduction de langues
    -    /vue -> générateur de template en vue ``blade``
-   routes -> app get : ici ce sera route get (quel est l'url qu'on me demande)

#### Quel requête demandons nous (url) -> la route (routes)
Dans le fichier route/web.php :
Route (/)
    - view : welcome ==> resources/view/welcome.blade.php


### Fonctionnement de Laravel

#### Interagir avec une SGBD
> Entrer dans Mysql
``` GIT BASH
mysql -uroot -p
```

> Créer une base de donnée.
```MySQL
create database blog
```

> Éditer le fichier /.env et /config/database.php
``` /.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=root
```
\+ Dans le ``/config/database.php`` remplacer les ``utf8mb4`` par ``utf8``

> Maintenant il va falloir générer les bases de données
``` GIT BASH
php artisan migrate
```
Elles seront générées à partir de la configuration passée dans ``database/migrations/...`` 

> Créer un fichier générant les tables de la base de donnée
``` GIT BASH
php artisan make:migration create_test --create test
```
Il générera un fichier qui va prendre le format ``AAAA_MM_JJ_HHMMSS_create_test.php`` et on crée une table nommée test situé dans ``database/migrations``. Si pas précisé, il prendra le nom ``create_test``.

> Ensuite générer la nouvelle table 
``` GIT BASH
php artisan migrate
```

> Si vous voulez réinitiliser votre SGBD a son état initial (suite à des modifications de sa structure)
``` GIT BASH
php artisan migrate:refresh
```
/!\ Quand on veut rajouter uniquement un champs dans la table, on ne passera pas par ce fichier, car il supprimera tout le contenu de la base de donnée avec la fonction ``down()``

> Permet de revenir en arrière après une modif dans la base de donnée
``` GIT BASH
php artisan migrate:rollback
```

#### php artisan
down -> maintenance
up -> maintenance achevée
_____
make:
*   controller -> pour ajouter des controlleurs d'affichage de route |=> se trouvera dans ``App\Http\Controllers`` 
    *   -m -> pour ajouter également le modèle
    *   -r -> données, on utilise des bases de données le CREUD et va générer les bonnes méthodes dans le fichier php dans le controlleur

*   model -> pour faire un modèle
    *   -mc -> ajoutera la migration et le controlleur

*   migration ... --create ... -> 1: create_X_table | 2: X || pour créer une table de la SGBD

### Déployement de Laravel sur un serveur

1. Mettre les fichiers via ftp, git, ...
2. Lancer ``composer install`` (installer composer si pas déjà présent)
3. \+ ``composer dumpautoload -o``
3. Éditer le fichier .env (avec vim)
4. Lancer ``php artisan key:generate``
(``sudo service nginx restart``)


## Tutoriel Laracast step by step

Voici mes notes __récapitulative__ du [tutoriel laracast](https://laracasts.com/series/laravel-from-scratch-2017)

> Créer le controlleur, le modèle et la migration ``Posts`` _(on renomera le modèle en Post sans le "s")_
``` GIT BASH
php artisan make:model -mc Posts
```

> Ajouter des champs à notre base de données
``` PHP : database/migrations/AAAA_MM_JJ_HHMMSS_create_posts_table
            $table->string('title');
            $table->text('body');
```

> Générer les bases de données
``` GIT BASH
php artisan migrate
```

> Entrer la route (adresse url) et renvoyer vers une fonction de notre controlleur
``` PHP : routes/web.php
Route::get('/', 'PostsController@index');
```

> Ajouter la fonction ``index`` à notre controlleur ``PostsController``. À l'intérieur de l'extentiation du controlleur
``` PHP : app/Http/Controllers/PostsController.php
    public function index()
    {
        return view('posts.index');
    }
```

> Ajouter nos fichiers de vues blade. On va se baser sur une page web déjà créée que l'on va "découper". On va se baser sur le [blog proposé par bootstrap](http://getbootstrap.com/docs/4.0/examples/blog/) 
``` 
On va le structurer de cette manière :
    - partials -> footer, header, side bar (composants répétitifs)
    - layouts -> "template" général de pages
    - posts -> même nom que notre modèle, controlleur et vues, là ou on place le contenu des pages
Pour voir le résultat allez dans ``resources/views``
```

> Créer la page principale blade (index dans le dossier ``posts``) -> que l'on appelle en faisant un return dans le fichier controlleur
```  PHP BLADE TEMPLATE : resources/views/posts/index.blade.php
@extends ('layouts.task')
@section ('content')
	 <div class="col-sm-8 blog-main">
        Contenu HTML
	</div><!-- /.blog-main -->
	@include ('partials.side')
@endsection
```

> Créer une page pour pouvoir ajouter des articles avec un formulaire dans notre base de données en POST  
> |-> Céer deux routes, la ``GET`` pour afficher le formulaire et la ``POST`` pour pouvoir exécuter le traitement dans la base de données via le modèle ``Post.php``
``` PHP : routes/web.php
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');
```

### Stocker des éléments dans une base de données
> Éditer le modèle  
Il y a trois solutions possible pour y arriver. La troisième sera abordée plus tard :
1. On passe chaque élément à récupérer (correspondant au ``name="X"`` dans le html (html de la vue blade))
2. On utilise la variable laravel ``$guarded`` qui récupère automatiquement tous les champs, plus besoin de les nommer
3. On crée un "template" de modèle que l'on pourra extencier (on le fait plus tard)
``` PHP : app/post.php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    // Solution 1 :
    // protected $fillable = ['title', 'body'];
    
    // Solution 2 :
    protected $guarded = [];
}
```

> Au controlleur ajouter les fonctions ``create´´ et ´´store``  
Pour voir ce que récupère Laravel quand on envoit les données, il y a plusieurs solutions possibles en fonction des besoins :
- on peut lancer la fonction propre à Laravel ``dd(request()->all());``
- toujours à cette même fonction, sous forme de tableau, lui demander quels champs il faut afficher ``dd(request(['title', 'body']));``
- ou on peut utiliser la fonction native à php pour avoir __plus de détails__ ``var_dump(request()->all());`` (on peut également lui faire un request comme ci-dessus)  
À nouveau, pour le stockage des éléments
``` PHP : app/Http/Controllers/PostsController.php
    public function create()
    {
        return view('posts.create');
    }
    public function store()
    {
        // dd(request()->all());
        // dd(request(['title', 'body']));
        // var_dump(request()->all());
        
        First :
        // Récupérer les données via request()
        $post = new Post;
        $post->title = request('title');
        $post->body = request('body');
        
        // Enregistrer dans la SGBD
        $post->save();
        END first
        
        // SI solution 1 dans : app/post.php
        // Récupérer les données via request() + sauvegarder dans la base de donnée via le modèle post.php
        Post::create([
            'title' => request('title'),
            'body' => request('body')
        ]);

        SI solution 2 dans: app/post.php + sauvegarder dans la base de donnée via le modèle post.php
        Récupérer les données via request()
        Post::create(request()->all());
        
        // Rediriger
        return redirect('/');
    }
```

> 
``` PHP

```

> 
``` PHP

```

> 
``` PHP

```

> 
``` PHP

```

> 
``` PHP

```

> 
``` PHP

```

> 
``` PHP

```
