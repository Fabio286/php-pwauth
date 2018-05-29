<?php
/** PWAuth-Driver */
 class PWAuth{
 
    private $pwauthPath = '/usr/sbin/pwauth';
	 
	 /** Esegue l'autenticazione e restituisce un array con i dati relativi all'utente in caso positivo, o false in caso negativo
	  * 
	  * @param string $external_uid
	  * @param string $external_passwd
	  */
    public function Authenticate($external_uid, $external_passwd) {
		// Start
		$handle = popen($this->pwauthPath, 'w');
		if($handle === FALSE) {
				die("Errore di apertura pwauth");
				return false;
		}
        
		if(fwrite($handle, "$external_uid\n$external_passwd\n") === FALSE) {
				die("Errore di comunicazione con pwauth");
				return false;
		}

		// Chiude e riceve risposta
		$result = pclose($handle);
		
		if($result==0) {// Login OK
			$etcPasswd = file('/etc/passwd');
			foreach($etcPasswd as $singleLine) {
				if(substr($singleLine, 0, strlen($external_uid ) + 1) == $external_uid.':') {
					$explodedLine = explode(':', $singleLine);
					
					$return = array();

					$return['user']    = $explodedLine[0];
					$return['uid']     = $explodedLine[2];
					$return['gid']     = $explodedLine[3];
					$return['comment'] = $explodedLine[4];
					$return['dir']     = $explodedLine[5];
					$return['shell']   = $explodedLine[6];
                    
					// GECOS field (comment)
					$userData = explode(',', $return['comment']);
                    
					$name               = $userData[0];
					$building           = $userData[1];
					$phone              = $userData[2];
					$other              = $userData[3];
					$return['name']     = $name;
					$return['building'] = $building;
					$return['phone']    = $phone;
					$return['other']    = $other;
                    
					return $return;
				}
			}
		}
		return false;
    }
}

/*// Test
$pwauth = new PWAuth;
$login = $pwauth->Authenticate('fabio', 'password');
echo '<pre>';
print_r($login);
echo '</pre>';*/
?>