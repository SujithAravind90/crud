<?php
session_start();
?>

<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $qualification = $_POST['qualification'];

    if (empty($name || $email || $password || $qualification)) {
        echo '<script>
        window.location.href = "index.php";
        alert("fields are empty")
        </script>';
        exit();
    } else if (empty($name)) {
        echo '<script>
        window.location.href = "index.php";
        alert("name is  empty")
        </script>';
        exit();
    } else if (empty($email)) {
        echo '<script>
        window.location.href = "index.php";
        alert("Email is  empty")
        </script>';
        exit();
    } else if (empty($password)) {
        echo '<script>
        window.location.href = "index.php";
        alert("password is  empty")
        </script>';
        exit();
    } else if (empty($qualification)) {
        echo '<script>
        window.location.href = "index.php";
        alert("Qualification is  empty")
        </script>';
        exit();
     } else {
        header("location:output.php");
     }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $qualification = $_POST['qualification'];

    $sql = "insert into `user` (`name`,`email`,`password`) values('$name','$email','$password')";

     mysqli_query($con, $sql);

    $sql1 = "SELECT id from user where email='$email'";

    $id_val= mysqli_query($con, $sql1);

    $row = mysqli_fetch_assoc($id_val);

    $id= $row["id"];

    $sql2 = "insert into `quali` (`id`,`qualification`) values('$id','$qualification')";

    $result = mysqli_query($con, $sql2);

    if ($result) {
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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

    <title>Crud Form</title>
</head>

<body>
    <div class="container my-5">
        <h2>ADD USER </h2>
        <form method="post">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter Name" name="name">

            </div>
            <div class="mb-3">
                <label>Email address</label>
                <input type="text" class="form-control" placeholder="Enter Email" name="email">

            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="mb-3">
                <label>Qualification</label>
                <input type="text" class="form-control" placeholder="Your qualification" name="qualification">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="output.php" class="btn btn-danger text-light" name="cancel">cancel</a>
        </form>
    </div>

</body>

</html>