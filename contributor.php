<?php 
require_once ("db.php");
require_once ("functions.php");
$user_id=$_SESSION['user_id'];

if(isset($_POST['submit'])){
    
    $first_name= $_POST['first_name'];
    $last_name= $_POST['last_name'];
    $email= $_POST['email'];
    $user_password= $_POST['password'];
    $country= $_POST['country'];
    $state= $_POST['state'];
    $postcode= $_POST['postcode'];
    $street_village= $_POST['street_village'];
    $national_id= $_POST['national_id'];
    $passport= $_POST['passport'];
    $birth_date= $_POST['birth_date'];
    $sex= $_POST['sex'];
	$type=$_POST['type'];
	$salt= md5($email);
	$password= md5($user_password);
	$code=rand();
	
	if(empty($first_name) or empty($last_name) or empty($email) or empty($password) or empty($country) or empty($state) or empty($postcode) or empty($street_village) or empty($birth_date) or empty($sex) or empty($type) ){
		echo $message= "Please fill up the missing data!";
		
		} else { 
			$sql= "INSERT INTO contributors" . "(first_name,last_name,email,password,country,state,street_village,postcode,salt,national_id,passport,birth_date,sex,type,code,created_at)" . "VALUES" . "('$first_name','$last_name','$email','$password','$country','$state','$street_village','$postcode','$salt','$national_id','$passport','$birth_date','$sex','$type','$code',NOW())";
			
			$result= mysqli_query($conn, $sql); //insert to database			
			
			if(!$result){
				die("Could not enter data:". mysqli_error($conn));}//insert to database check
				else{ 
					// sending verification Code
					$id = mysqli_insert_id();
					
					$to= "$email";
					$admin_email="admin@disaster.com";
					$from="$admin_email";
					$subject="Complete Registration";
					$msg='<html>
                        <body bgcolor="#FFFFFF">
                        Hi ' . $first_name. ',
                        <br /><br />
                        You must complete this step to activate your account with us.
                        <br /><br />
                        Please Give the following code to verify your account &gt;&gt;
						
						Code: '.$code.'
                        
                       
                        <br /><br />
                        Your Login Data is as follows: 
                        <br /><br />
                        E-mail Address: ' . $email . ' <br />
                        
                        Password: ' . $user_password . ' 
                        <br /><br /> 
                        Thanks! 
                        </body>
                        </html>';
						
						$headers = "From: $from\r\n";
                        $headers .= "Content-type: text/html\r\n";
                        $to = "$to";
						mail($to, $subject, $msg, $headers); //sending final message
						$message= "<h4>Thanks $first_name,</h4><br />
                       We just sent an Activation Code to: $email Please check your email inbox in a moment to get your Activation code.";
					
								
									header("Location: verify.php?u=$first_name&e=$email&m=$message");
									
									
				
				
				}
			
			}
    

}

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
    <h3 style="text-align:center; margin-bottom:50px;">Register to contribute for the Victim Peoples</h3>
    <div><?php echo $message; ?></div>
    
    
    <form id="register" action="contributor.php" method="post" accept-charset="utf-8">
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
     <td>Email:</td>
     <td><input type="email" size="50" name="email" required /></td>
     </tr>
     <tr>
     <td>Password:</td>
     <td><input type="password" size="50" name="password"  required /></td>
     </tr>
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
     <td><input type="radio" name="sex" value="male" checked>Male
    <input type="radio" name="sex" value="female">Female
    <input type="radio" name="sex" value="others">Others
    </td>
     </tr>
      <tr>
     <td>How you contribute:</td>
     <td>
     <select name="type" required >
    	<option value="Doner">As Doner</option>
  		<option value="Volunteer">As Volunteer</option>
  		<option value="Other">Other</option>
  </select>     
    </td>
     </tr>
       <tr>
     <td></td>
     <td><input type="submit" name="submit" value="Register" /></td>
     </tr>
     </table>
     
        
    </form>
    
       
<?php require_once("footer.php"); ?> 