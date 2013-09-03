<?php
session_cache_limiter(false);
session_start();

$_SESSION['token'] = isset ($_SESSION['token']) ? $_SESSION['token'] : '';

require 'Slim/Slim.php';
require 'db.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'mode' => 'production',
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
        'path' => './logs',
        'name_format' => 'Y-m-d',
        'message_format' => '%label% - %date% - %message%'
        ))
));
    
$app->contentType("application/json");

$app->get('/jadwal/:id', 'jadwal');
$app->get('/jadwal', 'jadwal_');
$app->get('/stasiuns', 'stasiuns');
$app->get('/stasiuns/:kd', 'stasiun');

// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'log.level' => \Slim\Log::WARN,
        'debug' => false
    ));
});

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'log.level' => \Slim\Log::DEBUG,
        'debug' => true
    ));
});
    
$app->notFound(function () use ($app) {
   echo 'notFound coy';
});

$app->run();


function jadwal($id) 
{
    try {
        $hsl = get_jadwal($id);
		
        echo json_encode($hsl);
    } catch(\Exception $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function jadwal_() 
{
    try {
		//set default to jak = jakartakota
		$id = 'jak';
        $hsl = get_jadwal($id);
    
        echo json_encode($hsl);
    } catch(\Exception $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function stasiuns() 
{
    global $app;

    $sql = "SELECT * FROM stasiun";
	
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $stasiuns = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $app->etag('stasiuns');
        $app->expires('+1 week');
        echo json_encode($stasiuns);
    } catch (\PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function stasiun($kd) 
{
    $sql = "SELECT * FROM stasiun WHERE kode = :kd";

    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("kd", $kd);
        $stmt->execute();
        $stasiun = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($stasiun);
    } catch (\PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//get data from http://infoka.krl.co.id
function get_jadwal($destination)
{
	if (empty($_SESSION['token']))
	{
		$_SESSION['token'] = get_token($destination);
	}
	
    $url = 'http://infoka.krl.co.id';
    $referer = $url.'/to/'.$destination;
    $uri = $url.'/'.$_SESSION['token'];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    curl_close($ch);

	preg_match("/([a-z0-9]{32,99})/", $output, $matches);
	$hasil = json_decode($output, true);
	
	//save token value to session
	if(!empty($matches[0]))
		$_SESSION['token'] = $hasil[$matches[0]];

	return $hasil;
}

function get_token($destination)
{
	$url = 'http://infoka.krl.co.id';
	$originuri = $url.'/to/'.$destination;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $originuri);
	
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $output = curl_exec($ch);
    curl_close($ch);
	
	preg_match("/([|'])([A-Za-z0-9]{45,999})(['|])/", $output, $matches);
	$hasil = str_replace('|','',$matches[0]);
	
    return $hasil;
}