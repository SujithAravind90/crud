<?php
session_start();

require_once './Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '1405262733404920',
  'app_secret' => 'c7c4a22a3df28f38ccb11c922db82eca',
  'default_graph_version' => 'v12.0',
]);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('https://your-website.com/fb-callback.php', $permissions);

?>

<?php

include('connect.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "select * from user where email='$email' and password='$password'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        header("location:output.php");
        exit();
    } else if (empty($email || $password)) {
        $_SESSION["loggedin"] = false;
        echo '<script>
        window.location.href = "login.php";
        alert("Email or Password is empty")
        </script>';
        exit();
    } else {
        $_SESSION["loggedin"] = false;
        echo '<script>
        window.location.href = "login.php";
        alert("Invalid email or password")
        </script>';
        exit();
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login crud</title>
</head>

<body>
    <div class="container my-5">
        <h2>LOGIN USER</h2>
        <form method="post">
            <div class="form-group mb-3">
                <label>Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button class="btn btn-primary" name="login">Login</button>
            <a href="index.php" class="btn btn-primary text-light" name="signup">Signup</a>
            <a  class="btn btn-success" href="<?php echo htmlspecialchars($loginUrl); ?>">Facebook</a>
        </form>
    </div>
</body>

</html>