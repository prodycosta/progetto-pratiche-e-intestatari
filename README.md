<h1>Progetto pratiche e intestatari</h1>

<h3>Per far partire l'applicativo</h3>
<p>una volta fatta la clone del repository e importato il progetto

esegui le seguenti righe nel terminale del progetto nel ide:
composer --version

composer install

cp .env.example .env

php artisan key:generate

php artisan serve

crea il db e nel file env imposta

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= il nome del db
DB_USERNAME= la tua username
DB_PASSWORD= la tua password del db</p>



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




