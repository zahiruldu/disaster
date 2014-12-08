<?php
require_once ("db.php");
require_once ("functions.php");


$message=$_GET['w'];


 	
	if(isset($_POST['login'])){
		$email= $_POST['email'];
		$user_password= $_POST['password'];
		$salt= md5($email);
		$password= md5($user_password);
		
		$sql= "SELECT * FROM contributors WHERE email='$email' AND salt='$salt' AND password='$password'";
		$result= mysqli_query($conn,$sql);
		if($row = mysqli_fetch_array($result)){
				$user_id= $row['id'];
				$user_name= $row['first_name'];
				$user_type= $row['type'];
				$_SESSION['user_id']= $user_id;
				$_SESSION['user_name']= $user_name;
				$_SESSION['user_type']= $user_type;
				
				$status="UPDATE contributors SET last_login = NOW() WHERE id = $user_id";
				mysqli_query($conn,$status);
				header("location: index.php");				
			} else{ $message="Your Email or Password is incorrect!";}
		
		
		}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>Verify</title>
      <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
    </head>
    <body>
    <div class="container"> 
        <?php require_once("navigation.php"); ?>
        
        <div id="login">
    <div > <?php echo $message; ?></div>
    
    	<form method="post" action="" >
        	<table>
            	<tr>
                	<td>Email:</td>
                    <td><input type="email" size="" name="email" /></td>
         		</tr> 
                <tr>
                	<td>Password:</td>
                    <td><input type="password" size="" name="password" /></td>
         		</tr> 
                <tr>
                	<td></td>
                    <td><input type="submit" size="" name="login"  value="Login"/></td>
         		</tr>     
            
            
            </table>
        </form>
    </div>
      
<?php require_once("footer.php"); ?> 