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

### php artisan
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