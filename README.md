# Apprentissage de Laravel
Dans le cadre de la CondingSchool de la [Molengeek](molengeek.com), nous apprenons à utiliser Laravel.

## Configurer notre serveur
D'abords on crée le projet laravel :
``` GIT BASH
laravel new first.dev
```

### Faire un virtualhost
#### Windows
Dossier ``first.dev`` dans le www de Wamp.

##### Modifier le fichier dans windows
Ensuite accéder à ``C:\Windows\System32\drivers\etc`` et modifier le fichier ``hosts`` de windows.
```HOST WINDOWS
127.0.0.1       first.dev
::1             first.dev
```
__/!\ Ne pas oublier d'avoir lancé en administrateur le bloc note ou votre éditeur.__

##### Modifier le fichier dans apache
``C:\wamp64\bin\apache\apache2.4.23\conf\extra`` et ensuite le fichier ``httpd-vhosts.conf``
```APACHE CONF
<VirtualHost *:80>
	ServerName first.dev
	DocumentRoot c:/wamp64/www/first.dev/public
	ServerAlias www.first.dev
	<Directory  "c:/wamp64/www/first.dev">
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

## Introduction à Laravel

### Arboressence de fichiers :
-   app -> modèle
-   config -> réglages SGBD
-   database/migrations -> création de tables en mysql
-   public -> ce qui doit être directement téléchargé par le client (ce qui n'est pas généré)
-   resources -> équivalent au fichier source
    -    /lang -> fichiers de traduction de langues
    -    /vue -> générateur de template en vue ``blade``
-   routes -> app get : ici ce sera route get (quel est l'url qu'on me demande)

### Quel requête demandons nous (url) -> la route (routes)
Dans le fichier route/web.php :
Route (/)
    - view : welcome ==> resources/view/welcome.blade.php

tuto laravel : https://laracasts.com/series/laravel-from-scratch-2017


## Fonctionnement de Laravel

### Interagir avec une SGBD
> Entrer dans Mysql
``` GIT BASH
mysql -uroot -p
```

> Créer une base de donnée.
```MySQL
create database first.dev
```

> Éditer le fichier /.env et /config/database.php
``` /.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=first.dev
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

### php artisan
down -> maintenance
up -> maintenance achevée
_____
make:
controller -> pour ajouter des controlleurs d'affichage de route |=> se trouvera dans ``App\Http\Controllers`` 
-m -> pour ajouter également le modèle
-r -> données, on utilise des bases de données le CREUD et va générer les bonnes méthodes dans le fichier php dans le controlleur

> Créer ``HomeController.php`` dans : ``App\Http\Controllers`` avec les resources dont on a besoin (CREUD) 
``` GIT BASH
php artisan make:controller HomeController -r
```
> Sur la fonction index, on retourne une vue et on lui passe des variables
``` PHP : \App\Http\Controllers\HomeController.php
    public function index()
    {
        $variable = "hello";
        return view('Home',['variable' => $variable]);
    }
```
> OU en utilisant la fonction ``compact()``
``` PHP : \App\Http\Controllers\HomeController.php
    public function index()
    {
        $variable = "hello";
        return view('Home', compact('variable'));
    }
```

> On appelle le controlleur ``HomeController`` et on lui demande de lancer la fonction ``create``. Ici on va ajouter un nouvel item à la SGBD.
``` PHP : /routes/Web.php
    Route::get('/add-project', 'HomeController@create');
```

> On ajoute la fonction create et on lui dit de retourner une vue
``` PHP : \App\Http\Controllers\HomeController.php
    public function create()
    {
        return view('project.create-project');
    }
```

> Notre vue contiendra donc un formulaire où on retrouvera dans la balise form :
``` HTML
<form action="{{ url('/store-project')}}" method="post">
```
Cela permet d'envoyer en post les données (sans les faire passer dans l'url) et le traitement se fera dans ``.../store-project`` qui aura une route qui lui sera définie et un controlleur qui envera le traitement à la SGBD.

> Il faut ajouter notre modèle dans le controlleur
``` PHP : \App\Http\Controllers\HomeController.php
use App\Project;
```

> Ensuite on va créer le modèle. Il permettra de définir de quelle façon on interagit avec la SGBD. Il sera créé dans : ``/app/Project.php``
``` GIT BASH
php artisan make:model Project 
```

> Ensuite on lui ajoute le SoftDeletes à notre modèle
``` PHP : /app/Project.php
<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
}
```

> On crée la route qui appelle la fonction store de notre controlleur
``` PHP : /routes/Web.php
Route::post('/store-project', 'HomeController@store');
```

> On regarde ce que va nous retourner php à la soumission de notre formulaire
``` PHP : \App\Http\Controllers\HomeController.php
    public function store(Request $request)
    {
        var_dump($request);
        // OU : dd($request);
    }
```
``var_dump`` est plus complet, ``dd`` est l'équivalent en fonction laravel

> On ajoute la fonction create
``` PHP : \App\Http\Controllers\HomeController.php
    public function store(Request $request)
    {
        $request;
        $newProject =[
            'title' => $request->title,
            'description' => $request->description
        ];
        $projet = new Project;
    }
```

> Mais on peu également l'écrire comme ceci et on rajoute à la fin une redirection vers la page d'acceuil
``` PHP : \App\Http\Controllers\HomeController.php
    public function store(Request $request)
    {
        $request;
        $projet = new Project;
        $projet->title = $request->title;
        $projet->description = $request->description;
        $projet->save();
        return redirect()->route('home');
    }
```

> On doit modifier la route pour la redirection en ajoutant un nom à la route
``` PHP : /routes/Web.php
Route::get('/', 'HomeController@index') -> name('home');
```


> 
``` GIT BASH
php artisan 
```

> 
``` GIT BASH
php artisan 
```

> 
``` GIT BASH
php artisan 
```

> 
``` GIT BASH
php artisan 
```

> 
``` GIT BASH
php artisan 
```

> 
``` GIT BASH
php artisan 
```

> 
``` GIT BASH
php artisan 
```

> 
``` GIT BASH
php artisan 
```