<?php


define("HOST", "localhost");
define("DATABASE", "db1");
// magical
define("U_R", "transMAGIC");
define("P_R", "bFYRFWc2jupQ9xbK");
$dbMAGIC = new PDO('mysql:host=localhost;dbname=db1', U_R, P_R);

$haveResult = false;
if(isset($_POST['reservationId'])){
		$delete = $dbMAGIC->prepare("DELETE FROM reservations WHERE id = :id");
		$delete->bindParam(':id', $_POST['reservationId'], PDO::PARAM_INT);
		$delete->execute();	
		header('Location: calendarDemo.php');
}else if(isset($_GET['id'])) {
	$resId = $_GET['id'];
	$reserve = $dbMAGIC->prepare("SELECT * FROM reservations WHERE id = :id LIMIT 1");
	$reserve->bindParam(':id', $resId, PDO::PARAM_INT);
	$reserve->execute();
	$reserve = $reserve->fetchAll();
	if(count($reserve)>0) {
		$reserve = $reserve[0];
		$haveResult = true;
	}


/*
if(isset($_POST['delete'])){
       $id = $_POST['delete_rec_id'];  
       $query = "DELETE FROM notes WHERE id=$id"; 
       $result = mysql_query($query);
}

    $query = "SELECT * FROM notes WHERE subject='Work' order by id desc";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) { 
            $id = $row['id'];
            $subject = $row['subject'];
            $date = $row['date'];
            $note = $row['note']; 

            print "<p><strong>$subject</strong> ($id), $date </p>"; 
            print "<p> $note </p>";        
    }  

if(isset($_POST['edit'])){
       $id = $_POST['edit_rec_id'];  
       $query = "EDIT FROM notes WHERE id=$id"; 
       $result = mysql_query($query);
}
*/
?>



<!DOCTYPE html>
<html>
<head>
<style>
h2{
	position: relative;
	left: 150px;
	font-size: 32px;
	font-family: Zapf Chancery;
	height: 35px;
}
</style>
</head>

<body>
<style>
	#printOutForm{
		width: 670px;
	}
/* Client Information Section  */
	#clientInfo{
		position: relative;
		height: 150px;
		width: 100%;
	}
	#clientLabels{
		position: relative;
		display: inline;
		float: left;
		top: 6px;
		width: 20%;
		height: 30px;
		font-size: 24px;
	}
	#clientText{
		display: inline;
		position: relative;
		float: right;
		width: 80%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
/* -------------------------- */
/* Emergency Contact Information */
	#emergencyInfo{
		position: relative;
		height: 60px;
		width: 100%;	
	}
	#emerLabels{
		position: relative;
		display: inline;
		float: left;
		top: 6px;
		width: 40%;
		height: 30px;
		font-size: 24px;
	}
	#emerText{
		display: inline;
		position: relative;
		float: right;
		width: 60%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
/* ------------------------- */
/* Pick Up Information */
	#pickUpInformation{
		position: relative;
		height: 150px;
		width: 100%;
	}
	#pickUpLabels{
		position: relative;
		display: inline;
		float: left;
		top: 6px;
		width: 40%;
		height: 30px;
		font-size: 24px;
	}
	#pickUpText{
		display: inline;
		position: relative;
		float: right;
		width: 60%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#pickUpAddr{
		position: relative;
		height: 90px;
		width: 100%;	
	}
	#pickUpAddrLabel{
		position: relative;
		display: inline;
		float: left;
		top: 6px;
		width: 40%;
		height: 100%;
		font-size: 24px;
	}
	#pickUpAddrText{
		position: relative;
		display: inline;
		float: right;
		width: 60%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	
/* ------------------------- */
/* Destination Information */
	#destInfo{
		position: relative;
		height: 150px;
		width: 100%;
	}
	#destLabels{
		position: relative;
		display: inline;
		float: left;
		top: 8px;
		width: 40%;
		height: 30px;
		font-size: 24px;
	}
	#destText{
		display: inline;
		position: relative;
		float: right;
		width: 60%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#destAddr{
		position: relative;
		height: 100px;
		width: 100%;	
	}
	#destAddrLabels{
		position: relative;
		display: inline;
		float: left;
		top: 8px;
		width: 40%;
		height: 100%;
		font-size: 24px;
	}
	#destAddrText{
		position: relative;
		display: inline;
		float: right;
		width: 60%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
/* ----------------------- */
/* Miscellanious Information */
	#Miscellanious{
		position: relative;
		height: 90px;
		width: 100%;
	}
	#reasonLabel{
		position: relative;
		display: inline;
		float: left;
		top: 6px;
		width: 40%;
		height: 30px;
		font-size: 24px;
	}
	#reasonText{
		display: inline;
		position: relative;
		float: right;
		width: 60%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#missLabel{
		position: relative;
		display: inline;
		float: left;
		top: 6px;
		width: 60%;
		height: 30px;
		font-size: 24px;
	}
	#missText{
		display: inline;
		position: relative;
		float: right;
		top: 6px;
		width: 40%;
		height: 30px;
		font-size: 24px;
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
/* ---------------------------- */
/* Driving Information */
	#drivingInfo{
		position: relative;
		height: 30px;
		width: 100%;
	}
	#vehicleId{
		display: inline;
		position: relative;
		float: right;
		height: 100%;
		width: 48%;	
	}
	#driverName{
		display: inline;
		position: relative;
		float: left;
		height: 100%;
		width: 48%;	
	}
	#drivingLabel{
		position: relative;
		display: inline;
		float: left;
		top: 10px;
		width: 30%;
		height: 30px;
		font-size: 24px;
	}
	#drivingText{
		display: inline;
		position: relative;
		float: right;
		top: 6px;
		width: 70%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
/* -------------------- */
/*  Notes Information */
	#notesInfo{
		position: relative;
		width: 100%;
		height: 90px;
	}
	#notesLabel{
		position: relative;
		display: inline;
		float: left;
		width: 15%;
		height: 30px;
		top: 10px;
		font-size: 24px;	
	}
	#notestopText{
		position: relative;
		display: inline;
		float: right;
		width: 85%;
		top: 10px;
		font-size: 24px;
		height: 30px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 	
	}
	#notesbotText{
		display: inline;
		float: left;
		width: 100%;
		position: relative;
		top: 10px;
		font-size: 24px;
		height: 30px;
		top: 5px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
/* ----------------------------- */
/* Verification Information */
	#verifyInfo{
		position: relative;
		height: 30px;
		width: 100%;
	}
	#driverDate{
		display: inline;
		position: relative;
		float: right;
		height: 100%;
		width: 48%;	
	}
	#driverInitials{
		display: inline;
		position: relative;
		float: left;
		height: 100%;
		width: 48%;	
	}
	#initialsLabel{
		position: relative;
		display: inline;
		float: left;
		top: 10px;
		width: 60%;
		height: 30px;
		font-size: 24px;
	}
	#initialsText{
		display: inline;
		position: relative;
		float: right;
		top: 6px;
		width: 40%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
	#driverDateLabel{
		position: relative;
		display: inline;
		float: left;
		top: 10px;
		width: 20%;
		height: 30px;
		font-size: 24px;
	}
	#driverDateText{
		display: inline;
		position: relative;
		float: right;
		top: 6px;
		width: 80%;
		height: 30px;
		font-size: 24px;
		border-bottom: 1px solid black; 
		color: <?php if($haveResult){echo($reserve['vehicleColor']);} ?>; 
	}
/*----------------------------*/
/* buttons */
	#buttons{
		position: absolute;
		top: 915px;
		height: 30px;
		width: 100%;
	}
	.delete{
	    height:50px;
	    width: 20%;
	    float: left;
	    background: white;
	    background-size: contain;

	}
	.printButton{
	    height:50px;
	    width: 45%;
	    float: left;
	   	background: white;
	    background-size: contain;
	}
	.editButton{
	    height: 50px;
	    width: 20%;
	    float: left;
	    background: white;
	    background-size: contain;
	}
</style>	
</body>
<!-- <footer>
<style>
	footer{
		position: relative;
		width: 670px;
		height: 50px;
		background-color: black;
		text-align: right;
		color: white;
	}
</style>
</footer> -->

<head>
	<h2>Appointment and Travel Info</h2>
</head>

<body>
	<div id="printOutForm">
		
		<!-- Client Information Block -->
		<div id = "clientInfo">
			<label id ="clientLabels">Client Name: </label>	
			<label id="clientText"><?php if($haveResult){echo($reserve['name']);} ?></label>
		
			<label id ="clientLabels">Phone #: </label>	
			<label id="clientText"><?php if($haveResult){echo($reserve['phone']);} ?></label>
			
			<label id ="clientLabels">Disability: </label>	
			<label id="clientText"><?php if($haveResult){echo($reserve['disability']);} ?></label>
			
			<label id ="clientLabels">Waiver: </label>	
			<label id="clientText"><?php if($haveResult){echo($reserve['waiver']);} ?></label>
			
			<label id ="clientLabels">Tickets: </label>	
			<label id="clientText"><?php if($haveResult){echo($reserve['ticket']);} ?></label>
			
		</div>
		
		<!-- Emergency Information Block -->
		<div id = "emergencyInfo">
			<label id ="emerLabels">Emergency Contact Name: </label>	
			<label id="emerText"><?php if($haveResult){echo($reserve['emergName']);} ?></label>
			
			<label id ="emerLabels">Emergency Contact #: </label>	
			<label id="emerText"><?php if($haveResult){echo($reserve['emergPhone']);} ?></label>
		
		</div>

		<!-- Pick Up Information Block -->
		<div id = "pickUpInfo">
			
			<label id ="pickUpLabels">Appointment Date: </label>	
			<label id="pickUpText"><?php if($haveResult){echo($reserve['pickDate']);} ?></label>
			
			<label id ="pickUpLabels">Pick-up Time: </label>	
			<label id="pickUpText"><?php if($haveResult){echo($reserve['pickTime']);} ?></label>
			
			<label id ="pickUpLabels">Phone # at Pick-up: </label>	
			<label id="pickUpText"><?php if($haveResult){echo($reserve['pickPhone']);} ?></label>
			
			<div id = "pickUpAddr">
				<label id ="pickUpAddrLabel">Pick-up Location: </label>	
				<label id="pickUpAddrText"><?php if($haveResult){echo($reserve['pickDescription']);} ?></label>
				<label id="pickUpAddrText"><?php if($haveResult){echo $reserve['pickAddr1'].' '.$reserve['pickAddr2'];} ?></label>
				<label id="pickUpAddrText"><?php if($haveResult){echo $reserve['pickCity'].", ".$reserve['pickZip'];} ?></label>
			</div>
			
		</div>
		
		<!-- Destination Information Block -->
		<div id = "destInfo">
			
			<label id ="destLabels">Appointment Time: </label>	
			<label id="destText"><?php if($haveResult){echo($reserve['destTime']);} ?></label>		
			
			<label id ="destLabels">Phone # at Destination: </label>	
			<label id="destText"><?php if($haveResult){echo($reserve['destPhone']);} ?></label>
			
			<div id = "destAddr">
				<label id ="destAddrLabels">Address of Appointment: </label>	
				<label id="destAddrText"><?php if($haveResult){echo($reserve['destDescription']);} ?></label>
				<label id="destAddrText"><?php if($haveResult){echo $reserve['destAddr1'].' '.$reserve['destAddr2'];} ?></label>
				<label id="destAddrText"><?php if($haveResult){echo $reserve['destCity'].", ".$reserve['destZip'];} ?></label>
			</div>
		</div>
		
		<!--  Miscellanious Information -->
		<div id = "Miscellanious">
			<label id ="reasonLabel">Reason for Appointment: </label>	
			<label id="reasonText"><?php if($haveResult){echo($reserve['reason']);} ?></label>	
			
			<label id ="missLabel">New Patient: </label>	
			<label id ="missText"><?php if($haveResult){echo($reserve['newPatient']);} ?></label>

			<label id ="missLabel">Needs Assistance with Paperwork: </label>	
			<label id="missText"><?php if($haveResult){echo($reserve['assistance']);} ?></label>

		</div>
		
		<!--  Driving Information -->
		<div id = "drivingInfo">
			<div id = "driverName">
				<label id ="drivingLabel">Driver: </label>
				<label id="drivingText"><?php if($haveResult){echo($reserve['driverName']);} ?></label>

			</div>
			
			<div id = "vehicleId">
				<label id ="drivingLabel">Vehicle: </label>	
				<label id="drivingText"><?php if($haveResult){echo($reserve['vehicleColor']);} ?></label>
			</div>
			
		</div>
		
		<!--  Driving Information -->
		<div id = "notesInfo">
			<label id ="notesLabel">Notes: </label>	
			<label id="notestopText"></label>
			<label id="notesbotText"></label>
			<label id="notesbotText"></label>
		</div>
		
		<div id = "verifyInfo">
			<div id = "driverInitials">
				<label id ="initialsLabel">(Driver's Initials): </label>	
				<label id="initialsText"></label>
			</div>
			<div id = "driverDate">
				<label id ="driverDateLabel">Date: </label>	
				<label id="driverDateText"></label>
			</div>
		</div>		
	</div>
	<div id="buttons">
		<button class="editButton" name="edit" onclick="<?php echo("location.href='editForm.php?id=".$resId."'")?> ;">Edit Reservation</button>
		<button class="printButton" name="print" onClick="window.print()">Print Reservation</button>
		<form name = "printOutForm" action="printOutForm.php" method="post">
			<input type="hidden" name="reservationId" value="<?php if($haveResult){echo($resId);} ?>">
			<input type="submit" name="deleteButton" class="delete" value="Delete Reservation">
		</form>
	</div>


</body>
<!-- <footer>
	@AIBD Transportation Center
</footer> -->
		<!-- 
			
		
		<div id = "verifyBlock">
			<label id ="sigLabel">(Driver's Initials): </label>	
			<label id="sigText"></label>
			<label id="dateText"></label>
			<label id ="dateLabel">Date: </label>	
		</div> -->
	
	<!--
	//print button starts here
	<input name="print" type="print" value="Print Reservation">
	
	//delete button starts here
    <form id="delete" method="post" action="">
    <input type="hidden" name="delete_rec_id" value="<?php print $id; ?>"/> 
    <input type="submit" name="delete" value="Delete"/>    
	</form>
	
	//edit button starts here
	<form id="edit" method="post" action="">
	<input type="" name="edit_rec_id" value="<?php print $id; ?>"/>
	<input type="submit" name="edit" value="Edit" onclick="location.href='insertFrom.php';">
	</form>
	-->
	
	
</html>
<?php
}
?>