<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <section class="container">

        <header>Regisrtation Form</header>

        <?php
        require("./env.php");


        if (isset($_POST["submit"])) {
            $fullname = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repassword = $_POST["repassword"];
            $errors = array();

            if (empty($fullname) || empty($email) || empty($password) || empty($repassword)) {
                array_push($errors, "All fields are required");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password should be at least 8 characters long");
            }
            if ($password !== $repassword) {
                array_push($errors, "Passwords do not match");
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                // Database connection
                $conn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Prepared statement to prevent SQL injection
                $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $password);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
        }
        ?>




        <form action="registration.php" method="post" class="form">

            <div class="input_box">
                <label>Full name</label>
                <input type="text" name="fullname" placeholder="Enter your name">
            </div>
            <div class="input_box">
                <label>Email address</label>
                <input type="email" name="email" placeholder="Enter email address">
            </div>
            <div class="input_box">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your Password">
            </div>
            <div class="input_box">
                <label>Re-Password</label>
                <input class="re" type="password" name="repassword" placeholder="Repeat your Password">
            </div>

            <div class="input_box">
                <input class="mybtn" type="submit" value="Register" name="submit">
            </div>

            <!-- <button type="submit">Register</button> -->
        </form>
        <div>
            <p>Alredy Registerd <a href="login.php">Login here</a></p>
        </div>
    </section>


    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>