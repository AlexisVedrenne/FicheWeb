insert into categorie(libelle)
values('Tutoriel'),('Exercice'),('Cours'),('Vidéo'),('Bug'),('Erreur'),('Documentation');
insert into user(email,roles,password,pseudo,statut_connexion,date_inscription)
values('test@gmail.com','{"role":"user"}','1234','toto',false,'2021-09-24 16:38:10');
insert into fiche(user_id,nom,date_creation)
values(1,"Tuto PHP",'2021-09-24 16:38:10');
insert into categorie_fiche(categorie_id,fiche_id)
values(1,1);