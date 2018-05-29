# Driver PHP per autenticazione PAM

## Requisiti
I driver per l'autenticazione PAM si basano sul passaggio dello username e della password all'applicazione **Pwauth**, pertanto necessitano di quest'ultimo installato per funzionare.

E' possibile installare Pwauth via repository lanciando `sudo apt-get install pwauth` o tramite sorgenti.  

I sorgenti di Pwauth sono reperibili al seguente link: https://github.com/phokz/pwauth/tree/master/pwauth

## Funzionamento
Istanziare la classe `PWAuth` e richiamare il metodo `Autenticate`, al quale passare user e password.

``` php
$pwauth = new PWAuth;
$login = $pwauth->Authenticate('username', 'password');
```

Si otterrà in risposta un array contenente le informazioni relative all'utente.
``` php
$login['user']    // Username
$login['uid']     // ID
$login['gid']     // ID del gruppo
$login['comment'] // Commento
$login['dir']     // Directory
$login['shell']   // Shell

// CAMPI IN FORMATO GECOS
$login['name']     // Nome
$login['building'] // Struttura
$login['phone']    // Telefono
$login['other']    // Altro
```