<?php
require_once ("db.php");
require_once ("functions.php");

$user_id=$_GET['u'];
$email=$_GET['e'];
$message=$_GET['m'];
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
    <?php 
	if(isset($_POST['submit'])){
		$code= $_POST['code'];
		if(empty($code)){$warning="Put your code and submit";}
			else{
				$sql= "UPDATE contributors SET email_activated='1' WHERE email='$email' AND code='$code'";
				$result= mysqli_query($conn,$sql);
						if(!$result){$warning= "Can't update database!";}
							elseif($result){
								$double_check= "SELECT email_activated FROM contributors WHERE email='$email'";
								$check = mysqli_query($conn,$double_check);
								
								while ($row = mysqli_fetch_array($check)){
									   $value = $row['email_activated'];
									   			if($value == 1){ 
												$warning= "You are activated successfully!";
												header("Location: login.php?w=$warning"); }
												else{$warning="Your account could not be activated!";}									   
									   
									   }																					
									
								}
				
				}
		}
	
	?>
    <div class="container">
    	<?php require_once("navigation.php"); ?>
    <div> <?php echo $message; ?></div>
    <div id="verifyform">
            <form method="post" action="" >
            <span><?php echo $warning; ?></span>
            Put your activation Code: <input type="text" name="code"  required />
            <input type="submit" name="submit" value="Verify" />
            </form>
    </div>
    
  <?php require_once("footer.php"); ?> 