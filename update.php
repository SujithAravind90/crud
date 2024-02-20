<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false) {
    header("Location: login.php");
}
?>

<?php
include 'connect.php';

$id = $_GET['updateid'];
$sql = "SELECT * FROM user WHERE id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$name=$row['name'];
$email=$row['email'];
$password=$row['password'];

$sql2 = "SELECT * FROM quali WHERE id='$id'";
$result2 = mysqli_query($con,$sql2);
$row = mysqli_fetch_assoc($result2);
$qualification=$row['qualification'];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $qualification = $_POST['qualification'];

    $sql = "update `user` set id='$id',name='$name',email='$email',password='$password' where id='$id'";
    $result = mysqli_query($con, $sql);

    $sql2 = "update `quali` set id='$id',qualification='$qualification' where id='$id'";
    $result2 = mysqli_query($con, $sql2);

    if ($result && $result2) {
        header('location:output.php');
    } else {
        die(mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crud Form</title>
    <script>
        var inactiveTime = 0;
        function resetInactiveTime() {
            inactiveTime = 0;
        }
        function checkInactivity() {
            inactiveTime++;
            if (inactiveTime >= 10) { 
                window.location.href = 'destroy.php';
            }
        }
        document.addEventListener('mousemove', resetInactiveTime);
        document.addEventListener('keypress', resetInactiveTime);
        setInterval(checkInactivity, 1000);
    </script>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value=<?php echo $name?> autocomplete="off" required>   
            </div>
            <div class="mb-3">
                <label>Email address</label>
                <input type="text" class="form-control" name="email" value=<?php echo $email?> autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value=<?php echo $password?> required>
            </div>
            <div class="mb-3">
                <label>Qualification</label>
                <input type="text" class="form-control" name="qualification" value=<?php echo $qualification?> autocomplete="off" required>
            </div>
            <button type="update" class="btn btn-primary" name="update">update</button>
            <a href="output.php" class="btn btn-danger text-light" name="cancel">cancel</a>
        </form>
    </div>

</body>

</html>