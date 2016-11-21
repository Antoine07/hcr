<?php 

function url($uri=null)
{

	if(is_null($uri))
		return getEnv('URL_SITE');

	$prefix = getEnv('URL_PREFIX');

	$path = $prefix .'/'. $uri;

	return getEnv('URL_SITE') . '/' . $path;
}


function get_pdo()
{
	$host = getenv('DB_HOST');
	$dbname = getenv('DB_NAME');
	$username = getenv('DB_USERNAME');
	$password = getenv('DB_PASSWORD');

	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		]);
	
	return $pdo;
}

function f_rand($min=0,$max=1,$mul=10000){
    if ($min>$max) return false;
    return mt_rand($min*$mul,$max*$mul)/$mul;
}

class Security
    {
        // Données entrantes
        public static function bdd($string)
        {
            // On regarde si le type de string est un nombre entier (int)
            if(ctype_digit($string))
            {
                $string = intval($string);
            }
            // Pour tous les autres types
            else
            {
                $string = mysql_real_escape_string($string);
                $string = addcslashes($string, '%_');
            }
                
            return $string;
        }

        // Données sortantes
        public static function h($string)
        {
            return htmlentities($string);
        }
    }