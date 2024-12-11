# Documents de conception 
##### Tous les document lié a la conception du site web CasaFamilia ce situe dans un dossier conception. 
###### https://github.com/B-R-3/CazaFamilia/tree/main/conception

### Le diagramme des cas d'utilisation
###### https://github.com/B-R-3/CazaFamilia/blob/main/conception/DCU_cazaFamilia.png

### Le modèle conceptuel des données (looping ou équivalent) 
###### https://github.com/B-R-3/CazaFamilia/tree/main/conception/bdd

### Le modèle logique des données (PHPMyAdmin ou équivalent) 
###### https://github.com/B-R-3/CazaFamilia/tree/main/conception/bdd

### Le modèle des données (script(s) SQL) 
###### https://github.com/B-R-3/CazaFamilia/blob/main/conception/bdd/caza_familia.sql

#### les états des commandes
##### Les différents etats de commande dans le modèle sont représenté sous trois forme differente dans la table commande. 
##### - L'etat en cours de validation
##### - L'état commande refusé 
##### - L'état commande validé

#### les types de conso. (sur place/à emporter)
##### Les types de consommation sur le modèle logique de donné sont rentré dans la table commande qui est elle meme issu de la table ligne commande. 
###### Lien vers tout la partie base de donné : https://github.com/B-R-3/CazaFamilia/tree/main/conception/bdd

### Le sitemap (enchaînement des pages)
###### Sitemap WEB : https://github.com/B-R-3/CazaFamilia/blob/main/conception/IHM%20WEB/sitemap%20restoweb.pdf
###### Sitemap SWING : https://github.com/B-R-3/CazaFamilia/blob/main/conception/IHM%20Swing/sitemap%20swing.pdf

#### les maquettes de l'IHM (Balsamiq ou équivalent)
###### IHM SWING : https://github.com/B-R-3/CazaFamilia/tree/main/conception/IHM%20Swing
###### IHM WEB : https://github.com/B-R-3/CazaFamilia/tree/main/conception/IHM%20WEB

### la maquette JSON
###### https://github.com/B-R-3/CazaFamilia/blob/main/CasaFamillia/commandes.json

# Documents de réalisation 
###### https://github.com/B-R-3/CazaFamilia/blob/main/README.md

# Documents d'exploitation

## Le manuel d'utilisation

### Inscription 
#### Afin de pouvoir s'inscrire sur le site web il faut : 
##### - Creer un nom d'utilisateur unique.
##### - Creer un mot de passe sécurisé et unique. 
##### - Donner une adresse mail valide. 

### Connexion 
#### Afin de pouvoir ensuite se connecter sur le site web il faut : 
##### - Rentrer son nom d'utilisateur créé juste avant. 
##### - Rentrer son mot de passe associé au nom d'utilisateur
#### Si les deux condition son validé par la BDD l'utilisateur peut acceder au contenu du site. 

### Commande 
#### Afin de pouvoir commander une multitude de produit l'utilisateur doit : 
##### - selectionner les produits désirés
##### - selectioner si la commande est a emporté ou sur place
##### - Cliquer sur validé pour passer a l'étape suivante

### Paiement 
#### Après la création de la commande l'utilisateur passe par la phase de payement et doit :
##### - confirmer sa commande
##### - suivre les etapes afin de payer par carte bleu sa commande

### API
#### Une fois la commande créé et payer la commande est envoyer par api au restaurateur qui va :
##### - verifier la commmande
##### - valider ou refuser la commande recu 
#### Une fois l'action du restaurateur effectué l'etat de la commande sera modifié et envoyé a l'utilisateur ayant passé la commande. 

