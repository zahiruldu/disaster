<?php 
require_once ("db.php");
require_once ("functions.php");
$user_id=$_SESSION['user_id'];
$victim= $_GET['u'];
$victim_id= $_GET['id'];
$message= $_GET['m'];
		if(isset($_POST['detail'])){
			$profile_pic = ($_FILES['profile_pic']);
			$affected_by= $_POST['affected_by'];
			$description= $_POST['description'];
			$pay_detail= $_POST['pay_detail'];
				
			if (empty($_FILES["profile_pic"]["name"])){				    
					     $message= "Please select a profile picture!";
					    }
					  elseif (file_exists("upload/" . $_FILES["profile_pic"]["name"])) {
					  	 $message= $_FILES["profile_pic"]["name"] . " already exists. ";
					  }				  					    
					    else{
					      move_uploaded_file($_FILES["profile_pic"]["tmp_name"],
					      "upload/" . $_FILES["profile_pic"]["name"]);

					      $profile_pic = "upload/" . $_FILES["profile_pic"]["name"];
						  $sql= "UPDATE victims SET profile_pic='$profile_pic',affected_by='$affected_by',description='$description',pay_detail='$pay_detail' WHERE id='$victim_id'";
						  
						 // $sql= "INSERT INTO victims"."(profile_pic,affected_by,description,pay_detail)"."VALUES"."('$profile_pic','$affected_by','$description','$pay_detail')"."WHERE id='$victim_id'";	
						  $result = mysqli_query($conn,$sql);
						  if(!$result){
							  die('error:'.mysqli_error($conn));
							  } else{
								  $message="Your have successfully submitted details!";
								  header("Location: register.php");}
			
			}
		
		
		}

	$detail= "<form method='post' action='' enctype='multipart/form-data' ><table>
				<tr><td>Upload a picture:<input type='file' name='profile_pic' placeholder='Upload Picture' /></td><tr>
				<tr><td>How you are affected:<input type='text' name='affected_by' placeholder='e.g Cyclone, Sidr, Collapse' /></td><tr>
				<tr><td>Description:<br><textarea cols='50' rows='5' name='description' placeholder='Write your Details'></textarea></td><tr>
				<tr><td>How people can support:<br><textarea cols='50' rows='5' name='pay_detail' placeholder='Write your Bank Deatails, Pay information in which people can donate you money and help'></textarea></td><tr>
				<tr><td><input type='submit' name='detail' value='Submit' placeholder='Upload Picture' /></td><tr>
	
	
			</table></form>";
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

<?php

if(isset($victim_id) && !empty($victim_id)){
	 echo $message;
	 echo $detail;
	} 


	
 require_once("footer.php");

  ?> 
