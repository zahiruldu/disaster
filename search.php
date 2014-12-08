<?php 
require_once ("db.php");
require_once ("functions.php");

$u= $_SESSION['user_id'];
$t= $_SESSION['user_type'];

?>
<?php 
// filter here
			if(isset($_POST['search'])){
					$country= $_POST['country'];
					$state= $_POST['state'];
					$postcode= $_POST['postcode'];
					$street_village= $_POST['street_village'];
					if(isset($country) && !empty($country)){
						$count= "SELECT COUNT(id) FROM victims WHERE country ='$country'";
						$count2= "SELECT *  FROM victims WHERE country ='$country' ORDER BY id DESC $limit";
						}elseif(isset($state) && !empty($state)){
							$count= "SELECT COUNT(id) FROM victims WHERE state ='$state'";
							$count2= "SELECT *  FROM victims WHERE state ='$state' ORDER BY id DESC $limit";
							} elseif(isset($postcode) && !empty($postcode)){
								$count= "SELECT COUNT(id) FROM victims WHERE postcode ='$postcode'";
								$count2= "SELECT *  FROM victims WHERE postcode ='$postcode' ORDER BY id DESC $limit";
								}elseif(isset($street_village) && !empty($street_village)){
									$count= "SELECT COUNT(id) FROM victims WHERE street_village ='$street_village'";
									$count2= "SELECT *  FROM victims WHERE street_village ='$street_village' ORDER BY id DESC $limit";
									}elseif(isset($country) && isset($state) && !empty($state)){
										$count= "SELECT COUNT(id) FROM victims WHERE country ='$country' AND state='$state'";
										$count2= "SELECT *  FROM victims WHERE country ='$country' AND state='$state' ORDER BY id DESC $limit";
										}elseif(isset($state) && isset($postcode) && !empty($postcode)){
											$count= "SELECT COUNT(id) FROM victims WHERE state ='$state' AND postcode='$postcode'";
											$count2= "SELECT *  FROM victims WHERE state ='$state' AND postcode='$postcode' ORDER BY id DESC $limit";
											}else{
												$count= "SELECT COUNT(id) FROM victims";
												$count2= "SELECT *  FROM victims ORDER BY id DESC $limit";}
					}
//run query here					
$sql = "$count";

$query = mysqli_query($conn, $sql); 
$row = mysqli_fetch_row($query);
$rows = $row[0];
$page_rows = 10;  //display number control

$last = ceil($rows/$page_rows);
	if($last < 1){ 
	   $last = 1; }
	   
$pagenum = 1;
	if(isset($_GET['pn'])){
		 $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);}
	if ($pagenum < 1) { 
	   $pagenum = 1; 
	   } else if ($pagenum > $last) { 
	   				$pagenum = $last; }
					
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

//query based on filter
		$sql = "$count2"; 
		$query = mysqli_query($conn, $sql);
$textline1 = "You are watching (<b>$rows</b>)"; 
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
$paginationCtrls = '';
if($last != 1){
		if ($pagenum > 1) { 
		$previous = $pagenum - 1; 
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
		for($i = $pagenum-4; $i < $pagenum; $i++){ 
				if($i > 0){ 
				$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; '; } 
				} 
			}
			$paginationCtrls .= ''.$pagenum.' &nbsp; ';
		for($i = $pagenum+1; $i <= $last; $i++){ 
		    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; '; 
		if($i >= $pagenum+4){
			 break; } 
		}
		 if ($pagenum != $last) { 
		 $next = $pagenum + 1; 
		 $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a> '; } 
		
	 } 
		 
		 $list = ''; 
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$id = $row["id"];
			$first_name = $row["first_name"];
			$last_name = $row["last_name"];
			$country = $row["country"];
			$state = $row["state"];
			$profile_pic = $row["profile_pic"];
			$affected_by = $row["affected_by"];
			$list .=" <div id='people_show'><a href='view.php?id=$id'><h3>".$first_name . $last_name."</h3><p><img src='".$profile_pic."' width='150' height='' /></p></a><p>".$state."," . $country."</p><p>I am a victim of $affected_by</p><button id='button'><a href='view.php?id=$id'>Help Me</a></button></div>";
			
			}
			mysqli_close($conn);

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
        	<form action="" method="post" >
     Country: 
        <select onChange="print_state('state', this.selectedIndex);" id="country" name ="country" ></select>
    
    City/District/State:
     <select name ="state" id ="state"  ></select>
      <script language="javascript">print_country("country");</script>
      <br><br>
     <input type="text" size="10" name="postcode" placeholder="Postcode"  />
    
     <input type="text" size="20" name="street_village" placeholder="Street/ Village" /> &nbsp; &nbsp;<input type="submit" name="search" value="Search" />
    
     
            </form>
            
           
            
            
            
            
            
            
            
            	<div> 
		<h2><?php echo $textline1; ?> victim people</h2> 
		<p><?php echo $textline2; ?></p> 
		<p><?php echo $list; ?></p> 
		<div id="pagination_controls"><?php echo $paginationCtrls; ?></div> 
	
        
        
      <?php require_once("footer.php"); ?> 