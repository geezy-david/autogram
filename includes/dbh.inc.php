<?php
$server = 'localhost';
$dbname = 'autoall';
$username = 'root';
$password ='';
$dsn ='mysql:host='.$server.';dbname='.$dbname;
$conn = new PDO($dsn, $username, $password);



?>