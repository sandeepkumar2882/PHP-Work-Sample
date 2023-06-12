<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="../css/form.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,800">
<script type="text/javascript" src="./js/login-toggle.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.js" defer></script>

<div class="container login-screen">
    <div class="form-container row p-5">
        <div class="details-wrapper col-md-6 pe-md-5">
            <div class="login">
                <h2 class="text-light">Add Admin</h2>
            </div>
            <div class="eula">
                <p>To add another admin, Just fill the form and click on Sign Up button</p>
            </div>
        </div>
        <div class="form-wrapper col-md-6">
            <?php
            if (isset($_SESSION['insert'])) //Checking Whether the Session is set or not
            {
                echo $_SESSION['insert']; //Display Session Message
                unset($_SESSION['insert']); //Remove Session Message
            }
            ?>
            <form action="" method="POST" class="form form-group">
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" id="full_name">
                <label for="email">Username | Email</label>
                <input type="email" name="user_name" id="user_name">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <!-- <input type="submit" name="submit" class="btn btn-primary submit-btn" id="submit" value="Login"> -->
                <button type="submit" name="submit" class="btn btn-primary submit-btn custom-btn" id="submit"><span>Click!</span><span>Sign Up</span></button>
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

<?php include('partials/footer.php'); ?>

<?php

//When you don't handle the errors you will get 500 internal server errors and you will not know what's wrong. Always handle errors.

//Check the submit button is clicked or not
if (isset($_POST['submit'])) {

    //Get data from Form
    $fullName = $_POST['full_name'];
    $userName = $_POST['user_name'];
    $password = PASSWORD_HASH($_POST['password'], PASSWORD_DEFAULT); //Password Encryption with MD5

    //SQL Query to insert data in tbl_admin table
    $sql = "INSERT INTO tbl_admin (full_name,user_name,password) values ( '$fullName','$userName','$password')";

    // Execute the query
    $result = $connection->query($sql);

    //Check the query
    if ($result == true) {
        $_SESSION['insert'] = '<div class="success">' . $fullName . ' Added as Admin Successfully </div>';
        header('Location:' . SITEURL . '/admin/manage-admin.php');
    } else {
        $_SESSION['insert'] = '<div class="error">' . $fullName . ' Failed to Add, Try Again! </div>';
        header('Location:' . SITEURL . '/admin/add-admin.php');
    }
}
?>