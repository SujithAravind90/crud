<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false) {
    header("Location: login.php");
}
?>   

<?php
include 'connect.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Form</title>
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

</head>

<body>
    <div class="container">
    <h2 class="my-3">USER TABLE</h2><a href="index.php" class="btn btn-primary my-3 text-light">Add user</a> 
        <table class="table my-3">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Qualification</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT user.id,user.name,user.email,user.password,quali.key_id,quali.qualification
                FROM user
                INNER JOIN quali ON user.id=quali.id;";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $qualification = $row['qualification'];

                        echo ' <tr>
        <th scope="row">' . $id . '</th>
        <td>' . $name . '</td>
        <td>' . $email . '</td>
        <td>' . $password . '</td>
        <td>' . $qualification . '</td>
        <td>
        <a href="update.php? updateid=' . $id . '" class="btn btn-primary text-light">update</a>
        <a href="delete.php? deleteid=' . $id . '" class="btn btn-danger text-light">delete</a>
        </td>
      </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="destroy.php"  class="btn btn-primary text-light my-5" id="logout">Logout</a>
        
    </div>

</body>

</html>
<script>
   $(document).ready(function(){
  $("#logout").click(function(){
    alert("confirm Logout");
  });
});
</script>