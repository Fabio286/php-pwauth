# PHP drivers for PAM authentication

## Requirements

PAM authentication drivers works by passing username and password to the application **Pwauth**, so this application is required.

It's possible to install this application by running  `sudo apt-get install pwauth` or via sources.  

Pwauth sources available at:  
https://github.com/phokz/pwauth/tree/master/pwauth

## Usage
Instantiate the `PWAuth` class and invoke the` Authenticate` method, passing it user and password.

``` php
$pwauth = new PWAuth;
$login = $pwauth->Authenticate('username', 'password');
```

It returns an associative array with user informations.
``` php
$login['user']    // Username
$login['uid']     // ID
$login['gid']     // Group ID
$login['comment'] // Comment
$login['dir']     // Directory
$login['shell']   // Shell

// GECOS FORMAT FIELDS
$login['name']     // Name
$login['building'] // Buolding
$login['phone']    // Phone
$login['other']    // Other
```
