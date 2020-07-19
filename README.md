# readCsvToCLI
Library php 

		    --------------------------------------------------
		                                                            
		             	       CommandeCsv                       
		                                                           
		    --------------------------------------------------

0. Le dossier Command est à placer dans le fichier src d'un projet symfony.
	exemple "Projet/src/Command"

1. Ligne de commande à taper dans la console à la racine du projet symfony

Affichage et formatage du fichier CSV dans la CLI 
	- php bin/console app:csvCommand
	exemple : C:\Users\Final\Desktop\Symfony\project_CSV_DND> php bin/console app:csvCommand

Ecriture d'un fichier Json à partir du fichier CSV
	- php bin/console app:csvCommand Json
	exemple : C:\Users\Final\Desktop\Symfony\project_CSV_DND> php bin/console app:csvCommand Json

Aide et information sur la commande
	- php bin/console app:csvCommand --help


2. Planification d'une tache

Planification de la tache via CRON
	- Création d'un fichier CRON qui permet l'automatisation de la tache

Planification de la tache via le planificateur de tache windows
	- Execution d'une commande pour envoyer au planificateur windows de créer une tache


