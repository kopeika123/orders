<?php
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'kopeika541');
define('DB_DATABASE', 'orders');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
