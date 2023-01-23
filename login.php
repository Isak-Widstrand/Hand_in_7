<?php

$sql = "SELECT * FROM users";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);
$result = $conn->query($sql);

$login_success = false;
$full_name = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (
            $row["userId"] == $_POST["username"] &&
            $row["passwd"] == $_POST["password"]
        ) {
            $login_success = true;
            $full_name = $row["firstname"] . " " .
                $row["lastname"];
        }
    }
} else {
    echo "0 results";
}
$conn->close();

if ($login_success = true) {
    $_SESSION["validateToken"] = true;
    echo'
    <form action="upload.php" method="post" enctype="multipart/form-data">
    Välj en fil att ladda upp:
    <input type="file" name="fileToUpload" id="fileToUpload" />
    <input type="submit" value="Ladda upp" name="submit" />
  </form>';
} 

if($login_success) {
	session_start();
	$_SESSION["username"] = $_POST["username"];
}

?>

<a href="inloggning.html"> Hemknapp</a>