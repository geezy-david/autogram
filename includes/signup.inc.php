<?php 


if (isset($_POST['signup'])){

	
include 'dbh.inc.php';
	
	$name = $_POST['name'];
	$name2 = $_POST['name2'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$pwd = $_POST['password'];
	
	
	
	if(!preg_match('/^[a-zA-Z0-9]*$/',$name) || !preg_match('/^[a-zA-Z0-9]*$/',$name2)){
		exit('failedname');
	}elseif(!preg_match('/^[a-zA-Z0-9\._-]*$/',$username) ){
		
		exit('failedusername');
	}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	
		exit('failedemail');
	}
	else{
		$email = trim($email);
		$email = htmlentities($email);
		$sql = 'SELECT * FROM users WHERE Email = ? limit  1';
    $stmt =$conn->prepare($sql);
	if(!$stmt->execute([$email])){
		
		exit('sqlerror');
	}else
    $count = $stmt->rowcount();
    if($count > 0){
	
		exit('emailused');	
	}else {
		$username = htmlentities($username);
	
		$sql = 'SELECT * FROM users WHERE username = ? limit  1';
    $stmt =$conn->prepare($sql);
    if(!$stmt->execute([$username])){
		
		exit('sqlerror');
	}else
    $count = $stmt->rowcount();
    if($count > 0){
		exit('userused');
	}else {
		
		$pwd = password_hash($pwd,PASSWORD_DEFAULT);
		$verified = false;
		$name = htmlentities($name);
		$name2 = htmlentities($name2);
		$selector = bin2hex(random_bytes(10));
		$took = bin2hex(random_bytes(32));
		$token = password_hash($took,PASSWORD_DEFAULT);
		//handle
		
		//handle
		$coin = 10;
		$sql = 'INSERT INTO users(FIRSTNAME,LASTNAME,USERNAME,EMAIL,PASSWORD,VERIFIED,COINS)VALUES(?,?,?,?,?,?,?)';
		$stmt = $conn->prepare($sql);
		if($stmt->execute([$name,$name2,$username,$email,$pwd,$verified,$coin])){
			$sql = 'SELECT ID FROM USERS WHERE EMAIL = ? LIMIT 1';
			$stmt = $conn->prepare($sql);
			if($stmt->execute([$email])){
			 $stm = $stmt->fetch(PDO::FETCH_OBJ);
			 $id = $stm->ID;
			$expire = date('U') + 7200;
		$sql='INSERT INTO verfier(EMAIL,TOKEN,SELECTOR,EXPIRES,UID)VALUES(?,?,?,?,?)';
		$stmt = $conn->prepare($sql);
		if($stmt->execute([$email,$token,$selector,$expire,$id])){
			include 'functions.php';
			$imagepath = makeavatar(strtoupper($name[0]));
			if($imagepath){
				$sql = 'UPDATE USERS SET CURRENTIMG = ? WHERE EMAIL = ? limit 1 ';
				$stmt=$conn->prepare($sql);
				if($stmt->execute([$imagepath,$email])){
				
session_start();
$_SESSION['username'] = $username;
$_SESSION['firstname'] = $name;
$_SESSION['lastname'] = $name2;
$_SESSION['email'] = $email;
$_SESSION['image'] = $imagepath;
exit('done');


			}else{exit('sqlerror');}
			}exit('done');

			
			}else{exit('sqlerror');}
		}else{exit('sqlerror');}
		
	}else{exit('sqlerror');}
	}
	}

}

}

 ?>