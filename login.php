<?php
require 'config.php';

session_start();
if (isset($_SESSION['admin_username'])) {
    header("location:dashboard.php");
}

$username = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    if (mysqli_num_rows($query) != 0) {
        $row = mysqli_fetch_assoc($query);

        session_start();
        $_SESSION['id'] = $row['id'];
        header("location:dashboard.php");
    } else {
        header("location:login.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center container " style="height: 100vh;">


        <div class="container bg-dark text-light p-5 rounded shadow" style="width: 50%;">
            <?php
            if ($err) {
                echo "<ul>$err</ul>";
            }
            ?>
            <h3 class="my-3">
                Login Page
            </h3>
            <form method="post" action="">
                <input placeholder="User" name="username" value="<?php echo $username ?>" class="form-control my-3" />
                <input placeholder="Password" name="password" class="form-control my-3" type="password" />
                <button name="login" class="btn btn-primary my-2" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>