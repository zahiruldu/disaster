<?php 
require_once ("db.php");
require_once ("functions.php");
$user_id=$_SESSION['user_id'];

$victim_id= $_GET['id'];

if(!empty($victim_id)){
	$victim_id="$victim_id";
	
	$sql="SELECT * FROM victims WHERE id='$victim_id'";
	$result= mysqli_query($conn,$sql);
	while($row= mysqli_fetch_array($result)){
			$id = $row["id"];
			$first_name = $row["first_name"];
			$last_name = $row["last_name"];
			$father_name = $row["father_name"];
			$mother_name = $row["mother_name"];
			$country = $row["country"];
			$state = $row["state"];
			$postcode = $row["postcode"];
			$street_village = $row["street_village"];
			$national_id = $row["national_id"];
			$passport = $row["passport"];
			$birth_date = $row["birth_date"];
			$sex = $row["sex"];
			$profile_pic = $row["profile_pic"];
			$affected_by = $row["affected_by"];
			$description = $row["description"];
			$pay_detail = $row["pay_detail"];
			
		
		}
	
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
    
    <div>
    	<div style="width:50%; float:right;"><?php echo"<img src='".$profile_pic."' width='150' height='' />"; ?></div>
    	<div id="detail_info">
    		<h3>My Details Information</h3>
    		    <table>				     
				     <tr><td><?php  echo "<b>My First Name: </b>" .$first_name; ?></td></tr>
				     <tr><td><?php  echo "<b>My Last Name: </b>" .$last_name; ?></td></tr>
				     <tr><td><?php  echo "<b>My Father Name:</b> " .$father_name; ?></td></tr>
				     <tr><td><?php  echo "<b>My Mother Name:</b> " .$mother_name; ?></td></tr>
				     <tr><td><?php  echo "<b>I am $sex from:</b> " . $country.",".$state; ?></td></tr>
				     <tr><td><?php  echo "<b>I live in: </b>" .$street_village.",".$postcode; ?></td></tr>
				     <tr><td><?php  echo "<b>My National ID:</b> " .$national_id; ?></td></tr>
				     <tr><td><?php  echo "<b>My passport: </b>" .$passport; ?></td></tr>
				     <tr><td><?php  echo "<b>I was affected by:</b> " .$affected_by; ?></td></tr>		   
				    			
				    </table>
				    <p>
				    	<h3>More about me:</h3>
				    	<?php  echo $description; ?>


				    </p>
				    <p>
				    	<h3>If you are willing to help me you can use this information:</h3>
				    	<?php  echo $pay_detail; ?>


				    </p>




    		</div>


    </div>
     
<?php require_once("footer.php"); ?> 