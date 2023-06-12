<?php include('../config/constants.php') ?>
<html>

<head>
    <title>Login - Admin</title>
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,800">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container login-screen">
        <div class="form-container row p-5">
            <div class="details-wrapper col-md-6 pe-md-5">
                <div class="login">
                    <h2 class="text-light">Login</h2>
                </div>
                <div class="eula">
                    <p>By logging in you agree to the ridiculously long terms that you didn't bother to read</p>
                </div>
            </div>
            <div class="form-wrapper col-md-6">
                <form action="" method="POST" class="form form-group">
                    <label for="email">Username | Email</label>
                    <input type="email" name="username" id="user_name">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <!-- <input type="submit" name="submit" class="btn btn-primary submit-btn" id="submit" value="Login"> -->
                    <button type="submit" name="submit" class="btn btn-primary submit-btn custom-btn" id="submit" class="custom-btn"><span>Click!</span><span>Logindiv.custom-menu-class ul {
    margin:20px 0px 20px 0px;
    list-style-type: none;
    list-style: none;
    list-style-image: none;
    text-align:right;
    display:inline-block;
}
div.custom-menu-class li {
    padding: 0px 20px 0px 0px;
    display: inline-block;
} 
 
div.custom-menu-class a {
    color:#000;
}</span></button>
                    <div>
                        <?php
                        //session message
                        if (isset($_SESSION['login-failed'])) //Checking Whether the Session is set or not
                        {
                            echo $_SESSION['login-failed']; //Display Session Message
                            unset($_SESSION['login-failed']); //Remove Session Message
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p class="text-center">
            Created with <i class="fa fa-heart"></i> by
            <a target="_blank" href="http://localhost:3005/">Rich Sandeep</a>
            - Review my work by clicking <a target="_blank" href="http://localhost:3005/">Here</a>.

        </p>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>

<?php

if (isset($_POST['submit'])) {
    //Process for login
    $userName = $_POST['username'];
    $password = $_POST['password'];

    //select query
    $sql = "SELECT * FROM tbl_admin WHERE user_name='$userName'";

    //execute query
    $result = $connection->query($sql);

    //count the rows
    $count = $result->num_rows;

    if ($count == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {

            //Create a session variable for checking the user is logged in or not (logout will unset it)
            $_SESSION['user'] = $userName;

            $_SESSION['login'] = "<div class='success'> Logged In Successfully! </div>";
            header('Location:' . SITEURL . '/admin');
        } else {
            $_SESSION['login-failed'] = "<div class='error'> Login Failed, Invalid Credentials! </div>";
            header('Location:' . SITEURL . '/admin/login.php');
        }
    } else {
        $_SESSION['login-failed'] = "<div class='error'> User not exists! </div>";
        header('Location:' . SITEURL . '/admin/login.php');
    }
}

?>