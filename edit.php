<?php 
require_once 'config.php';

$get_id = $_REQUEST['id'];
$sql = "SELECT * FROM `student` WHERE `student_id` = " . $get_id;
$query = $db->query($sql);
$row = $query->fetch_assoc();

if (isset($_POST['btnsubmit'])) {
	$student_id = $db->real_escape_string($_POST['student_id']);
	$firstname = $db->real_escape_string($_POST['firstname']);
	$lastname = $db->real_escape_string($_POST['lastname']);
	$address = $db->real_escape_string($_POST['address']);
	$contactno = $db->real_escape_string($_POST['contactno']);

	$sql = "UPDATE `student` SET 
			`firstname` = '". $firstname  . "',
			`lastname` = '". $lastname  . "',
			`address` = '". $address  . "',
			`contactno` = '". $contactno  . "'
			WHERE `student_id` = " . $student_id;
	$result = $db->query($sql);

	if ($result === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $db->error;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit</title>
</head>
<body>
<h2>Edit Student</h2>
<form method="post">
	<input type="hidden" value="<?=$get_id?>" name="student_id">
	First Name: <input type="text" name="firstname" value="<?=$row['firstname']?>"><br />
	Last Name: <input type="text" name="lastname" value="<?=$row['lastname']?>"><br />
	Address: <input type="text" name="address" value="<?=$row['address']?>"><br />
	Contact No.: <input type="text" name="contactno" value="<?=$row['contactno']?>"><br />
	<input type="submit" value="Save" name="btnsubmit"> &nbsp;&nbsp;&nbsp;
	<a href="index.php">Back to Student List</a>
</form>
</body>
</html>