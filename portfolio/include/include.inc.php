<?php
require_once 'db.class.php';
require_once 'model.class.php';
require_once 'view.class.php';
require_once 'controler.class.php';



$database = new Database();
$db = $database->connect();


$model = new Model($db);
$view = new View();
$controler = new Controler($model, $view);
?>
