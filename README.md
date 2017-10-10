app -> modèle
config -> réglages SGBD
database/migrations -> création de tables en mysql
public -> ce qui doit être directement téléchargé par le client (ce qui n'est pas généré)

resources -> équivalent au fichier source
    /lang -> fichiers de traduction de langues
    /vue -> générateur de template en vue ``blade``

routes -> app get : ici ce sera route get (quel est l'url qu'on me demande)

Dans le fichier route/web.php

Route (/)
    - view : welcome ==> resources/view/welcome.blade.php

tuto laravel : https://laracasts.com/series/laravel-from-scratch-2017