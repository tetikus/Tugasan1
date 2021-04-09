<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = 0;
$update = false;
$fullname = "";
$gender = "";
$class = "";
$club = "";


//INSERT DATA
if (isset($_POST['submit'])) {

    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $club = $_POST['club'];


    $conn->query("INSERT INTO registration (fullname, gender, class, club) VALUES ('$fullname', '$gender', '$class', '$club')") or
        die($conn->error);

    $_SESSION['message'] = "Your Data has been recorded";

    header("location: index.php");
}

//DELETE DATA
$result = $conn->query("SELECT * FROM registration") or die($conn->error);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM registration WHERE id=$id") or
        die($conn->error);

    $_SESSION['message'] = "Your Data has been Deleted";

    header("location: index.php");
}

//EDIT DATA
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $conn->query("SELECT * FROM registration WHERE id=$id") or
        die($conn->error);
    echo "Data Retrieved";

    $row = $result->fetch_array();
    $fullname = $row['fullname'];
    $gender = $row['gender'];
    $class = $row['class'];
    $club = $row['club'];
}

//UPDATE DATA
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $club = $_POST['club'];

    $conn->query("UPDATE registration SET fullname='$fullname', gender='$gender', class='$class', club='$club' WHERE id=$id") or
        die($conn->error);

    $_SESSION['message'] = "Record already edited!";

    header("location: index.php");
}
