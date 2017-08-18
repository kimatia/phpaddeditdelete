<?php 
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Home</title>
</head>
<body>
<?php

$content = "<a href='add.php'>Add New Student</a><br /><br />";
$query = "SELECT * FROM `student` ORDER BY `lastname`";
$result = $db->query($query);
if ($result->num_rows > 0) {
	$content .= "<table border='1' width='600px'>";
	$content .= "<tr>";
	$content .= 	"<th>Last Name</th>";
	$content .= 	"<th>First Name</th>";
	$content .= 	"<th>Address</th>";
	$content .= 	"<th>Contact No.</th>";
	$content .= 	"<th>Options</th>";
	$content .= "</tr>";
	while($row = $result->fetch_assoc()) {
		$content .= "<tr>";
		$content .=	 "<td>" . $row['lastname'] . "</td>";
		$content .=	 "<td>" . $row['firstname'] . "</td>";
		$content .=	 "<td>" . $row['address'] . "</td>";
		$content .=	 "<td>" . $row['contactno'] . "</td>";
		$content .=	 "<td>";
		$content .=		 "<a href='edit.php?id=".$row['student_id']."'>Edit</a> | ";
		$content .=		 "<a href='delete.php?id=".$row['student_id']."'>Delete</a>";
		$content .=	 "</td>";
		$content .= "</tr>";
	}
	$content .= "</table>";
} else {
	$content .= "No student found.";
}
echo $content;
?>
</body>
</html>