<?php
$selectorr = '';
$token ='';
$date ='';
$token2 ='';
$email ='';
if(isset($_GET['selector']) && isset($_GET['token'])){
$selector = $_GET['selector'];
$token = $_GET['token'];
if(ctype_xdigit($selector) !== false && ctype_xdigit($token) !== false){
$newdate = date('U');
require 'includes/dbh.inc.php';
$sql = 'SELECT * FROM VERFIER WHERE SELECTOR = ? LIMIT 1';
$stmt = $conn->prepare($sql);
if($stmt->execute([$selector])){
    $count = $stmt->rowcount();
    if($count > 0){
        $stm = $stmt->fetch(PDO::FETCH_OBJ);
        $date = $stm->EXPIRES;
        $email = $stm->EMAIL;
        if($date > $newdate){
$token2 = $stm->TOKEN;
if(password_verify($token,$token2)){
$sql ='UPDATE USERS SET VERIFIED = 1 WHERE EMAIL = ? LIMIT 1';
$stmt = $conn->prepare($sql);
if($stmt->execute([$email])){
    $sql ='DELETE FROM VERFIER WHERE EMAIL = ? LIMIT 1';
    $stmt = $conn->prepare($sql);
    if($stmt->execute([$email])){
        $sql ='SELECT * FROM USERS WHERE EMAIL = ? LIMIT 1';
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$email])){
            $stm = $stmt->fetch(PDO::FETCH_OBJ);

            session_start();
$_SESSION['username'] = $stm->USERNAME;
$_SESSION['firstname'] = $stm->FIRSTNAME;
$_SESSION['lastname'] = $stm->LASTNAME;
$_SESSION['email'] = $stm->EMAIL;
$_SESSION['image'] = $stm->CURRENTIMG;
header('location:home.php'); 
        }else{
            header('location:home.php');  
        }
    }else{
        header('location:home.php');  
    }
}else{
    header('location:home.php');  
}
}else{
   header('location:home.php');  
}
        }else{
            echo 'link already expired';
        }
    }else{
    header('location:home.php'); 
}
}else{
    header('location:home.php'); 
}

}else{
    header('location:home.php'); 
}


}else{
   header('location:home.php');
}