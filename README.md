# SAE 2.01
## LECOURT HUMBERT Tom / JOURDAIN Thomas

## Script pour lancer le serveur Web local

Dans un terminal, exécutez cette ligne pour lancer le serveur Web local :
composer start:linux

C'est un raccourci à la longue commande documentée plus haut avec l'aide de
composer. De plus, ce script n'a pas de limite de temps d'exécution :
"Composer\\Config::disableProcessTimeout"

## Scripts pour faciliter l'utilisation de PHP CS Fixer

Dans un terminal, vous pouvez maintenant exécuter ces deux lignes :
composer test:cs
composer fix:cs
Le premier va vérifier le code de PHP CS Fixer, et le second va le
corriger.
