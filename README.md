<h1>Progetto pratiche e intestatari</h1>

<h3>Per far partire l'applicativo</h3>
<p>una volta fatta la clone del repository e importato il progetto

esegui le seguenti righe nella cartella del  terminale del progetto nel ide:
composer --version

composer install

cp .env.example .env

modifica informazioi nel .env 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= il nome del db
DB_USERNAME= la tua username
DB_PASSWORD= la tua password del db

modifica anche per poter modificare la password dimenticata

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=la tua email
MAIL_PASSWORD=password presa da gmail non é quella della email
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="la tua email"
MAIL_FROM_NAME="nome a tuo piacimento"

per MAIL_PASSWORD devi andare su gmail -> icona account -> gestisci account -> sicurezza -> verifica in due passaggi -> passwor delle app -> metti nome app e ti uscira la password da mettere in MAIL_PASSWORD -> mettila e togli gli spazi in modo che sia tutto attaccata

php artisan key:generate

php artisan storage:link

scrivi nel terminale "php artisan migrate" per creare le tabelle

prima di far partire l'applicativo scrivi le seguenti query 
per la tabella ruoli=  INSERT INTO roles (id, nome)
VALUES
  (1, 'Admin'),
  (2, 'User');

  account partirá in automatico con ruolo Users, puo essere Admin se modificato dal db dalla tabella utenti, cambi la colonna ruolo da 1 a 2 oppure puo essere modificato da un admin
per la tabella stato_pratica=  INSERT INTO stato_pratica (id, descrizione)
VALUES
  (1, 'Lavorazione'),
  (2, 'Finita'),
  (3, 'Annullata');
  


infine nel terminale del progetto scrivi "php artisan serve"
</p>



<h3>Funzionalità</h3>

____________________________________________________________________________________________________________________________________________________________________________________________________________________

<ul>
    <li>Login e Register: Per creare un account</li>
    <li>Possibilitá di aggiungere intestatari con qualsiasi dettaglio</li>
    <li>Possibilita di aggiungere Pratiche con qualsiasi dettaglio</li>
    <li>Dashboard per vedere e modificare i propri intestatari</li>
    <li>Dashboard per vedere e modificare le proprie pratiche</li>
    <li>Account per modificare le proprie informazion, eliminare account o cambiare password</li>
    <li>Se sei un amministratore, hai la possibilità di visualizzare tutti gli utenti, gli intestatari e le pratiche; inoltre, puoi modificare ed eliminare qualsiasi dato desideri.</li>
</ul>



____________________________________________________________________________________________________________________________________________________________________________________________________________________

<h1>Tecnologie usate</h1>

<ul>
    <li>Frontend: Laravel e Bootstrap</li>
    <li>Backend: Laravel </li>
    <li>Database: MySQL</li>
</ul>




