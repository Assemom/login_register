<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>

    <?php

    require("./env.php");

    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

        print_r($user);

        if ($user) {
            if ($password == $user["password"]) {
                header("location: index.php");
                die();
            } else {
                echo "<div class='alert alert-danger'>Password does not Exist</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Email does not Exist</div>";
        }
    }

    ?>

    <section class="container">
        <header class="login-header">Login Page</header>
        <form action="login.php" method="post" class="form">

            <div class="input_box">
                <label>Email address</label>
                <input type="email" name="email" placeholder="Enter email address" required>
            </div>
            <div class="input_box">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your Password" required>
            </div>
            <div class="input_box">
                <input class="mybtn" type="submit" value="Login" name="login">
            </div>
        </form>
        <div>
            <p>Not registered here <a href="registration.php">Register Here</a></p>
        </div>
    </section>

    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>