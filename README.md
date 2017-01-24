# electronic_protocol
# Ηλεκτρονικό Πρωτόκολλο Σχολείου
- **Πρωτοκόλληση** Εισερχομένων και Εξερχομένων εγγράφων
- **Επισύναψη** Αρχείων και **καθορισμός Ημερομηνίας Διατήρησης - Καταστροφής** ανάλογα με το Φάκελο Αρχειοθέτησης **Φ.**
- **Φάκελοι Αρχειοθέτησης** και **Χρόνος Διατήρησης Εγγράφων**. Δυνατότητα τροποποίησης ανάλογα με τις εκάστοτε εγκυκλίους
- **Αναζήτηση** Πρωτοκόλλου, **Ανάκτηση - Διαγραφή** συνημμένων αρχείων
- **Εκτύπωση Απόδειξης** Κατάθεσης Πρωτοκόλλου
- Εκτύπωση Ηλεκτρονικού Πρωτοκόλλου για **βιβλιοδέτηση**
- Εκτύπωση λίστας εγγράφων για **Εκκαθάριση Αρχείου** μετά τη λήξη Διατήρησης αυτών
- **Backup** βάσης δεδομένων, εύκολο κατέβασμα για φύλαξη αυτών
- **Διαχείριση Χρηστών** με ρόλους "Διαχειριστής", "Συγγραφέας", "Αναγνώστης" και ανάλογη πρόσβαση

#
# Εγκατάσταση

## Προτεινόμενη μέθοδος

Εγκατάσταση σε φυσικό server του σχολείου όπου έχουμε πρόσβαση.

#
# Λειτουργικό σύστημα Linux με Lamp (Linux, Apache, Mysql, Php).

Μπείτε στον server ή συνδεθείτε με ssh μέσω terminal
```
ssh {username}@{ip_server}
```
Γίνετε superuser
```su``` ή ```sudo su```

Εγκαταστήστε αν δεν είναι ήδη εγκατεστημένο το **wget** 

Debian, Ubuntu: ``` apt-get -y install wget ``` , Centos: ``` yum -y install wget```

Κατεβάστε ένα από τα ακόλουθα script που ταιριάζει με τη διανομή σας
- Debian με Php5
```
wget -O install_electronic_protocol_Debian_php5.sh "https://drive.google.com/uc?export=download&id=0B2ACFOVDi2ORU3p3ZXl6ekJISW8"
```
- Debian με Php7
```
wget -O install_electronic_protocol_Debian_php7.sh "https://drive.google.com/uc?export=download&id=0B2ACFOVDi2ORLVJVazJtbmtUYzg"
```
- Ubuntu
```
wget -O install_electronic_protocol_Ubuntu.sh "https://drive.google.com/uc?export=download&id=0B2ACFOVDi2ORWmFmSVkwN2xqdjg"
```
- Centos
```
wget -O install_electronic_protocol_Centos.sh "https://drive.google.com/uc?export=download&id=0B2ACFOVDi2ORejZEVU1fQWJRSWc"
```

Αν έχετε άλλη διανομή τροποποιήστε ένα συγγενές script σύμφωνα με τις ανάγκες της διανομής

Τρέξτε το script που κατεβάσατε πχ:
```
sh install_electronic_protocol_Debian_php5.sh 
```

Ακολουθήστε τις οδηγίες


Θα σας ζητηθεί να δώσετε
- απαντήσεις yes\no για τη ρύθμιση της mysql

και
- ένα όνομα για την εφαρμογή πχ: protocol, apousiesprotocol, elprotocol, ...
- το password για το χρήστη root της mysql
- username και password λογαριασμού gmail για αποστολή email

όπως φαίνεται στα παρακάτω αποσπάσματα κώδικα:
```
###################################################################

Εγκατάσταση Ηλεκτρονικού Πρωτοκόλλου σε Debian server με php5

Για να προχωρήσετε θα πρέπει να ετοιμάσετε τα παρακάτω:

      1	το όνομα της εφαρμογής πχ: protocol, electronic_protocol ...

      2	το password του χρήστη root για την mysql

      3	το username και password χρήστη gmail για τη ρύθμιση email

###################################################################

Θέλετε να προχωρήσετε; (y/n):
```


```
###################################################################

Ενημέρωση του συστήματος και εγκατάσταση του Lamp server:

      Apache, Mysql, Php

Αν είστε σίγουροι ότι τα προγράμματα είναι σωστά εγκατεστημένα
παραλείψτε το επόμενο βήμα απαντώντας n = ΟΧΙ

###################################################################

Θέλετε να προχωρήσετε; (y/n):
```


```
###################################################################

Εγκατάσταση του Ηλεκτρονικού Πρωτοκόλλου και απαραίτητες ρυθμίσεις

Γι αυτό θα χρησιμοπιηθεί το πρόγραμμα ''Composer'' και το αποθετήριο
''Packagist'' έτσι ώστε να εγκατασταθούν όλες οι κλάσεις που χρειάζονται.

###################################################################

Θέλετε να προχωρήσετε; (y/n):
```


```
###################################################################

Δώστε το όνομα της εφαρμογής :
```


```
###################################################################

Δώστε το password του χρήστη root για τη mysql :
```


```
###################################################################

Δώστε το username ενός λογαριασμού gmail για αποστολή email:
Δώστε το password του λογαριασμού gmail για αποστολή email: 
```


```
###################################################################

Τέλος εγκατάστασης.

Περιηγηθείτε στο Ηλ.Πρωτόκολλο με τους υπερσυνδέσμους:
     http://localhost/$appname από τον υπολογιστή
     http://$ip/$appname από υπολογιστή του intranet

###################################################################
```

#
# Λειτουργικό σύστημα Windows με Xampp

Εγκαταστήστε το [Xampp] (https://www.apachefriends.org/)


Εγκαταστήστε τον [Composer] (https://getcomposer.org/download/)


Κατεβάστε το [Ηλεκτρονικό Πρωτόκολλο] (https://github.com/g-theodoroy/electronic_protocol/archive/master.zip)


Αποσυμπιέστε το αρχείο **electronic_protocol-master.zip** στο φάκελο **C:/xampp/htdocs/**. Είναι ο εξορισμού φάκελος που το Xampp εγκαθιστά τις ιστοσελίδες. Εαν εγκαταστήσατε το Xampp αλλού πράξτε ανάλογα. Μετονομάστε το φάκελο σε ένα πιο σύντομο όνομα πχ protocol, ...  

Αλλάξτε τις τιμές των παρακάτω μεταβλητών στα ακόλουθα αρχεία:
- .env
 - γραμμή 10:      DB_DATABASE=**d@t@b@se**
 - γραμμή 12:      DB_PASSWORD=**p@ssw@rd**
 - γραμμή 26:      MAIL_USERNAME=**gm@ilusern@me**
 - γραμμή 27:      MAIL_PASSWORD=**gm@ilp@ss**
- config/database.php
 - γραμμή 59:      'database' => env('DB_DATABASE', '**d@t@b@se**'),
 - γραμμή 61:      'password' => env('DB_PASSWORD', '**p@ssw@rd**'),
- config/session.php
 - γραμμή 125:      'cookie' => '**laravel**_session',
- public/.htaccess 
 - γραμμή 7:      **διαγράψτε τη γραμμή**
 
Αν δεν αλλάξατε κάτι η mysql στο Xampp έχει εξορισμού:
- username root (αυτό δεν θέλει αλλαγή)
- password      (κενό)

Δώστε ένα όνομα στη d@t@b@ase πχ: protocol

Ανοίξτε το πρόγραμμα phpadmin του Xampp και δημιουργήστε την βάση δεδομένων που μόλις ονομάσατε (πχ: protocol)

Ανοίξτε την κονσόλα των Windows: πρόγραμμα **Cmd**. Μεταβείτε στον φάκελο που έχετε βάλει το Ηλ.Πρωτόκολλο (πχ protocol).
```
cd C:\xampp\htdocs\protocol
```
Eκτελέστε τις παρακάτω εντολές:
```
composer install
php artisan migrate:refresh --seed
php artisan db:seed --class=KeepvaluesTableSeeder
php artisan key:generate
php artisan optimize
```

Κατευθύνετε τον φυλομετρητή σας στη σελίδα http://localhost/protocol/public

# 
# Ευχαριστίες
Το Ηλεκτρονικό Πρωτόκολλο χρησιμοποιεί με ευγνωμοσύνη τα:
- [Laravel](https://laravel.com/)
- [Bootstarp](http://getbootstrap.com/)
- [jQuery](https://jquery.com/)

Γεώργιος Θεοδώρου
