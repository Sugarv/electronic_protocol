# electronic_protocol

<img src="https://cloud.githubusercontent.com/assets/23439035/22380227/4f839c3a-e4c5-11e6-91fc-457f55281e6e.png" width="99%">

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
# Οδηγίες Χρήσης

https://drive.google.com/file/d/0B2ACFOVDi2ORWmZjUGNmQTNpVlk/view?usp=sharing

#
# Εγκατάσταση

## Εγκατάσταση σε Ubuntu 18.04

Ενημερώθηκε 7 Απρ 2019.

Ακολουθείται εν μέρει ο οδηγός στην ιστοσελίδα:

https://websiteforstudents.com/install-laravel-php-framework-on-ubuntu-16-04-17-10-18-04-with-apache2-and-php-7-2-support/


#### Ενημέρωση του συστήματος
```
sudo apt update
sudo apt upgrade
```

#### Εγκατάσταση apache, php kai sqlite3
```
sudo apt install apache2 sqlite3

sudo apt install php7.2 libapache2-mod-php7.2 php7.2-mbstring php7.2-xmlrpc php7.2-soap php7.2-gd php7.2-xml php7.2-cli php7.2-zip php7.2-sqlite3
```

#### Ρύθμιση της php (php.ini) για το laravel
```
sudo gedit /etc/php/7.2/apache2/php.ini
```
αλλάζουμε τις τιμές των παρακάτω παραμέτρων ως εξής:

memory_limit = 256M

upload_max_filesize = 64M

cgi.fix_pathinfo=0


#### Εγκατάσταση composer
```
sudo apt install curl git
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

#### Δημιουργία φακέλου ```/opt/protocol``` και κατέβασμα του Ηλ. Πρωτοκόλλου από το github 
```
sudo mkdir /opt/protocol
cd /opt/protocol
sudo git clone https://github.com/g-theodoroy/electronic_protocol.git .
sudo composer install
```

#### Ρύθμιση δικαιωμάτων του φακέλου ```/opt/protocol``` στον χρήστη www-data
```
sudo chown -R www-data:www-data /opt/protocol/
sudo chmod -R 755 /opt/protocol/
```

#### Δημιουργία του αρχείου με τη ρύθμιση alias
```
sudo mkdir /etc/apache2/alias
sudo gedit /etc/apache2/alias/protocol.conf
```
Γράφουμε στο αρχείο ```protocol.conf``` τα παρακάτω:
```
Alias /protocol "/opt/protocol/public"

<Directory "/opt/protocol/public">
        DirectoryIndex index.php
        AllowOverride All
        Options FollowSymlinks
        Require all granted
</Directory>
```

#### Ρύθμιση του apache να διαβάσει το αρχείο protocol.conf
```
sudo gedit /etc/apache2/apache2.conf
```
Προσθήκη στο τέλος
```
Include "alias/*"
```

#### Ρύθμιση και επανεκκίνηση apache
```
sudo a2enmod rewrite
sudo systemctl restart apache2.service
```

#### Το Ηλ. Πρωτόκολλο είναι προσβάσιμο στον υπερσύνδεσμο
http://localhost/protocol

#### Για να ρυθμίσετε την αποστολή email συμπληρώστε ανάλογα τα στοιχεία στο αρχείο ```.env```.

γραμμές 26 έως 31:
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=gm@ilusern@me
MAIL_PASSWORD=gm@ilp@ss
MAIL_ENCRYPTION=tls
```



#
# Εναλλακτικές λύσεις

## Λειτουργικό σύστημα Windows με εγκατεστημένο Xampp, Wamp, ...


Υπάρχουν διάφορες εφαρμογές που στήνουν στα Windows Apache και Mysql servers για παραγωγή και δοκιμή webapp όπως: Xampp, Wamp, ...


Θα περιγράψουμε ενδεικτικά πως μπορεί να γίνει αυτό σε Xampp. Με παρόμοιο τρόπο μπορεί να γίνει και σε άλλες εναλλακτικές λύσεις.


## Εγκατάσταση σε Xampp


Εγκαταστήστε το [Xampp](https://www.apachefriends.org/)


Εγκαταστήστε τον [Composer](https://getcomposer.org/download/)


Κατεβάστε το [Ηλεκτρονικό Πρωτόκολλο](https://github.com/g-theodoroy/electronic_protocol/archive/master.zip)


### Ρυθμίσεις
Αποσυμπιέστε το αρχείο **electronic_protocol-master.zip** σε όποιο φάκελο επιθυμείτε. Εδώ θα χρησιμοποιήσουμε τον δίσκο **C:\\**. Μετονομάστε το φάκελο **C:\electronic_protocol-master** σε ένα πιο σύντομο όνομα πχ protocol, ...  Στο τέλος θα έχουμε τα αρχεία του Ηλ.Πρωτοκόλλου στον φάκελο **C:\protocol**.


Ανοίξτε τον φάκελο (**C:\protocol**) με την Εξερεύνηση των windows και αλλάξτε τις τιμές των παρακάτω μεταβλητών στα ακόλουθα αρχεία:

## Αν χρησιμοποιείτε sqlite

#### .env

 - γραμμή 29:
   - MAIL_USERNAME=**gm@ilusern@me**
 - γραμμή 30:
   - MAIL_PASSWORD=**gm@ilp@ss**


## Αν χρησιμοποιείτε mysql

#### .env
 - γραμμή 12:
   - DB_DATABASE=**d@t@b@se**
 - γραμμή 14:
   - DB_PASSWORD=**p@ssw@rd**
 - γραμμή 29:
   - MAIL_USERNAME=**gm@ilusern@me**
 - γραμμή 30:
   - MAIL_PASSWORD=**gm@ilp@ss**
#### config/database.php
 - γραμμή 48:      
   - 'database' => env('DB_DATABASE', '**d@t@b@se**'),
 - γραμμή 50:      
   - 'password' => env('DB_PASSWORD', '**p@ssw@rd**'),
 
 
Αν δεν αλλάξατε κάτι η mysql στο Xampp έχει εξορισμού:
- username root (αυτό δεν θέλει αλλαγή)
- password      (κενό)

Δώστε ένα όνομα στη d@t@b@se πχ: protocol

Αντικαταστήστε τη λέξη laravel με κάτι άλλο (πχ: protocol). Χρήσιμο αν τρέξουμε δύο πρωτόκολλα

Δώστε ένα όνομα στo @ppn@me πχ: protocol



### Ρύθμιση Apache του Xampp να ανακατευθύνεται στο Ηλ. Πρωτόκολλο


Αυτό γίνεται με δύο τρόπους:
- Ρύθμιση virtual-host του Apache
- Ρύθμιση μέσω της ντιρεκτίβας alias (ψευδώνυμο)


**Προσωπικά βρίσκω πιο εύκολο το 2ο (Alias)**


Ανοίγουμε με την εξερεύνηση των Windows τον φάκελο ```C:\xampp\apache\conf```.

Δημιουργούμε ένα Νέο φάκελο με όνομα ```alias```.

Στον φάκελο ```C:\xampp\apache\conf\alias``` δημιουργούμε ένα αρχείο conf πχ: ```protocol.conf```. Ίσως είναι πιο εύκολο να αντιγράψουμε ένα άλλο αρχείο conf, να το μετονομάσουμε και να διαγράψουμε τα δεδομένα.

Εισάγετε στο αρχείο ```C:\xampp\apache\conf\alias\protocol.conf``` που μόλις δημιουργήσατε τα παρακάτω και αποθηκεύστε:
```
Alias /protocol "C:\protocol\public"

<Directory "C:\protocol\public">
        DirectoryIndex index.php
        AllowOverride All
        Options FollowSymlinks
        Require all granted
</Directory>
```
Ανοίξτε το αρχείο ```C:\xampp\apache\conf\httpd.conf``` και για να συμπεριλάβετε τις ρυθμίσεις προσθέστε στο τέλος:
```
Include "conf/alias/*"
```

### Ρυθμίσεις


#### Ρύθμιση php


Εκκινήστε το Xampp και τους servers apache και mysql 

Ανοίξτε το πρόγραμμα  phpMyAdmin του Xampp και δημιουργήστε την βάση δεδομένων που μόλις ονομάσατε (πχ: protocol)


Ανοίξτε την κονσόλα των Windows: πρόγραμμα **Cmd**. Μεταβείτε στον φάκελο που έχετε βάλει το Ηλ.Πρωτόκολλο (πχ protocol).
```
cd C:\protocol
```
Eκτελέστε τις παρακάτω εντολές για να εγκατασταθούν τα απαραίτητα:
```
composer install

php artisan key:generate
php artisan optimize
```
## με mysql
```
php artisan migrate:refresh --seed
php artisan db:seed --class=KeepvaluesTableSeeder
```
## με sqlite
Η βάση είναι ήδη έτοιμη

Κατευθύνετε τον φυλομετρητή σας στη σελίδα http://localhost/protocol


# 
# Ασφάλεια δεδομένων

Θα πρέπει να φροντίσετε να κρατάτε τακτικά backup των δεδομένων σας. Επίσης ο server στον οποίο θα εγκαταστήσετε την εφαρμογή να έχει τουλάχιστον συστοιχία δίσκων RAID1. 

#
# Μέγεθος συνημμένων αρχείων

Για να ορίσετε το μέγιστο μέγεθος των αρχείων που αποθηκεύονται πάνω από τα 2 ΜΒ που είναι η εξ ορισμού ρύθμιση της php πρέπει να αλλάξετε την τιμή της μεταβλητής **upload_max_filesize**  στο αρχείο ```php.ini``` σε  τιμή μεγαλύτερη από **2M**, πχ: 4Megabytes.

```upload_max_filesize = 4M```

Θα βρείτε αυτό το αρχείο ανάλογα με το λειτουργικό σύστημα σε
- Linux           =>  ```/etc/php/php.ini```
- Windows + Xampp =>  ```C:\xampp\php\php.ini```


#
# Ενημέρωση του Ηλ. Πρωτοκόλλου

Όταν υπάρξουν αλλαγές στον κώδικα στο github τότε το Ηλ. Πρωτόκολλο εμφανίζει ένα μήνυμα ότι υπάρχουν αλλαγές. Ο Διαχειριστής θα πρέπει να τις κάνει χειροκίνητα. Προσπαθώ όταν ανεβάζω τις αλλαγές να περιγράφω αναλυτικά τί αλλαγή έγινε και σε ποιά αρχεία. Αν δεν επηρεάστηκε ο κώδικας γράφω "Καμία αλλαγή στον κώδικα".

Σας προτείνω μια λύση που απλοποιεί τη δουλειά με το εργαλείο **git**. Στο παράδειγμα υποθέτουμε ότι έχει γίνει εγκατάσταση
σε **Debian 9 server**

Μπαίνουμε στο server ή συνδεόμαστε μέσω ssh από άλλο pc.

Πηγαίνουμε στον κατάλογο που εγκαταστήσαμε το Ηλ.Πρωτόκολλο πχ: protocol
```cd /usr/share/protocol```

Με την εγκατάσταση και την πρώτη εγγραφή χρήστη έχουν τροποποιηθεί κάποια αρχεία. Μπορούμε να τα δούμε αν πληκτρολογήσουμε ```git status```. Θα μας δώσει τα παρακάτω:
```
On branch master
Your branch is up-to-date with 'origin/master'.
Changes not staged for commit:
  (use "git add <file>..." to update what will be committed)
  (use "git checkout -- <file>..." to discard changes in working directory)

	modified:   .env
	modified:   config/database.php
	modified:   config/session.php
	modified:   public/.htaccess

Untracked files:
  (use "git add <file>..." to include in what will be committed)

	composer.lock
	storage/conf/.denyregister

no changes added to commit (use "git add" and/or "git commit -a")
```

Για να μη χάσουμε τις αλλαγές στα αρχεία κατά την ενημέρωση δίνουμε τις παρακάτω εντολές:
```
git stash
git pull
git stash pop
```
Κάντε κλικ στο menu: Διαχείριση->Ενημερώθηκε για να μην εμφανίζεται το μήνυμα που ειδοποιεί για ενημέρωση.

**Έτοιμοι!**


# 
# Ευχαριστίες
Το Ηλεκτρονικό Πρωτόκολλο χρησιμοποιεί με ευγνωμοσύνη τα:
- [Laravel](https://laravel.com/)
- [Bootstarp](http://getbootstrap.com/)
- [jQuery](https://jquery.com/)

Γεώργιος Θεοδώρου


### Εικόνες

<img src="https://cloud.githubusercontent.com/assets/23439035/22380174/282f5fa2-e4c5-11e6-9fc7-24fc2da66e06.png" width="99%">
<img src="https://user-images.githubusercontent.com/23439035/27009310-405d0402-4e93-11e7-9a40-309eb5720168.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/22380175/283495f8-e4c5-11e6-9190-1f674818a0b2.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/26480073/69b32634-41e0-11e7-9c22-d9f02d93acab.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/22380182/28599768-e4c5-11e6-9c98-4ee0b4d7bfb9.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/22380173/282c6144-e4c5-11e6-9011-4b469a3e8104.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/22380176/2839c35c-e4c5-11e6-985d-5b1dd0f81550.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/22380177/283cc8cc-e4c5-11e6-8ec4-dc65ffacecd9.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/22380179/284f0988-e4c5-11e6-9ae1-5b40bfac0ea3.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/22380178/284eef16-e4c5-11e6-97a7-22eeb612d65b.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/22380180/28553786-e4c5-11e6-97f3-efa7f3ac67da.png" width="99%">
<img src="https://cloud.githubusercontent.com/assets/23439035/22380181/2857e67a-e4c5-11e6-85e9-a41b940ac1ab.png" width="99%">
