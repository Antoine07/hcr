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