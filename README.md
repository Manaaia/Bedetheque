# AFPA-Fil_rouge_2

Website for management of comics in several libraries (users, cotisations, fines, borrows and returns, stocks, consultation, localisation, etc).

Project realised for the web and mobile development program at AFPA.

Languages : PHP, JS, SQL, CSS, HTML. Architecture : MVC.

Current functionnalities by role:

Visitor
  - Search albums by name, author or serie
  - Display album detailed page (includes location and disponibility)
  - Random recommandation of 5 albums
  - Connexion
  
Adherent
  - Search albums by name, author or serie
  - Display album detailed page (includes location and disponibility)
  - Random recommandation of 5 albums
  - Display personal information page (includes current borrows and cotisation state)
  
Administrator
  - Search albums by name, author or serie
  - Display album detailed page (includes location and disponibility)
  - Random recommandation of 5 albums
  - Add, search, modify and delete employees
  
Librarian
  - Search albums by name, author or serie
  - Display album detailed page (includes location and disponibility)
  - Random recommandation of 5 albums
  - Add, search, modify and delete adherents
  - Display current borrows
  - Add borrows
  
Product Manager
  - Search albums by name, author or serie
  - Display album detailed page (includes location and disponibility)
  - Random recommandation of 5 albums
  - Add, modify and delete comic
  
Manager
  - Search albums by name, author or serie
  - Display album detailed page (includes location and disponibility)
  - Random recommandation of 5 albums
  - Display adherents statistics
  - Display comics statistics
  


Future developments to implement :
  - return of borrows
  - fines (for loss and delay)
  - further javascript controls
  - roles handling in database
  - Editor for letters
  - Actual automated generation of letters
  
  
  
Set up for this project:
You can download the master branch of this project on your machine and launch it with a local server by using wamp for exemple.
You will need to create a database named "bdtk" in phpMyAdmin and import the bdtk.sql file (located in Contenu > assets > bdd).


This project is no longer updated.
