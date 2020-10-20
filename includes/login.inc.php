<?php 
if(isset($_POST['login'])){
	include 'dbh.inc.php';
	$name = $_POST['name'];
	$pwd = $_POST['pwd'];
$name = htmlentities($name);
$sql = 'SELECT * FROM USERS WHERE USERNAME = ? OR EMAIL = ? LIMIT 1';
$stmt = $conn->prepare($sql);
if($stmt->execute([$name,$name])){
   $count = $stmt->rowcount();
   if($count > 0){
      
    $stm = $stmt->fetch(PDO::FETCH_OBJ);
$pwddb = $stm->PASSWORD;
if(!password_verify($pwd,$pwddb)){
    exit('wrongpwd');
}else{exit('logedin');}

   } else{exit('wrongnum');}
}else{exit('sqlerror');}
}

 ?>