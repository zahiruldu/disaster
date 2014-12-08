<?php 
require_once ("db.php");
require_once ("functions.php");
$user_id=$_SESSION['user_id'];
$user_type= $_SESSION['user_type'];

if(isset($_POST['submit']) && !empty($user_id)){
    
    $first_name= $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $father_name= $_POST['father_name'];
    $mother_name= $_POST['mother_name'];
    $country= $_POST['country'];
    $state= $_POST['state'];
    $postcode= $_POST['postcode'];
    $street_village= $_POST['street_village'];
    $national_id= $_POST['national_id'];
    $passport= $_POST['passport'];
    $birth_date= $_POST['birth_date'];
    $sex= $_POST['sex'];
	
	
	if(empty($first_name) or empty($last_name) or empty($father_name) or empty($mother_name) or empty($country) or empty($state) or empty($postcode) or empty($street_village) or empty($birth_date) or empty($sex) ){
		 $message= "Please fill up the missing data!";
		
		} else {
			$sql= "INSERT INTO victims" . "(first_name,last_name,father_name,mother_name,country,state,postcode,street_village,national_id,passport,birth_date,sex,created_by,created_at)" . "VALUES" . "('$first_name','$last_name','$father_name','$mother_name','$country','$state','$postcode','$street_village','$national_id','$passport','$birth_date','$sex','$user_id',NOW())";
			
			$result= mysqli_query($conn, $sql);
			
			
			if(!$result){
				die("Could not enter data:". mysqli_error($conn));}
				else{ 	
					$sql="SELECT id FROM victims WHERE first_name='$first_name' AND last_name='$last_name'AND father_name='$father_name' AND mother_name='$mother_name'";
					$check= mysqli_query($conn,$sql);
					while($row= mysqli_fetch_array($check)){$id=$row['id'];}			
				$message="Data submitted successfully ! Now submit more about this person in the folllowing";
				header("Location: detail.php?id=$id&u=$first_name&m=$message");
				
				}
			
			}
    

}
 elseif(isset($_POST['submit']) && empty($user_id)) {
	 $message= " Please Login as contributor to add people";}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>Register</title>
    <script type= "text/javascript" src = "js/countries.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
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
	if($user_type == "Volunteer"){
    
	
	?>
    <h2 id="register_title">Register the Victim Peoples</h2>
    <div><?php echo $message; ?></div>
    
    
    <form id="register" action="register.php" method="post" accept-charset="utf-8">
     <table>
     <tr>
     <td>First Name:</td>
     <td><input type="text" size="50" name="first_name" required /></td>
     </tr>
     <tr>
     <td>Last Name:</td>
     <td><input type="text" size="50" name="last_name" required /></td>
     </tr>
     <tr>
     <td>Father's Name:</td>
     <td><input type="text" size="50" name="father_name" required /></td>
     </tr>
     <tr>
     <td>Mother's Name:</td>
     <td><input type="text" size="50" name="mother_name" /></td>
     </tr>
     <tr>
     <td>Country: </td>
     <td>
        <select onChange="print_state('state', this.selectedIndex);" id="country" name ="country" ></select>
     </td>
     </tr>
       <tr>
     <td>City/District/State:</td>
     <td><select name ="state" id ="state" required ></select></td>
      <script language="javascript">print_country("country");</script>
     </tr>
      <tr>
     <td>PostCode:</td>
     <td><input type="text" size="50" name="postcode" required /></td>
     </tr>
       <tr>
     <td>Street/ Village:</td>
     <td><input type="text" size="50" name="street_village" required /></td>
     </tr>
      <tr>
     <td>National ID:</td>
     <td><input type="text" size="50" name="national_id" /></td>
     </tr>
      <tr>
     <td>Passport No:</td>
     <td><input type="text" size="50" name="passport" /></td>
     </tr>
      <tr>
     <td>Date of Birth:</td>
     
     <td><input type="text" size="50" id="datepicker" name="birth_date" required /></td>
     </tr>
      <tr>
     <td>Gender:</td>
     <td><input type="radio" name="sex" value="male" checked>Male<br>
    <input type="radio" name="sex" value="female">Female<br>
    <input type="radio" name="sex" value="others">Others</td>
     </tr>
     
       <tr>
     <td></td>
     <td><input type="submit" name="submit" value="Add Victim" /></td>
     </tr>
     </table>
     
        
    </form>
    <?php } else{
        $message="Only the Volunteer can add victims. You can contribute as Doner or Others ways! <br><a href='index.php'>Donate</a>";
    }


     ?>
    <div style="margin: 0 auto; text-align: center;"><?php echo $message; ?></div>

    
<?php require_once("footer.php"); ?> 