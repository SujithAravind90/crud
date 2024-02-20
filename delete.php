<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false) {
    header("Location: login.php");
}
?>

<?php
include 'connect.php';

if (isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];
    $key_id = $_GET['deleteid'];

    $sql2 = "delete from `quali` WHERE id=$id";
    $result2 = mysqli_query($con, $sql2);

    $sql = "delete from `user` WHERE id=$id";
    $result = mysqli_query($con, $sql);

    if ($result && $result2) {
        header('location:output.php');
        exit();
    } else {
        die(mysqli_error($con));
    }
}
?>