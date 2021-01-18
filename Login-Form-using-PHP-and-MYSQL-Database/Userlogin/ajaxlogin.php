<?php

session_start();
require_once('config.php');

if(!isset($_SERVER['HTTP_REFERER'])){
    header('location: https://www.linkedin.com/in/vrunda-nawal1/');
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?  LIMIT 1";
$stmtselect  = $db->prepare($sql);
$result = $stmtselect->execute([$username]);
if($result){
	$user = $stmtselect->fetch();

	 if($stmtselect->rowCount() > 0 ){
        $validpassword = password_verify($password, $user['password']);
		 if($validpassword){
			$_SESSION['userlogin'] = $user;
            echo '200';
            
		}else{
			print 'Ther Username and password are wrong';
			
		}
    }else {
        print 'Ther Username and password are wrong';
    }
		
	
}else{
	echo 'There were errors while connecting to database.';
}

?>