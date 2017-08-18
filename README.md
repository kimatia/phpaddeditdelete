# php-mysqli-oop

Simple PHP MySQLi Object Oriented

PHP MySQLi = PHP MySQL Improved!

The MySQLi functions allows you to access MySQL database servers

Note: The MySQLi extension is designed to work with MySQL version 4.1.13 or newer.

## Database and Table
- Create new database named "phptutorial"
- Create table named "student"
```
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(75) NOT NULL,
  `contactno` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

## Open a Connection to MySQL
```
define("HOST",               "localhost");
define("USERNAME",           "root");
define("PASSWORD",           "");
define("DBNAME",             "phptutorial");
define("PORT",               "3306");

$db = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);

if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}
```

## Display all Student
```
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
```

## Insert new Student
```
$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$contactno = $_POST['contactno'];

	$sql = "INSERT INTO `student`(`firstname`,`lastname`,`address`,`contactno`) 
  VALUES('". $firstname  . "','". $lastname  . "','". $address  . "','". $contactno  . "')";
	$result = $db->query($sql);

	if ($result === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}
```

## Get Student Information by ID
```
$get_id = $_REQUEST['id'];
$sql = "SELECT * FROM `student` WHERE `student_id` = " . $get_id;
$query = $db->query($sql);
$row = $query->fetch_assoc();
echo $row['firstname'];
echo $row['lastname'];
echo $row['address'];
echo $row['contactno'];
```

## Update Student
```
$student_id = $_POST['student_id'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$contactno = $_POST['contactno'];

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
```


# Delete Student
```
$get_id = $_REQUEST['id'];
$sql = "DELETE FROM `student` WHERE `student_id` = " . $get_id;
$result = $db->query($sql);

if ($db->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
```

### [Demo here](http://jaysonsarino.com/phptutorial/php-mysqli-oo).
